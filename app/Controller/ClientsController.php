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

class ClientsController extends AppController {

    public $name = 'Clients';
    public $uses = array('Client');
    public $helpers = array('Html', 'Form', 'Session', 'Js', 'Paginator', 'Common', 'Time');
    public $components = array('Email', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('clients', $this->_getClientList());
    }

    public function _getClientList(){
        $vendors = array();  
        $data=$this->Client->find('all', array('fields'=>array('Client.id', 'Client.name', 'Client.email'), 'conditions'=>array('Client.is_deleted'=>'0', 'Client.status'=>'1'), 'order'=>'Client.name ASC'));
        if(!empty($data)){
            foreach($data as $val){
                $vendors[$val["Client"]["id"]]=$val["Client"]["name"]." (".$val["Client"]["email"].")";
            }
        }
        return $vendors;
    }
    
    
    public function admin_listclients() {
        $this->loadModel('Client');
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', ' Client Master');
        
        $user_type = $this->Session->read('User.User.user_type_id');
        $user_id = $this->Session->read('User.User.id');
        
        if($user_type==1){ // super admin access
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('Client.add_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }                
                $condition = array('Client.is_deleted !=' => 1, 'OR' => array('Client.name LIKE' => "{$_GET['search']}%", 'Client.email LIKE' => "{$_GET['search']}%", 'Client.code LIKE' => "{$_GET['search']}%"));
                $condition = array_merge($condition, $datecond); 
            } else {
                $condition = array('Client.is_deleted !=' => 1);
            }
        }else{
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('Client.add_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }                  
                $condition = array('Client.added_by' => $user_id, 'Client.added_by_type' => $user_type, 'Client.is_deleted !=' => 1, 'OR' => array('Client.name LIKE' => "{$_GET['search']}%", 'Client.email LIKE' => "{$_GET['search']}%", 'Client.code LIKE' => "{$_GET['search']}%"));
                $condition = array_merge($condition, $datecond); 
            } else {
                $condition = array('Client.added_by' => $user_id, 'Client.added_by_type' => $user_type, 'Client.is_deleted !=' => 1);
            }
        }
        $this->paginate = array(
            'conditions' => $condition,
            'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'Client.modified DESC'
        );
        $data = $this->paginate('Client');
        $this->set(compact('data'));
    }    
    
