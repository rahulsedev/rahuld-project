<?php

App::uses('CakeTime', 'Utility');

class TempCustomer extends AppModel {

    public $name = 'TempCustomer';
    public $cacheQueries = false;
    public $actsAs = array('Containable');
    public $virtualFields = array(
        'full_name' => 'CONCAT(TempCustomer.first_name, " ", TempCustomer.last_name)',
        'full_name_username' => 'CONCAT(TempCustomer.username, " (", CONCAT(TempCustomer.first_name, " ", TempCustomer.last_name), ")")'
    );
    
    public $validate = array(
        'phone' => array(
            'rule1' => array(
                'rule' => 'Numeric',
                'allowEmpty' => true,
                'message' => 'Please enter numbers only.'
            )
        ),
        'first_name' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter first name.'
            ),
            'rule2' => array(
                'rule' => '/^[a-zA-Z ]*$/',
                'message' => 'First name only letters allowed'
            ),
        ),
        'last_name' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter last name.'
            ),
            'rule2' => array(
                'rule' => '/^[a-zA-Z ]*$/',
                'message' => 'Last name only letters allowed'
            ),
        ),
        'service_type' => array(
          'rule1' => array(
            'rule' => 'notEmpty',
            'message' => 'Please choose a Service type.'
          )
        ),
        'username' => array(
          'rule1' => array(
          'rule' => array('uniqueCustomerNamevalid'),
          'message' => 'Please choose another username, given username already exists.'
          ),
          'rule2' => array(
          'rule' => 'notEmpty',
          'message' => 'Please enter username.'
          )
        ),
        'username' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter user name.'
            ),
            'rule2' => array(
                //'rule' => '/^(?![0-9]*$)[a-zA-Z0-9]+$/',
                //'rule'=>'/^[a-z_A-Z0-9]+$/',
                'rule' => '/^(?!_\.\-)[A-Za-z0-9_\.\-]+(?<!_\.\-)$/',
                //'rule'=>'^[a-zA-Z0-9][\w\_]+[a-zA-Z0-9]$',
                'message' => 'Only letters or alphaNumerics with underscore(not first and last).Please enter a valid user name.'
            //'rule'    => 'alphaNumericDashUnderscore',
            //'message' => 'Customername can only be letters, numbers, dash and underscore'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Please choose another username, given username already exists.'
            ),
            'minLength' => array(
                'rule' => array('minLength', '2'),
                'message' => 'Customername must be at least 2 characters long.'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', '20'),
                'message' => 'Customername cannot more than 20 characters long.'
            )
        ),
        'email' => array(

        'rule1' => array(
          'rule' => 'notEmpty',
          'message' => 'Please enter email address.'
          ),
          'rule2' => array(
          'rule' => array('uniqueEmailvalid'),
          'rule' => 'isUnique',
          'message' => 'Please enter another email, given email address already exists.'
          ),
        'rule3' => array(
          'rule' => 'email',
          //'required' => true,
          'message' => 'Please enter correct email address.'
          ),          
          ),
        'password' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'allowEmpty' => false,
                'required' => true,
                'message' => 'Password cannot be empty.'
            ),
            'rule2' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be at least 6 characters long'
            ),
        ),
        'cpassword' => array(
            'rule1' => array(
                'rule' => 'confirmpass',
                'message' => 'Confirm password should be same as password.'
            ),
            'rule2' => array(
                'rule' => 'notEmpty',
                'allowEmpty' => false,
                'message' => 'Please enter confirm password.'
            )
        ),

        'address1' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter Address #1.'
            )
        ),        

        'city' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter City.'
            )
        ), 
        
        'country' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter Country.'
            )
        ), 

        'state' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter State.'
            )
        ), 

        'zip' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter Postal Code/Zip.'
            )
        ), 

        'phone' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter phone.'
            )
        ), 
        

    );

    public function setValidate($fields = null) {
        if ($fields === null) {
            $this->validate = $this->_validate;
        } else {
            $this->validate = array();
            foreach ($fields['Customer'] as $f => $field['key']) {
                if (isset($this->_validate[$f])) {
                    $this->validate[$f] = $this->_validate[$f];
                }
            }
        }
    }

    /*     * ***********************************************************************
     * function      : confirmpass
     * functionality : check password and confirm password field same or not
     * ********************************************************************** */

    public function confirmpass() {
        $valid = false;
        if ($this->data['Customer']['password'] == $this->data['Customer']['cpassword']) {
            $valid = true;
        }

        return $valid;
    }

    public function uniqueEmailvalid() {
        $valid = false;
        if (isset($this->data['Customer']['id']) && !empty($this->data['Customer']['id'])) {

            $res = $this->find('list', array('fields' => array('email'), 'conditions' => "Customer.email='" . $this->data['Customer']['email'] . "' AND Customer.id != " . $this->data['Customer']['id']));
            $count = count($res);
        } else {
            $count = 0;
        }

        if ($count > 0)
            return false;
        else
            return true;
    }

    public function uniqueCustomerNamevalid() {
        $valid = false;

        if (isset($this->data['Customer']['id']) && !empty($this->data['Customer']['id'])) {

            $res = $this->find('list', array('fields' => array('username'), 'conditions' => "Customer.username='" . $this->data['Customer']['username'] . "' AND Customer.id != '" . $this->data['Customer']['id'] . "'"));
            $count = count($res);
        } else {
            $count = 0;
        }

        if ($count > 0)
            return false;
        else
            $valid = true;

        return true;
    }

    # TO Check for Unique name

    public function checkUniqueCustomername($data, $fieldName) {
        if (isset($this->data['Customer']['id']) && !empty($this->data['Customer']['id'])) {
            if ($data[$fieldName] == $this->field($fieldName, "username='" . $this->data['Customer']['username'] . "' AND id != '" . $this->data['Customer']['id'] . "'")) {
                return false;
            } else {
                //$valid = false;
                if (isset($fieldName) && $this->hasField($fieldName)) {
                    $valid = $this->isUnique(array($fieldName => $data));
                }

                return $valid;
            }
        } else {
            if ($data[$fieldName] == $this->field($fieldName, "username='" . $this->data['Customer']['email'] . "'")) {
                return false;
            } else {
                //$valid = false;
                if (isset($fieldName) && $this->hasField($fieldName)) {
                    $valid = $this->isUnique(array($fieldName => $data));
                }

                return $valid;
            }
        }
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = md5($this->data[$this->alias]['password']);
        }

        return true;
    }

    public function _getCustomerInformation() {
        $Fields = array('Customer.id', 'Customer.username', 'Customer.first_name', 'Customer.last_name');
        $CustomersData = $this->find("all", array("fields" => $Fields));
        $CustomerData = array();
        foreach ($CustomersData As $CustomerDataKey => $CustomerDataValue) {
            $CustomerData[$CustomerDataValue['Customer']['id']] = $CustomerDataValue['Customer'];
        }

        return $CustomerData;
    }

    public function afterFind($results, $primary = false) {
        $statusArray = Configure::read('EntityStatus');
        foreach ($results as $key => $val) {
            if (isset($val['Customer']['modified'])) {
                $results[$key]['Customer']['ago'] = CakeTime::timeAgoInWords(strtotime($val['Customer']['modified']));
                $results[$key]['Customer']['current_status'] = $statusArray[$val['Customer']['status']];
            }
        }
        return $results;
    }

	public function getAllCustomers() {
		$users = array();
		$this->recursive = -1;
		$users = $this->find(
			'all', array(
				'fields' => array(
					'Customer.full_name',
					'Customer.email'
				),
				'conditions' => array('Customer.is_deleted' => 0)
			)
		);
		return $users;
	}
}
