<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 10/03/2016
 * Time: 14:30
 */

//require __DIR__ . '/DAO.php';

require __DIR__ . '\\..\\Class\\Class.message.php';

class MessageDAO extends DAO {

    private $_connexion;

    public function  __construct() {
        $this->_connexion = Database::createInstance();
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $statement = $this->_connexion->prepare('SELECT * FROM message WHERE id_message= :id_message');

        $statement->execute(array(
            'id_message' => $id
        ));

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$result) {
            return false;
        } else {
            return new Message($result);
        }
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.

        $query = $this->_connexion->query('SELECT id_message FROM message');
        $ids = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($ids, COUNT_RECURSIVE) == 0) {
            return false;
        } else {
            $messages = array();

            foreach($ids as $id_message) {
                array_push($messages, $this->find($id_message['id_message']));
            }

            return $messages;
        }
    }

    public function findAllByChat($id_chat) {

        $statement = $this->_connexion->prepare(
            'SELECT * FROM message WHERE fk_id_chat= :id_chat'
        );

        $success = $statement->execute(array(
            'id_chat' => $id_chat
        ));

        if($success) {
            $messages = array();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $message) {
                array_push($messages, new Message($message));
            }

            return $messages;
        } else {
            return false;
        }
    }

    public function findAllByUser($id_user) {

        $statement = $this->_connexion->prepare(
            'SELECT * FROM message WHERE fk_id_user= :id_user'
        );

        $success = $statement->execute(array(
            'id_user' => $id_user
        ));

        if($success) {
            $messages = array();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $message) {
                array_push($messages, new Message($message));
            }

            return $messages;
        } else {
            return false;
        }
    }

    public function create($credentials)
    {
        // TODO: Implement create() method.

        $statement = $this->_connexion->prepare(
            'INSERT INTO message(fk_id_chat, fk_id_user, message, created, modified) VALUES(:fk_id_chat, :fk_id_user, :message, NOW(), NOW())'
        );

        $success = $statement->execute(array(
            'fk_id_chat' => $credentials['_fk_id_chat'],
            'fk_id_user' => $credentials['_fk_id_user'],
            'message'    => $credentials['_message']
        ));

        if($success) {
            return true;
        } else {
            return false;
        }
    }

    public function update($credentials)
    {
        // TODO: Implement update() method.

        $statement = $this->_connexion->prepare(
            'UPDATE message SET message= :message WHERE id_message= :id_message'
        );

        $success = $statement->execute(array(
            'message'    => $credentials['_message'],
            'id_message' => $credentials['_id_message']
        ));

        if($success) {
            return true;
        } else {
            return false;
        }

    }

    public function delete($id)
    {
        // TODO: Implement delete() method.

        $statement = $this->_connexion->prepare('DELETE FROM message WHERE id_message= :id_message');

        $success = $statement->execute(array(
            'id_message' => $id
        ));

        if($success) {
            return true;
        } else {
            return false;
        }
    }

}