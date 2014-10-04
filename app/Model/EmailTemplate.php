<?php

class EmailTemplate extends AppModel {

	var $name = 'EmailTemplate';
// public $useDbConfig = 'super_admin';

	var $validate = array(
		'mail_subject' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter the subject line.'
			),
		),
		'mail_body' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter mail template body.'
			),
		),
	);

	public function afterFind($results, $primary = false) {
		foreach ($results as $key => $val) {

			if (isset($val['EmailTemplate']['modified'])) {
				$results[$key]['EmailTemplate']['ago'] = CakeTime::timeAgoInWords(strtotime($val['EmailTemplate']['modified']));
			}
		}
		return $results;
	}
	
}
