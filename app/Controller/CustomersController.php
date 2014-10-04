<?php

/*
 * ***********************************************************************************
 * Customers Controller
 * Functionality		 :	User related function used for all types of users
 * including super administrator,client user,QA type of users,admin type of users
 * ***********************************************************************************
 */

App::uses('AppController', 'Controller');
// App::uses('ConnectionManager', 'Model');
App::uses('Sanitize', 'Utility');

class CustomersController extends AppController {

    public $name = 'Customers';
    public $uses = array('Customer');
    public $helpers = array('Html', 'Form', 'Session', 'Js', 'Paginator', 'Common', 'Time');
    public $components = array('Email', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    
    public function admin_index() {
        $this->loadModel('Customer');
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', ' Customers');
        if ($this->request->isGet() && isset($_GET['search'])) {
            $condition = array('Customer.is_deleted !=' => 1, 'OR' => array('Customer.username LIKE' => "{$_GET['search']}%", 'Customer.first_name LIKE' => "{$_GET['search']}%", 'Customer.last_name LIKE' => "{$_GET['search']}%", 'Customer.email LIKE' => "{$_GET['search']}%"));
        } else {
            $condition = array('Customer.is_deleted !=' => 1);
        }
        $this->paginate = array(
            'conditions' => $condition,
            'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'Customer.created DESC'
        );
        $data = $this->paginate('Customer');
        pr($data);exit;
        $this->set(compact('data'));
    }        
    
    


    
    
    
//------------------  old code need to delete ----------------------------------//    
    
    public function admin_login() {

        if ($this->Session->check('SUPER_ADMIN') || $this->Session->check('UserID')) {
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
        }

        $this->layout = 'login_layout';
        if ($this->request->is('post')) {
            $data = $this->User->find(
                'first', array(
                'fields' => array(),
                'conditions' => array(
                    'User.password' => md5($this->request->data['User']['password']),
                    'User.user_name' => $this->request->data['User']['user_name'],
                    'User.is_deleted <>' => 1
                )
                )
            ); 
            if ($data) {
                if ($data['User']['status'] == 0) {
                    $this->Session->setFlash('Your account is blocked', 'errormessage');
                    $this->redirect(array('controller' => 'users', 'action' => 'login'));
                } else {
                    // we check here if client of that user is blocked or not
                    switch ($data['User']['user_type_id']) {
                        case 1:
                            $this->Session->write('SUPER_ADMIN', 1);
                            $this->Session->write('User', $data);
                            $this->Session->setFlash('You have been successfully logged In.', 'default', 'success');
                            $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
                            break;
                        case 2 :
                            $this->Session->write('Admin', $data);
                            $this->Session->setFlash('You have been successfully logged In.', 'default', 'success');
                            $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));exit;
                            break;
                        case 3 :
                            $this->Session->write('User', $data);
                            $this->Session->setFlash('You have been successfully logged In.', 'default', 'success');
                            $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'branchadmin' => true));
                            break;
                    }
                }
            } else {
                $this->Session->setFlash('Username and password do not match', 'errormessage');
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
            $this->request->data['User']['user_name'] = '';
            $this->request->data['User']['password'] = '';
        } else {
            // If user already logged in then redirect to dashboard
            //$this->_redirectLoggedInUser();
        }
    }

    public function admin_dashboard() {
        $this->layout = "crm_layout";
        $this->set('title_for_layout', "Dashboard");
    }

    public function branchadmin_dashboard() {
        $this->layout = "crm_layout";
        $this->set('title_for_layout', "Dashboard");
        //$this->redirect(array('controller' => 'products', 'action' => 'listproducts'));
    }

    public function forgotpassword() {
        $this->layout = 'login_layout';
        $this->set('title_for_layout', "Forgot Password");
        if ($this->request->is('post')) {
            $this->loadModel('User');
            $data = $this->User->find('first', array('fields' => array(), 'conditions' => array('User.email' => $this->request->data['User']['email'], 'User.user_name' => $this->request->data['User']['user_name'])));

            if ($data) {
                // we check here if client of that user is blocked or not
                if ($data['User']['is_blocked'] == 1) {
                    $this->Session->setFlash('Sorry! Your account has been blocked by an administrator', 'errormessage');
                    $this->redirect(array('controller' => 'users', 'action' => 'forgotpassword'));
                } else {
                    $newpassword = substr(md5(time()), 0, 6); // to generate a password of 6 characters
                    //$encpt_newpassword = md5($newpassword);
                    $encpt_newpassword = $newpassword;
                    $this->User->id = $data['User']['id'];
                    $userdata['User']['password'] = $encpt_newpassword;
                    if ($this->User->saveField('password', $userdata['User']['password'], array('validate' => false))) {
                        $this->loadModel('EmailTemplate');
                        $link = "<a href=" . Configure::read('LOGIN_URL.URL') . ">" . Configure::read('LOGIN_URL.URL') . "</a>";

                        $temp = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 1)));
                        $temp['EmailTemplate']['mail_body'] = str_replace(array('../../..', '#FIRSTNAME', '#USERNAME', '#PASSWORD', '#CLICKHERE'), array(Configure::read('FULL_BASE_URL.URL'), ucwords($data['User']['first_name']), $data['User']['user_name'], $newpassword, $link), $temp['EmailTemplate']['mail_body']);
                        $this->set('template', $temp['EmailTemplate']['mail_body']);

                        App::uses('CakeEmail', 'Network/Email');
                        $Email = new CakeEmail();
                        //$Email->template('default');
                        $Email->emailFormat('both');
                        $Email->from(array(Configure::read('Email.EmailSupport') => Configure::read('SITE_SETTINGS.Name')));
                        $Email->sender(Configure::read('Email.EmailSupport'), Configure::read('SITE_SETTINGS.Name'));
                        $Email->to($this->request->data['User']['email']);
                        $Email->subject($temp['EmailTemplate']['mail_subject']);
                        $Email->send($temp['EmailTemplate']['mail_body']);
                        $this->Session->setFlash('A new password has been send to your mailbox.', 'default', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'login'));
                    }
                }
            } else {
                $this->Session->setFlash('Username and Email do not match', 'errormessage');
                $this->redirect(array('controller' => 'users', 'action' => 'forgotpassword'));
            }
            $this->request->data['User']['user_name'] = '';
            $this->request->data['User']['email'] = '';
        }
    }

    public function admin_logout() {
        $this->Session->delete('User');
        $this->Session->delete('UserID');
        $this->Session->delete('UserTypeID');
        $this->Session->delete('SUPER_ADMIN');
        $this->redirect('/admin');
    }

    public function admin_changepassword() {
        $this->layout = 'login_layout';
        $this->set('title_for_layout', 'Change password');
        $currentUserSession = $this->Session->read('User');
        $id = $currentUserSession['User']['id'];
        $this->set('userID', $id);
        if ($this->request->is('post')) {
            $newpassword = $this->request->data['User']['password'];
            $this->User->id = $currentUserSession['User']['id'];
            if ($this->User->saveField('password', trim($newpassword), false)) {
                $this->Session->write('User.User.password', md5($this->request->data['User']['password']));
                $this->Session->setFlash('Password been successfully Changed.', 'default', 'success');
                switch ($currentUserSession['User']['user_type_id']) {
                    case Configure::read('UserType.superadmin'):
                        $this->Session->setFlash('Password has been changed successfully', 'default', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
                        break;
                    case Configure::read('UserType.user') :
                        $this->Session->setFlash('Password has been changed successfully', 'default', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
                        break;
                    case Configure::read('UserType.admin') :
                        $this->Session->setFlash('Password has been changed successfully', 'default', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
                        break;
                }
            } else {
                switch ($currentUserSession['User']['user_type_id']) {
                    case Configure::read('UserType.superadmin'):
                        $this->Session->setFlash('Oops! There is some problem while changing password', 'default', 'message');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'superadmin' => true));
                        break;
                    case Configure::read('UserType.user') :
                        $this->Session->setFlash('Oops! There is some problem while changing password', 'default', 'message');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
                        break;
                    case Configure::read('UserType.admin') :
                        $this->Session->setFlash('Oops! There is some problem while changing password', 'default', 'message');
                        $this->redirect(array('controller' => 'admins', 'action' => 'dashboard', 'admin' => true));
                        break;
                }
            }
        }
    }

    public function branchadmin_changepassword() {
        $this->layout = 'login_layout';
        $this->set('title_for_layout', 'Change password');
        $userSession = $this->Session->read('User');
        $id = $userSession['User']['id'];
        $this->set('userID', $id);
        if ($this->request->is('post')) {
            $newpassword = $this->request->data['User']['password'];
            $this->User->id = $userSession['User']['id'];
            if ($this->User->saveField('password', trim($newpassword), false)) {
                $this->Session->setFlash('Password been successfully Changed.', 'default', 'success');
                switch ($userSession['User']['user_type_id']) {
                    case Configure::read('UserType.superadmin'):
                        $this->Session->setFlash('Password has been changed successfully', 'default', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
                        break;
                    case Configure::read('UserType.branchadmin') :
                        $this->Session->setFlash('Password has been changed successfully', 'default', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
                        break;
                    case Configure::read('UserType.admin') :
                        $this->Session->setFlash('Password has been changed successfully', 'default', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
                        break;
                }
            } else {
                switch ($userSession['User']['user_type_id']) {
                    case Configure::read('UserType.superadmin'):
                        $this->Session->setFlash('Oops! There is some problem while changing password', 'default', 'message');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'superadmin' => true));
                        break;
                    case Configure::read('UserType.branchadmin') :
                        $this->Session->setFlash('Oops! There is some problem while changing password', 'default', 'message');
                        $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
                        break;
                    case Configure::read('UserType.admin') :
                        $this->Session->setFlash('Oops! There is some problem while changing password', 'default', 'message');
                        $this->redirect(array('controller' => 'admins', 'action' => 'dashboard', 'admin' => true));
                        break;
                }
            }
        }
    }

    public function ajax_check_oldpassword() {
        $this->autoRender = false;
        $count = $this->User->find('count', array(
            'conditions' => array('User.password' => md5(trim($this->params->query['data']['User']['old_password'])), 'User.id' => $this->Session->read('User.User.id')),
            'recursive' => -1
        ));
        if ($count > 0) {
            $validate = 'true';
        } else {
            $validate = 'Old password does not match.';
        }
        echo json_encode($validate);
    }

    public function rewrite_session($user_id = null) {
        $data = $this->User->find(
            'first', array(
            'fields' => array(),
            'conditions' => array('User.id' => $user_id)
            )
        );

        if ($data) {
            // we check here if client of that user is blocked or not
            switch ($data['User']['user_type_id']) {
                case Configure::read('UserType.superadmin'):
                    $this->Session->write('SUPER_ADMIN', 1);
                    $this->Session->write('UserTypeID', $data['User']['user_type_id']);
                    $this->Session->write('User', $data);
                    break;
                case Configure::read('UserType.branchadmin') :
                    $this->Session->write('UserTypeID', $data['User']['user_type_id']);
                    $this->Session->write('UserData', $data);
                    $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
                    break;
                case Configure::read('UserType.admin') :
                    $this->Session->write('UserTypeID', $data['User']['user_type_id']);
                    $this->Session->write('User', $data);
                    break;
            }
        }
    }

    /*     * **************ADMINISTRATOR MODULE UNDER SUPER ADMIN PANEL*************************** */
    /*     * ************************LIST ADMINS,CREATE NEW ADMIN,EDIT,ACTIAVTE***************** */

    public function admin_listadmins() {
        $this->loadModel('User');
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', ' Administrators');
        if ($this->request->isGet() && isset($_GET['search'])) {
            $condition = array('User.user_type_id' => Configure::read('UserType.admin'), 'User.is_deleted !=' => 1, 'User.branch_id IS NULL', 'OR' => array('User.user_name LIKE' => "{$_GET['search']}%", 'User.first_name LIKE' => "{$_GET['search']}%", 'User.last_name LIKE' => "{$_GET['search']}%", 'User.email LIKE' => "{$_GET['search']}%"));
        } else {
            $condition = array('User.user_type_id' => Configure::read('UserType.admin'), 'User.is_deleted !=' => 1, 'User.branch_id IS NULL');
        }

        $this->paginate = array(
            'conditions' => $condition,
            'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'User.modified DESC'
        );
        $data = $this->paginate('User');
        $this->set(compact('data'));
    }

    public function admin_trashadmins() {
        $this->loadModel('User');
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Trash Administrators');
        if ($this->request->isGet() && isset($_GET['search'])) {
            $condition = array('User.user_type_id' => Configure::read('UserType.admin'), 'User.is_deleted' => 1, 'OR' => array('User.user_name LIKE' => "{$_GET['search']}%", 'User.first_name LIKE' => "{$_GET['search']}%", 'User.last_name LIKE' => "{$_GET['search']}%", 'User.email LIKE' => "{$_GET['search']}%"));
        } else {
            $condition = array('User.user_type_id' => Configure::read('UserType.admin'), 'User.is_deleted' => 1);
        }


        $this->paginate = array(
            'conditions' => $condition,
            'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'User.modified DESC'
        );
        $data = $this->paginate('User');
        $this->set(compact('data'));
    }

    public function ajax_check_username($id = null) {
        $this->autoRender = false;
        if ($id == null) {
            $count = $this->User->find('count', array(
                'conditions' => array('User.user_name' => $this->params->query['data']['User']['user_name']),
                'recursive' => -1
            ));
        } else {
            $count = $this->User->find('count', array(
                'conditions' => array(
                    'User.id !=' => $id,
                    'User.user_name' => $this->params->query['data']['User']['user_name']
                ),
                'recursive' => -1
            ));
        }
        if ($count == 0) {
            $validate = 'true';
        } else {
            $validate = 'This username is already exist';
        }
        echo json_encode($validate);
    }

    public function ajax_check_email($id = null) {
        $this->autoRender = false;
        if ($id == null) {
            $count = $this->User->find('count', array(
                'conditions' => array('User.email' => $this->params->query['data']['User']['email']),
                'recursive' => -1
            ));
        } else {
            $count = $this->User->find('count', array(
                'conditions' => array(
                    'User.id !=' => $id,
                    'User.email' => $this->params->query['data']['User']['email']
                ),
                'recursive' => -1
            ));
        }
        if ($count == 0) {
            $validate = 'true';
        } else {
            $validate = 'This email is already exist';
        }
        echo json_encode($validate);
    }

    public function admin_addadmin() {
        $this->autoRender = false;
        $error = false;
        $this->loadModel('User');

        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $this->request->data['User']['user_type_id'] = Configure::read('UserType.admin');
                $this->User->create();
                $this->request->data['User']['entry_ts'] = date('Y-m-d H:i:s');

                //CODE TO FIRE AN EMAIL END
                if ($this->User->save($this->request->data['User'], false)) {
                    $password = $this->request->data['User']['password'];

                    //CODE TO FIRE AN EMAIL
                    $this->loadModel('EmailTemplate');
                    $link = "<a href=" . Configure::read('LOGIN_URL.URL') . ">" . Configure::read('LOGIN_URL.URL') . "</a>";

                    $temp = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 2)));
                    $temp['EmailTemplate']['mail_body'] = str_replace(array('../../..', '#FIRSTNAME', '#USERNAME', '#PASSWORD', '#CLICKHERE'), array(Configure::read('FULL_BASE_URL.URL'), ucwords($this->request->data['User']['first_name']), $this->request->data['User']['user_name'], $password, $link), $temp['EmailTemplate']['mail_body']);
                    $this->set('template', $temp['EmailTemplate']['mail_body']);
                    if ($this->request->data['User']['email'] != '') {
                        App::uses('CakeEmail', 'Network/Email');
                        $Email = new CakeEmail();
                        //$Email->template('default');
                        $Email->emailFormat('both');
                        $Email->from(array(Configure::read('Email.EmailSupport') => Configure::read('SITE_SETTINGS.Name')));
                        $Email->sender(Configure::read('Email.EmailSupport'), Configure::read('SITE_SETTINGS.Name'));
                        $Email->to($this->request->data['User']['email']);
                        $Email->subject($temp['EmailTemplate']['mail_subject']);
                        $Email->send($temp['EmailTemplate']['mail_body']);
                    }

                    $this->Session->setFlash('Admin has been added successfully and email notification has been send.', 'default', 'success');
                    $this->redirect(array('controller' => 'users', 'action' => 'listadmins', 'admin' => true));
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
            if ($error = true) {
                $errors = $this->User->validationErrors;
                if (!empty($errors)) {
                    $str = '';
                    foreach ($errors as $key => $val):
                        $str.=$val[0];
                    endforeach;
                }
                $this->Session->setFlash('Admin adding request not completed due to following errors : .' . $str . '. Try again!', 'message');
                $this->redirect(array('controller' => 'users', 'action' => 'listadmins', 'admin' => true));
            }
        }
    }

    public function admin_editadmin($id = null) {
        $user_session = $this->Session->read('User');

        $PopupTitle = "Edit Administrator";
        $id = base64_decode($id);
        $this->set("PopupTitle", $PopupTitle);
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            $this->User->uninvalidate('password');
            $this->User->uninvalidate('cpassword');
            if ($this->User->validates()) {
                $this->User->id = $id;
                if ($this->User->save($this->request->data, false, array('first_name', 'last_name', 'user_name', 'email', 'phone', 'address_line1', 'address_line2'))) {

                    $this->Session->setFlash('Admin has been updated successfully', 'default', 'success');
                    $this->redirect(array('controller' => 'users', 'action' => 'listadmins', 'admin' => true));
                    exit;
                }
            } else {

                $str = '';
                foreach ($this->User->validationErrors as $key => $error):
                    $str.=$error[0] . '<br/>';
                endforeach;

                $this->Session->setFlash('Admin is not updated <br/>' . $str, 'default', 'error');
                $this->redirect(array('controller' => 'users', 'action' => 'listadmins', 'admin' => true));
                exit;
            }
        } else {
            $this->User->recursive = -1;
            $this->User->id = $id;
            $this->request->data = $this->User->read();

            if ($this->RequestHandler->isAjax()) {

                $this->set('users', $this->request->data);
                $this->set('_serialize', array('users', 'PopupTitle'));
            }
        }
    }

    public function admin_deleteadmin($id = null) {
        $id = base64_decode($id);
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Delete Admin');
        $this->User->id = $id;
        $userdata = $this->User->find('first', array('fields' => array('User.email', 'User.first_name', 'User.last_name'), 'conditions' => array('User.id' => $id)));
        if ($this->User->saveField('is_deleted', 1)) {
            
        }
        $this->Session->setFlash('Admin has been deleted successfully and email notification sent', 'default', 'success');
        $this->redirect(array('controller' => 'users', 'action' => 'listadmins', 'admin' => true));
    }

    public function admin_restoreadmin($id = null) {
        $id = base64_decode($id);
        $this->layout = 'superadmin_layout';
        $this->set('title_for_layout', 'Delete Admin');
        $this->User->id = $id;
        $this->User->saveField('is_deleted', 0);
        $this->Session->setFlash('Admin has been restored successfully', 'default', 'success');
        $this->redirect(array('controller' => 'users', 'action' => 'listadmins', 'admin' => true));
    }

    public function admin_blockadmin($id = null, $blocktype = null) {
        $id = base64_decode($id);
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Active/Inactive User');

        if (isset($blocktype) && $blocktype == 'block') {
            $this->User->id = $id;
            $this->User->saveField('status', 0);

            $this->Session->setFlash('Admin has been deactivated successfully', 'default', 'success');
            $this->redirect(array('controller' => 'users', 'action' => 'listadmins', 'admin' => true));
        }
        if (isset($blocktype) && $blocktype == 'unblock') {
            $this->User->id = $id;
            $this->User->saveField('status', 1);
            $this->Session->setFlash('Admin has been activated successfully', 'default', 'success');
            $this->redirect(array('controller' => 'users', 'action' => 'listadmins', 'admin' => true));
        }
    }

    /*     * **************CLIENT(USER) MODULE UNDER SUPER ADMIN PANEL*************************** */
    /*     * ************************LIST CLIENT(USER),CREATE NEW CLIENT,EDIT,ACTIAVTE***************** */

    public function superadmin_listclients() {
        $this->loadModel('User');
        $this->layout = 'superadmin_layout';

        if ($this->request->isGet() && isset($_GET['search'])) {
            $condition = array('User.user_type_id' => Configure::read('UserType.branchadmin'), 'User.is_deleted !=' => 1, 'OR' => array('User.user_name LIKE' => "{$_GET['search']}%", 'User.first_name LIKE' => "{$_GET['search']}%", 'User.last_name LIKE' => "{$_GET['search']}%", 'User.email LIKE' => "{$_GET['search']}%"));
        } else {
            $condition = array('User.user_type_id' => Configure::read('UserType.branchadmin'), 'User.is_deleted !=' => 1);
        }


        $this->paginate = array(
            'conditions' => $condition,
            'limit' => 20,
            'order' => 'User.id DESC',
        );
        $data = $this->paginate('User');
        $this->set(compact('data'));
        $this->loadModel('User');
        $admin_data = $this->User->find('list', array('conditions' => array('User.user_type_id' => Configure::read('UserType.admin'), 'User.is_deleted' => 0, 'User.is_blocked' => 0), 'fields' => array('User.id', 'User.first_name'), 'order' => array('User.first_name ASC'), 'recursive' => -1));
        $this->set('admin_data', $admin_data);
        $str = '';

        foreach ($admin_data as $key => $val):

            $str.="{value: $key, text: '$val'},";
        endforeach;
        $this->set('admins', trim($str));
    }

    public function superadmin_trashclients() {
        $this->loadModel('User');
        $this->layout = 'superadmin_layout';

        if ($this->request->isGet() && isset($_GET['search'])) {
            $condition = array('User.user_type_id' => Configure::read('UserType.branchadmin'), 'User.is_deleted' => 1, 'OR' => array('User.user_name LIKE' => "{$_GET['search']}%", 'User.first_name LIKE' => "{$_GET['search']}%", 'User.last_name LIKE' => "{$_GET['search']}%", 'User.email LIKE' => "{$_GET['search']}%"));
        } else {
            $condition = array('User.user_type_id' => Configure::read('UserType.branchadmin'), 'User.is_deleted' => 1);
        }


        $this->paginate = array(
            'conditions' => $condition,
            'limit' => 20,
            'order' => 'User.id DESC',
        );
        $data = $this->paginate('User');
        $this->set(compact('data'));
        $this->loadModel('User');
        $admin_data = $this->User->find('list', array('conditions' => array('User.user_type_id' => Configure::read('UserType.admin'), 'User.is_deleted' => 0, 'User.is_blocked' => 0), 'fields' => array('User.id', 'User.first_name'), 'order' => array('User.first_name ASC'), 'recursive' => -1));
        $this->set('admin_data', $admin_data);
        $str = '';

        foreach ($admin_data as $key => $val):

            $str.="{value: $key, text: '$val'},";
        endforeach;
        $this->set('admins', trim($str));
    }

    public function superadmin_addclient() {
        $this->autoRender = false;
        $error = false;
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $this->request->data['User']['user_type_id'] = Configure::read('UserType.branchadmin');
                $this->User->create();
                $this->request->data['User']['entry_ts'] = date('Y-m-d H:i:s');

                //CODE TO FIRE AN EMAIL END
                if ($this->User->save($this->request->data['User'], false)) {
                    $password = $this->request->data['User']['password'];

                    //CODE TO FIRE AN EMAIL

                    $this->loadModel('EmailTemplate');
                    $link = "<a href=" . Configure::read('LOGIN_URL.URL') . ">" . Configure::read('LOGIN_URL.URL') . "</a>";

                    $temp = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 2)));
                    $temp['EmailTemplate']['mail_body'] = str_replace(array('../../..', '#FIRSTNAME', '#USERNAME', '#PASSWORD', '#CLICKHERE'), array(Configure::read('FULL_BASE_URL.URL'), ucwords($this->request->data['User']['first_name']), $this->request->data['User']['user_name'], $password, $link), $temp['EmailTemplate']['mail_body']);
                    $this->set('template', $temp['EmailTemplate']['mail_body']);
                    if ($this->request->data['User']['email'] != '') {
                        App::uses('CakeEmail', 'Network/Email');
                        $Email = new CakeEmail();
                        //$Email->template('default');
                        $Email->emailFormat('both');
                        $Email->from(array(Configure::read('Email.EmailSupport') => Configure::read('SITE_SETTINGS.Name')));
                        $Email->sender(Configure::read('Email.EmailSupport'), Configure::read('SITE_SETTINGS.Name'));
                        $Email->to($this->request->data['User']['email']);
                        $Email->subject($temp['EmailTemplate']['mail_subject']);
                        $Email->send($temp['EmailTemplate']['mail_body']);
                    }

                    $this->Session->setFlash('Client(User) has been added successfully.', 'default', 'success');
                    $this->redirect(array('controller' => 'users', 'action' => 'listclients', 'superadmin' => true));
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
            if ($error = true) {
                $errors = $this->User->validationErrors;
                if (!empty($errors)) {
                    $str = '';
                    foreach ($errors as $key => $val):
                        $str.=$val[0];
                    endforeach;
                }
                $this->Session->setFlash('Client(User) adding request not completed due to following errors : .' . $str . '. Try again!', 'message');
                $this->redirect(array('controller' => 'users', 'action' => 'listclients', 'superadmin' => true));
            }
        }
    }

    public function superadmin_editclient($id = null) {
        $user_session = $this->Session->read('User');

        $PopupTitle = "Edit Client(User)";
        $id = base64_decode($id);
        $this->set("PopupTitle", $PopupTitle);
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            $this->User->uninvalidate('password');
            $this->User->uninvalidate('cpassword');
            if ($this->User->validates()) {
                $this->User->id = $id;
                if ($this->User->save($this->request->data, false, array('first_name', 'last_name', 'user_name', 'email', 'phone', 'address_line1', 'address_line2', 'business_name', 'website'))) {

                    $this->Session->setFlash('Client(User) has been updated successfully', 'default', 'success');
                    $this->redirect(array('controller' => 'users', 'action' => 'listclients', 'superadmin' => true));
                    exit;
                }
            } else {

                $str = '';
                foreach ($this->User->validationErrors as $key => $error):
                    $str.=$error[0] . '<br/>';
                endforeach;

                $this->Session->setFlash('Client(User) is not updated <br/>' . $str, 'default', 'error');
                $this->redirect(array('controller' => 'users', 'action' => 'listclients', 'superadmin' => true));
                exit;
            }
        } else {
            $this->User->recursive = -1;
            $this->User->id = $id;
            $this->request->data = $this->User->read();

            if ($this->RequestHandler->isAjax()) {

                $this->set('users', $this->request->data);
                $this->set('_serialize', array('users', 'PopupTitle'));
            }
        }
    }

    public function superadmin_blockclient($id = null, $blocktype = null) {
        $id = base64_decode($id);
        $this->layout = 'superadmin_layout';
        $this->set('title_for_layout', 'Block Unblock Client');

        if (isset($blocktype) && $blocktype == 'block') {
            $this->User->id = $id;
            $this->User->saveField('is_blocked', 1);

            $this->Session->setFlash('Client(User) has been blocked successfully', 'default', 'success');
            $this->redirect(array('controller' => 'users', 'action' => 'listclients', 'superadmin' => true));
        }
        if (isset($blocktype) && $blocktype == 'unblock') {
            $this->User->id = $id;
            $this->User->saveField('is_blocked', 0);
            $this->Session->setFlash('Client(User) has been unblocked successfully', 'default', 'success');
            $this->redirect(array('controller' => 'users', 'action' => 'listclients', 'superadmin' => true));
        }
    }

    public function superadmin_deleteclient($id = null) {
        $id = base64_decode($id);
        $this->layout = 'superadmin_layout';
        $this->set('title_for_layout', 'Delete User');
        $this->User->id = $id;
        $userdata = $this->User->find('first', array('fields' => array('User.email', 'User.first_name', 'User.last_name'), 'conditions' => array('User.id' => $id)));
        if ($this->User->saveField('is_deleted', 1)) {
            //CODE TO FIRE AN EMAIL 
            $this->loadModel('EmailTemplate');

            $temp = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 7)));
            $temp['EmailTemplate']['mail_body'] = str_replace(array('../../..', '#FIRSTNAME'), array(Configure::read('FULL_BASE_URL.URL'), ucwords($userdata['User']['first_name'] . ' ' . $userdata['User']['last_name'])), $temp['EmailTemplate']['mail_body']);
            $this->set('template', $temp['EmailTemplate']['mail_body']);
            if ($userdata['User']['email'] != '') {
                App::uses('CakeEmail', 'Network/Email');
                $Email = new CakeEmail();
                //$Email->template('default');
                $Email->emailFormat('both');
                $Email->from(array(Configure::read('Email.EmailSupport') => Configure::read('SITE_SETTINGS.Name')));
                $Email->sender(Configure::read('Email.EmailSupport'), Configure::read('SITE_SETTINGS.Name'));
                $Email->to($userdata['User']['email']);
                $Email->subject($temp['EmailTemplate']['mail_subject']);
                $Email->send($temp['EmailTemplate']['mail_body']);
            }
        }
        $this->Session->setFlash('Client(User) has been deleted successfully', 'default', 'success');
        $this->redirect(array('controller' => 'users', 'action' => 'listclients', 'superadmin' => true));
    }

    public function superadmin_restoreclient($id = null) {
        $id = base64_decode($id);
        $this->layout = 'superadmin_layout';
        $this->set('title_for_layout', 'Restore User');
        $this->User->id = $id;
        $this->User->saveField('is_deleted', 0);
        $this->Session->setFlash('Client(User) has been restored successfully', 'default', 'success');
        $this->redirect(array('controller' => 'users', 'action' => 'listclients', 'superadmin' => true));
    }

    public function signup($uniqueKey = null) {
        $this->layout = 'login_layout';
        $this->set('title_for_layout', 'Sign Up');
        if (empty($uniqueKey)) {
            $this->Session->setFlash('Invalid request code. Please contact with administrator to send you invitation.', 'errormessage');
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->loadModel('Invitation');
        $userInfo = $this->Invitation->find('first', array(
            'conditions' => array(
                'Invitation.request_token' => trim($uniqueKey),
                'Invitation.is_used' => 0
            )
        ));
        if (empty($userInfo)) {
            $this->Session->setFlash('Invalid request code. Please contact with administrator to send you invitation.', 'errormessage');
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->set('userInfo', $userInfo);
        $this->set('uniqueKey', $uniqueKey);
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $password = $this->request->data['User']['password'];
                $this->request->data['User']['user_type_id'] = Configure::read('UserType.branchadmin');
                $this->User->create();
                $this->request->data['User']['entry_ts'] = date('Y-m-d H:i:s');

                //CODE TO FIRE AN EMAIL END
                if ($this->User->save($this->request->data['User'], false)) {
                    $this->Invitation->id = $userInfo['Invitation']['id'];
                    $this->Invitation->saveField('is_used', 1, array('validate' => false));
                    $this->Invitation->saveField('is_request_accepted', 1, array('validate' => false));
                    $this->Invitation->saveField('request_token', '', array('validate' => false));
                    //CODE TO FIRE AN EMAIL
                    $this->loadModel('EmailTemplate');
                    $link = "<a href=" . Configure::read('LOGIN_URL.URL') . ">" . Configure::read('LOGIN_URL.URL') . "</a>";

                    $temp = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 4)));
                    $temp['EmailTemplate']['mail_body'] = str_replace(
                        array(
                        '../../..',
                        '#FIRSTNAME',
                        '#USERNAME',
                        '#PASSWORD',
                        '#CLICKHERE'
                        ), array(
                        Configure::read('FULL_BASE_URL.URL'),
                        ucwords($this->request->data['User']['first_name']),
                        $this->request->data['User']['user_name'],
                        $password,
                        $link
                        ), $temp['EmailTemplate']['mail_body']
                    );
                    $this->set('template', $temp['EmailTemplate']['mail_body']);
                    if ($this->request->data['User']['email'] != '') {
                        App::uses('CakeEmail', 'Network/Email');
                        $Email = new CakeEmail();
                        //$Email->template('default');
                        $Email->emailFormat('both');
                        $Email->from(array(Configure::read('Email.EmailSupport') => Configure::read('SITE_SETTINGS.Name')));
                        $Email->sender(Configure::read('Email.EmailSupport'), Configure::read('SITE_SETTINGS.Name'));
                        $Email->to($this->request->data['User']['email']);
                        $Email->subject($temp['EmailTemplate']['mail_subject']);
                        $temp['EmailTemplate']['mail_body'];
                        $Email->send($temp['EmailTemplate']['mail_body']);
                    }

                    $adminName = $this->User->find('first', array('conditions' => array('User.id' => 1)));
                    $tempAdmin = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 5)));
                    $tempAdmin['EmailTemplate']['mail_body'] = str_replace(
                        array(
                        '../../..',
                        '#ADMINNAME',
                        '#FULLNAME',
                        '#EMAIL',
                        '#USERNAME',
                        '#INVITEDBY',
                        '#INVITEDDATE'
                        ), array(
                        Configure::read('FULL_BASE_URL.URL'),
                        ucwords($adminName['User']['first_name']),
                        ucwords($this->request->data['User']['first_name'] . ' ' . $this->request->data['User']['last_name']),
                        $this->request->data['User']['email'],
                        $this->request->data['User']['user_name'],
                        ucwords($userInfo['User']['first_name'] . ' ' . $userInfo['User']['last_name']),
                        date('d/M/Y', strtotime($userInfo['Invitation']['created']))
                        ), $tempAdmin['EmailTemplate']['mail_body']
                    );
                    $this->set('template', $tempAdmin['EmailTemplate']['mail_body']);
                    if ($adminName['User']['email'] != '') {
                        App::uses('CakeEmail', 'Network/Email');
                        $Email = new CakeEmail();
                        //$Email->template('default');
                        $Email->emailFormat('both');
                        $Email->from(array(Configure::read('Email.EmailSupport') => Configure::read('SITE_SETTINGS.Name')));
                        $Email->sender(Configure::read('Email.EmailSupport'), Configure::read('SITE_SETTINGS.Name'));
                        $Email->to($adminName['User']['email']);
                        $Email->subject($tempAdmin['EmailTemplate']['mail_subject']);
                        $tempAdmin['EmailTemplate']['mail_body'];
                        $Email->send($tempAdmin['EmailTemplate']['mail_body']);
                    }

                    $this->Session->setFlash('Congratulations! Your account has been created successfully.', 'default', 'success');
                    $this->redirect(array('controller' => 'users', 'action' => 'login'));
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
            if ($error = true) {
                $errors = $this->User->validationErrors;
                $this->Session->setFlash('Unable to save user.', 'errormessage');
                $this->redirect(array('controller' => 'users', 'action' => 'signup'));
            }
        }
    }

    public function dashboard() {
        $this->layout = 'user_layout';
        $this->set('title_for_layout', 'User Dashboard');
        // Dashboard Conditions Goes Here
    }

    public function editprofile() {
        $this->layout = 'user_layout';
        $this->set('title_for_layout', 'Edit Profile');

        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if (!isset($this->request->data['User']['password'])) {
                $this->User->uninvalidate('password');
                $this->User->uninvalidate('cpassword');
            }
            if ($this->User->validates()) {
                $this->User->id = $this->Session->read('User.User.id');
                $this->request->data['User']['id'] = $this->Session->read('User.User.id');
                if (!empty($this->request->data['Metauser']) || !empty($this->request->data['UserService']) || !empty($this->request->data['UserSocial']) || !empty($this->request->data['UserOffer'])) {
                    if (!empty($this->request->data['Metauser'])) {
                        $this->request->data['Metauser']['user_id'] = $this->Session->read('User.User.id');
                        if (isset($this->request->data['Metauser']['remember_card']) && $this->request->data['Metauser']['remember_card'] == 1) {
                            // No action required
                        } else {
                            $this->request->data['Metauser']['card_type'] = '';
                            $this->request->data['Metauser']['card_number'] = '';
                            $this->request->data['Metauser']['cvv'] = '';
                            $this->request->data['Metauser']['name_on_card'] = '';
                            $this->request->data['Metauser']['receipt_email'] = '';
                            $this->request->data['Metauser']['zip_code'] = '';
                            $this->request->data['Metauser']['remember_card'] = '';
                        }
                    }
                    if (!empty($this->request->data['UserService'])) {
                        $this->request->data['UserService'][0]['user_id'] = $this->Session->read('User.User.id');
                        $this->request->data['UserService'][1]['user_id'] = $this->Session->read('User.User.id');
                        $this->request->data['UserService'][2]['user_id'] = $this->Session->read('User.User.id');
                    }
                    if (!empty($this->request->data['UserSocail'])) {
                        $this->request->data['UserSocail']['user_id'] = $this->Session->read('User.User.id');
                    }
                    if (!empty($this->request->data['UserOffer'])) {
                        $this->request->data['UserOffer'][0]['user_id'] = $this->Session->read('User.User.id');
                        $this->request->data['UserOffer'][1]['user_id'] = $this->Session->read('User.User.id');
                        $this->request->data['UserOffer'][2]['user_id'] = $this->Session->read('User.User.id');
                        $this->request->data['UserOffer'][3]['user_id'] = $this->Session->read('User.User.id');
                    }
                    if ($this->User->saveAssociated($this->request->data)) {
                        $this->Session->setFlash('Profile has been updated successfully', 'default', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'editprofile'));
                    }
                } else {
                    if ($this->User->save($this->request->data, false)) {
                        $this->Session->setFlash('Profile has been updated successfully', 'default', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'editprofile'));
                    }
                }
            } else {
                $str = '';
                foreach ($this->User->validationErrors as $error) {
                    $str .= $error[0] . '<br/>';
                }
                $this->Session->setFlash('Profile is not updated <br/>' . $str, 'default', 'error');
                $this->redirect(array('controller' => 'users', 'action' => 'editprofile'));
            }
        } else {
            if ($this->Session->check('User')) {
                $userId = $this->Session->read('User.User.id');
                $this->User->id = $userId;
                $this->request->data = $this->User->read();
            } else {
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }
    }

    private function _redirectLoggedInUser() {
        // If user already logged in then redirect to dashboard
        if ($this->Session->check('User')) {
            $userLoginData = $this->Session->read('User');
            // we check here if client of that user is blocked or not
            switch ($userLoginData['User']['user_type_id']) {
                case Configure::read('UserType.superadmin'):
                    $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'superadmin' => true));
                    break;
                case Configure::read('UserType.branchadmin') :
                    $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
                    break;
                case Configure::read('UserType.admin') :
                    $this->redirect(array('controller' => 'admins', 'action' => 'dashboard', 'admin' => true));
                    break;
            }
        }
    }

    public function admin_systemsetting() {
        $PopupTitle = "System Setting";
        $this->set("PopupTitle", $PopupTitle);
        $this->loadModel('SystemSetting');

        if ($this->request->is('post')) {
            $this->request->data = Sanitize::clean($this->request->data, array('escape' => true));
            $this->request->data["SystemSetting"] = $this->request->data["User"];
            unset($this->request->data["User"]);
            $this->SystemSetting->set($this->request->data);
            if ($this->SystemSetting->validates()) {
                if ($this->SystemSetting->save($this->request->data['SystemSetting'], false)) {
                    $this->Session->setFlash('System Settings has been updated successfully', 'default', 'success');
                    $this->redirect($this->referer());
                    exit;
                }
            } else {
                $str = '';
                foreach ($this->SystemSetting->validationErrors as $key => $error):
                    $str.=$error[0] . '<br/>';
                endforeach;
                $this->Session->setFlash('System Settings is not updated <br/>' . $str, 'default', 'error');
                $this->redirect($this->referer());
                exit;
            }
        } else {
            $exData = $this->SystemSetting->find('first');
            if (!empty($exData)) {
                $this->request->data = $exData;
            } else {
                $this->request->data["SystemSetting"] = array('id' => '', 'site_name' => '', 'admin_email' => '', 'vat' => '');
            }
            if ($this->RequestHandler->isAjax()) {
                $this->set('settings', $this->request->data);
                $this->set('_serialize', array('settings', 'PopupTitle'));
            }
        }
    }

    public function admin_viewadmin($id = null) {
        $PopupTitle = "Administrator Details";
        $id = base64_decode($id);
        $this->set("PopupTitle", $PopupTitle);
        if ($this->RequestHandler->isAjax()) {
            $branch = $this->User->find('first', array(
                'conditions' => array(
                    'User.id' => $id
                )
            ));
            $this->set('adminData', $branch);
            $this->set('_serialize', array('adminData', 'PopupTitle'));
        }
    }

    
	public function findUser() {
		$this->User->recursive = 0;
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->layout = 'ajax';
            $conditions = array(
                'OR' => array(
                    'User.first_name LIKE ' => $this->request->query['q'] . '%',
                    'User.last_name LIKE ' => $this->request->query['q'] . '%',
                    'User.user_name LIKE ' => $this->request->query['q'] . '%',
                    'User.email LIKE ' => $this->request->query['q'] . '%',
                ),
                'User.id <> ' => $this->Session->read('User.User.id'),
                'User.is_deleted' => 0
            );
			$results = $this->User->find('all', array(
				'fields' => array('user_name'),
				//remove the leading '%' if you want to restrict the matches more
				'conditions' => $conditions
			));
			// pr($this->User->getLastQuery());
			if (isset($results) && count($results) > 0) {
				foreach ($results as $result) {
					echo $result['User']['user_name'] . "\n";
				}
			}
		}
	}

	public function username_exists() {
		$this->autoRender = false;
		$count = $this->User->find('count', array(
			'conditions' => array(
				'User.user_name' => $this->params->query['data']['Message']['receiver_user_name']
			),
			'recursive' => -1
		));
		if ($count == 0) {
			$validate = 'Username or Email does not exists.';
		} else {
			$validate = 'true';
		}
		echo json_encode($validate);
	}

	public function usernameExists() {
		$this->autoRender = false;
		if (!empty($this->request->data)) {
			$count = $this->User->find('count', array(
				'conditions' => array(
					'User.user_name' => $this->request->data['userName']
				),
				'recursive' => -1
			));
			if ($count == 0) {
				$validate['msg'] = false;
			} else {
				$validate['msg'] = true;
			}
			echo json_encode($validate);
		}
	}
	
	public function findAdminCustomers() {
		$this->User->recursive = 0;
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->layout = 'ajax';
			$conditions = array(
				'OR' => array(
					'User.first_name LIKE ' => $this->request->query['q'] . '%',
					'User.last_name LIKE ' => $this->request->query['q'] . '%',
					'User.user_name LIKE ' => $this->request->query['q'] . '%',
					'User.email LIKE ' => $this->request->query['q'] . '%',
				),
				'User.id <> ' => $this->Session->read('User.User.id'),
				'User.user_type_id' => (int)Configure::read("UserType.admin"),
				'User.is_deleted' => 0,
				'User.is_blocked' => 0
			);
			$results = $this->User->find('all', array(
				'fields' => array('user_name'),
				//remove the leading '%' if you want to restrict the matches more
				'conditions' => $conditions
			));
			// pr($this->User->getLastQuery());
			if (isset($results) && count($results) > 0) {
				foreach ($results as $result) {
					echo $result['User']['user_name'] . "\n";
				}
			}
		}
	}
}
