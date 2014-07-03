<?php
App::uses('AppController', 'Controller');
/**
 * Dtunits Controller
 *
 * @property Dtunit $Dtunit
 * @property PaginatorComponent $Paginator
 */
class DtunitsController extends AppController {

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
		$this->Dtunit->recursive = 0;
		$this->set('dtunits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dtunit->exists($id)) {
			throw new NotFoundException(__('Invalid dtunit'));
		}
		$options = array('conditions' => array('Dtunit.' . $this->Dtunit->primaryKey => $id));
		$this->set('dtunit', $this->Dtunit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dtunit->create();
			if ($this->Dtunit->save($this->request->data)) {
				$this->Session->setFlash(__('The dtunit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dtunit could not be saved. Please, try again.'));
			}
		}
		$units = $this->Dtunit->Unit->find('list');
		$buildings = $this->Dtunit->Building->find('list');
		$this->set(compact('units', 'buildings'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Dtunit->exists($id)) {
			throw new NotFoundException(__('Invalid dtunit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dtunit->save($this->request->data)) {
				$this->Session->setFlash(__('The dtunit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dtunit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dtunit.' . $this->Dtunit->primaryKey => $id));
			$this->request->data = $this->Dtunit->find('first', $options);
		}
		$units = $this->Dtunit->Unit->find('list');
		$buildings = $this->Dtunit->Building->find('list');
		$this->set(compact('units', 'buildings'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Dtunit->id = $id;
		if (!$this->Dtunit->exists()) {
			throw new NotFoundException(__('Invalid dtunit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Dtunit->delete()) {
			$this->Session->setFlash(__('The dtunit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The dtunit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
