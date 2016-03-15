<?php

class Database {

    private static $_instance = NULL;
    private $_connexion;

    private function __construct() {
        self::$_instance = $this;
        self::$_instance->connexion();
    }

    public function connexion() {
        try {
            $this->_connexion = new PDO('mysql:host=localhost;dbname=chat_rest;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $ex) {
            die('Erreur :<br />' . $ex->getMessage());
        }
    }

    public static function createInstance() {
        if(self::$_instance == NULL) {
            new Database();
        }

        return self::$_instance->_connexion;
    }
}
