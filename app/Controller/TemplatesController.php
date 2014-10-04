<?php

App::uses('AppController', 'Controller');

// App::uses('ConnectionManager', 'Model');

class TemplatesController extends AppController {

    public $name = 'Templates';
    public $uses = array('User', 'EmailTemplate');
    public $helpers = array('Html', 'Form', 'Session', 'Fck');
    public $components = array('Email');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function admin_listtemplates() {
        $this->layout = 'crm_layout';
        $this->set('title_for_layout', 'Email Templates');
        $user_session = $this->Session->read('User');
        $id = $user_session['User']['id'];
        $this->loadModel('EmailTemplate');
        
        if ($this->request->isGet() && isset($_GET['search'])) {
            $condition = array('EmailTemplate.is_active' => 1, 'OR' => array('EmailTemplate.template_for LIKE' => "{$_GET['search']}%", 'EmailTemplate.mail_subject LIKE' => "{$_GET['search']}%", 'EmailTemplate.mail_body LIKE' => "{$_GET['search']}%"));
        } else {
            $condition = array('EmailTemplate.is_active' => 1);
        }        
        
		$this->paginate = array(
			'conditions' => $condition,
			'limit' => Configure::read('LIST_NUM_RECORDS.Superadmin'),
            'order' => 'EmailTemplate.modified DESC'
		);        

        $data = $this->paginate('EmailTemplate');
        $this->set(compact('data'));
    }

    public function admin_edit_template($id = null) {
        $this->layout = 'crm_layout';
        $id = base64_decode($id);
        $this->set('title_for_layout', "Edit Email Template");
        $this->loadModel('EmailTemplate');

        if ($this->request->is('post')) {
            $this->EmailTemplate->set($this->request->data);
            if ($this->EmailTemplate->validates()) {
                $this->EmailTemplate->id = $id;
                if ($this->EmailTemplate->save($this->request->data['EmailTemplate'], false)) {
                    $this->Session->setFlash('Email template has been updated successfully', 'default', 'success');
                    $this->redirect(array('controller' => 'templates', 'action' => 'listtemplates', 'admin' => true));
                }
            } else {
                //pr($this->User->validationErrors);echo 'error';
            }
        } else {
            $this->EmailTemplate->id = $id;
            $this->request->data = $this->EmailTemplate->read();
        }
    }
}
