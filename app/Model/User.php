<?php

App::uses('CakeTime', 'Utility');

class User extends AppModel {

    public $name = 'User';
    public $cacheQueries = false;
    public $actsAs = array('Containable');
    public $virtualFields = array(
        'full_name' => 'CONCAT(User.first_name, " ", User.last_name)',
        'full_name_username' => 'CONCAT(User.user_name, " (", CONCAT(User.first_name, " ", User.last_name), ")")'
    );
    public $belongsTo = array(
        'UserType' => array(
            'className' => 'UserType',
            'foreignKey' => 'user_type_id'
    ));

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
        /*
          'user_name' => array(
          'rule1' => array(
          'rule' => array('uniqueUserNamevalid'),
          'message' => 'Please choose another username, given username already exists.'
          ),
          'rule2' => array(
          'rule' => 'notEmpty',
          'message' => 'Please enter username.'
          )
          ), */
        'user_name' => array(
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
            //'message' => 'Username can only be letters, numbers, dash and underscore'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Please choose another username, given username already exists.'
            ),
            'minLength' => array(
                'rule' => array('minLength', '2'),
                'message' => 'Username must be at least 2 characters long.'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', '20'),
                'message' => 'Username cannot more than 20 characters long.'
            )
        ),
        /* 'email' => array(
          'rule1' => array(
          'rule' => 'email',
          //'required' => true,
          'message' => 'Please enter correct email address.'
          ),
          'rule2' => array(
          //'rule' => array('uniqueEmailvalid'),
          'rule' => 'isUnique',
          'message' => 'Please enter another email, given email address already exists.'
          ),
          'rule3' => array(
          'rule' => 'notEmpty',
          'message' => 'Please enter email address.'
          )
          ), */
        'password' => array(
            'rule1' => array(
                'rule' => array('minLength', 5),
                'message' => 'Password must be at least 5 characters long'
            ),
            'rule2' => array(
                'rule' => 'notEmpty',
                'allowEmpty' => false,
                'required' => true,
                'message' => 'Password cannot be empty.'
            )
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
        // Logo validation
        'logo' => array(
            'rule1' => array('rule' => array(
                    'extension',
                    array('png', 'PNG')
                ),
                'message' => 'Please supply a png format image'
            )
        )
    );

    public function setValidate($fields = null) {
        if ($fields === null) {
            $this->validate = $this->_validate;
        } else {
            $this->validate = array();
            foreach ($fields['User'] as $f => $field['key']) {
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
        if ($this->data['User']['password'] == $this->data['User']['cpassword']) {
            $valid = true;
        }

        return $valid;
    }

    public function uniqueEmailvalid() {
        $valid = false;
        if (isset($this->data['User']['id']) && !empty($this->data['User']['id'])) {

            $res = $this->find('list', array('fields' => array('email'), 'conditions' => "User.email='" . $this->data['User']['email'] . "' AND User.id != " . $this->data['User']['id']));
            $count = count($res);
        } else {
            $count = 0;
        }

        if ($count > 0)
            return false;
        else
            return true;
    }

    public function uniqueUserNamevalid() {
        $valid = false;

        if (isset($this->data['User']['id']) && !empty($this->data['User']['id'])) {

            $res = $this->find('list', array('fields' => array('user_name'), 'conditions' => "User.user_name='" . $this->data['User']['user_name'] . "' AND User.id != '" . $this->data['User']['id'] . "'"));
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

    public function checkUniqueUsername($data, $fieldName) {
        if (isset($this->data['User']['id']) && !empty($this->data['User']['id'])) {
            if ($data[$fieldName] == $this->field($fieldName, "user_name='" . $this->data['User']['user_name'] . "' AND id != '" . $this->data['User']['id'] . "'")) {
                return false;
            } else {
                //$valid = false;
                if (isset($fieldName) && $this->hasField($fieldName)) {
                    $valid = $this->isUnique(array($fieldName => $data));
                }

                return $valid;
            }
        } else {
            if ($data[$fieldName] == $this->field($fieldName, "user_name='" . $this->data['User']['email'] . "'")) {
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

    public function _getUserInformation() {
        $Fields = array('User.id', 'User.user_name', 'User.first_name', 'User.last_name');
        $UsersData = $this->find("all", array("fields" => $Fields));
        $UserData = array();
        foreach ($UsersData As $UserDataKey => $UserDataValue) {
            $UserData[$UserDataValue['User']['id']] = $UserDataValue['User'];
        }

        return $UserData;
    }

    public function afterFind($results, $primary = false) {
        $statusArray = Configure::read('EntityStatus');
        foreach ($results as $key => $val) {
            if (isset($val['User']['modified'])) {
                $results[$key]['User']['ago'] = CakeTime::timeAgoInWords(strtotime($val['User']['modified']));
                $results[$key]['User']['current_status'] = $statusArray[$val['User']['status']];
            }
        }
        return $results;
    }

	public function getAllUsers() {
		$users = array();
		$this->recursive = -1;
		$users = $this->find(
			'all', array(
				'fields' => array(
					'User.full_name',
					'User.email'
				),
				'conditions' => array('User.is_deleted' => 0)
			)
		);
		return $users;
	}
}
