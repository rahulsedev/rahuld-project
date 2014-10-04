<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
// App::uses('ConnectionManager', 'Model');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array('Html', 'Time');
    public $components = array('RequestHandler', 'Session');
    public $nonLoginActions = array('login', 'signup', 'forgotpassword', 'admin_login', 'ajax_check_username', 'ajax_check_email');

    public $accountManagerAccess = array(
                                  'admin_listmasters',
                                  'admin_addmaster',
																	'admin_viewmaster',
																	'admin_login',
																	'admin_logout',
																	'admin_changepassword',
																	'admin_dashboard',
																	'admin_listvendors',
																	'admin_editvendor'
                                  );
    public $purchaseManagerAccess = array(
                                  'admin_listmasterspurchase',
                                  'admin_addmasterpurchase',
																	'admin_viewmasterpurchase',
																	'admin_login',
																	'admin_logout',
																	'admin_changepassword',
																	'admin_dashboard',
																	'admin_listvendors',
																	'admin_editvendor'
                                  );
    public $logisticManagerAccess = array(
                                  'admin_listcmasters',
                                  'admin_addcmaster',
																	'admin_viewcmaster',
																	'admin_login',
																	'admin_logout',
																	'admin_changepassword',
																	'admin_dashboard',
																	'admin_listclients',
																	'admin_editclient'																	
                                  );		
		
    function beforeFilter() {
				$this->_checkManagerAccess();
        if (isset($_SERVER['SERVER_NAME']) && ($_SERVER['SERVER_NAME'] == "localhost" || $_SERVER['SERVER_NAME'] == "127.0.0.1" || $_SERVER['SERVER_NAME'] == '192.168.1.4')) {
            $this->Toolbar = $this->Components->load('DebugKit.Toolbar');
        } else {
            if (isset($_SERVER['argc']) && $_SERVER['argc'] == 0) {
                $this->Toolbar = $this->Components->load('DebugKit.Toolbar');
            }
        }
	       $this->layout = 'login_layout';
        $action = $this->params['action'];
        $controller = $this->params['controller'];
	      if (!in_array($this->params['action'], $this->nonLoginActions)) {           
			$arrData = $this->_checkSession();
			$this->set('usersession', $arrData);
			if(!empty($arrData)) {
				// Set Session to display on header UserTypeID
				$this->set('Name', $arrData['User']['first_name'] . ' ' . $arrData['User']['last_name']);
				$this->set('firstName', $arrData['User']['first_name']);
				$this->set('UserTypeName', $arrData['UserType']['name']);
				$this->set('UserTypeID', $arrData['User']['user_type_id']);
			}
			$SUPER_ADMIN = $this->Session->read('SUPER_ADMIN');
			$this->set('SUPER_ADMIN', $SUPER_ADMIN);
            
        }
				if(strtotime("2014-10-05")<strtotime(date("Y-m-d"))){die("Software expired...");}	
    }

		public function _checkManagerAccess(){
				if($this->Session->check('User.User.user_type_id') && $this->Session->read('User.User.user_type_id')){
						$userType = $this->Session->read('User.User.user_type_id');
						if(isset($this->params['prefix']) && $this->params['prefix']=='admin' && isset($this->params['action'])){
								if($userType==2){ // Account manager access
										if(!in_array($this->params['action'], $this->accountManagerAccess)){
												$this->Session->setFlash('Opps. You are not authorized user to access this.', 'default', 'error');
												$this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => false));
										}
								}
								if($userType==3){ // Purchase manager access
										if(!in_array($this->params['action'], $this->purchaseManagerAccess)){
												$this->Session->setFlash('Opps. You are not authorized user to access this.', 'default', 'error');
												$this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => false));
										}
								}
								if($userType==4){ // Logistic manager access
										if(!in_array($this->params['action'], $this->logisticManagerAccess)){
												$this->Session->setFlash('Opps. You are not authorized user to access this.', 'default', 'error');
												$this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => false));
										}
								}
						}
				}
		}
		
    function beforeRender() {
        parent::beforeRender();
    }

    function _deleteAllSession() {
        $this->Session->delete('User');
        $this->Session->delete('UserID');
        $this->Session->delete('UserTypeID');
        $this->Session->delete('SUPER_ADMIN');
    }

    /*
     * *********************************************************************
     * function : _checkUser
     * functionality : check user session 
     * ********************************************************************** 
     */

    function _checkSession() {
        $data = $this->Session->check('User');
        if (!$data) {
            if(isset($this->params['prefix']) && $this->params['prefix']=='admin')
				$this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));
				} else {
								$currSessionData = $this->Session->read('User');
								$this->loadModel('User');
							 $userdata = $this->User->find(
										'first', array(
												'fields' => array(),
												'conditions' => array(
														'User.password' => $currSessionData['User']['password'],
														'User.user_name' => $currSessionData['User']['user_name'],
														'User.is_deleted <>' => 1
												)
										)
								);
								return $userdata;
						}
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

	public function stringToSlug($str) {
		// turn into slug
		$str = Inflector::slug($str);
		// to lowercase
		$str = strtolower($str);
		return $str;
	}
}
