<?php
	App::uses('AppController', 'Controller');
	class UsersController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('login', 'logout', 'user_login');
		}
		public function user_login(){
			if($this->Auth->user()){
				$this->redirect($this->Auth->redirectUrl());
			}else{
				$dir_image = 'photo/admin.png';
				$this->set(compact('dir_image'));
				$this->set('title', 'Acceso');
				$this->set('form', 'User');
				$this->request->data['User']['type'] = 'ADM';
			}
		}
		public function login(){
			$term = null;
			if($this->request->is('post')){
				$type = $this->request->data['User']['type'];
				$username = $this->request->data['User']['username'];
				$password = $this->request->data['User']['password'];
				if($type != 'ADM'){
					$this->loadModel('College');
					if($college = $this->College->find('first', array('conditions' => array('prefix' => $type)))){
						$this->User->useDbConfig = $college['College']['name_database'];
					}else{
						$term['message'] = 'No existe el Usuario';
	    				$term['type'] = 'danger';
					}
				}
				if($this->Auth->login()){
					$term['type'] = 'login';
				}else{
					$term['message'] = 'Usuario y/o contraseña incorrecto';
	    			$term['type'] = 'success';
				}
			}else{
				$this->Session->setFlash('<i class="glyphicon glyphicon-warning-sign"></i>  No puede acceder a esta sección.', 'default', array('class' => 'warning text-center'));
				$this->redirect(array('controller' => 'colleges', 'action' => 'ListCollege'));
			}
			echo json_encode($term);
	    	$this->autoRender = false;
		}
		public function logout(){
			return $this->redirect($this->Auth->logout());
		}
		public function index() {
			$this->User->recursive = 0;
			$this->set('users', $this->Paginator->paginate());
		}
		public function view($id = null) {
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Invalid user'));
			}
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->set('user', $this->User->find('first', $options));
		}
		public function add() {
			if ($this->request->is('post')) {
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			$roles = $this->User->Role->find('list');
			$this->set(compact('roles'));
		}
		public function edit($id = null) {
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->request->is(array('post', 'put'))) {
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				$this->request->data = $this->User->find('first', $options);
			}
			$roles = $this->User->Role->find('list');
			$this->set(compact('roles'));
		}
		public function delete($id = null) {
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->User->delete()) {
				$this->Session->setFlash(__('The user has been deleted.'));
			} else {
				$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
		}
	}
?>