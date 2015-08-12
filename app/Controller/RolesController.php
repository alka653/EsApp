<?php
	App::uses('AppController', 'Controller');
	class RolesController extends AppController {
		public $components = array('Paginator');
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('ListCollege');
		}
		public function index() {
			$this->Role->recursive = 0;
			$this->set('roles', $this->Paginator->paginate());
		}
		public function view($id = null) {
			if (!$this->Role->exists($id)) {
				throw new NotFoundException(__('Invalid role'));
			}
			$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
			$this->set('role', $this->Role->find('first', $options));
		}
		public function add() {
			if ($this->request->is('post')) {
				$this->Role->create();
				if ($this->Role->save($this->request->data)) {
					$this->Session->setFlash(__('The role has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The role could not be saved. Please, try again.'));
				}
			}
			$states = $this->Role->State->find('list');
			$this->set(compact('states'));
		}
		public function edit($id = null) {
			if (!$this->Role->exists($id)) {
				throw new NotFoundException(__('Invalid role'));
			}
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Role->save($this->request->data)) {
					$this->Session->setFlash(__('The role has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The role could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
				$this->request->data = $this->Role->find('first', $options);
			}
			$states = $this->Role->State->find('list');
			$this->set(compact('states'));
		}
		public function delete($id = null) {
			$this->Role->id = $id;
			if (!$this->Role->exists()) {
				throw new NotFoundException(__('Invalid role'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->Role->delete()) {
				$this->Session->setFlash(__('The role has been deleted.'));
			} else {
				$this->Session->setFlash(__('The role could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
		}
	}
?>