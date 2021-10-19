<?php


 class RoleChecker{

     static function check($role, $cb){

         $user = Auth::getUser();
         if($user && $user->role == $role){
            return $cb();
         }
         return header('location:403');
    }

 }