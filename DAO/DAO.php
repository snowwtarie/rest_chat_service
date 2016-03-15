<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 10/03/2016
 * Time: 09:21
 */

abstract class DAO {

    public abstract function find($id);
    public abstract function findAll();
    public abstract function create($credentials);
    public abstract function update($credentials);
    public abstract function delete($id);

}