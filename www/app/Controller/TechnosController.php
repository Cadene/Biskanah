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
	public $components = array('Paginator','Nodeable');

    /**
     * display method
     * Affiche un bâtiment
     *
     * @param int $_POST['building_id']
     * @param int $_SESSION['camp_id']
     * @return void
     */
    /*public function display($type = null)
    {
        if($type === null)
            throw new  NotFoundException(__('Invalid techno type : '.$type));

        // récupère les infos du joueur et du camp
        $buildings = $this->Data->read('Buildings');
        $technos = $this->Data->read('Technos');

        $data['Techno'] = current($this->Data->read('Technos')[$type]);

        $lvl = $data['Techno']['lvl'];
        $this->loadModel('Datatechno');
        $tmp = $this->Datatechno->findByIdLvlBetween($type,$lvl,4,$buildings,$technos);
        $data = array_merge($data,$tmp);

        $this->loadModel('Dttechno');
        $data['Dttechnos'] = $this->Dttechno->findByTechnoId($data['Techno']['id']);

        $this->set(compact('data'));

        if ($data['Techno']['lvl'] <= 0) {
            $this->view = 'level0';
        } else {
            $type = $data['Techno']['type'];
            $func = 'view' . $type;
            $this->view = $func;

            if (method_exists($this,$func)) {
                $this->$func($data);
            }
        }
    }*/



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
    public function create()
    {
        if ($this->request->is('post'))
        {
            if(!isset($this->request->data['Techno']['type']))
                throw new NotImplementedException('Bad arguments in POST');

            $query = array(
                'type' => $this->request->data['Techno']['type']
            );
            $kind = 2; // is techno

            // Vérifier qu'un labo existe
            $data['Buildings'] = $this->Data->read('Buildings');
            if (!isset($data['Buildings'][11]))
                throw new Exception('Construisez d\'abord un laboratoire.');
            $data['Building'] = $data['Buildings'][11]['Building'];

            // Vérifier que la techno n'existe pas
            if ($this->Nodeable->doesNodeExist($kind,$query['type']))
                throw new NotImplementedException('Il existe déjà une technologie de ce type.');

            // vérification des prérequis
            $this->Datanode = $this->Components->load('Datanode');
            $type = $query['type'];
            if($this->Datanode->isAllowed($kind, $type) !== true)
            {
                throw new NotImplementedException('Les prérequis pour construire cette techno sont manquants.');
            }

            // récupère les infos de la techno à construire
            $buildings = $this->Data->read('Buildings');
            $technos = $this->Data->read('Technos');
            $this->loadModel('Datatechno');
            $lvl = 1;
            $data['Datatechno'] = $this->Datatechno->findByIdLvl($query['type'],$lvl,$buildings,$technos);

            // vérifie les ressources
            if(!$this->Nodeable->isEnoughResources($data['Datatechno'])){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }

            // créer la techno
            $this->loadModel('Techno');
            $this->Techno->save(array(
                'user_id' => $this->Session->read('User.id'),
                'datatechno_id' => $query['type'],
                'lvl' => 0
            ));

            // récupérer les temps de création
            $dttechnos = $this->Data->read('Dttechnos');
            $times = $this->Nodeable->startFinishTimes($kind,$dttechnos,$data['Databuilding']['time']);

            // créer la file de construction
            $this->loadModel('Dttechno');
            $this->Dttechno->save(array(
                'techno_id' => $this->Techno->id,
                'begin' => $times['start'],
                'finish' => $times['finish'],
                'building_id' => $data['Building']['id']
            ));

            // Mettre à jour les ressources du camp
            $this->loadModel('Camp');
            $this->Camp->updateAll(
                array(
                    'res1' => $this->Data->read('Camp.newres1'),
                    'res2' => $this->Data->read('Camp.newres2'),
                    'res3' => $this->Data->read('Camp.newres3'),
                    'last_update' => time()
                ),
                array('Camp.id' => $this->Session->read('Camp.current'))
            );

            $this->Session->setFlash(__('La techno a bien été créé.'));
            return $this->redirect(array('controller'=>'camps','action'=>'view'));
        }
        else
        {
            $this->Datanode = $this->Components->load('Datanode');
            $allowed = $this->Datanode->allowedTechnos();
            $this->set('allowedTechnos', $allowed);
        }
    }


    /**
     * upgrade method
     *
     * Ajoute une technologie à la liste des techno en recherche
     *
     * @param int $_POST['dttechno_id']
     * @return void
     */
    public function upgrade()
    {
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


