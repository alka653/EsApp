<?php
	App::uses('AppModel', 'Model');
	class Menu extends AppModel {
		public $belongsTo = array(
			'State' => array(
				'className' => 'State',
				'foreignKey' => 'state_id'
			)
		);
		public $hasMany = array(
			'Authorize' => array(
				'className' => 'Authorize',
				'foreignKey' => 'menu_id',
				'dependent' => false
			)
		);
	}
?>