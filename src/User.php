<?php


namespace App;

use App\Database;
use PDOStatement;

class User
{

    /**
     * Get all users
     * 
     */
    public static function getUsers(){
        try{
            $pdo = Database::connect();
            $query = "SELECT * from user";
            $smt = $pdo->prepare($query);
            
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get user by username
     * 
     */
    public static function getUser($username){
        try{
            $pdo = Database::connect();
            $query = "SELECT * from user WHERE username = :username";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":username", $username);
            
            $smt->execute();
            return($smt->fetch(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get user by username
     * 
     */
    public static function getUserById($id){
        try{
            $pdo = Database::connect();
            $query = "SELECT * from user WHERE id = :id";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":id", $id);
            
            $smt->execute();
            return($smt->fetch(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get user by username with search
     * 
     */
    public static function getUserSearch($username){
        try{
            $pdo = Database::connect();
            $query = "SELECT * from user WHERE username LIKE '$username%'";
            $smt = $pdo->prepare($query);
            //$smt->bindParam(":username", $username);

            $smt->execute();
            print_r(json_encode($smt->fetchAll(\PDO::FETCH_ASSOC)));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    /**
     * Get followers of user
     * 
     */
    public static function getFollower($id_user){
        try{
            $pdo = Database::connect();
            $query = "SELECT user.username, user.biography, user.firstname, user.lastname, user.picture FROM user INNER JOIN follow ON user.id = follow.id_user_follow WHERE id_user_followed = :id_user";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":id_user", $id_user);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get user's follow
     * 
     */
    public static function getUserFollow($id_user){
        try{
            $pdo = Database::connect();
            $query = "SELECT user.username, user.biography, user.firstname, user.lastname, user.picture FROM user INNER JOIN follow ON user.id = follow.id_user_followed WHERE id_user_follow = :id_user";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":id_user", $id_user);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Follow user
     * 
     */
    public static function followUser($id_user, $id_user_followed){
        try{
            $pdo = Database::connect();
            $query = "INSERT INTO follow(id_user_follow, id_user_followed) VALUES(:id_user_followed, :id_user);";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":id_user", $id_user);
            $smt->bindParam(":id_user_followed", $id_user_followed);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Follow user
     * 
     */
    public static function verifFollower($id_user_followed, $id_user){
        try{
            $pdo = Database::connect();
            $query = "SELECT * FROM follow WHERE id_user_followed = :id_user && id_user_follow = :id_user_followed";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":id_user", $id_user);
            $smt->bindParam(":id_user_followed", $id_user_followed);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * Update update account
     * 
     */
    public static function updateAccount($user_id, $biography, $firstname, $url, $city, $header, $picture){
        try{
            $pdo = Database::connect();
            $query = "UPDATE user SET ";
            $first_arg = 1;
            if($biography != ""){
                if($first_arg == 1){
                    $first_arg = 0;
                    $query = $query . "biography = :biography ";
                }else{
                    $query = $query . ", biography = :biography ";
                }
            }
            if($firstname != ""){
                if($first_arg == 1){
                    $first_arg = 0;
                    $query = $query . "firstname = :firstname ";
                }else{
                    $query = $query . ", firstname = :firstname ";
                }
            }
            if($url != ""){
                if($first_arg == 1){
                    $first_arg = 0;
                    $query = $query . "url = :url ";
                }else{
                    $query = $query . ", url = :url ";
                }
            }
            if($city != ""){
                if($first_arg == 1){
                    $first_arg = 0;
                    $query = $query . "city = :city ";
                }else{                    
                    $query = $query . ", city = :city ";
                }
            }
            if($header != ""){
                if($first_arg == 1){
                    $first_arg = 0;
                    $query = $query . "header = :header ";
                }else{
                    $query = $query . ", header = :header ";
                }
            }
            if($picture != ""){
                if($first_arg == 1){
                    $first_arg = 0;
                    $query = $query . "picture = :picture ";
                }else{
                    $query = $query . ", picture = :picture ";
                }
            }
            $query = $query . "WHERE id = :user_id";

            $smt = $pdo->prepare($query);
            var_dump($smt);
            $smt->bindParam(":user_id", $user_id);

            if($biography != ""){
                $smt->bindParam(":biography", $biography);
            }

            if($firstname != ""){
                $smt->bindParam(":firstname", $firstname);
            }

            if($url != ""){
                $smt->bindParam(":url", $url);
            }

            if($city != ""){
                $smt->bindParam(":city", $city);
            }
            if($header != ""){
                $smt->bindParam(":header", $header);
            }
            if($picture != ""){
                $smt->bindParam(":picture", $picture);
            }
            $smt->execute();

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * Update update account
     * 
     */
    public static function selectAllMessage($user_id){
        try{
            $pdo = Database::connect();
            $query = "select count(id_receiver) as 'Nombre de message', id_receiver as 'destinataire' FROM message WHERE id_sender=:user_id || id_receiver=:user_id group by id_receiver;";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":user_id", $user_id);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Select message from conv
     * 
     */
    public static function showMessage($sender, $receiver){
        try{
            $pdo = Database::connect();
            $query = "select * from message WHERE id_sender = :sender AND id_receiver = :receiver OR id_sender = :receiver AND id_receiver = :sender";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":sender", $sender);
            $smt->bindParam(":receiver", $receiver);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Select message from conv
     * 
     */
    public static function getNamebyId($id_user){
        try{
            $pdo = Database::connect();
            $query = "SELECT * FROM user WHERE id = :id_user";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":id_user", $id_user);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }


        /**
     * Send Message
     * 
     */
    public static function sendMessage($content, $sender, $receiver){
        try{
            $pdo = Database::connect();
            $query = "INSERT INTO message(content,id_receiver,id_sender) VALUES(:content,:id_receiver,:id_sender)";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":id_receiver", $receiver);
            $smt->bindParam(":content", $content);
            $smt->bindParam(":id_sender", $sender);
            $smt->execute();
            return;

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }



}

?>