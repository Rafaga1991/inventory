<?php

namespace model;

use core\Model;

class Employee extends Model {
    public function getEmployees(){
        $query = "SELECT 
            e.id, e.name, e.lastname, 
            CONCAT(e.name, ' ', e.lastname) `fullname`,
            e.email, e.date_add, e.extensionnumber, 
            d.name `department` 
        FROM employee e 
            INNER JOIN department d
            ON e.idDepartment=d.id
        WHERE e.delete=false";
        return parent::query($query);
    }
}