<?php
	App::uses('AppModel', 'Model');
	App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
	class User extends AppModel {
		public $belongsTo = array(
			'Role' => array(
				'className' => 'Role',
				'foreignKey' => 'role_id'
			)
		);
		public function parentNode(){
			if(!$this->id && empty($this->data)){
				return null;
			}
			if(isset($this->data['User']['role_id'])){
				$roleId = $this->data['User']['role_id'];
			}else{
				$roleId = $this->field('role_id');
			}
			if(!$roleId){
				return null;
			}
			return array('Role' => array('id' => $roleId));
		}
		public function beforeSave($options = array()) {
	        if(isset($this->data[$this->alias]['password'])){
	        	$passwordHasher = new BlowfishPasswordHasher();
	        	$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
	        }
	        return true;
	    }
	}
?>