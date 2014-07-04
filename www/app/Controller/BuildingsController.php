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
    public function display($id=null)
    {
        if($id === null)
            throw new  NotFoundException(__('Invalid building'));

        if(!$this->_isBuildingOnCamp($id))
            throw new NotFoundException(__('This building isn\'t a part of your current camp.'));

        $this->Data->writeIfNot('Building', $this->Building->findById($id));

        $databuilding_id = $this->Data->read('Building.databuilding_id');
        $this->loadModel('Databuilding');
        $this->Data->write('Databuilding', $this->Databuilding->findByIdBetween($databuilding_id,$databuilding_id+4));

        $this->loadModel('Dtbuilding');
        $this->Data->write('Dtbuilding', $this->Dtbuilding->findByBuildingId($id));

        $this->loadModel('Typebuilding');
        $this->Data->write('Typebuilding', $this->Typebuilding->findById( $this->Data->read('Building.databuilding_id_type') ));

        if($this->Data->read('Building.databuilding_id_lvl') <= 0){
            $this->level0();
        }else{
            $type = $this->Data->read('Building.databuilding_id_type');
            $func = 'view' . $type;
            if(method_exists($this,$func))
                $this->$func();
            else{
                $data = $this->Data->read();
                $this->set(compact('data'));
            }

        }
    }

/**
 * level0 method
 * view all buildings under level1
 */
    private function level0(){
        $data = $this->Data->read();
        $this->set(compact('data'));
        $this->view = 'level0';
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
            // $query tableau de request-
            if(!isset($this->request->data['Building']['type']))
            {
                throw new NotImplementedException('Bad arguments in POST');
            }

            $query = array(
                'databuilding_id' => $this->Data->toDataId($this->request->data['Building']['type']),
                'type' => $this->request->data['Building']['type'],
                'camp_id' => $this->Session->read('Camp.current')
            );

            $this->loadModel('Building');
            if ($this->_isBuildingType($query['type']))
            {
                throw new NotImplementedException('Il existe déjà un batiment de ce type.');
            }

            // vérification des prérequis
            $this->Datanode = $this->Components->load('Datanode');
            $kind = 1; // buildings
            $type = $query['type'];
            $lvl = 1;
            if(!$this->Datanode->isAllowed($kind, $type, $lvl)){
                throw new NotImplementedException('Les prérequis pour construire ce batiment sont manquants.');
            }

            // récupère les infos du batiment à construire
            $this->loadModel('Databuilding');
            $this->Data->writeIfNot('Databuilding', $this->Databuilding->findById($query['databuilding_id']));
            if($this->Data->read('Databuilding.lvl') != 1){
                throw new NotImplementedException('Le batiment demandé est de niveau !=1');
            }

            // vérifie les ressources
            if(!$this->_enoughResources($this->Data->read('Databuilding'))){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }else{
                $this->Building->save(array(
                    'camp_id' => $this->Session->read('Camp.current'),
                    'databuilding_id' => $query['databuilding_id']-1 // id_building level(0) = (id_building level(1) - 1)
                ));

                $this->loadModel('Dtbuilding');
                $begin = $this->_begin($this->Dtbuilding->lastByCampId($query['camp_id']));
                $this->Dtbuilding->save(array(
                    'building_id' => $this->Building->id,
                    'camp_id' => $query['camp_id'],
                    'begin' => $begin,
                    'finish' => ($begin + $this->Data->read('Databuilding.time'))
                ));

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
            $this->Session->setFlash(__('Le batiment a bien été créé.'));
            return $this->redirect(array('controller'=>'camps','action'=>'view'));
        }
        else
        {
            $this->Datanode = $this->Components->load('Datanode');
            $verifiedBuildings = $this->Datanode->allowedBuildings();
            $this->set('verifiedBuildings', $verifiedBuildings);
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
        if($this->request->is('post')){

            $data = $this->request->data['Building'];
            // $query tableau de request
            if(!isset($data['id']))
                throw new NotImplementedException('Bad arguments in POST');
            $query = array(
                'id' => $data['id'],
                'camp_id' => $this->Session->read('Camp.current')
            );

            if(!$this->_isBuildingOnCamp($query['id'])){
                throw new NotImplementedException('Construisez d\'abord sur cette case avant de vouloir améliorer.');
            }

            $this->loadModel('Building');
            $this->Data->write('Building',$this->Building->findById($query['id']));

            // Récupère la file d'attente de construction pour le building ciblé
            $this->loadModel('Dtbuilding');
            $this->Data->writeIfNot('Dtbuilding', $this->Dtbuilding->findByBuildingId($query['id']));

            // Augmente de 1 le niveau du batiment par rapport à la file d'attente
            $lvls_to_add = $this->_lvls_to_add($this->Data->read('Dtbuilding'));
            $query['databuilding_id'] = $this->Data->read('Building.databuilding_id') + $lvls_to_add;
            $query['databuilding_id_lvl'] = $this->Data->read('Building.databuilding_id_lvl') + $lvls_to_add;

            // récupère les infos du batiment à construire
            $this->loadModel('Databuilding');
            $this->Data->writeIfNot('Databuilding',$this->Databuilding->findById($query['databuilding_id']));

            // vérifie les ressources
            if(!$this->_enoughResources($this->Data->read('Databuilding'))){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }else{

                $begin = $this->_begin($this->Dtbuilding->lastByCampId($query['camp_id']));
                $this->Dtbuilding->save(array(
                    'building_id' => $query['id'],
                    'camp_id' => $query['camp_id'],
                    'begin' => $begin,
                    'finish' => ($begin + $this->Data->read('Databuilding.time'))
                ));

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

            $this->Session->setFlash(__('Le batiment a bien été amélioré.'));
        }
        return $this->redirect(array('controller'=>'camps','action'=>'view'));
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


    /**
     * Vérifie qu'il existe un batiment de même type sur la vile
     *
     * @param $field
     *
     * @return bool
     */
    private function _isBuildingType($type)
    {
        foreach ($this->Data->read('Buildings') as $building)
        {
            $building = current($building);

            if ($building['type'] == $type)
            {
                return true;
            }
        }
        return false;
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
}
