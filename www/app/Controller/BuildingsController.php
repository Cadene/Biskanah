<?php
App::uses('AppController', 'Controller');
/**
 * Buildings Controller
 *
 * @property Building $Building
 * @property PaginatorComponent $Paginator
 */
class BuildingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
* index method
* Affiche un bâtiment
*
* @param int $_POST['building_id']
* @param int $_SESSION['camp_id']
* @return void
*/
	public function index() {

	}

/**
* create method
* Créer un bâtiment
*
* @param int $_POST['camp_id']
* @param int $_POST['type']
* @param int $_POST['field']
* @param int $_POST['level']
* @return void
*/
	public function create() {
        if($this->request->is('post')){
            $d['Building'] = array(
                'camp_id' => $this->request->data['Building']['camp_id'],
                'type' => $this->request->data['Building']['type'],
                'field' => $this->request->data['Building']['field'],
                'level' => $this->request->data['Building']['level']
            );
            /*$this->loadModel('Camp');
            $this->Camp->enoughResources()
            $this->loadModel('Resource');
            $this->Resource->modify($d);
            verif :
                si assez d'argent on tax'
            crée DTBuilding
            save Building*/

        }
	}

/**
* upgrade method
* Améliorer le niveau d'un bâtiment
*
* @param int $_POST['building_id']
* @param int $_SESSION['camp_id']
* @return void
*/
	public function upgrade() {

	}

/**
* destroy method
* Detruire un bâtiment
*
* @param int $_POST['building_id']
* @return void
*/
	public function destroy() {

	}

/**
* destroy method
* Annule la construction d'un bâtiment
*
* @param int $_POST['building_id']
* @return void
*/
	public function cancel() {

	}



/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Building->recursive = 0;
		$this->set('buildings', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Building->exists($id)) {
			throw new NotFoundException(__('Invalid building'));
		}
		$options = array('conditions' => array('Building.' . $this->Building->primaryKey => $id));
		$this->set('building', $this->Building->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Building->create();
			if ($this->Building->save($this->request->data)) {
				$this->Session->setFlash(__('The building has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The building could not be saved. Please, try again.'));
			}
		}
		$camps = $this->Building->Camp->find('list');
		$this->set(compact('camps'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Building->exists($id)) {
			throw new NotFoundException(__('Invalid building'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Building->save($this->request->data)) {
				$this->Session->setFlash(__('The building has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The building could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Building.' . $this->Building->primaryKey => $id));
			$this->request->data = $this->Building->find('first', $options);
		}
		$camps = $this->Building->Camp->find('list');
		$this->set(compact('camps'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Building->id = $id;
		if (!$this->Building->exists()) {
			throw new NotFoundException(__('Invalid building'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Building->delete()) {
			$this->Session->setFlash(__('The building has been deleted.'));
		} else {
			$this->Session->setFlash(__('The building could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
