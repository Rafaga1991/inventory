<?php

namespace model;

use core\Model;

class File extends Model { 
    public $primaryKey = 'idEmployee';

    public function exists($idEmployee){
        return !empty(parent::query("SELECT * FROM $this->table WHERE `$this->primaryKey`=$idEmployee"));
    }
}