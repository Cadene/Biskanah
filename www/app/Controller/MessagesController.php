<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * Affiche les messages reçus
 * View: received
 *
 * @param int $_SESSION['user_id']
 * @return void
 */
	public function index() {

	}

/**
 * sent method
 *
 * Affiche les messages envoyés
 * View: sent
 *
 * @param int $_SESSION['user_id']
 * @return void
 */
	public function sent() {

	}

/**
 * read method
 *
 * Affiche un message
 * View: read
 *
 * @param int $_POST['message_id']
 * @return void
 */
	public function read() {

	}

/**
 * write method
 *
 * Ecrire un message
 * View: write
 *
 * @param int $_POST['message_id']
 * @return void
 */
	public function read_msg() {

	}

/**
 * archive method
 *
 * Archive un message
 *
 * @param int $_POST['message_id']
 * @return void
 */
	public function archive() {

	}

/**
 * delete method
 *
 * Efface un message
 *
 * @param int $_POST['message_id']
 * @return void
 */
	public function delete() {

	}


/**
 * index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}

        $this->Message->updateAll(array('read'=>"NOW()" ),array('id'=>$id, 'read' => NULL));
		$this->loadModel('User');
        $this->User->DowngradeUnreadMsg($this->Message->getReveiver($id));
        $options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {

            debug($this->request->data);
            $tmp = $this->request->data['Message'];
            $d['Message']['title'] = $tmp['title'];
            $d['Message']['content'] = $tmp['content'];
            $d['Message']['sent'] = $tmp['sent'];
            $d['Message']['read'] = NULL;
            $d['Message']['to'] = $tmp['to'];
            $d['Message']['from'] = $tmp['from'];


            $this->Message->create();
			if ($this->Message->generate($d)) {
                $this->loadModel('User');
                $this->User->UpdateUnreadMsg($d['Message']['to']);
                $this->Session->setFlash(__('The message has been saved.'));
                return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
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
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
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
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('The message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
