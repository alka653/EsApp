<?php
	/*
	$this->User->useDbConfig = 'school1'; -> Seleccionar la configuracion en database.php
												de la base de datos
	*/
	App::uses('AppController', 'Controller');
	class CollegesController extends AppController{
		public $name = 'Colleges';
		public $components = array('Session');
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('ListCollege', 'college_login', 'CollegeFindDB');
		}
		public function isAuthorized($user){
			if(($user['role_id'] == '1') && ($user['type'] == 'A')){
				if(in_array($this->action, array('add', 'save', 'edit', 'CollegeFindDB', 'college_edit', 'update', 'ChangeState'))){
					return true;
				}else{
					if($this->Auth->user('id')){
						$this->Session->setFlash('<i class="glyphicon glyphicon-warning-sign"></i>  No puede acceder a esta sección.', 'default', array('class' => 'warning text-center'));
						$this->redirect(array('controller' => 'welcome', 'action' => 'index'));
					}
				}
			}
			return parent::isAuthorized($user);
		}
		public function ListCollege(){
			$user = $this->Auth->user();
			if($user['id']){
				if($user['role_id'] =! '1'){
					$this->redirect(array('controller' => 'welcome', 'action' => 'index'));
				}else{
					$state_id = array();
				}
			}else{
				$state_id = array('state_id' => '1');
			}
			$colleges = $this->College->find('all', array('conditions' => $state_id, 'order' => array('name_college ASC')));
			$this->set('title', 'Seleccion de Colegio');
			$this->set(compact('colleges'));
			$this->set('dir', 'college/photo');
		}
		public function add(){
			$this->layout = null;
	    	$this->autoRender = true;
	    	$this->set('action', 'save');
		}
		public function edit($id = null){
		    $this->view = 'add';
			$this->layout = null;
			$college = $this->College->findById($id);
			$this->request->data = $college;
	    	$this->set('action', 'update');
		}
		public function update($id = null){
			if($this->request->is('put')){
				$this->College->id = $id;
				if($this->College->exists()){
					if($this->College->save($this->request->data)){
						$msg = 'Exito al Actualizar';
						$type = 'success text-center';
					}else{
						$msg = 'Error al Actualizar';
						$type = 'danger text-center';
					}
				}else{
					$msg = 'Colegio no Existente';
					$type = 'warning text-center';
				}
			}else{
				$msg = 'Error al Enviar los Datos';
				$type = 'danger text-center';
			}
			$this->Session->setFlash($msg, 'default', array('class' => $type));
			$this->redirect(array('action' => 'ListCollege'));
		}
		public function save(){
			if($this->request->is('post')){
				if($this->College->save($this->request->data)){
					$msg = 'Exito al guardar';
	    			$type = 'success text-center';
	    		}else{
					$msg = 'Ha ocurrido un error';
	    			$type = 'warning text-center';
	    		}
	    	}else{
	    		$msg = 'Ha ocurrido un error';
	    		$type = 'warning text-center';
			}
			$this->Session->setFlash($msg, 'default', array('class' => $type));	
			$this->redirect(array('action' => 'ListCollege'));
		}
		public function CollegeFindDB(){
			$term = null;
	    	if(!empty($this->request->query['text']) && !empty($this->request->query['type'])){
	    		$text = $this->request->query['text'];
				$type = $this->request->query['type'];
	    		if($this->College->find('first', array('conditions' => array($type => $text)))){
	    			$term['message'] = $type.' ya se encuentra en uso ';
	    			$term['type'] = 'danger';
	    			$term['button'] = '0';
	    		}else{
	    			$term['button'] = '1';
	    		}
	    	}else{
	    		$term['message'] = 'Ha ocurrido un error';
	    		$term['type'] = 'danger';
	    	}
	    	echo json_encode($term);
	    	$this->autoRender = false;
		}
		public function college_login($prefix){
			if($this->Auth->user()){
				$this->redirect($this->Auth->redirectUrl());
			}else{
				if($college = $this->College->find('first', array('conditions' => array('prefix' => $prefix, 'state_id' => '1')))){
					$dir_image = 'college/photo/'.$college['College']['photo_dir'].'/'.$college['College']['photo'];
					$this->set(compact('dir_image'));
					$this->set('title', $college['College']['name_college']);
					$this->request->data['User']['type'] = $prefix;
					$this->set('form', 'College');
					$this->viewPath = 'Users';
		    		$this->view = 'user_login';
				}else{
					$this->Session->setFlash('<i class="glyphicon glyphicon-warning-sign"></i>  Colegio no existente.', 'default', array('class' => 'warning text-center'));
					$this->redirect(array('controller' => 'colleges', 'action' => 'ListCollege'));
				}
			}
		}
		public function college_edit($prefix){
			if($college = $this->College->find('first', array('conditions' => array('prefix' => $prefix)))){
				$this->set(compact('college'));
			}else{
				$this->Session->setFlash('<i class="glyphicon glyphicon-warning-sign"></i>  Colegio no existente.', 'default', array('class' => 'warning text-center'));
				$this->redirect(array('action' => 'ListCollege'));
			}
		}
		public function ChangeState($college, $state, $name){
			if($this->request->is('get')){
				$this->College->id = $college;
				if($this->College->exists()){
					if($this->College->saveField('state_id', $state)){
						$msg = 'Exito al cambiar de estado';
	    				$type = 'success text-center';
					}else{
						$msg = 'Error al cambiar de estado';
	    				$type = 'danger text-center';
					}
					$this->Session->setFlash($msg, 'default', array('class' => $type));
					$this->redirect(array('action' => 'college_edit', 'name' => $name));
				}else{
					$this->Session->setFlash('<i class="glyphicon glyphicon-warning-sign"></i>  Colegio no existente.', 'default', array('class' => 'warning text-center'));
					$this->redirect(array('action' => 'ListCollege'));
				}
			}else{
				$this->Session->setFlash('<i class="glyphicon glyphicon-warning-sign"></i>  Ha ocurrido un error.', 'default', array('class' => 'warning text-center'));
				$this->redirect(array('action' => 'ListCollege'));
			}
		}
	}
?>