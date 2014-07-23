<?php
App::uses('AppController', 'Controller');
/**
 * Units Controller
 *
 * @property Unit $Unit
 * @property PaginatorComponent $Paginator
 */
class UnitsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Nodeable');

/**
 * index method
 *
 * Toutes les unités du joueur dans tous les camps du joueur
 * View: index
 *
 * @param int $_SESSION['user_id']
 * @return void
 */
    /**
     * Liste des unités en fonction de leur batiment de recherche
     *
     * @param $databuilding_id
     */
    public function trainable($databuilding_id)
    {
        $this->Nodeable = $this->Components->load('Nodeable');
        $this->Nodeable->nodeable($this,'units',$databuilding_id);
    }

/**
 * create method
 *
 * Ajoute des unités à la liste des unités en entrainement
 *
 * @param int $_POST['building_id']
 * @param int $_POST['type'] type d'unité
 * @param int $_POST['nb'] nombre d'unités
 * @param int $_SESSION['camp_id']
 * @return void
 */
	public function create($type=null)
    {
        $query = $this->request->data;

        // récupération du Dataunit
        $data['Dataunits'] = $this->Data->read('Dataunits');

        if (!isset($data['Dataunits'][$type]))
        {
            throw new Exception('error type '.$type);
        }
        $data['Dataunit'] = current($data['Dataunits'][$type]);

        $data['Buildings'] = $this->Data->read('Buildings');

        // vérifictation de l'existence de building
        if (!isset($data['Buildings'][$data['Dataunit']['databuilding_id']]))
        {
            throw new Exception('error pas de building');
        }
        else
        {
            $data['Building'] = current($data['Buildings'][$data['Dataunit']['databuilding_id']]);
        }

        // vérification des prérequis
        $this->Datanode = $this->Components->load('Datanode');
        if ($this->Datanode->isAllowed(3, $type) !== true)
        {
            throw new NotImplementedException('Les prérequis pour construire cette unité sont manquants.');
        }

        // vérifie les ressources
        if (!$this->Nodeable->isEnoughResources($data['Dataunit'],$query['nbUnits']))
        {
            throw new NotImplementedException('Pas assez de ressources dispo');
        }

        // créer l'unité
        $data['UnitsCamps'] = $this->Data->read('UnitsCamps');

        if (!isset($data['UnitsCamps'][$type]))
        {
            $this->loadModel('UnitsCamp');
            $this->UnitsCamp->save(array(
                'camp_id' => $this->Session->read('Camp.current'),
                'dataunit_id' => $type,
                'num' => 0
            ));
            $data['UnitsCamp']['id'] = $this->UnitsCamp->id;
        }
        else
        {
            $data['UnitsCamp'] = current($data['UnitsCamps'][$type]);
        }

        // récupérer le temps de création
        $this->loadModel('Dtunit');
        $data['Dtunits'] = $this->Dtunit->findAllByBuilding($data['Building']['id']);
        $times = $this->Nodeable->startFinishTimes(
            3, $data['Dtunits'], $data['Dataunit']['time'] * $query['nbUnits']
        );

        // créer la file de construction
        $this->loadModel('Dtunit');
        $this->Dtunit->save(array(
            'dataunit_id' => $type,
            'unit_camp_id' => $data['UnitsCamp']['id'],
            'building_id' => $data['Building']['id'],
            'begin' => $times['start'],
            'finish' => $times['finish']
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
        return $this->redirect(array('controller'=>'buildings','action'=>'display',$data['Building']['id']));



    }


/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Unit->recursive = 0;
		$this->set('units', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Unit->exists($id)) {
			throw new NotFoundException(__('Invalid unit'));
		}
		$options = array('conditions' => array('Unit.' . $this->Unit->primaryKey => $id));
		$this->set('unit', $this->Unit->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Unit->create();
			if ($this->Unit->save($this->request->data)) {
				$this->Session->setFlash(__('The unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unit could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Unit->exists($id)) {
			throw new NotFoundException(__('Invalid unit'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Unit->save($this->request->data)) {
				$this->Session->setFlash(__('The unit has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unit could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Unit.' . $this->Unit->primaryKey => $id));
			$this->request->data = $this->Unit->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Unit->id = $id;
		if (!$this->Unit->exists()) {
			throw new NotFoundException(__('Invalid unit'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Unit->delete()) {
			$this->Session->setFlash(__('The unit has been deleted.'));
		} else {
			$this->Session->setFlash(__('The unit could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
