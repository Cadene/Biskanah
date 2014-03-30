<?php
App::uses('AppController', 'Controller');
/**
 * Typebuildings Controller
 *
 * @property Typebuilding $Typebuilding
 * @property PaginatorComponent $Paginator
 */
class TypebuildingsController extends AppController {

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
		$this->Typebuilding->recursive = 0;
		$this->set('typebuildings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Typebuilding->exists($id)) {
			throw new NotFoundException(__('Invalid typebuilding'));
		}
		$options = array('conditions' => array('Typebuilding.' . $this->Typebuilding->primaryKey => $id));
		$this->set('typebuilding', $this->Typebuilding->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Typebuilding->create();
			if ($this->Typebuilding->save($this->request->data)) {
				$this->Session->setFlash(__('The typebuilding has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The typebuilding could not be saved. Please, try again.'));
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
		if (!$this->Typebuilding->exists($id)) {
			throw new NotFoundException(__('Invalid typebuilding'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Typebuilding->save($this->request->data)) {
				$this->Session->setFlash(__('The typebuilding has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The typebuilding could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Typebuilding.' . $this->Typebuilding->primaryKey => $id));
			$this->request->data = $this->Typebuilding->find('first', $options);
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
		$this->Typebuilding->id = $id;
		if (!$this->Typebuilding->exists()) {
			throw new NotFoundException(__('Invalid typebuilding'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Typebuilding->delete()) {
			$this->Session->setFlash(__('The typebuilding has been deleted.'));
		} else {
			$this->Session->setFlash(__('The typebuilding could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
