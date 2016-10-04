<?php

class Hal extends stdClass
{
    public $_link = null;
    public $_embedded = null;

    public function __construct()
    {
        $this->_link = new stdClass();
        $this->_embedded = new stdClass();
    }

    public function setLinks(string $key, $value)
    {
        $this->_link->$key = $value;
    }

    public function setData(string $key, array $data)
    {
        $this->_embedded->$key = $data;
    }
}