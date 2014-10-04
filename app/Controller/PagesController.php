<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('CmsPage');
	public $helpers = array('Html', 'Form', 'Session', 'Js', 'Paginator', 'Common', 'Time', 'Fck');
	public $components = array('Email', 'RequestHandler', 'Route');

	/**
	 * Displays a view
	 *
	 * @param mixed What page to display
	 * @return void
	 */
	public function beforeFilter() {
		parent::beforeFilter();
	}

	public function admin_listcmspages() {
		$this->layout = 'crm_layout';
		$this->set('title_for_layout', "Static CMS Pages");
		$currentUserSession = $this->Session->read('User');
		$id = $currentUserSession['User']['id'];
		if ($currentUserSession['User']['user_type_id'] != 1) {
			$this->Session->setFlash('You donot have permission', 'default', 'message');
			$this->redirect(array('controller' => 'users', 'action' => 'dashboard', 'admin' => true));
		}
        
        if ($this->request->isGet() && isset($_GET['search'])) {
            $condition = array('CmsPage.is_active' => 1, 'OR' => array('CmsPage.title LIKE' => "{$_GET['search']}%", 'CmsPage.content LIKE' => "{$_GET['search']}%"));
        } else {
            $condition = array('CmsPage.is_active' => 1);
        }        
        
		$this->paginate = array(
			'conditions' => $condition,
			'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'CmsPage.modified DESC'
		);
		$data = $this->paginate('CmsPage');
		$this->set(compact('data'));       
        
	}    

    public function admin_edit_cmspage($id = null) {
        $this->layout = 'crm_layout';
        $id = base64_decode($id);
        $this->set('title_for_layout', "Edit CMS Page");

        if ($this->request->is('post')) {
            $this->CmsPage->set($this->request->data);
            if ($this->CmsPage->validates()) {
                $this->CmsPage->id = $id;
                if ($this->CmsPage->save($this->request->data['CmsPage'], false)) {
                    $this->Session->setFlash('CMS Page has been updated successfully', 'default', 'success');
                    $this->redirect(array('controller' => 'pages', 'action' => 'listcmspages', 'admin' => true));
                }
            } else {
                //pr($this->User->validationErrors);echo 'error';
            }
        } else {
            $this->CmsPage->id = $id;
            $this->request->data = $this->CmsPage->read();
        }
    }
    
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
	

    public function admin_manage_banner($id = null) {

        $PopupTitle = "Manage Banner";
        $id = base64_decode($id);
        $this->set("PopupTitle", $PopupTitle);
	$this->loadModel('Banner');
        
	App::import('Vendor', 'Image/Image');
	$up = new Image();
	if ($this->request->is('post')) {
            // $this->request->data = Sanitize::clean($this->request->data, array('escape' => true));
            $this->Banner->set($this->request->data);
	    //pr($this->request->data);exit;
            if ($this->Banner->validates()) {
                if (!empty($this->data['Banner']['image']['name'])) {
                    $up->set_paths(WWW_ROOT . 'img/banner/', WWW_ROOT . 'img/upload/');
                    $IMG_PATH = $up->upload_image($this->request->data['Banner']['image']);
                    $pathArr = explode("/", $IMG_PATH);
		    $image_name = $pathArr[count($pathArr) - 1];
                    copy($IMG_PATH, WWW_ROOT . 'img/upload/' . $image_name);
                    $up->resize($IMG_PATH, '720', '300');
                    $this->request->data['Banner']['image'] = $image_name;
                    
		    if (file_exists(WWW_ROOT . 'img/banner/' . $this->request->data['Banner']['old_image'])) {
                        @unlink(WWW_ROOT . 'img/banner/' . $this->request->data['Banner']['old_image']);
                    }
                    if (file_exists(WWW_ROOT . 'img/upload/' . $this->request->data['Banner']['old_image'])) {
                        @unlink(WWW_ROOT . 'img/upload/' . $this->request->data['Banner']['old_image']);
                    }
                } else {
                    $this->request->data['Banner']['image'] = $this->request->data['Banner']['old_image'];
                }
                //upload photo
		if(empty($this->request->data['Banner']['is_on']))
			$this->request->data['Banner']['is_on'] = '0';
                if ($this->Banner->save($this->request->data['Banner'], false)) {
                    $this->Session->setFlash('Banner has been saved successfully', 'default', 'success');
                    $this->redirect(array('controller' => 'pages', 'action' => 'listcmspages', 'admin' => true));
                    exit;
                }
            } else {

                $str = '';
                foreach ($this->Banner->validationErrors as $key => $error):
                    $str.=$error[0] . '<br/>';
                endforeach;

                $this->Session->setFlash('Banner is not saved <br/>' . $str, 'default', 'error');
                $this->redirect(array('controller' => 'pages', 'action' => 'listcmspages', 'admin' => true));
                exit;
            }
        } else {
            $this->Banner->recursive = -1;
            $this->request->data = $this->Banner->find('first', array('conditions'=>array('Banner.cms_page_id'=>$id)));
	    if(!empty($this->request->data)){
		$dataToGo = $this->request->data;
	    }else{
		$dataToGo['Banner'] = array('id'=>'', 'cms_page_id'=>$id, 'title'=>'', 'image'=>'', 'is_on'=>'1');
	    }
            if ($this->RequestHandler->isAjax()) {
                $this->set('banners', $dataToGo);
                $this->set('_serialize', array('banners', 'PopupTitle', 'cms_page_id'=>$id));
            }
        }
    }	
	
	
}
