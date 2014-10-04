<?php

App::uses('CakeTime', 'Utility');

class Vendor extends AppModel {

    public $name = 'Vendor';
    public $cacheQueries = false;
    public $actsAs = array('Containable');

    public $virtualFields = array(
        'full_name' => 'CONCAT(User.first_name, " ", User.last_name)',
        'full_name_username' => 'CONCAT(User.user_name, " (", CONCAT(User.first_name, " ", User.last_name), ")")'
    );

    public $belongsTo = array(
        'UserType' => array(
            'className' => 'UserType',
            'foreignKey' => 'added_by_type'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'added_by'        
        )
    );

}