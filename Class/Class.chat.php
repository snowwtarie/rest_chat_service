<?php

class Chat implements JsonSerializable {

    private $_id_chat;
    private $_created;

    public function __construct($credentials) {
        $this->_id_chat = $credentials['id_chat'];
        $this->_created = $credentials['created'];
    }

    /**
     * @return mixed
     */
    public function getIdChat()
    {
        return $this->_id_chat;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->_created;
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