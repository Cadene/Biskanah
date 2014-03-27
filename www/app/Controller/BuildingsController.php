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
    public function display($id=null){
        if($id === null)
            throw new  NotFoundException(__('Invalid building'));

        if(!$this->_isBuildingOnCamp($id))
            throw new NotFoundException(__('This building isn\'t a part of your current camp.'));

        $this->Data->write('Building', $this->Building->findById($id));

        $databuilding_id = $this->Data->read('Building.databuilding_id');
        $this->loadModel('Databuilding');
        $this->Data->write('Databuilding', $this->Databuilding->findByIdBetween($databuilding_id,$databuilding_id+4));

        $this->loadModel('Dtbuilding');
        $this->Data->write('Dtbuilding', $this->Dtbuilding->findByBuildingId($id));

        $type = $this->Data->read('Building.databuilding_id_type');

        
    }

/**
* view method
* Affiche un bâtiment
*
* @param int $_POST['building_id']
* @param int $_SESSION['camp_id']
* @return void
*/
	public function view($id=null) {
        if($id === null)
            throw new  NotFoundException(__('Invalid building'));

        if(!$this->_isBuildingOnCamp($id))
            throw new NotFoundException(__('This building isn\'t a part of your current camp.'));

        $this->Data->write('Building', $this->Building->findById($id));

        $databuilding_id = $this->Data->read('Building.databuilding_id');
        $this->loadModel('Databuilding');
        $this->Data->write('Databuilding', $this->Databuilding->findByIdBetween($databuilding_id,$databuilding_id+4));

        $this->loadModel('Dtbuilding');
        $this->Data->write('Dtbuilding', $this->Dtbuilding->findByBuildingId($id));

        $type = $this->Data->read('Building.databuilding_id_type');

        $this->view = $type;

        if($type==0){

        }
        if($type==11){
            $this->Datanode = $this->Components->load('Datanode');
            $allowedTechnos = $this->Datanode->allowedTechnos();
            $this->Data->writeIfNot('Dttechnos',
                $this->loadModel('Dttechno')->findByBuildingId($this->Data->read('Building.id'))
            );
            $this->set('allowedTechnos', $allowedTechnos);
        }
        if($type==2){

        }
        if($type==0){

        }
        if($type==0){

        }
        if($type==0){

        }
        if($type==0){

        }
        if($type==0){

        }
        if($type==0){

        }
        if($type==0){

        }
        if($type==0){

        }

        $this->set('data',$this->Data->read());
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
	public function create($field = null) {
        if($this->request->is('post')){

            // $query tableau de request-
            if(!isset($this->request->data['Building']['type'])
                && !isset($this->request->data['Building']['field']))
                throw new NotImplementedException('Bad arguments in POST');
            $query['Building'] = array(
                'databuilding_id' => $this->Data->toDataId($this->request->data['Building']['type']),
                'type' => $this->request->data['Building']['type'],
                'field' => $this->request->data['Building']['field'],
                'camp_id' => $this->Session->read('Camp.current')
            );

            // récupère dans $data['Buildings'] les infos des buildings
            $this->loadModel('Building');
            if($this->_isBuildingInField($query['Building']['field'])){
                throw new NotImplementedException('Il existe déjà un batiment construit sur le field');
            }

            // vérification des prérequis
            $this->Datanode = $this->Components->load('Datanode');
            if(!$this->Datanode->isBuildingAllowed($query['Building']['type'])){
                throw new NotImplementedException('Les prérequis sont manquants.');
            }

            // récupère les infos du batiment à construire
            $this->loadModel('Databuilding');
            $this->Data->writeIfNot('Databuilding',$this->Databuilding->findById($query['Building']['databuilding_id']));
            if($this->Data->read('Databuilding.lvl') != 1){
                throw new NotImplementedException('Le batiment demandé est de niveau !=1');
            }

            // vérifie les ressources
            if(!$this->_enoughResources($this->Data->read('Camp'),$this->Data->read('Databuilding'))){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }else{
                $this->loadModel('Building');
                $this->Building->save(array(
                    'camp_id' => $this->Session->read('Camp.current'),
                    'field' => $query['Building']['field'],
                    'databuilding_id' => $query['Building']['databuilding_id']-1 // id_building level(0) = (id_building level(1) - 1)
                ));

                $this->loadModel('Dtbuilding');
                $this->Dtbuilding->save(array(
                    'building_id' => $this->Building->id,
                    'begin' => time(),
                    'finish' => (time()+ $this->Data->read('Databuilding.time'))
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
            $this->Session->setFlash(__('Le batiment a bien été créé.'));
            return $this->redirect(array('controller'=>'camps','action'=>'view'));
        }
        else
        {
            $this->Datanode = $this->Components->load('Datanode');
            $verifiedBuildings = $this->Datanode->allowedBuildings();
            $this->set('verifiedBuildings', $verifiedBuildings);
            $this->set('field',$field);
        }
    }


    // TODO où mettre la fonction enoughRessources ?
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

            // $query tableau de request
            if(!isset($this->request->data['Building']['id']))
                throw new NotImplementedException('Bad arguments in POST');
            $query['Building'] = array(
                'id' => $this->request->data['Building']['id'],
                'camp_id' => $this->Session->read('Camp.current')
            );

            if(!$this->_isBuildingOnCamp($query['Building']['id'])){
                throw new NotImplementedException('Construisez d\'abord sur cette case avant de vouloir améliorer.');
            }

            // Récupère la file d'attente de construction pour le building ciblé
            $this->loadModel('Dtbuilding');
            $this->Data->writeIfNot('Dtbuilding', $this->Dtbuilding->findByBuildingId($query['Building']['id']));

            // Augmente de 1 le niveau du batiment par rapport à la file d'attente
            $query['Building']['databuilding_id'] = count($this->Data->read('Dtbuilding')) +
                                             $this->Data->read('Building.databuilding_id') + 1;
            $query['Building']['databuilding_id_lvl'] = count($this->Data->read('Dtbuilding')) +
                                             $this->Data->read('Building.databuilding_id_lvl') + 1;

            // récupère les infos du batiment à construire
            $this->loadModel('Databuilding');
            $this->Data->writeIfNot('Databuilding',$this->Databuilding->findById($query['Building']['databuilding_id']));
            if($this->Data->read('Databuilding.lvl') <= 1){
                throw new NotImplementedException('Le batiment demandé est de niveau <=1');
            }

            // vérification des prérequis
            $this->Datanode = $this->Components->load('Datanode');
            if(!$this->Datanode->isBuildingAllowed($query['Building']['databuilding_id'])){
                throw new NotImplementedException('Les prérequis sont manquants.');
            }

            // vérifie les ressources
            if(!$this->_enoughResources($this->Data->read('Camp'),$this->Data->read('Databuilding'))){
                throw new NotImplementedException('Pas assez de ressources dispo');
            }else{

                $this->loadModel('Dtbuilding');
                $this->Dtbuilding->save(array(
                    'building_id' => $query['Building']['id'],
                    'begin' => time(),
                    'finish' => (time()+ $this->Data->read('Databuilding.time'))
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

            $this->Session->setFlash(__('Le batiment a bien été amélioré.'));
        }
        return $this->redirect(array('controller'=>'camps','action'=>'view'));
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
     * Vérifie que le champ est libre
     *
     * @param $field
     *
     * @return bool
     */
    private function _isBuildingInField($field)
    {
        foreach($this->Data->read('Buildings') as $building){
            $building=current($building);
            if($building['field'] == $field){
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
