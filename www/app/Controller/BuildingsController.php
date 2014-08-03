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
	public $components = array('Paginator','Data','Nodeable');

/**
 * view method
 * Affiche un bâtiment
 *
 * @param int $_POST['building_id']
 * @param int $_SESSION['camp_id']
 * @return void
 */
    public function display($type = null)
    {
        if($type === null)
            throw new  NotFoundException(__('Invalid building type : '.$type));

        // récupère les infos du joueur et du camp
        $buildings = $this->Data->read('Buildings');
        $technos = $this->Data->read('Technos');

        App::uses('LGLoader','Lib/Game');

        if(!$this->Nodeable->doesNodeExist(1,$type))
        {
            $data = $this->Databuilding->findByIdLvlBetween($type,0,4,$buildings,$technos);

            $this->set(compact('data'));

            return;
        }

        $data['Building'] = current($this->Data->read('Buildings')[$type]);

        $lvl = $data['Building']['lvl'];
        $tmp = $this->Databuilding->findByIdLvlBetween($type,$lvl,4,$buildings,$technos);
        $data = array_merge($data,$tmp);

        $this->loadModel('Dtbuilding');
        $data['Dtbuildings'] = $this->Dtbuilding->findByBuildingId($data['Building']['id']);


        $this->set(compact('data'));
        if ($data['Building']['lvl'] <= 0)
        {
            $this->view = 'level0';
        }
        else
        {
            $type = $data['Building']['type'];
            $this->view = 'view' . $type;

            $func = 'view';
            $this->$func($type,$data);

        }
    }

    public function index()
    {
        $this->Data = $this->Components->load('Data');

        $data['Camp'] = $this->Data->read('Camp');
        $data['Buildings'] = $this->Data->read('Buildings');
        $data['Dtbuildings'] = $this->Data->read('Dtbuildings');
        $data['Technos'] = $this->Data->read('Technos');
        $data['Dttechnos'] = $this->Data->read('Dttechnos');

        App::uses('LGLoader','Lib/Game');
        $data['Databuildings'] = LGLoader::read('Buildings');
        $requisits = LGLoader::read('Requisits');

        $data['Buildables'] = $requisits->allowed(
            'buildings', $data['Buildings'], $data['Technos'], array()
        );

        debug($data['Buildables']);

        $this->set('data',$data);
    }

/**
 * view11 method
 * view laboratory building
 */
    private function view($type,$data)
    {
        $this->Data = $this->Components->load('Data');

        $data['Buildings'] = $this->Data->read('Buildings');

        if ($type == 11 || $type == 12)
        {
            $data['Technos'] = $this->Data->read('Technos'.$type);

            $this->loadModel('Dttechno');
            $data['Dttechnos'] = $this->Dttechno->findByBuildingId($data['Building']['id']);

            $this->loadModel('Datatechno');
            $data['Datatechnos'] = $this->Datatechno->findAllStuffed(
                $data['Buildings'], $data['Technos'], 1
            );
        }
        else if ($type == 7 || $type == 8 || $type == 9)
        {
            $data['UnitsCamps'] = $this->Data->read('UnitsCamps');
            $data['Technos'] = $this->Data->read('Technos');

            $this->loadModel('Dtunit');
            $data['Dtunits'] = $this->Dtunit->findAllByBuilding($data['Building']['id']);

            $data['Dataunits'] = $this->Data->read('Dataunits');
        }

        $this->set(compact('data'));
    }


/**
* create method
* Crée un bâtiment de niveau 0 dans la table Buildings
* Crée un bâtiment de niveau 1 dans la table Dtbuildings
*
* @param int $_POST['camp_id']
* @param int $_POST['type']
* @param int $_POST['field']
* @param int $_POST['level']
* @return void
*/
    public function requisits()
    {
        $this->Nodeable = $this->Components->load('Nodeable');
        $this->Nodeable->nodeable($this);
    }

    /**
     * Crée ou met à jour les batiments
     *
     * @param null $type
     *
     * @throws NotImplementedException
     */
    public function create($type=null)
    {
        if ($type !== null)
        {
            // récupère les infos du building à construire
            $data['Databuilding'] = $this->_getNextDatabuilding($type);

            // vérification des prérequis
            if ($data['Databuilding']['lvl'] === 1)
            {
                $this->Datanode = $this->Components->load('Datanode');
                if ($this->Datanode->isAllowed(1, $type) !== true) {
                    throw new NotImplementedException('Les prérequis pour construire ce batiment sont manquants.');
                }
            }

            $this->_verifyEnoughRes($data['Databuilding']);
            $this->_verifyOneBoxeLeft($data['Databuilding']);

            // créer le batiment niveau 0
            if ($data['Databuilding']['lvl'] === 1)
            {
                $this->loadModel('Building');
                $this->Building->save(array(
                    'camp_id' => $this->Session->read('Camp.current'),
                    'databuilding_id' => $type,
                    'lvl' => 0
                ));
                $data['Building']['id'] = $this->Building->id;
            }
            else
            {
                $data['Building']['id'] = current($this->Data->read('Buildings')[$type])['id'];
            }

            // récupérer les temps de créations
            $data['Dtbuildings'] = $this->Data->read('Dtbuildings');
            $times = $this->Nodeable->startFinishTimes(
                1,$data['Dtbuildings'],$data['Databuilding']['time']
            );

            // créer la file de construction
            $this->loadModel('Dtbuilding');
            $this->Dtbuilding->save(array(
                'databuilding_id' => $type,
                'building_id' => $data['Building']['id'],
                'begin' => $times['start'],
                'finish' => $times['finish'],
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

            $this->Session->setFlash(__('Le batiment a bien été créé.'));
            return $this->redirect(array('action'=>'index'));
        }
        return $this->redirect(array('action'=>'buildable'));
    }

    private function _getNextDatabuilding($type)
    {
        if (!$this->Nodeable->doesNodeExist(1,$type))
        {
            $nextLvl = 1;
        }
        else
        {
            $this->loadModel('Dtbuilding');
            $dtbuildings = $this->Dtbuilding->findByDatabuilding($type);
            $data['Buildings'] = $this->Data->read('Buildings');
            $data['Building'] = current($data['Buildings'][$type]);
            $nextLvl = $data['Building']['lvl'] + count($dtbuildings) + 1;
        }

        $data['Buildings'] = $this->Data->read('Buildings');
        $data['Technos'] = $this->Data->read('Technos');
        $this->loadModel('Databuilding');
        $data['Databuilding'] = $this->Databuilding->findByIdLvl(
            $type,$nextLvl,$data['Buildings'],$data['Technos']
        );

        return $data['Databuilding'];
    }

    private function _verifyOneBoxeLeft($databuilding)
    {
        $camp = $this->Data->read('Camp');

        if ($camp['maxBoxes'] - $camp['boxes'] <= 1)
        {
            if ($databuilding['id'] != 16)
                throw new NotImplementedException('Pas assez de place disponible, créez un terraformeur');
        }
    }

    private function _verifyEnoughRes($databuilding)
    {
        if(!$this->Nodeable->isEnoughResources($databuilding))
            throw new NotImplementedException('Pas assez de ressources dispo');
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
