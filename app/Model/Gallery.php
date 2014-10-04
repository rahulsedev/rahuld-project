<?php

App::uses('CakeTime', 'Utility');

class Gallery extends AppModel {

    public $name = 'Gallery';
    public $cacheQueries = false;
    public $actsAs = array('Containable');
   
}
