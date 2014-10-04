<?php

App::uses('CakeTime', 'Utility');

class Banner extends AppModel {

    public $name = 'Banner';
    public $cacheQueries = false;
    public $actsAs = array('Containable');
   
    public $belongsTo = array(
        'CmsPage' => array(
            'className' => 'CmsPage',
            'foreignKey' => 'cms_page_id'
            )
        );
}
