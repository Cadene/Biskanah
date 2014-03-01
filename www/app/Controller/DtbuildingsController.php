<?php
App::uses('AppController', 'Controller');
/**
 * Dtbuildings Controller
 *
 * @property Dtbuilding $Dtbuilding
 * @property PaginatorComponent $Paginator
 */
class DtbuildingsController extends AppController {

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
	public function admin_index() {
		$this->Dtbuilding->recursive = 0;
		$this->set('dtbuildings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dtbuilding->exists($id)) {
			throw new NotFoundException(__('Invalid dtbuilding'));
		}
		$options = array('conditions' => array('Dtbuilding.' . $this->Dtbuilding->primaryKey => $id));
		$this->set('dtbuilding', $this->Dtbuilding->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dtbuilding->create();
			if ($this->Dtbuilding->save($this->request->data)) {
				$this->Session->setFlash(__('The dtbuilding has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dtbuilding could not be saved. Please, try again.'));
			}
		}
		$buildings = $this->Dtbuilding->Building->find('list');
		$this->set(compact('buildings'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Dtbuilding->exists($id)) {
			throw new NotFoundException(__('Invalid dtbuilding'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dtbuilding->save($this->request->data)) {
				$this->Session->setFlash(__('The dtbuilding has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dtbuilding could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dtbuilding.' . $this->Dtbuilding->primaryKey => $id));
			$this->request->data = $this->Dtbuilding->find('first', $options);
		}
		$buildings = $this->Dtbuilding->Building->find('list');
		$this->set(compact('buildings'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Dtbuilding->id = $id;
		if (!$this->Dtbuilding->exists()) {
			throw new NotFoundException(__('Invalid dtbuilding'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Dtbuilding->delete()) {
			$this->Session->setFlash(__('The dtbuilding has been deleted.'));
		} else {
			$this->Session->setFlash(__('The dtbuilding could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
