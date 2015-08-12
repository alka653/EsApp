<?php
	App::uses('Controller', 'Controller');
	class AppController extends Controller {
		public $components = array(
			'Session',
			'Auth' => array(
				'loginRedirect' => array('controller' => 'welcome', 'action' => 'index'),
				'logoutRedirect' => array('controller' => 'colleges', 'action' => 'ListCollege'),
				'authenticate' => array('Form' => array('passwordHasher' => 'Blowfish')),
				'authorize' => array('Controller'),
				'authError' => false
			)
		);
		public function beforeFilter(){
			$current_user = $this->Auth->user();
			$this->set(compact('current_user'));

		}
		public function isAuthorized($user){/*
			if(isset($user['role_id']) && $user['role_id'] == '1'){
				return true;
			}
			return false;*/
		}
	}
?>