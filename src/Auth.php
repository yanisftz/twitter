<?php

namespace App;

use App\Database;


class Auth extends Database
{

    /**
     * Regsiter new user
     * 
     * @param string $email
     * @param string $password
     * @param string $firstname
     * @param string $lastname
     * @param Datetime $birthdate
     * @param string $city
     * @param boolean $gender
     * 
     */
    public static function register($firstname, $lastname, $username, $email, $password, $birthdate, $genre){
        try{
            $pdo = Database::connect();
            $query = "INSERT INTO user(firstname, lastname, username, email, password, birthdate, genre) VALUES (:firstname, :lastname, :username, :email, :password, :birthdate, :genre)";
            $smt = $pdo->prepare($query);
            
            $smt->bindParam(":firstname", $firstname);
            $smt->bindParam(":lastname", $lastname);
            $smt->bindParam(":username", $username);
            $smt->bindParam(":email", $email);
            $smt->bindParam(":password", $password);
            $smt->bindParam(":birthdate", $birthdate);
            $smt->bindParam(":genre", $genre);
            $smt->execute();
            exit("Inscription réussie !");
        }catch (\Exception $e) {
            exit($e->getCode());
            if($e->getCode() == 23000){
                exit($e->getCode());
            }else{
                exit($e->getMessage());
            }
        }

    }

    /**
     * Login user
     * 
     * @param string $email
     * @param string $password
     * 
     */
    public static function login($email, $password){
        try{
            session_start();
            $pdo = Database::connect();
            $query = "SELECT * from user WHERE email = :email";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":email", $email);
            $smt->execute();
            $data = $smt->fetch(\PDO::FETCH_ASSOC);
            if($data){
                if($data["is_active"] == 1){
                    if(hash("ripemd160", $password) == $data["password"]){
                        $_SESSION["user"] = $data;
                        exit("Connexion réussi !");
                    }else{
                        exit("Mot de passe incorrect.");
                    }
                }else{
                    exit("Votre compte est désactivé, contacter un administrateur.");
                }
            }
            exit("utilisateur introuvable");

        }catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    /**
     * Logout user
     * 
     */
    public static function logout(){
        $_SESSION = array();
        session_destroy();
    }


    /**
     * Update email user
     * 
     * @param int $id
     * 
     */
    public static function updateEmail($email, $id){
        $pdo = Database::connect();
        $query = "UPDATE user SET email = :email WHERE id = :id";
        $smt = $pdo->prepare($query);

        $smt->bindParam(":email", $email);
        $smt->bindParam(":id", $id);

        $smt->execute();

    }
    /**
     * Update password user
     * 
     * @param int $id
     * 
     */
    public static function updatePassword($password, $id){
        $pdo = Database::connect();
        $query = "UPDATE user SET password = :password WHERE id = :id";
        $smt = $pdo->prepare($query);

        $smt->bindParam(":password", $password);
        $smt->bindParam(":id", $id);
        
        $password = password_hash($password, PASSWORD_DEFAULT);

        $smt->execute();

    }
}

?>