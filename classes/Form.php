<?php

class Form
{

    static function validate($rules)
    {

        $errors = [];

        //request may be either post or get
        foreach ($rules as $key => $rule) {

            $rls = explode('|', $rule);

            foreach ($rls as $r) {

                if (trim($_POST[$key]) == "") {
                    if ($r == 'required') {
                        $errors[$key] = 'This field is required';
                    }
                } else {
                    switch ($r) {
                        case 'unique': if(!self::isUnique($key, $_POST[$key])){
                            $errors[$key] = 'This '.$key.'is already Exists ';
                        };
                        break;
                        case 'email': if(!filter_var($_POST[$key], FILTER_VALIDATE_EMAIL)) {
                            $errors[$key] = "Invalid Email Address";
                        }
                        break;
                    }
                }


            }


        }

        return $errors;

    }

    private static function isUnique($col, $value)
    {

        $data = Database::connect()->table('users')
            ->select()
            ->where($col, '=', $value)
            ->get();
        if($data && count($data) > 0){
            return false;
        }
        return true;

    }

}