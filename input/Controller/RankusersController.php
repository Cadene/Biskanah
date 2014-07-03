<?php
App::uses('AppController', 'Controller');
/**
 * Rankusers Controller
 *
 * @property Rankuser $Rankuser
 * @property PaginatorComponent $Paginator
 */
class RankusersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rankuser->recursive = 0;
		$this->set('rankusers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rankuser->exists($id)) {
			throw new NotFoundException(__('Invalid rankuser'));
		}
		$options = array('conditions' => array('Rankuser.' . $this->Rankuser->primaryKey => $id));
		$this->set('rankuser', $this->Rankuser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rankuser->create();
			if ($this->Rankuser->save($this->request->data)) {
				$this->Session->setFlash(__('The rankuser has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rankuser could not be saved. Please, try again.'));
			}
		}
		$users = $this->Rankuser->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Rankuser->exists($id)) {
			throw new NotFoundException(__('Invalid rankuser'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rankuser->save($this->request->data)) {
				$this->Session->setFlash(__('The rankuser has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rankuser could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rankuser.' . $this->Rankuser->primaryKey => $id));
			$this->request->data = $this->Rankuser->find('first', $options);
		}
		$users = $this->Rankuser->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Rankuser->id = $id;
		if (!$this->Rankuser->exists()) {
			throw new NotFoundException(__('Invalid rankuser'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Rankuser->delete()) {
			$this->Session->setFlash(__('The rankuser has been deleted.'));
		} else {
			$this->Session->setFlash(__('The rankuser could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
