<?php

App::uses('CakeTime', 'Utility');

class Country extends AppModel {

    public $name = 'Country';
    public $cacheQueries = false;
    public $actsAs = array('Containable');
 
    public function getAllCountries() {
            $data = array();
            $this->recursive = -1;
            $data = $this->find(
                    'all', array(
                            'fields' => array(
                                    'Country.name',
                                    'Country.iso',
                                    'Country.iso3'
                            ),
                    )
            );
            return $data;
    }
}
