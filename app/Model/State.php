<?php
	App::uses('AppModel', 'Model');
	class State extends AppModel {
		public $hasMany = array(
			'Authorize' => array(
				'className' => 'Authorize',
				'foreignKey' => 'state_id',
				'dependent' => false
			),
			'Menu' => array(
				'className' => 'Menu',
				'foreignKey' => 'state_id',
				'dependent' => false
			),
			'Role' => array(
				'className' => 'Role',
				'foreignKey' => 'state_id',
				'dependent' => false
			),
			'College' => array(
				'className' => 'College',
				'foreignKey' => 'state_id',
				'dependent' => false
			)
		);
	}
?>