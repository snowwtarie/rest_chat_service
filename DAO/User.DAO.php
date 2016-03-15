<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 10/03/2016
 * Time: 09:23
 */

//require __DIR__ . '/DAO.php';

require __DIR__ . '\\..\\Class\\Class.user.php';
//require __DIR__ . '\\..\\Class\\Class.chat.php';

class UserDAO extends DAO {

    private $_connexion;

    public function __construct() {
        $this->_connexion = Database::createInstance();
    }

    public function find($id)
    {
        // TODO: Implement find() method.

        $statement = $this->_connexion->prepare('SELECT * FROM user WHERE id_user= :id_user');

        $statement->execute(array(
            'id_user' => $id
        ));

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        } else {
            return new User($result);
        }
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.

        $query = $this->_connexion->query('SELECT id_user FROM user');

        $ids = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($ids, COUNT_RECURSIVE) == 0) {
            return false;
        } else {
            $users = array();

            foreach($ids as $id) {
                array_push($users, $this->find($id['id_user']));
            }

            return $users;
        }
    }

    public function findAllByChat($id_chat)
    {
        // TODO: Implement findAll() method.

        $query = $this->_connexion->prepare('SELECT id_user FROM user WHERE fk_id_chat= :id_chat');

        $query->execute(array(
            'id_chat' => $id_chat
        ));

        $ids = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($ids, COUNT_RECURSIVE) == 0) {
            return false;
        } else {
            $users = array();

            foreach($ids as $id) {
                array_push($users, $this->find($id['id_user']));
            }

            return $users;
        }
    }

    public function create($credentials)
    {
        // TODO: Implement create() method.
        $insert = $this->_connexion->prepare('
              INSERT INTO user(login, fk_id_chat, admin, banned) VALUES (:login, :fk_id_chat, :admin, :banned)'
        );

        $rowsAffected = $insert->execute(array(
            'login'      => $credentials['_login'],
            'fk_id_chat' => $credentials['_fk_id_chat'],
            'admin'      => $credentials['_is_admin'],
            'banned'     => $credentials['_is_banned']
        ));

        if($rowsAffected > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($credentials)
    {
        // TODO: Implement update() method.
        $prepare = $this->_connexion->prepare(
            'UPDATE user SET fk_id_chat= :fk_id_chat, login= :login, admin= :admin, banned= :banned WHERE id_user= :id_user'
        );

        $rowsAffected = $prepare->execute(array(
            'fk_id_chat' => $credentials['_fk_id_chat'],
            'login'      => $credentials['_login'],
            'admin'      => $credentials['_is_admin'],
            'banned'     => $credentials['_is_banned'],
            'id_user'    => $credentials['_id_user']
        ));

        if($rowsAffected > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $statement = $this->_connexion->prepare('DELETE FROM user WHERE id_user= :id_user');

        $rowsAffected = $statement->execute(array(
            'id_user' => $id
        ));

        if($rowsAffected > 0) {
            return true;
        } else {
            return false;
        }
    }
}