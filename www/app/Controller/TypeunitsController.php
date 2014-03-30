<?php
App::uses('AppController', 'Controller');
/**
 * Typeunits Controller
 *
 * @property Typeunit $Typeunit
 * @property PaginatorComponent $Paginator
 */
class TypeunitsController extends AppController {

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
		$this->Typeunit->recursive = 0;
		$this->set('typeunits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Typeunit->exists($id)) {
			throw new NotFoundException(__('Invalid typeunit'));
		}
		$options = array('conditions' => array('Typeunit.' . $this->Typeunit->primaryKey => $id));
		$this->set('typeunit', $this->Typeunit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Typeunit->create();
			if ($this->Typeunit->save($this->request->data)) {
				$this->Session->setFlash(__('The typeunit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The typeunit could not be saved. Please, try again.'));
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
		if (!$this->Typeunit->exists($id)) {
			throw new NotFoundException(__('Invalid typeunit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Typeunit->save($this->request->data)) {
				$this->Session->setFlash(__('The typeunit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The typeunit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Typeunit.' . $this->Typeunit->primaryKey => $id));
			$this->request->data = $this->Typeunit->find('first', $options);
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
		$this->Typeunit->id = $id;
		if (!$this->Typeunit->exists()) {
			throw new NotFoundException(__('Invalid typeunit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Typeunit->delete()) {
			$this->Session->setFlash(__('The typeunit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The typeunit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
