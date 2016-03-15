<?php

class User implements JsonSerializable {

    private $_id_user;
    private $_fk_id_chat;
    private $_login;
    private $_is_admin;
    private $_is_banned;

    public function __construct($credentials) {
        $this->_id_user = $credentials['id_user'];
        $this->_fk_id_chat = $credentials['fk_id_chat'];
        $this->_login = $credentials['login'];
        $this->_is_admin = $credentials['admin'];
        $this->_is_banned = $credentials['banned'];
    }

    /**
     * @return mixed
     */
    public function getFkIdChat()
    {
        return $this->_fk_id_chat;
    }

    /**
     * @param mixed $fk_id_chat
     */
    public function setFkIdChat($fk_id_chat)
    {
        $this->_fk_id_chat = $fk_id_chat;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->_login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->_login = $login;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->_is_admin;
    }

    /**
     * @param mixed $is_admin
     */
    public function setIsAdmin($is_admin)
    {
        $this->_is_admin = $is_admin;
    }

    /**
     * @return mixed
     */
    public function getIsBanned()
    {
        return $this->_is_banned;
    }

    /**
     * @param mixed $is_banned
     */
    public function setIsBanned($is_banned)
    {
        $this->_is_banned = $is_banned;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
        return json_encode(get_object_vars($this));
    }
}
