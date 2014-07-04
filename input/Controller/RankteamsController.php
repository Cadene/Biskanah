<?php
App::uses('AppController', 'Controller');
/**
 * Rankteams Controller
 *
 * @property Rankteam $Rankteam
 * @property PaginatorComponent $Paginator
 */
class RankteamsController extends AppController {

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
		$this->Rankteam->recursive = 0;
		$this->set('rankteams', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rankteam->exists($id)) {
			throw new NotFoundException(__('Invalid rankteam'));
		}
		$options = array('conditions' => array('Rankteam.' . $this->Rankteam->primaryKey => $id));
		$this->set('rankteam', $this->Rankteam->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rankteam->create();
			if ($this->Rankteam->save($this->request->data)) {
				$this->Session->setFlash(__('The rankteam has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rankteam could not be saved. Please, try again.'));
			}
		}
		$teams = $this->Rankteam->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Rankteam->exists($id)) {
			throw new NotFoundException(__('Invalid rankteam'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Rankteam->save($this->request->data)) {
				$this->Session->setFlash(__('The rankteam has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rankteam could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Rankteam.' . $this->Rankteam->primaryKey => $id));
			$this->request->data = $this->Rankteam->find('first', $options);
		}
		$teams = $this->Rankteam->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Rankteam->id = $id;
		if (!$this->Rankteam->exists()) {
			throw new NotFoundException(__('Invalid rankteam'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Rankteam->delete()) {
			$this->Session->setFlash(__('The rankteam has been deleted.'));
		} else {
			$this->Session->setFlash(__('The rankteam could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
