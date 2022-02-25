<?php

namespace model;

use core\Model;

class Assigned extends Model {
    public function getAssigned(){
        return parent::query("SELECT 
            a.id `idAssigned`, a.idEmployee,  a.create_at `assigned_at`,
            CONCAT(e.name, ' ', e.lastname) `fullname`, a.update_at `received_at`,
            i.*, ut.name `unitname`, b.name `brandname` 
        FROM 
            assigned a 
            INNER JOIN employee e ON a.idEmployee=e.id 
            INNER JOIN inventory i ON a.idInventary=i.id 
            INNER JOIN brand b ON i.idBrand=b.id 
            INNER JOIN unittype ut ON ut.id=i.idUnitType 
        WHERE 
            a.`delete`=0 AND e.`delete`=0 AND i.`delete`=0
        ");
    }

    public function getAssignedById($id, $colname='idInventory'){
        return parent::query("SELECT 
            a.id `idAssigned`, a.idEmployee, a.create_at `assigned_at`,
            CONCAT(e.name, ' ', e.lastname) `fullname`,
            i.*, ut.name `unitname`, b.name `brandname` ,
            a.state `assignedState`, a.update_at `received_at`
        FROM 
            assigned a 
            INNER JOIN employee e ON a.idEmployee=e.id 
            INNER JOIN inventory i ON a.idInventory=i.id 
            INNER JOIN brand b ON i.idBrand=b.id 
            INNER JOIN unittype ut ON ut.id=i.idUnitType 
        WHERE 
            a.`delete`=0 AND e.`delete`=0 AND i.`delete`=0 AND a.$colname=$id
        ");
    }

    public function getLastAssigned($id, $colname='i.id', $orderBy='a.create_at DESC'){
        return parent::query("SELECT 
            a.id `idAssigned`, a.idEmployee, a.create_at `assigned_at`,
            CONCAT(e.name, ' ', e.lastname) `fullname`,
            i.*, ut.name `unitname`, b.name `brandname` ,
            a.state `assignedState`, a.update_at `received_at`
        FROM 
            assigned a 
            INNER JOIN employee e ON a.idEmployee=e.id 
            INNER JOIN inventory i ON a.idInventory=i.id 
            INNER JOIN brand b ON i.idBrand=b.id 
            INNER JOIN unittype ut ON ut.id=i.idUnitType 
        WHERE 
            $colname=$id ORDER BY $orderBy
        ");
    }

    public function getLastAssignedDischarge($id = null, bool $group=true){
        return parent::query("SELECT 
            a.id `idAssigned`, a.idEmployee, a.create_at `assigned_at`,
            CONCAT(e.name, ' ', e.lastname) `fullname`, e.delete_at `discharge_at`,
            i.*, ut.name `unitname`, b.name `brandname`,
            a.state `assignedState`, a.update_at `received_at`
        FROM 
            assigned a 
            INNER JOIN employee e ON a.idEmployee=e.id 
            INNER JOIN inventory i ON a.idInventory=i.id 
            INNER JOIN brand b ON i.idBrand=b.id 
            INNER JOIN unittype ut ON ut.id=i.idUnitType 
        WHERE 
            e.delete=1 AND a.delete=0 " . ($id?"AND e.id=$id ":'') . ($group?'GROUP BY e.id DESC':''));
    }
}