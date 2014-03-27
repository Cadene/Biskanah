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
		if($this->request->is('post'))
		{			
			$data = current($this->request->data);
			// $query tableau de request-
            if(!isset($data['type']) || !isset($data['building_id']))
                throw new NotImplementedException('Bad arguments in POST');
            $query = array(
                'building_id' => $data['building_id'],
                'type' => $data['type']
            );
            $this->loadModel('Techno');
            if($this->_isTechnoInUser($query['type'])){
                throw new NotImplementedException('La technologie existe déjà.');
            }

            // vérification des prérequis
            $this->Datanode = $this->Components->load('Datanode');
            if(!$this->Datanode->isTechnoAllowed($query['type'])){
                throw new NotImplementedException('Les prérequis sont manquants.');
            }

            // récupère les infos du batiment à construire
            $this->loadModel('Datatechno');
            $this->Data->writeIfNot('Datatechno',$this->Datatechno->findByLvlType($query['type'],1));

            // vérifie les ressources
            if(!$this->_enoughResources($this->Data->read('Camp'),$this->Data->read('Datatechno'))){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }else{
                $this->Techno->save(array(
                    'user_id' => $this->Session->read('User.id'),
                    'datatechno_id' => $query['type']*100 // id_building level(0) = (id_building level(1) - 1)
                ));

                $this->loadModel('Dttechno');
                $this->Dttechno->save(array(
                    'techno_id' => $this->Techno->id,
                    'building_id' => $query['building_id'],
                    'begin' => time(),
                    'finish' => (time()+ $this->Data->read('Datatechno.time'))
                ));

                $this->loadModel('Camp');
                $this->Camp->updateAll(
                    array(
                        'res1' => $this->Data->read('Camp.res1'),
                        'res2' => $this->Data->read('Camp.res2'),
                        'res3' => $this->Data->read('Camp.res3')
                    ),
                    array('Camp.id' => $this->Session->read('Camp.current'))
                );
            }
            $this->Session->setFlash(__('La techno a bien été créée.'));
            return $this->redirect(array('controller'=>'camps','action'=>'view'));
		}
		$this->redirect($this->referer());
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
	}

	private function _isTechnoInUser($type)
	{
		return in_array($this->Data->read('Technos'), ['Techno' => ['datatechno_id_type' => $type]]);	
	}

    private function _enoughResources($Resource, $Data){
    if( ($new['res1'] = $Resource['res1'] - $Data['res1']) >= 0)
        if( ($new['res2'] = $Resource['res2'] - $Data['res2']) >= 0)
            if( ($new['res3'] = $Resource['res3'] - $Data['res3']) >= 0){
              $Resource['res1'] = $new['res1'];
              $Resource['res2'] = $new['res2'];
              $Resource['res3'] = $new['res3'];
              return true;
            }
    return false;
    }
}


