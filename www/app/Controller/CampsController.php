<?php
App::uses('AppController', 'Controller');
/**
 * Camps Controller
 *
 * @property Camp $Camp
 * @property PaginatorComponent $Paginator
 */
class CampsController extends AppController {

    public $uses = array('Camp', 'World');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


/**
*	index method
* Vue privée du camp avec les multiples bâtiments
* 
* @param int id s:camp_id
* @return void
*/
	public function index($id = null){
        if(!$id){
            $id = $this->Session->read('Camp.current');
        }else{
            $this->Session->write('Camp.current',$id);
        }
        $user_id = $this->Session->read('User.id');
		$d = $this->Camp->find('first', array('conditions' => array('Camp.id' => $id, 'User.id' => $user_id)));
        $this->set('d',$d);
    }

/**
*	edit method
* Editer le nom du camp
* 
* @param int id s:camp_id
* @param string camp_name p:camp_name
* @return void
*/
	public function edit($id = null){
        if($this->request->is('post')){
            if(!$id){
                $id = $this->Session->read('Camp.current');
            }
        }
	}


/**
*	delete method
* Supprimer un camp 
* 
* @param int id s:camp_id
* @return void
*/
	public function delete($id = null){
		
	}
	


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Camp->recursive = 0;
		$this->set('camps', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Camp->exists($id)) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$options = array('conditions' => array('Camp.' . $this->Camp->primaryKey => $id));
		$this->set('camp', $this->Camp->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Camp->create();
			if ($this->Camp->save($this->request->data)) {
				$this->Session->setFlash(__('The camp has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The camp could not be saved. Please, try again.'));
			}
		}
		$worlds = $this->Camp->World->find('list');
		$users = $this->Camp->User->find('list');
		$resources = $this->Camp->Resource->find('list');
		$this->set(compact('worlds', 'users', 'resources'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Camp->exists($id)) {
			throw new NotFoundException(__('Invalid camp'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Camp->save($this->request->data)) {
				$this->Session->setFlash(__('The camp has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The camp could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Camp.' . $this->Camp->primaryKey => $id));
			$this->request->data = $this->Camp->find('first', $options);
		}
		$worlds = $this->Camp->World->find('list');
		$users = $this->Camp->User->find('list');
		$resources = $this->Camp->Resource->find('list');
		$this->set(compact('worlds', 'users', 'resources'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Camp->id = $id;
		if (!$this->Camp->exists()) {
			throw new NotFoundException(__('Invalid camp'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Camp->delete()) {
			$this->Session->setFlash(__('The camp has been deleted.'));
		} else {
			$this->Session->setFlash(__('The camp could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
