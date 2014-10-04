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

class HomesController extends AppController {

    public $name = 'Homes';
    public $uses = array();
    public $helpers = array('Html', 'Form', 'Session', 'Js', 'Paginator', 'Common', 'Time');
    public $components = array('Email', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index(){
				$this->layout = 'front';
        $this->set('title_for_layout', 'Home');
    }

    public function products(){
				$this->layout = 'front';
        $this->set('title_for_layout', 'Products');
    }

    public function contact(){
				$this->layout = 'front';
        $this->set('title_for_layout', 'Home');
    }

    public function about(){
				$this->layout = 'front';
        $this->set('title_for_layout', 'Products');
    }
    
	public function contact_us() {
		$this->layout = 'front';
		$this->set('title_for_layout', 'CONTACT US');
		$this->loadModel('Contact');
		if ($this->request->is('post')) {
			$this->Contact->set($this->request->data);
			if ($this->Contact->validates($this->request->data)) {
				App::uses('CakeEmail', 'Network/Email');

				//CODE TO FIRE AN EMAIL
				$this->loadModel('EmailTemplate');
				$temp = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 4)));
				$temp['EmailTemplate']['mail_body'] = str_replace(array('../../..', '#ADMINNAME', '#FULLNAME', '#EMAIL', '#NUMBER', '#SUBJECT', '#MESSAGE'), array(Configure::read('FULL_BASE_URL.URL'), 'ADMIN', $this->request->data['Contact']['name'], $this->request->data['Contact']['email'], $this->request->data['Contact']['number'], $this->request->data['Contact']['subject'], nl2br($this->request->data['Contact']['message'], true)), $temp['EmailTemplate']['mail_body']);
				$this->set('template', $temp['EmailTemplate']['mail_body']);
				$Email = new CakeEmail();
				//$Email->template('default');
				$Email->emailFormat('both');
				$Email->from(array(Configure::read('Email.EmailSupport') => Configure::read('Email.EmailSupport')));
				$Email->sender(Configure::read('Email.EmailSupport'), Configure::read('Email.EmailName'));
				$Email->to(Configure::read('Email.EmailAdmin'));
				$Email->subject($temp['EmailTemplate']['mail_subject']);

				if ($Email->send($temp['EmailTemplate']['mail_body'])) {
					$this->Session->setFlash('Your enquiry delivered successfully. Our representative will be get back to you in next 2 working days.', 'default', array(), 'success');
				} else {
					$this->Session->setFlash('Email not sent. Please try again!', 'default', array(), 'error');
				}
				$this->redirect(array('controller' => 'homes', 'action' => 'contact_us'));
			} else {
				$errors = $this->Contact->validationErrors;
				if (!empty($errors)) {
					$errorstr = '<ul>';

					foreach ($errors as $val) {
						$errorstr .= '<li>' . $val[0] . '</li>';
					}
					$errorstr .= '</ul>';
				}
				$this->Session->setFlash($errorstr, 'default', array(), 'error');
				$this->redirect(array('controller' => 'homes', 'action' => 'contact_us'));
			}
		}
	}

	public function services() {
		$this->layout = 'front';
		$this->set('title_for_layout', 'Services');
		$this->loadModel('CmsPage');
		$data = $this->CmsPage->find('first', array('conditions' => array('CmsPage.id' => 1)));
		$this->set('data', $data);
	}
	
	public function day_trading_data() {
		$this->layout = 'front';
		$this->set('title_for_layout', 'Day Trading Data');
		$this->loadModel('CmsPage');
		$data = $this->CmsPage->find('first', array('conditions' => array('CmsPage.id' => 4)));
		$this->set('data', $data);
	}
	
	public function short_term_trading_data() {
		$this->layout = 'front';
		$this->set('title_for_layout', 'Short Term Trading Data');
		$this->loadModel('CmsPage');
		$data = $this->CmsPage->find('first', array('conditions' => array('CmsPage.id' => 5)));
		$this->set('data', $data);
	}
	
	public function hp_text() {
		$this->layout = 'front';
		$this->set('title_for_layout', 'hpText');
		$this->loadModel('CmsPage');
		$data = $this->CmsPage->find('first', array('conditions' => array('CmsPage.id' => 3)));
		$this->set('data', $data);
	}
	
	public function terms() {
		$this->layout = 'front';
		$this->set('title_for_layout', 'Terms of Use');
		$this->loadModel('CmsPage');
		$data = $this->CmsPage->find('first', array('conditions' => array('CmsPage.id' => 2)));
		$this->set('data', $data);
	}
	   
       
}
