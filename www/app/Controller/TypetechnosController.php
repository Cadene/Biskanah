<?php
App::uses('AppController', 'Controller');
/**
 * Typetechnos Controller
 *
 * @property Typetechno $Typetechno
 * @property PaginatorComponent $Paginator
 */
class TypetechnosController extends AppController {

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
		$this->Typetechno->recursive = 0;
		$this->set('typetechnos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Typetechno->exists($id)) {
			throw new NotFoundException(__('Invalid typetechno'));
		}
		$options = array('conditions' => array('Typetechno.' . $this->Typetechno->primaryKey => $id));
		$this->set('typetechno', $this->Typetechno->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Typetechno->create();
			if ($this->Typetechno->save($this->request->data)) {
				$this->Session->setFlash(__('The typetechno has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The typetechno could not be saved. Please, try again.'));
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
		if (!$this->Typetechno->exists($id)) {
			throw new NotFoundException(__('Invalid typetechno'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Typetechno->save($this->request->data)) {
				$this->Session->setFlash(__('The typetechno has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The typetechno could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Typetechno.' . $this->Typetechno->primaryKey => $id));
			$this->request->data = $this->Typetechno->find('first', $options);
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
		$this->Typetechno->id = $id;
		if (!$this->Typetechno->exists()) {
			throw new NotFoundException(__('Invalid typetechno'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Typetechno->delete()) {
			$this->Session->setFlash(__('The typetechno has been deleted.'));
		} else {
			$this->Session->setFlash(__('The typetechno could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
