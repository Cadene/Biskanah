<?php
App::uses('AppController', 'Controller');
/**
 * Worlds Controller
 *
 * @property World $World
 * @property PaginatorComponent $Paginator
 */
class WorldsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


/**
 * index method
 *
 * Affiche la map quadrillée centrée sur un camp
 * View: map
 *
 * @param int $x
 * @param int $y
 * @param int $_SESSION['camp_id']
 * @return void
 */
	public function index($x=null, $y=null) {

	}

/**
 * view method
 *
 * Aperçu d'un camp avec les rapports
 * View: view
 *
 * @param int $camp_id
 * @return void
 */
	public function view($camp_id=null) {

	}

/**
 * admin_create method
 *
 * Crée le world
 *
 * @return void
 *
    public function admin_create(){
        $max_x = 200;
        $max_y = 200;

        for($i=0-$max_x; $i<$max_x; $i++){
            for($j=0-$max_y; $j<$max_y; $j++){
               $data['World'] = array('x'=> $i, 'y'=>$j, 'type' => 0);
               $this->World->create();
               $this->World->save($data['World']);
            }
        }

        echo "ok";

        die();
    }*/

/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->World->recursive = 0;
		$this->set('worlds', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->World->exists($id)) {
			throw new NotFoundException(__('Invalid world'));
		}
		$options = array('conditions' => array('World.' . $this->World->primaryKey => $id));
		$this->set('world', $this->World->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->World->create();
			if ($this->World->save($this->request->data)) {
				$this->Session->setFlash(__('The world has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The world could not be saved. Please, try again.'));
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
	public function admin_edit($id = null) {
		if (!$this->World->exists($id)) {
			throw new NotFoundException(__('Invalid world'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->World->save($this->request->data)) {
				$this->Session->setFlash(__('The world has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The world could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('World.' . $this->World->primaryKey => $id));
			$this->request->data = $this->World->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->World->id = $id;
		if (!$this->World->exists()) {
			throw new NotFoundException(__('Invalid world'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->World->delete()) {
			$this->Session->setFlash(__('The world has been deleted.'));
		} else {
			$this->Session->setFlash(__('The world could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
