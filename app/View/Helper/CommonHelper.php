<?php

App::uses('AppHelper', 'View/Helper');
//App::uses('Helper', 'View');
App::uses('ConnectionManager', 'Model');

//App::uses('TimeHelper', 'View/Helper');
/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CommonHelper extends AppHelper {

    public $helpers = array('Time');

    public function getAdmin_name($user_id = null) {

        App::import('Model', 'User');
        $User = new User();
        $res = $User->find('first', array('conditions' => array('User.id' => $user_id), 'fields' => array('User.user_name')));
        if (!empty($res)) {
            return $res['User']['user_name'];
        }
    }
    
    public function countReply($postId = null) {
        $total=0;
        App::import('Model', 'Discussions');
        $discussions = new Discussions();
        $data = $discussions->find('count', array('conditions' => array('Discussions.parent_id IS NOT NULL', 'Discussions.parent_id'=>$postId)));
        if ($data>0) {
            $total = $data;
        }
        return $total;
    }
    
    public function isCreator($currUserId = null, $postId =null ) {
        $isCreator=false;
        App::import('Model', 'Discussions');
        $discussions = new Discussions();
        $data = $discussions->find('count', array('conditions' => array('Discussions.parent_id IS NULL', 'Discussions.id'=>$postId, 'Discussions.posted_by'=>$currUserId)));
        if ($data>0) {
            $isCreator = true;
        }
        return $isCreator;
    }
    
}