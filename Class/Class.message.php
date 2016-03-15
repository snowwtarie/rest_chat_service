<?php

class Message implements JsonSerializable {

    private $_id_message;
    private $_fk_id_chat;
    private $_fk_id_user;
    private $_message;
    private $_created;
    private $_modified;

    public function __construct($credentials) {
        $this->_id_message = $credentials['id_message'];
        $this->_fk_id_chat = $credentials['fk_id_chat'];
        $this->_fk_id_user = $credentials['fk_id_user'];
        $this->_message = $credentials['message'];
        $this->_created = $credentials['created'];
        $this->_modified = $credentials['modified'];
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
    public function getFkIdUser()
    {
        return $this->_fk_id_user;
    }

    /**
     * @param mixed $fk_id_user
     */
    public function setFkIdUser($fk_id_user)
    {
        $this->_fk_id_user = $fk_id_user;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->_message = $message;
    }

    /**
     * @return mixed
     */
    public function getIdMessage()
    {
        return $this->_id_message;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->_created;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->_modified;
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