    public function admin_editclient($id = null) {
        $user_session = $this->Session->read('Client');
        $id = base64_decode($id);
        $PopupTitle = (isset($id) && $id>0)?"Edit Client":"Add Client";
        $this->set("PopupTitle", $PopupTitle);
        if ($this->request->is('post')) {
            $this->Client->set($this->request->data);
            if ($this->Client->validates()) {
                $this->request->data['Client']['added_by'] = $this->Session->read('User.User.id');
                $this->request->data['Client']['modified_by'] = $this->Session->read('User.User.id');
                $this->request->data['Client']['added_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['Client']['modified_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['Client']['add_date'] = date("Y-m-d", strtotime(str_replace("/", "-", $this->request->data['Client']['add_date'])));
                $msg = !empty($this->request->data['Client']['id'])?"updated":"added";
                if ($this->Client->save($this->request->data, false)) {
                    $this->Session->setFlash('Client has been '.$msg.' successfully', 'default', 'success');
                    $this->redirect(array('controller' => 'clients', 'action' => 'listclients', 'admin' => true));
                    exit;
                }
            } else {
                $str = '';
                foreach ($this->Client->validationErrors as $key => $error):
                    $str.=$error[0] . '<br/>';
                endforeach;
                $this->Session->setFlash('Client details could not saved <br/>' . $str, 'default', 'error');
                $this->redirect(array('controller' => 'clients', 'action' => 'listclients', 'admin' => true));
                exit;
            }
        } else {
            if ($id>0){
                //$this->Client->recursive = -1;
                $this->Client->id = $id;
                $data = $this->request->data = $this->Client->read();
                $this->request->data["Client"]["add_date"] = date("d-m-Y", strtotime($data["Client"]["add_date"]));
            } else {
                $this->Client->recursive = -1;
                $sch = array_keys($this->Client->getColumnTypes());
                foreach($sch as $info)
                    $this->request->data["Client"][$info] = "";
            }
            if ($this->RequestHandler->isAjax()) {    
                $this->set('clients', $this->request->data);
                $this->set('_serialize', array('clients', 'PopupTitle'));
            }
        }
    }      
    
    public function admin_listcmasters() {
        $this->loadModel('ClientMaster');
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Logistics');
        
        $user_type = $this->Session->read('User.User.user_type_id');
        $user_id = $this->Session->read('User.User.id');
        
        if($user_type==1){ // super admin access
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('ClientMaster.added_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }
                $condition = array('ClientMaster.is_deleted !=' => 1, 'OR' => array('Client.name LIKE' => "{$_GET['search']}%", 'ClientMaster.material LIKE' => "{$_GET['search']}%"));
               $condition = array_merge($condition, $datecond);
            } else {
                $condition = array('ClientMaster.is_deleted !=' => 1);
            }
        }else{
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('ClientMaster.added_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }
                $condition = array('ClientMaster.added_by' => $user_id, 'ClientMaster.added_by_type' => $user_type, 'ClientMaster.is_deleted !=' => 1, 'OR' => array('Client.name LIKE' => "{$_GET['search']}%", 'ClientMaster.material LIKE' => "{$_GET['search']}%"));
                $condition = array_merge($condition, $datecond); 
            } else {
                $condition = array('ClientMaster.added_by' => $user_id, 'ClientMaster.added_by_type' => $user_type, 'ClientMaster.is_deleted !=' => 1);
            }
        }
        $this->paginate = array(
            'conditions' => $condition,
            'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'ClientMaster.modified DESC'
        );
        $data = $this->paginate('ClientMaster');
        $this->set(compact('data'));
    }

    public function admin_addcmaster() {
        $this->autoRender = false;
        $error = false;
        $this->loadModel('ClientMaster');
        if ($this->request->is('post')) {
            $this->ClientMaster->set($this->request->data);
            if ($this->ClientMaster->validates()) {
                $this->request->data['ClientMaster']['added_by'] = $this->Session->read('User.User.id');
                $this->request->data['ClientMaster']['modified_by'] = $this->Session->read('User.User.id');
                $this->request->data['ClientMaster']['added_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['ClientMaster']['modified_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['ClientMaster']['added_date'] = date("Y-m-d", strtotime(str_replace("/", "-", $this->request->data['ClientMaster']['added_date'])));
                $this->ClientMaster->create();
                if ($this->ClientMaster->save($this->request->data['ClientMaster'], false)) {
                    $this->Session->setFlash('Master has been added successfully.', 'default', 'success');
                    $this->redirect(array('controller' => 'clients', 'action' => 'listcmasters', 'admin' => true));
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
            if ($error = true) {
                $errors = $this->ClientMaster->validationErrors;
                if (!empty($errors)) {
                    $str = '';
                    foreach ($errors as $key => $val):
                        $str.=$val[0];
                    endforeach;
                }
                $this->Session->setFlash('Master adding request not completed due to following errors : .' . $str . '. Try again!', 'message');
                $this->redirect(array('controller' => 'clients', 'action' => 'listcmasters', 'admin' => true));
            }
        }
    }

    public function admin_viewcmaster($id = null) {
        $this->loadModel('ClientMaster');
        $PopupTitle = "Master Details";
        $id = base64_decode($id);
        $this->set("PopupTitle", $PopupTitle);
        if ($this->RequestHandler->isAjax()) {
            $branch = $this->ClientMaster->find('first', array(
                'conditions' => array(
                    'ClientMaster.id' => $id
                )
            ));
            $branchData = $branch;
            $branchData["ClientMaster"]["added_date"] = date("d-m-Y", strtotime($branch["ClientMaster"]["added_date"]));
            $this->set('adminData', $branchData);
            $this->set('_serialize', array('adminData', 'PopupTitle'));
        }
    }    


    public function admin_editmaster($id = null) {
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
        $this->set('title_for_layout', 'Delete Client');
        $this->Client->id = $id;
        $userdata = $this->Client->find('first', array('fields' => array('Client.email', 'Client.name'), 'conditions' => array('Client.id' => $id)));
        if ($this->Client->saveField('is_deleted', 1)) {
            
        }
        $this->Session->setFlash('Client has been deleted successfully', 'default', 'success');
        $this->redirect(array('controller' => 'clients', 'action' => 'listclients', 'admin' => true));
    }

    public function admin_blockadmin($id = null, $blocktype = null) {
        $id = base64_decode($id);
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Active/Inactive Client');

        if (isset($blocktype) && $blocktype == 'block') {
            $this->Client->id = $id;
            $this->Client->saveField('status', 0);

            $this->Session->setFlash('Client has been deactivated successfully', 'default', 'success');
            $this->redirect(array('controller' => 'clients', 'action' => 'listclients', 'admin' => true));
        }
        if (isset($blocktype) && $blocktype == 'unblock') {
            $this->Client->id = $id;
            $this->Client->saveField('status', 1);
            $this->Session->setFlash('Client has been activated successfully', 'default', 'success');
            $this->redirect(array('controller' => 'clients', 'action' => 'listclients', 'admin' => true));
        }
    }
           
}
