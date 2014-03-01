<?php
App::uses('AppController', 'Controller');
/**
 * Assists Controller
 *
 * @property Assist $Assist
 * @property PaginatorComponent $Paginator
 */
class AssistsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * Affiche les assistances sur un camp
 * View: index
 *
 * @param int $_SESSION['camp_id']
 * @return void
 */
	public function index() {
	}

/**
 * edit method
 *
 * Permet de renvoyer des unités d'une assistance (création d'un a2b, etc.)
 * Permet de nourrir une assistance (uranium)
 * View: edit
 *
 * @param int $_POST['assist_id']
 * @param mixed[] $_POST['units']
 * @param mixed[] $_POST['res'];
 * @param int $_SESSION['camp_id']
 * @return void
 */
	public function edit() {
	}	


/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Assist->recursive = 0;
		$this->set('assists', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Assist->exists($id)) {
			throw new NotFoundException(__('Invalid assist'));
		}
		$options = array('conditions' => array('Assist.' . $this->Assist->primaryKey => $id));
		$this->set('assist', $this->Assist->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Assist->create();
			if ($this->Assist->save($this->request->data)) {
				$this->Session->setFlash(__('The assist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assist could not be saved. Please, try again.'));
			}
		}
		$resources = $this->Assist->Resource->find('list');
		$this->set(compact('resources'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Assist->exists($id)) {
			throw new NotFoundException(__('Invalid assist'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Assist->save($this->request->data)) {
				$this->Session->setFlash(__('The assist has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assist could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Assist.' . $this->Assist->primaryKey => $id));
			$this->request->data = $this->Assist->find('first', $options);
		}
		$resources = $this->Assist->Resource->find('list');
		$this->set(compact('resources'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Assist->id = $id;
		if (!$this->Assist->exists()) {
			throw new NotFoundException(__('Invalid assist'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Assist->delete()) {
			$this->Session->setFlash(__('The assist has been deleted.'));
		} else {
			$this->Session->setFlash(__('The assist could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
