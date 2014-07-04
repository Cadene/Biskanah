<?php
App::uses('AppController', 'Controller');
/**
 * Technos Controller
 *
 * @property Techno $Techno
 * @property PaginatorComponent $Paginator
 */
class TechnosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * Toutes les technologies du joueur 
 * View: index
 *
 * @param int $_SESSION['user_id']
 * @return void
 */
	public function index() {

	}

/**
 * upgrade method
 *
 * Ajoute une technologie à la liste des techno en recherche
 *
 * @param int $_POST['dttechno_id']
 * @return void
 */
	public function upgrade() {

	}

/**
 * create method
 *
 * Ajoute une technologie à la liste des techno en recherche
 *
 * @param int $_POST['building_id']
 * @param int $_POST['type'] type
 * @param int $_SESSION['camp_id']
 * @return void
 */
	public function create() {

	}

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Techno->recursive = 0;
		$this->set('technos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Techno->exists($id)) {
			throw new NotFoundException(__('Invalid techno'));
		}
		$options = array('conditions' => array('Techno.' . $this->Techno->primaryKey => $id));
		$this->set('techno', $this->Techno->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Techno->create();
			if ($this->Techno->save($this->request->data)) {
				$this->Session->setFlash(__('The techno has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The techno could not be saved. Please, try again.'));
			}
		}
		$users = $this->Techno->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Techno->exists($id)) {
			throw new NotFoundException(__('Invalid techno'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Techno->save($this->request->data)) {
				$this->Session->setFlash(__('The techno has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The techno could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Techno.' . $this->Techno->primaryKey => $id));
			$this->request->data = $this->Techno->find('first', $options);
		}
		$users = $this->Techno->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Techno->id = $id;
		if (!$this->Techno->exists()) {
			throw new NotFoundException(__('Invalid techno'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Techno->delete()) {
			$this->Session->setFlash(__('The techno has been deleted.'));
		} else {
			$this->Session->setFlash(__('The techno could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
