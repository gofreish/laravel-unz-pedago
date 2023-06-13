<?php
/*
    16.12.2019
    RolesService.php
*/

namespace App\Services;

use Spatie\Permission\Models\Role;

class RolesService{

    static $defaultRoles = ['guest'];

    static $programme_create = ['coordonateur']; 

    public static function get(){
        $roles = Role::all();
        $result = array();
        foreach($roles as $role){
            array_push($result, $role->name);
        }
        //return array_merge(self::$defaultRoles, $result);
        return $result;
    }

    public  static function aAuMoinsUn( $tabA, $tabB ){
        //On cherche si tabB à au moins un élément de tabA
        foreach ($tabA as $key => $value) {
            if( $tabB->contains($value) )
                return true;
        }
        return false;
    }

}