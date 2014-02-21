<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = array(
        //'Security',
        'Session',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'Sesion',
                'action' => 'Index'
            ),
            'loginRedirect' => array(
                'controller' => 'Sesion',
                'action' => 'Welcome'
            ),
            'logoutRedirect' => array(
                'controller' => 'Sesion',
                'action' => 'Logout'
            ),
            'unauthorizedRedirect' => array(
                'controller' => 'Sesion',
                'action' => 'Rechazado'
            ),
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'us3r',
                        'password' => 'p4ss')
                )
            )
        )
    );

    public function beforeRender()
    {
        parent::beforeRender();
        $this->set('authUser', $this->Auth->user());
        $this->set('loggedIn', $this->Auth->loggedIn());
    }

    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);
        $this->layout = 'base';
    }
    
    protected function checkModels()
    {
        $bosch = $this->Session->read('configuration');
        $lineId = $bosch->getConfiguration()->getLine();
    }

}
