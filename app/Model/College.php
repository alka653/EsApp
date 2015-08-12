<?php
	App::uses('AppModel', 'Model');
	class College extends AppModel{
		public $displayField = 'name_college';
		public $belongsTo = array(
			'State' => array(
				'className' => 'State',
				'foreignKey' => 'state_id'
			)
		);
		public $actsAs = array(
			'Upload.Upload' => array(
				'photo' => array(
					'path' => '{ROOT}{DS}webroot{DS}img{DS}{model}{DS}{field}{DS}',
					'fields' => array(
						'dir' => 'photo_dir'
					),
					'thumbnailMethod' => 'php',
					'deleteOnUpdate' => true,
					'deleteFolderOnDelete' => true
				),
			),
		); 
		public function beforeSave($options = array()) {
			/*
			Creacion de base de datos del colegio
	        if(isset($this->data[$this->alias]['name_database'])){
	    		$this->query("CREATE DATABASE escolapp_bd_".$this->data[$this->alias]['name_database'].";");
	    		$database = 'escolapp_bd_'.$this->data[$this->alias]['name_database'];
      			$nds = 'default'.'_'.$database;      
      			$db  = ConnectionManager::getDataSource('default');
      			$db->setConfig(array(
        			'name'       => $nds,
        			'database'   => $database,
        			'persistent' => false
      			));
      			if($ds = ConnectionManager::create($nds, $db->config)){
	        		$this->useDbConfig  = $nds;
	    			$this->query("CREATE TABLE nueva(id int not null);");
	      		}else{
	      			return false;
	      		}
	        }
	        return true;
	        */
	    }
	}
?>