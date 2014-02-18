<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public $useTable = 'us3rs_m0n1t0r';
    public $validate = array(
        'us3r' => array(
            'required' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Usuario es requerido'),
        ),
        'p4ss' => array(
            'required' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Usuario es requerido'),
    ));

    public function getByUsernameAndPass($username, $pass)
    {
        $passwordHasher = new SimplePasswordHasher();
        $pass = $passwordHasher->hash($pass);
        $users = $this->findByUs3rAndP4ssAndStatus($username, $pass, Usuario::STATUS_ENABLED);
        return count($users) > 0 ? $users[0] : null;
    }

    public function beforeSave($options = array())
    {
        if (isset($this->data['User']['p4ss']) === true)
        {
            $passwordHasher = new SimplePasswordHasher();
            $this->data['User']['p4ss'] = $passwordHasher->hash($this->data['User']['p4ss']);
        }
    }

    public function insert($user, $pass)
    {
        $data = array();
        $data['us3r'] = substr($user, 0, 10);
        $data['p4ss'] = $pass;
        $data['status'] = self::STATUS_ENABLED;
        try
        {
            $this->save($data);
        }
        catch (PDOException $e)
        {
            switch ($e->getCode())
            {
                case 23000:
                    break;
                default:
                    throw $e;
            }
        }
    }

    public function changePass($id, $newPass)
    {
        $passwordHasher = new SimplePasswordHasher();
        $newPass = $passwordHasher->hash($newPass);
        $db = $this->getDataSource();
        $db->fetchAll("UPDATE us3rs_m0n1t0r SET p4ss = ? WHERE id = ?", array(
            $newPass, $id));
    }

}
