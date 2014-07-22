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
     * Liste de technologies en fonction de leur batiment de recherche
     *
     * @param $databuilding_id
     */
    public function searchable($databuilding_id)
    {
        $this->Nodeable = $this->Components->load('Nodeable');
        $this->Nodeable->nodeable($this,'technos',$databuilding_id);
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
    public function create($type=null)
    {
        if ($type != null)
        {
           // récupère les infos de la techno à construire
            $data['Datatechno'] = $this->_getNextDatatechno($type);

            // Vérifier qu'un labo du bon databuilding_id existe
            if (!$data['Building'] = $this->_doesBuildingExist($data['Datatechno']['databuilding_id'])) {
                throw new Exception('Construisez d\'abord un laboratoire.');
            }

            // vérification des prérequis
            if ($data['Datatechno']['lvl'] === 1)
            {
                $this->Datanode = $this->Components->load('Datanode');
                if ($this->Datanode->isAllowed(2, $type) !== true) {
                    throw new NotImplementedException('Les prérequis pour construire cette techno sont manquants.');
                }
            }

            // vérifie les ressources
            if (!$this->Nodeable->isEnoughResources($data['Datatechno'])) {
                throw new NotImplementedException('Pas assez de ressources dispo');
            }

            // créer la techno
            if ($data['Datatechno']['lvl'] === 1)
            {
                $this->loadModel('Techno');
                $this->Techno->save(array(
                    'user_id' => $this->Session->read('User.id'),
                    'datatechno_id' => $type,
                    'lvl' => 0
                ));
                $data['Techno']['id'] = $this->Techno->id;
            }
            else
            {
                $data['Techno']['id'] = current($this->Data->read('Technos')[$type])['id'];
            }

            // récupérer les temps de création
            $data['dttechnos'] = $this->Data->read('Dttechnos');
            $times = $this->Nodeable->startFinishTimes(2,$data['dttechnos'],$data['Datatechno']['time']);

            // créer la file de construction
            $this->loadModel('Dttechno');
            $this->Dttechno->save(array(
                'datatechno_id' => $type,
                'techno_id' => $data['Techno']['id'],
                'begin' => $times['start'],
                'finish' => $times['finish'],
                'building_id' => $data['Building']['id'],
                'user_id' => $this->Session->read('User.id'),
                'camp_id' => $this->Session->read('Camp.current')
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
            return $this->redirect(array('controller'=>'buildings','action'=>'display',11));
        }
        return $this->redirect(array('controller'=>'buildings','action'=>'display',11));
    }


    private function _doesBuildingExist($datab_id)
    {
        $data['Buildings'] = $this->Data->read('Buildings');

        if (!isset($data['Buildings'][$datab_id]))
            return false;

        return $data['Buildings'][$datab_id]['Building'];
    }

    private function _getNextDatatechno($type)
    {
        if (!$this->Nodeable->doesNodeExist(2,$type))
        {
            $nextLvl = 1;
        }
        else
        {
            $this->loadModel('Dttechno');
            $dttechnos = $this->Dttechno->findByDatatechno($type);
            $data['Technos'] = $this->Data->read('Technos');
            $data['Techno'] = current($data['Technos'][$type]);
            $nextLvl = $data['Techno']['lvl'] + count($dttechnos) + 1;
        }

        $data['Buildings'] = $this->Data->read('Buildings');
        $data['Technos'] = $this->Data->read('Technos');
        $this->loadModel('Datatechno');
        $data['Datatechno'] = $this->Datatechno->findByIdLvl(
            $type,$nextLvl,$data['Buildings'],$data['Technos']
        );

        return $data['Datatechno'];
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


