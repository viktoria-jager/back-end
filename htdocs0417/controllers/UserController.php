<?php



class UserController {


    public static function login () {
        
        
        require "views/guest-login.html";
        

    }


    public static function logout () {
        
        session_destroy();
        header("location: /");   
        

    }

    public static function check_login () {

        
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = UserModel::getOneByEmail($email); 

        if (password_verify($password, $user["password_hash"] )) {
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminName'] = $user['username'];
            header("location: /admin-list"); 
        }
        else {
            header("location: /login");
        }
        
       
        

    }


}