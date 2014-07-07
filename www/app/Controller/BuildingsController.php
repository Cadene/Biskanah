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

        if(!$this->Nodeable->doesNodeExist(1,$type))
            throw new NotFoundException(__('Vous devez d\'abord créer le building.'));

        // récupère les infos du joueur et du camp
        $buildings = $this->Data->read('Buildings');
        $technos = $this->Data->read('Technos');

        $data['Building'] = current($this->Data->read('Buildings')[$type]);

        $lvl = $data['Building']['lvl'];
        $this->loadModel('Databuilding');
        $tmp = $this->Databuilding->findByIdLvlBetween($type,$lvl,4,$buildings,$technos);
        $data = array_merge($data,$tmp);

        $this->loadModel('Dtbuilding');
        $data['Dtbuildings'] = $this->Dtbuilding->findByBuildingId($data['Building']['id']);

        $this->set(compact('data'));

        if ($data['Building']['lvl'] <= 0) {
            $this->view = 'level0';
        } else {
            $type = $data['Building']['type'];
            $func = 'view' . $type;
            $this->view = $func;

            if (method_exists($this,$func)) {
                $this->$func($data);
            }
        }
    }

/**
 * view11 method
 * view laboratory building
 */
    private function view11($data)
    {
        $this->Datanode = $this->Components->load('Datanode');
        $allowedTechnos = $this->Datanode->allowedTechnos();
        $this->loadModel('Dttechno');
        $dttechnos = $this->Dttechno->findByBuildingId($data['Building']['id']);
        $this->set(compact('allowedTechnos', 'dttechnos'));
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

            if ($this->Nodeable->doesNodeExist($kind,$query['type']))
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
            $lvl = 1;
            $data['Databuilding'] = $this->Databuilding->findByIdLvl($query['type'],$lvl,$buildings,$technos);

            // vérifie les ressources
            if(!$this->Nodeable->isEnoughResources($data['Databuilding'])){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }

            // créer le batiment niveau 0
            $this->loadModel('Building');
            $this->Building->save(array(
                'camp_id' => $this->Session->read('Camp.current'),
                'databuilding_id' => $query['type'],
                'lvl' => 0
            ));

            // récupérer les temps de créations
            $dtbuildings = $this->Data->read('Dtbuildings');
            $times = $this->Nodeable->startFinishTimes($kind,$dtbuildings,$data['Databuilding']['time']);

            // créer la file de construction
            $this->loadModel('Dtbuilding');
            $this->Dtbuilding->save(array(
                'building_id' => $this->Building->id,
                'begin' => $times['start'],
                'finish' => $times['finish'],
                'camp_id' => $query['camp_id']
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
            return $this->redirect(array('controller'=>'camps','action'=>'actual'));
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
        if ($this->request->is('post'))
        {
            if(!isset($this->request->data['Building']['id']))
                throw new NotImplementedException('Bad arguments in POST');
            $query = array(
                'id' => $this->request->data['Building']['id'],
                'camp_id' => $this->Session->read('Camp.current')
            );
            $kind = 1;

            // Est ce que le batiment existe déjà ?
            $this->loadModel('Building');
            $data['Building'] = $this->Building->findById($query['id']);
            if (!$this->Nodeable->doesNodeExist(1,$data['Building']['type']))
                throw new NotImplementedException('Construisez d\'abord un batiment de niveau 1.');

            // quel est le prochain niveau ?
            $this->loadModel('Dtbuilding');
            $data['Dtbuilding'] = $this->Dtbuilding->findByBuildingId($query['id']);
            $nextLvl = $data['Building']['lvl'] + count($data['Dtbuilding']) + 1;

            // récupère les infos du batiment à construire en fonction du niveau
            $id = $data['Building']['type'];
            $buildings = $this->Data->read('Buildings');
            $technos = $this->Data->read('Technos');
            $this->loadModel('Databuilding');
            $data['Databuilding'] = $this->Databuilding->findByIdLvl($id,$nextLvl,$buildings,$technos);

            // vérifie les ressources
            if(!$this->Nodeable->isEnoughResources($data['Databuilding']))
                throw new NotImplementedException('Pas assez de ressources dispo');

            // récupération des temps de constructions
            $dtbuildings = $this->Data->read('Dtbuildings');
            $times = $this->Nodeable->startFinishTimes($kind,$dtbuildings,$data['Databuilding']['time']);

            // ajout à la liste d'attente
            $this->Dtbuilding->save(array(
                'building_id' => $data['Building']['id'],
                'begin' => $times['start'],
                'finish' => $times['finish'],
                'camp_id' => $query['camp_id']
            ));

            // Mise à jour des ressources
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
