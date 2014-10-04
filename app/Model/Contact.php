<?php

class Contact extends AppModel {

	var $name = 'Contact';
	var $useTable = false;
	var $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Name is required field.'
		),
		'email' => array(
			'rule1' => array(
				'rule' => 'email',
				'message' => 'Please enter valid email address.'
			),
			'rule2' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter email address.'
			)
		),
		/* 'service' => array(
			'rule' => 'notEmpty',
			'message' => 'Service is required field.'
		), */
		'subject' => array(
			'rule' => 'notEmpty',
			'message' => 'Subject is required field.'
		),
		'message' => array(
			'rule' => 'notEmpty',
			'message' => 'Message is required field.'
		)
	);

}
