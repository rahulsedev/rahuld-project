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

class VendorsController extends AppController {

    public $name = 'Vendors';
    public $uses = array('Vendor');
    public $helpers = array('Html', 'Form', 'Session', 'Js', 'Paginator', 'Common', 'Time');
    public $components = array('Email', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('vendors', $this->_getVendorList());
    }


    public function _getVendorList(){
        $vendors = array();  
        $data=$this->Vendor->find('all', array('fields'=>array('Vendor.id', 'Vendor.name', 'Vendor.email'), 'conditions'=>array('Vendor.is_deleted'=>'0', 'Vendor.status'=>'1'), 'order'=>'Vendor.name ASC'));
        if(!empty($data)){
            foreach($data as $val){
                $vendors[$val["Vendor"]["id"]]=$val["Vendor"]["name"]."(".$val["Vendor"]["email"].")";
            }
        }
        return $vendors;
    }

    public function admin_listvendors() {
        $this->loadModel('Vendor');
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', ' Vendor Master');
        
        $user_type = $this->Session->read('User.User.user_type_id');
        $user_id = $this->Session->read('User.User.id');
        
        if($user_type==1){ // super admin access
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('Vendor.add_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }                
                $condition = array('Vendor.is_deleted !=' => 1, 'OR' => array('Vendor.name LIKE' => "{$_GET['search']}%", 'Vendor.email LIKE' => "{$_GET['search']}%", 'Vendor.code LIKE' => "{$_GET['search']}%"));
                $condition = array_merge($condition, $datecond); 
            } else {
                $condition = array('Vendor.is_deleted !=' => 1);
            }
        }else{
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('Vendor.add_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }                  
                $condition = array('Vendor.added_by' => $user_id, 'Vendor.added_by_type' => $user_type, 'Vendor.is_deleted !=' => 1, 'OR' => array('Vendor.name LIKE' => "{$_GET['search']}%", 'Vendor.email LIKE' => "{$_GET['search']}%", 'Vendor.code LIKE' => "{$_GET['search']}%"));
                $condition = array_merge($condition, $datecond); 
            } else {
                $condition = array('Vendor.added_by' => $user_id, 'Vendor.added_by_type' => $user_type, 'Vendor.is_deleted !=' => 1);
            }
        }
        $this->paginate = array(
            'conditions' => $condition,
            'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'Vendor.modified DESC'
        );
        $data = $this->paginate('Vendor');
        $this->set(compact('data'));
    }    
    
