<?php
	App::uses('AppModel', 'Model');
	class Authorize extends AppModel {
		public $belongsTo = array(
			'Role' => array(
				'className' => 'Role',
				'foreignKey' => 'role_id'
			),
			'Menu' => array(
				'className' => 'Menu',
				'foreignKey' => 'menu_id'
			),
			'State' => array(
				'className' => 'State',
				'foreignKey' => 'state_id'
			)
		);
	}
?>