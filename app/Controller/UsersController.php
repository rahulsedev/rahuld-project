<?php

/*
 * ***********************************************************************************
 * Users Controller
 * Functionality		 :	User related function used for all types of users
 * including super administrator,client user,QA type of users,admin type of users
 * ***********************************************************************************
 */

App::uses('AppController', 'Controller');
// App::uses('ConnectionManager', 'Model');
App::uses('Sanitize', 'Utility');

class UsersController extends AppController {

    public $name = 'Users';
    public $uses = array('User');
    public $helpers = array('Html', 'Form', 'Session', 'Js', 'Paginator', 'Common', 'Time');
    public $components = array('Email', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_login() {

        if ($this->Session->check('SUPER_ADMIN') || $this->Session->check('UserID')) {
            $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
        }

        $this->layout = 'crm_layout';
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
                            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
                            break;
                        case 2 :
                            $this->Session->write('User', $data);
                            $this->Session->setFlash('You have been successfully logged In.', 'default', 'success');
                            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));exit;
                            break;
                        case 3 :
                            $this->Session->write('User', $data);
                            $this->Session->setFlash('You have been successfully logged In.', 'default', 'success');
                            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
                            break;
                        case 3 :
                            $this->Session->write('User', $data);
                            $this->Session->setFlash('You have been successfully logged In.', 'default', 'success');
                            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
                            break;
                        case 4 :
                            $this->Session->write('User', $data);
                            $this->Session->setFlash('You have been successfully logged In.', 'default', 'success');
                            $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
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
                
                $this->Session->setFlash('Password has been changed successfully', 'default', 'success');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => false));
            } else {
                $this->Session->setFlash('Oops! There is some problem while changing password', 'default', 'message');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => false));
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
            $condition = array('User.is_deleted !=' => 1, 'OR' => array('User.user_name LIKE' => "{$_GET['search']}%", 'User.first_name LIKE' => "{$_GET['search']}%", 'User.last_name LIKE' => "{$_GET['search']}%", 'User.email LIKE' => "{$_GET['search']}%"));
        } else {
            $condition = array('User.is_deleted !=' => 1);
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
                if ($this->User->save($this->request->data, false, array('first_name', 'last_name', 'user_name', 'email', 'phone', 'address_line1', 'address_line2', 'password'))) {

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

    public function dashboard() {
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Tridev Sales & Marketing Solutions');
        // Dashboard Conditions Goes Here
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
	
	public function findAdminUsers() {
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
           
}