    public function admin_editvendor($id = null) {
        $user_session = $this->Session->read('Vendor');
        $id = base64_decode($id);
        $PopupTitle = (isset($id) && $id>0)?"Edit Vendor":"Add Vendor";
        $this->set("PopupTitle", $PopupTitle);
        if ($this->request->is('post')) {
            $this->Vendor->set($this->request->data);
            if ($this->Vendor->validates()) {
                $this->request->data['Vendor']['added_by'] = $this->Session->read('User.User.id');
                $this->request->data['Vendor']['modified_by'] = $this->Session->read('User.User.id');
                $this->request->data['Vendor']['added_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['Vendor']['modified_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['Vendor']['add_date'] = date("Y-m-d", strtotime(str_replace("/", "-", $this->request->data['Vendor']['add_date'])));
                $msg = !empty($this->request->data['Vendor']['id'])?"updated":"added";
                if ($this->Vendor->save($this->request->data, false)) {
                    $this->Session->setFlash('Vendor has been '.$msg.' successfully', 'default', 'success');
                    $this->redirect(array('controller' => 'vendors', 'action' => 'listvendors', 'admin' => true));
                    exit;
                }
            } else {
                $str = '';
                foreach ($this->Vendor->validationErrors as $key => $error):
                    $str.=$error[0] . '<br/>';
                endforeach;
                $this->Session->setFlash('Vendor details could not saved <br/>' . $str, 'default', 'error');
                $this->redirect(array('controller' => 'vendors', 'action' => 'listvendors', 'admin' => true));
                exit;
            }
        } else {
            if ($id>0){
                //$this->Vendor->recursive = -1;
                $this->Vendor->id = $id;
                $data = $this->request->data = $this->Vendor->read();
                $this->request->data["Vendor"]["add_date"] = date("d-m-Y", strtotime($data["Vendor"]["add_date"]));
            } else {
                $this->Vendor->recursive = -1;
                $sch = array_keys($this->Vendor->getColumnTypes());
                foreach($sch as $info)
                    $this->request->data["Vendor"][$info] = "";
            }
            if ($this->RequestHandler->isAjax()) {    
                $this->set('vendors', $this->request->data);
                $this->set('_serialize', array('vendors', 'PopupTitle'));
            }
        }
    }    
    
    public function admin_listmasters() {
        $this->loadModel('VendorMaster');
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Accounts');
        
        $user_type = $this->Session->read('User.User.user_type_id');
        $user_id = $this->Session->read('User.User.id');
        
        if($user_type==1){ // super admin access
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('VendorMaster.added_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }                
                $condition = array('VendorMaster.is_deleted !=' => 1, 'OR' => array('VendorMaster.expense_type LIKE' => "{$_GET['search']}%", 'Vendor.name LIKE' => "{$_GET['search']}%", 'VendorMaster.material LIKE' => "{$_GET['search']}%"));
                $condition = array_merge($condition, $datecond); 
            } else {
                $condition = array('VendorMaster.is_deleted !=' => 1);
            }
        }else{
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('VendorMaster.added_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }                  
                $condition = array('VendorMaster.added_by' => $user_id, 'VendorMaster.added_by_type' => $user_type, 'VendorMaster.is_deleted !=' => 1, 'OR' => array('VendorMaster.expense_type LIKE' => "{$_GET['search']}%", 'Vendor.name LIKE' => "{$_GET['search']}%", 'VendorMaster.material LIKE' => "{$_GET['search']}%"));
                $condition = array_merge($condition, $datecond); 
            } else {
                $condition = array('VendorMaster.added_by' => $user_id, 'VendorMaster.added_by_type' => $user_type, 'VendorMaster.is_deleted !=' => 1);
            }
        }
        $this->paginate = array(
            'conditions' => $condition,
            'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'VendorMaster.modified DESC'
        );
        $data = $this->paginate('VendorMaster');
        $this->set(compact('data'));
    }

    public function admin_addmaster() {
        $this->autoRender = false;
        $error = false;
        $this->loadModel('VendorMaster');
        if ($this->request->is('post')) {
            $this->VendorMaster->set($this->request->data);
            if ($this->VendorMaster->validates()) {
                $this->request->data['VendorMaster']['added_by'] = $this->Session->read('User.User.id');
                $this->request->data['VendorMaster']['modified_by'] = $this->Session->read('User.User.id');
                $this->request->data['VendorMaster']['added_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['VendorMaster']['modified_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['VendorMaster']['added_date'] = date("Y-m-d", strtotime(str_replace("/", "-", $this->request->data['VendorMaster']['added_date'])));
                $this->VendorMaster->create();
                if ($this->VendorMaster->save($this->request->data['VendorMaster'], false)) {
                    $this->Session->setFlash('Master has been added successfully.', 'default', 'success');
                    $this->redirect(array('controller' => 'vendors', 'action' => 'listmasters', 'admin' => true));
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
            if ($error = true) {
                $errors = $this->VendorMaster->validationErrors;
                if (!empty($errors)) {
                    $str = '';
                    foreach ($errors as $key => $val):
                        $str.=$val[0];
                    endforeach;
                }
                $this->Session->setFlash('Master adding request not completed due to following errors : .' . $str . '. Try again!', 'message');
                $this->redirect(array('controller' => 'vendors', 'action' => 'listmasters', 'admin' => true));
            }
        }
    }

    public function admin_viewmaster($id = null) {
        $this->loadModel('VendorMaster');
        $PopupTitle = "Master Details";
        $id = base64_decode($id);
        $this->set("PopupTitle", $PopupTitle);
        if ($this->RequestHandler->isAjax()) {
            $branch = $this->VendorMaster->find('first', array(
                'conditions' => array(
                    'VendorMaster.id' => $id
                )
            ));
            $branchData = $branch;
            $branchData["VendorMaster"]["added_date"] = date("d-m-Y", strtotime($branch["VendorMaster"]["added_date"]));
            $this->set('adminData', $branchData);
            $this->set('_serialize', array('adminData', 'PopupTitle'));
        }
    }    


// ----------------

    public function admin_listmasterspurchase() {
        $this->loadModel('VendorMasterPurchase');
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Purchases');
        
        $user_type = $this->Session->read('User.User.user_type_id');
        $user_id = $this->Session->read('User.User.id');
        
        if($user_type==1){ // super admin access
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('VendorMasterPurchase.added_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }                  
                $condition = array('VendorMasterPurchase.is_deleted !=' => 1, 'OR' => array('Vendor.name LIKE' => "{$_GET['search']}%", 'VendorMasterPurchase.material LIKE' => "{$_GET['search']}%"));
                $condition = array_merge($condition, $datecond); 
            } else {
                $condition = array('VendorMasterPurchase.is_deleted !=' => 1);
            }
        }else{
            if ($this->request->isGet() && isset($_GET['search'])) {
                $datecond = array();
                if(!empty($_GET["start_date"]) && !empty($_GET["end_date"])){
                    $start_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["start_date"])));
                    $end_date = date("Y-m-d", strtotime(str_replace("/", "-", $_GET["end_date"])));
                    $datecond = array('OR'=>array('VendorMasterPurchase.added_date BETWEEN ? and ?' => array($start_date, $end_date)));
                }                  
                $condition = array('VendorMasterPurchase.added_by' => $user_id, 'VendorMasterPurchase.added_by_type' => $user_type, 'VendorMasterPurchase.is_deleted !=' => 1, 'OR' => array('Vendor.name LIKE' => "{$_GET['search']}%", 'VendorMasterPurchase.material LIKE' => "{$_GET['search']}%"));
                $condition = array_merge($condition, $datecond); 
            } else {
                $condition = array('VendorMasterPurchase.added_by' => $user_id, 'VendorMasterPurchase.added_by_type' => $user_type, 'VendorMasterPurchase.is_deleted !=' => 1);
            }
        }
        $this->paginate = array(
            'conditions' => $condition,
            'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'VendorMasterPurchase.modified DESC'
        );
        $data = $this->paginate('VendorMasterPurchase');
        $this->set(compact('data'));
    }

    public function admin_addmasterpurchase() {
        $this->autoRender = false;
        $error = false;
        $this->loadModel('VendorMasterPurchase');
        if ($this->request->is('post')) {
            $this->VendorMasterPurchase->set($this->request->data);
            if ($this->VendorMasterPurchase->validates()) {
                $this->request->data['VendorMasterPurchase']['added_by'] = $this->Session->read('User.User.id');
                $this->request->data['VendorMasterPurchase']['modified_by'] = $this->Session->read('User.User.id');
                $this->request->data['VendorMasterPurchase']['added_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['VendorMasterPurchase']['modified_by_type'] = $this->Session->read('User.User.user_type_id');
                $this->request->data['VendorMasterPurchase']['added_date'] = date("Y-m-d", strtotime(str_replace("/", "-", $this->request->data['VendorMasterPurchase']['added_date'])));
                $this->VendorMasterPurchase->create();
                if ($this->VendorMasterPurchase->save($this->request->data['VendorMasterPurchase'], false)) {
                    $this->Session->setFlash('Master has been added successfully.', 'default', 'success');
                    $this->redirect(array('controller' => 'vendors', 'action' => 'listmasterspurchase', 'admin' => true));
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
            if ($error = true) {
                $errors = $this->VendorMasterPurchase->validationErrors;
                if (!empty($errors)) {
                    $str = '';
                    foreach ($errors as $key => $val):
                        $str.=$val[0];
                    endforeach;
                }
                $this->Session->setFlash('Master adding request not completed due to following errors : .' . $str . '. Try again!', 'message');
                $this->redirect(array('controller' => 'vendors', 'action' => 'listmasterspurchase', 'admin' => true));
            }
        }
    }

    public function admin_viewmasterpurchase($id = null) {
        $this->loadModel('VendorMasterPurchase');
        $PopupTitle = "Master Details";
        $id = base64_decode($id);
        $this->set("PopupTitle", $PopupTitle);
        if ($this->RequestHandler->isAjax()) {
            $branch = $this->VendorMasterPurchase->find('first', array(
                'conditions' => array(
                    'VendorMasterPurchase.id' => $id
                )
            ));
            $branchData = $branch;
            $branchData["VendorMasterPurchase"]["added_date"] = date("d-m-Y", strtotime($branch["VendorMasterPurchase"]["added_date"]));
            $this->set('adminData', $branchData);
            $this->set('_serialize', array('adminData', 'PopupTitle'));
        }
    }    
    
// ----------------    
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
        $this->set('title_for_layout', 'Delete Vendor');
        $this->Vendor->id = $id;
        $userdata = $this->Vendor->find('first', array('fields' => array('Vendor.email', 'Vendor.name'), 'conditions' => array('Vendor.id' => $id)));
        if ($this->Vendor->saveField('is_deleted', 1)) {
            
        }
        $this->Session->setFlash('Vendor has been deleted successfully', 'default', 'success');
        $this->redirect(array('controller' => 'vendors', 'action' => 'listvendors', 'admin' => true));
    }

    public function admin_blockadmin($id = null, $blocktype = null) {
        $id = base64_decode($id);
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Active/Inactive Vendor');

        if (isset($blocktype) && $blocktype == 'block') {
            $this->Vendor->id = $id;
            $this->Vendor->saveField('status', 0);

            $this->Session->setFlash('Vendor has been deactivated successfully', 'default', 'success');
            $this->redirect(array('controller' => 'vendors', 'action' => 'listvendors', 'admin' => true));
        }
        if (isset($blocktype) && $blocktype == 'unblock') {
            $this->Vendor->id = $id;
            $this->Vendor->saveField('status', 1);
            $this->Session->setFlash('Vendor has been activated successfully', 'default', 'success');
            $this->redirect(array('controller' => 'vendors', 'action' => 'listvendors', 'admin' => true));
        }
    }
           
}
