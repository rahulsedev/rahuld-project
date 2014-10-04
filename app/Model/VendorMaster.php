<?php

App::uses('CakeTime', 'Utility');

class VendorMaster extends AppModel {

    public $name = 'VendorMaster';
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
        ),
        'Vendor' => array(
            'className' => 'Vendor',
            'foreignKey' => 'vendor_id'        
        )
        );

}
