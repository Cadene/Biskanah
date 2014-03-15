<?php
App::uses('AppController', 'Controller');
/**
 * Databuildings Controller
 *
 * @property Databuilding $Databuilding
 * @property PaginatorComponent $Paginator
 */
class DatabuildingsController extends AppController {

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
        preg_match_all()
		$this->Databuilding->recursive = 0;
		$this->set('databuildings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Databuilding->exists($id)) {
			throw new NotFoundException(__('Invalid databuilding'));
		}
		$options = array('conditions' => array('Databuilding.' . $this->Databuilding->primaryKey => $id));
		$this->set('databuilding', $this->Databuilding->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Databuilding->create();
			if ($this->Databuilding->save($this->request->data)) {
				$this->Session->setFlash(__('The databuilding has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The databuilding could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Databuilding->exists($id)) {
			throw new NotFoundException(__('Invalid databuilding'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Databuilding->save($this->request->data)) {
				$this->Session->setFlash(__('The databuilding has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The databuilding could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Databuilding.' . $this->Databuilding->primaryKey => $id));
			$this->request->data = $this->Databuilding->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Databuilding->id = $id;
		if (!$this->Databuilding->exists()) {
			throw new NotFoundException(__('Invalid databuilding'));
		}// TODO liste the other
		$this->request->onlyAllow('post', 'delete');
		if ($this->Databuilding->delete()) {
			$this->Session->setFlash(__('The databuilding has been deleted.'));
		} else {
			$this->Session->setFlash(__('The databuilding could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
