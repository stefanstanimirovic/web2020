<?php

// 3 nivoa pristupa - private, protected, public
// private - jedino unutar klase
// protected - unutar klase i unutar izvedenih klasa
// public - nikakve restrikcije
class Role
{
    // polje gde su sve permisije za rolu
    private $permissions;

    // konstruktor
    // ako ne napisete konstruktor - generise se podrazumevani (bez parametara)
    // moze da se napise konstruktor
    protected function __construct()
    {
        $this->permissions = array();
    }

    public static function getRolePerms($role_id)
    {
        $role = new Role();
        $sql = "SELECT t2.perm_desc FROM role_permissions AS t1
                LEFT JOIN permissions AS t2
                ON t1.perm_id = t2.id
                WHERE t1.role_id = $role_id";
        $result = queryMysql($sql);
        while($row = $result->fetch_assoc()) 
        {
            $role->permissions[$row['perm_desc']] = true;
        }
        return $role;
    }

    public function hasPermission($perm)
    {
        return isset($this->permissions[$perm]);
    }
}