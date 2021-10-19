<?php


    class Auth{

        static function storeLogin($loginData){
            //if login data is array then pick the first item as associative array
            $data = gettype($loginData)== 'array' ? $loginData[0] : $loginData;
            //encode the associative array/object into string
            setcookie('login', json_encode($data), time() + 30 * 86400, '/');
        }

        static function removeLogin(){
            setcookie('login', null, -1, '/');
        }

        static function getUser(){
            return json_decode($_COOKIE['login']);
        }

        static  function isLoggedIn(){

            if(!isset($_COOKIE['login'])){

                return false;
            }
           // echo $_COOKIE['login'];
            return true;
        }
        static function hasRole($role){
            //first check if user logged in
            if(self::isLoggedIn()){
                $user = Auth::getUser();
                if( !($user && $user->role == $role)){
                    return false;
                }
            }else{
                return false;
            }
            return true;

        }

    }