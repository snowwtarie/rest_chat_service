<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 10/03/2016
 * Time: 11:52
 */

require __DIR__ . '/DAO.php';
require __DIR__ . '\\..\\Class\\Class.database.php';

require __DIR__ . '\\..\\Class\\Class.chat.php';

class ChatDAO extends DAO {

    private $_connexion;

    public function __construct() {
        $this->_connexion = Database::createInstance();
    }

    public function find($id)
    {
        // TODO: Implement find() method.

        $query = $this->_connexion->prepare('SELECT * FROM chat WHERE id_chat= :id_chat');

        $query->execute(array(
            'id_chat' => $id
        ));

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if(!$result) {
            return false;
        } else {
            return new Chat($result);
        }
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.

        $query = $this->_connexion->query('SELECT id_chat FROM chat');
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if(count($result, COUNT_RECURSIVE) == 0) {
            return false;
        } else {

            $chats = array();

            foreach($result as $id) {
                array_push($chats, $this->find($id['id_chat']));
            }

            return $chats;
        }
    }

    public function create($credentials)
    {
        // TODO: Implement create() method.
        $rowsAffected = $this->_connexion->exec('INSERT INTO chat(created) VALUES (NOW())');

        if ($rowsAffected > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($credentials)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        $prepare = $this->_connexion->prepare('DELETE FROM chat WHERE id_chat= :id_chat');

        $rowsAffected = $prepare->exec(array(
            'id_chat' => $id
        ));

        if($rowsAffected > 0) {
            return true;
        } else {
            return false;
        }
    }
}