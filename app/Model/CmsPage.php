<?php

class CmsPage extends AppModel {

	var $name = 'CmsPage';
	
	public $hasOne = array(
		'Banner' => array(
			'className' => 'Banner',
			'foreignKey' => 'cms_page_id'
		)
	);

	var $validate = array(
		'title' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter the page title.'
			),
		),
		'content' => array(
			'rule1' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter the page content.'
			),
		),
	);

}
