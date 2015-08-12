<?php
	App::uses('AppController', 'Controller');
	class WelcomeController extends AppController{
		public $components = array('Session');
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('');
		}
		public function isAuthorized($user){
			if($user['role_id'] == '1'){
				if(in_array($this->action, array('index'))){
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
		public function index(){
			$this->set('title', 'Página Principal');
		}
		public function MessageError(){

		}
	}
?>