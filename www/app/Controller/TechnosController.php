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
        if($this->request->is('post')){
            $data = current($this->request->data);
            // $query tableau de request
            if(!isset($$data['id']) && !isset($data['building_id']))
                throw new NotImplementedException('Bad arguments in POST');
            $query = array(
                'id' => $data['id'],
                'building_id' => $data['building_id']
            );

            $this->loadModel('Techno');
            $this->Data->write('Techno',$this->Techno->findById($query['id']));

            $this->loadModel('Dttechno');
            $this->Dttechno->write('User_Dttechnos',$this->Dttechno->findByTechnoId($query['id']));

            $lvls_to_add = $this->_lvls_to_add($this->Data->read('User_Dttechnos'));

            $query['type'] = $this->Data->read('Techno.datatechno_id_type');
            $query['datatechno_id'] = $this->Data->read('Techno.datatechno_id') + $lvls_to_add;
            $query['lvl'] = $this->Data->read('Techno.datatechno_id_lvl') + $lvls_to_add;

            $this->loadModel('Datatechno');
            $this->Data->write('Datatechno',$this->Datatechno->findById($query['datatechno_id']));

            // vérifie les ressources
            if(!$this->_enoughResources($this->Data->read('Datatechno'))){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }else{

                $begin = $this->_begin($this->Dttechno->lastByBuildingId($query['building_id']));

                $this->Dttechno->save(array(
                    'techno_id' => $query['id'],
                    'building_id' => $query['building_id'],
                    'begin' => $begin,
                    'finish' => $begin + $this->Data->read('Datatechno.time'))
                );

                $this->loadModel('Camp');
                $this->Camp->updateAll(
                    array(
                        'res1' => $this->Data->read('Camp.currentres1'),
                        'res2' => $this->Data->read('Camp.currentres2'),
                        'res3' => $this->Data->read('Camp.currentres3'),
                        'last_update' => time()
                    ),
                    array('Camp.id' => $this->Session->read('Camp.current'))
                );
            }

            $this->Session->setFlash(__('La technologie a bien été amélioré.'));
        }
        return $this->redirect(array('controller'=>'camps','action'=>'view'));
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
            if($this->_isInTechnos($query['type'])){
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
            if(!$this->_enoughResources($this->Data->read('Datatechno'))){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }else{
                $this->Techno->save(array(
                    'user_id' => $this->Session->read('User.id'),
                    'datatechno_id' => $query['type']*100 // id_building level(0) = (id_building level(1) - 1)
                ));

                $this->loadModel('Dttechno');

                $begin = $this->_begin($this->Dttechno->lastByBuildingId($query['building_id']));

                $this->Dttechno->save(array(
                    'techno_id' => $this->Techno->id,
                    'building_id' => $query['building_id'],
                    'begin' => $begin,
                    'finish' => ($begin + $this->Data->read('Datatechno.time'))
                ));

                $this->loadModel('Camp');
                $this->Camp->updateAll(
                    array(
                        'res1' => $this->Data->read('Camp.res1'),
                        'res2' => $this->Data->read('Camp.res2'),
                        'res3' => $this->Data->read('Camp.res3'),
                        'last_update' => time()
                    ),
                    array('Camp.id' => $this->Session->read('Camp.current'))
                );
            }
            $this->Session->setFlash(__('La techno a bien été créée.'));
            return $this->redirect(array('controller'=>'buildings','action'=>'display',$query['building_id']));
		}
		$this->redirect($this->referer());
	}




    private function _isInTechnos($type)
    {
        foreach($this->Data->read('Technos') as $techno){
            $techno = current($techno);
            if($techno['datatechno_id_type'] == $type)
                return true;
        }
        return false;
    }

    private function _begin($lastDttechno){
        if(empty($lastDttechno))
            return time();
        else
            return $lastDttechno['finish'] + 1;
    }

    private function _lvls_to_add($dttechnos){
        if(empty($dttechnos)){
            return 1;
        }else{
            return count($dttechnos) + 1;
        }
    }

    // TODO où mettre la fonction enoughRessources ?
    private function _enoughResources($Data){
        $Camp = $this->Data->read('Camp');
        if( ($new['res1'] = $Camp['currentres1'] - $Data['res1']) >= 0)
            if( ($new['res2'] = $Camp['currentres2'] - $Data['res2']) >= 0)
                if( ($new['res3'] = $Camp['currentres3'] - $Data['res3']) >= 0){
                    foreach(array(1,2,3) as $i)
                        $this->Data->write('Camp.currentres'.$i, $new['res'.$i]);
                    return true;
                }
        return false;
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



}


