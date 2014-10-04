<?php

App::uses('CakeTime', 'Utility');

class SystemSetting extends AppModel {

    public $name = 'SystemSetting';
    public $cacheQueries = false;
    public $actsAs = array('Containable');
    public $validate = array(
        'site_name' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please site name.'
            ),
        ),
        'admin_email' => array(
            'rule1' => array(
                'rule' => 'email',
                //'required' => true,
                'message' => 'Please enter correct email address.'
            ),
            'rule2' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter email address.'
            )
        ),
        'vat' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter vat.'
            ),
        ),
    );
   
    public function getSystemSettings() {
        $settings = array();
        $settings = $this->find('all');
        return $settings;
    }
}
