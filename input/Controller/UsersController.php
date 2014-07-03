<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    public $uses = array('User', 'World', 'Message');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * Profil du joueur avec son rang, son alliance, sa description et ses camps
 * View: si id = s:user_id alors v:my_profil, sinon v:profil
 *
 * @param int $user_id
 * @param int $_SESSION['user_id']
 * @return void
 */
	public function index($user_id = null) {

	}

/**
 * register method
 *
 * Crée l'utilisateur en bd
 * Envoie un message in game de bienvenue à l'utilisateur
 * Envoie un mail de bienvenue à l'utilisateur
 * Redirige vers camps/index
 * View: register
 *
 * @param string $_POST['username']
 * @param string $_POST['email']
 * @param string $_POST['password']
 * @param string $_POST['captcha']
 * @return void
 */
	public function register() {
        if ($this->request->is('post')) {
            $data['User'] = array(
                'password' => $this->Auth->password($this->request->data['User']['password']),
                'username' => $this->request->data['User']['username'],
                'email' => $this->request->data['User']['email'],
            );
            $this->User->create();
            if ($this->User->save($data['User'])) {
                $data['User']['id'] = $this->User->id;
                $this->loadModel('World');
                $data['World']['id'] = $this->World->generateFirstCamp();
                $this->loadModel('Camp');
                $data['Camp']['id'] = $this->Camp->generate($data);
               //$this->Message->hello($this->User->id);
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('controller'=>'pages'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
	}

/**
 * validate method
 *
 * Crée l'utilisateur en bd
 * Envoie un message in game de bienvenue à l'utilisateur
 * Envoie un mail de bienvenue à l'utilisateur
 * Redirige vers camps/index
 * View: register
 *
 * @param string $_POST['username']
 * @param string $_POST['email']
 * @param string $_POST['password']
 * @param string $_POST['captcha']
 * @return void
 *
    public function register() {
        if ($this->request->is('post')) {
            $data['User'] = array(
                'password' => $this->request->data['User']['password'],
                'username' => $this->request->data['User']['username'],
                'email' => $this->request->data['User']['email']
            );
            $this->User->create();
            if ($this->User->save($data['User'])) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('controller'=>'pages','action' => 'display','index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }*/

/**
 * login method
 *
 * Crée les variables de session
 * Redirige vers camps/index
 *
 * @param string $_POST['username']
 * @param string $_POST['password']
 * @return void
 */
	public function login() {
        if ($this->request->is('post')) {
            $data['User'] = array(
                'password' => $this->Auth->password($this->request->data['User']['password']),
                'username' => $this->request->data['User']['username']
            );
            if ($query = $this->User->login($data['User']['username'])) {
                if($query['User']['password'] == $data['User']['password']){
                    unset($query['User']['password']);
                    $this->Session->destroy();
                    $this->Session->write($query);
                    $this->Session->setFlash(__('Le joueur est connecté.'));
                    return $this->redirect(array('controller'=>'camps','action' => 'view'));
                } else {
                    $this->Session->setFlash(__('Le mot de passe est incorrecte.'));
                }
            } else {
                $this->Session->setFlash(__('Le pseudo est incorrecte.'));
            }
        }
	}

/**
 * logout method
 *
 * Supprime les variables de session
 * Redirige vers pages/display/index
 *
 * @param string $_POST['username']
 * @param string $_POST['password']
 * @return void
 */
    public function logout(){
        $this->Session->destroy();
        return $this->redirect($this->Auth->logout());
    }

/**
 * edit method
 *
 * Modifie les informations du compte
 * Redirige vers pages/display/index
 * View: edit
 *
 * @param string $_POST['email']
 * @param string $_POST['password']
 * @param string $_POST['newpassword']
 * @param string $_POST['desc']
 * @param int $_SESSION['user_id']
 * @return void
 */
	public function edit() {
        $this->Data->write('User.First.Second',array('Test.nop'=>'Yes'));
        debug($this->Data->read());
        die();

	}



/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$teams = $this->User->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$teams = $this->User->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
