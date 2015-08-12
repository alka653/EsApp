<?php
	App::uses('AppModel', 'Model');
	class Role extends AppModel {
		public $belongsTo = array(
			'State' => array(
				'className' => 'State',
				'foreignKey' => 'state_id'
			)
		);
		public $hasMany = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'role_id',
				'dependent' => false
			)
		);
	}
?>