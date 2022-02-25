<?php

namespace model;

use core\Model;

class Inventory extends Model {
    public function getInventory($conditions=''){
        return parent::query("SELECT 
            i.*, b.name `brandname`, ut.name `unitname`
        FROM 
            inventory i 
            INNER JOIN brand b ON i.idBrand=b.id 
            INNER JOIN unittype ut ON i.idUnitType=ut.id 
        WHERE 
            i.`delete`=0 AND 
            b.`delete`=0 AND 
            ut.`delete`=0 
            $conditions 
            ORDER BY i.create_at DESC
        ");
    }
    
    public function getInventoryById($brandID, $unitID){
        return parent::query("SELECT 
            i.*, b.name `brandname`, ut.name `unitname`
        FROM 
            inventory i 
            INNER JOIN brand b ON i.idBrand=b.id 
            INNER JOIN unittype ut ON i.idUnitType=ut.id 
        WHERE 
            i.`delete`=0 AND 
            b.`delete`=0 AND 
            ut.`delete`=0 AND 
            i.idBrand=$brandID AND 
            i.idUnitType=$unitID 
            ORDER BY i.create_at DESC
        ");
    }
}