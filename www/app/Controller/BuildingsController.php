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
 * view method
 * Affiche un bâtiment
 *
 * @param int $_POST['building_id']
 * @param int $_SESSION['camp_id']
 * @return void
 */
    public function display($id = null)
    {
        if($id === null)
            throw new  NotFoundException(__('Invalid building'));

        if(!$this->_isBuildingOnCamp($id))
            throw new NotFoundException(__('This building isn\'t a part of your current camp.'));

        // récupère les infos du joueur et du camp
        $buildings = $this->Data->read('Buildings');
        $technos = $this->Data->read('Technos');

        debug($buildings);

        $data['Building'] = $this->Building->findById($id);
        $lvl = $data['Building']['lvl'];
        $this->loadModel('Databuilding');
        $tmp = $this->Databuilding->findByIdLvlBetween($id,$lvl,4,$buildings,$technos);
        $data = array_merge($data,$tmp);

        $this->loadModel('Dtbuilding');
        $data['Dtbuilding'] = $this->Dtbuilding->findByBuildingId($id);

        $this->set(compact('data'));

        if ($data['Building']['lvl'] <= 0) {
            $this->view = 'level0';
        } else {
            $type = $data['Building']['type'];
            $func = 'view' . $type;

            if (method_exists($this,$func)) {
                $this->$func();
            }
        }
    }

/**
 * view11 method
 * view laboratory building
 */
    private function view11()
    {
        $this->Datanode = $this->Components->load('Datanode');
        $allowedTechnos = $this->Datanode->allowedTechnos();
        $this->loadModel('Dttechno');
        $this->Data->writeIfNot(
            'Dttechnos', 
            $this->Dttechno->findByBuildingId( $this->Data->read('Building.id') )
        );
        $data = $this->Data->read();
        $this->set(compact('allowedTechnos', 'data'));
        $this->view = 'view11';
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
	public function create()
    {
        if ($this->request->is('post'))
        {
            if(!isset($this->request->data['Building']['type']))
                throw new NotImplementedException('Bad arguments in POST');

            $query = array(
                'type' => $this->request->data['Building']['type'],
                'camp_id' => $this->Session->read('Camp.current')
            );
            $kind = 1; // is building
            $lvl = 1;

            if ($this->_isBuildingType($query['type']))
                throw new NotImplementedException('Il existe déjà un batiment de ce type.');

            // vérification des prérequis
            $this->Datanode = $this->Components->load('Datanode');
            $type = $query['type'];
            if($this->Datanode->isAllowed($kind, $type) !== true)
            {
                throw new NotImplementedException('Les prérequis pour construire ce batiment sont manquants.');
            }

            // récupère les infos du batiment à construire
            $buildings = $this->Data->read('Buildings');
            $technos = $this->Data->read('Technos');

            $this->loadModel('Databuilding');
            $data['Databuilding'] = $this->Databuilding->findByIdLvl($query['type'],$lvl,$buildings,$technos);


            // vérifie les ressources
            if(!$this->_enoughResources($data['Databuilding'])){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }

            $this->loadModel('Building');
            $this->Building->save(array(
                'camp_id' => $this->Session->read('Camp.current'),
                'databuilding_id' => $query['type'],
                'lvl' => 0
            ));

            $dtbuildings = $this->Data->read('Dtbuildings');
            $begin = $this->_begin($dtbuildings);
            $finish = round($begin + $data['Databuilding']['time']);

            $this->loadModel('Dtbuilding');
            $this->Dtbuilding->save(array(
                'building_id' => $this->Building->id,
                'begin' => $begin,
                'finish' => $finish,
                'camp_id' => $query['camp_id']
            ));


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
            return $this->redirect(array('controller'=>'camps','action'=>'view'));
        }
        else
        {
            $this->Datanode = $this->Components->load('Datanode');
            $allowed = $this->Datanode->allowedBuildings();
            $this->set('allowedBuildings', $allowed);
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
	public function upgrade()
    {
        if($this->request->is('post'))
        {
            $data = $this->request->data['Building'];

            if(!isset($data['id']))
                throw new NotImplementedException('Bad arguments in POST');

            $query = array(
                'id' => $data['id'],
                'camp_id' => $this->Session->read('Camp.current')
            );

            $this->loadModel('Building');
            $data['Building'] = $this->Building->findById($query['id']);

            if (!$this->_isBuildingType($data['Building']['type']))
                throw new NotImplementedException('Construisez d\'abord un batiment de niveau 1.');

            // Récupère la file d'attente de construction pour le building ciblé
            $this->loadModel('Dtbuilding');
            $data['Dtbuilding'] = $this->Dtbuilding->findByBuildingId($query['id']);

            $nextLvl = $data['Building']['lvl'] + count($data['Dtbuilding']) + 1;

            // récupère les infos du batiment à construire
            $id = $data['Building']['type'];
            $buildings = $this->Data->read('Buildings');
            $technos = $this->Data->read('Technos');
            $this->loadModel('Databuilding');
            $data['Databuilding'] = $this->Databuilding->findByIdLvl($id,$nextLvl,$buildings,$technos);

            // vérifie les ressources
            if(!$this->_enoughResources($data['Databuilding']))
                throw new NotImplementedException('Pas assez de ressources dispo');

            $dtbuildings = $this->Data->read('Dtbuildings');
            $begin = $this->_begin($dtbuildings);
            $finish = round($begin + $data['Databuilding']['time']);

            $this->Dtbuilding->save(array(
                'building_id' => $data['Building']['id'],
                'begin' => $begin,
                'finish' => $finish,
                'camp_id' => $query['camp_id']
            ));

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

            $this->Session->setFlash(__('Le batiment a bien été amélioré.'));
        }
        return $this->redirect(array('controller'=>'camps','action'=>'actual'));
	}


    /**
     * Vérifie qu'il existe un batiment de même type sur la ville
     *
     * @param $field
     *
     * @return bool
     */
    private function _isBuildingType($type)
    {
        $buildings = $this->Data->read('Buildings');
        return (isset($buildings[$type]) && $buildings[$type]['Building']['lvl'] >= 0);
    }

    private function _isBuildingOnCamp($id){
        foreach($this->Data->read('Buildings') as $building){
            $building=current($building);
            if($building['id'] == $id){
                $data['Building'] = $building;
                return true;
            }
        }
        return false;
    }

    /**
     * A partir de dtbuildings et de son last, si il existe, on rend le beginTime du prochain building
     *
     * @param $dtbuildings
     *
     * @return int
     */
    private function _begin($dtbuildings)
    {
        if(empty($dtbuildings))
            return time();

        $last = count($dtbuildings)-1;
        return $dtbuildings[$last]['Dtbuilding']['finish'] + 1;
    }

    // TODO où mettre la fonction enoughRessources ?
    private function _enoughResources($data)
    {
        $camp = $this->Data->read('Camp');

        if( (($new['res1'] = $camp['res1'] - $data['res1']) >= 0)
            && (($new['res2'] = $camp['res2'] - $data['res2']) >= 0)
            && (($new['res3'] = $camp['res3'] - $data['res3']) >= 0)
        ) {
            foreach (array(1,2,3) as $i)
                $this->Data->write('Camp.newres'.$i, $new['res'.$i]);
            return true;
        }
        return false;
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
