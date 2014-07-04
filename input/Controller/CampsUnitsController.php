<?php
App::uses('AppController', 'Controller');
/**
 * CampsUnits Controller
 *
 * @property CampsUnit $CampsUnit
 * @property PaginatorComponent $Paginator
 */
class CampsUnitsController extends AppController {

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
		$this->CampsUnit->recursive = 0;
		$this->set('campsUnits', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CampsUnit->exists($id)) {
			throw new NotFoundException(__('Invalid camps unit'));
		}
		$options = array('conditions' => array('CampsUnit.' . $this->CampsUnit->primaryKey => $id));
		$this->set('campsUnit', $this->CampsUnit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CampsUnit->create();
			if ($this->CampsUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The camps unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The camps unit could not be saved. Please, try again.'));
			}
		}
		$camps = $this->CampsUnit->Camp->find('list');
		$units = $this->CampsUnit->Unit->find('list');
		$this->set(compact('camps', 'units'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CampsUnit->exists($id)) {
			throw new NotFoundException(__('Invalid camps unit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CampsUnit->save($this->request->data)) {
				$this->Session->setFlash(__('The camps unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The camps unit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('CampsUnit.' . $this->CampsUnit->primaryKey => $id));
			$this->request->data = $this->CampsUnit->find('first', $options);
		}
		$camps = $this->CampsUnit->Camp->find('list');
		$units = $this->CampsUnit->Unit->find('list');
		$this->set(compact('camps', 'units'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CampsUnit->id = $id;
		if (!$this->CampsUnit->exists()) {
			throw new NotFoundException(__('Invalid camps unit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CampsUnit->delete()) {
			$this->Session->setFlash(__('The camps unit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The camps unit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
