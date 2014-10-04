<?php

App::uses('CakeTime', 'Utility');

class State extends AppModel {

    public $name = 'State';
    public $cacheQueries = false;
    public $actsAs = array('Containable');
 

    public function getStatebyCountry($country) {
            $data = array();
            $this->recursive = -1;
            $users = $this->find(
                    'all', array(
                            'fields' => array(
                                    'State.code',
                                    'State.State_prov'
                            ),
                            'conditions' => array('State.country' => $country)
                    )
            );
            return $data;
    }
}
