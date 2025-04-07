<?php


namespace App;

use App\Database;


class Tweet
{

    /**
     * Get all tweets
     * 
     */
    public static function getTweetsData(){
        try{
            $pdo = Database::connect();
            $query = "SELECT *, tweet.id as 'tweet_id' from tweet INNER JOIN user ON user.id=tweet.id_user ORDER BY tweet.id DESC";
            $smt = $pdo->prepare($query);
            
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get all retweets
     * 
     */
    public static function getRetweetsData(){
        try{
            $pdo = Database::connect();
            $query = "SELECT tweet.id_user as 'id_user_of_retweet', user.*, tweet.* from retweet INNER JOIN tweet ON retweet.id_tweet=tweet.id INNER JOIN user ON tweet.id_user=user.id;";
            $smt = $pdo->prepare($query);
            
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

        /**
     * retweet
     * 
     */
    public static function retweet($id_user, $id_tweet_rt){
        try{
            $pdo = Database::connect();
            $query = "INSERT INTO retweet(id_user,id_tweet) VALUES(:id_user,:id_tweet_rt);";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":id_user", $id_user);
            $smt->bindParam(":id_tweet_rt", $id_tweet_rt);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get all retweets
     * 
     */
    public static function deleteTweet($id){
        try{
            $pdo = Database::connect();
            $query = "DELETE FROM tweet WHERE id = :id";
            $smt = $pdo->prepare($query);
            $smt->bindParam(":id", $id);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }



    /**
     * Get all tweets
     * 
     */
    public static function updateTweet(){
        try{
            $pdo = Database::connect();
            $query = "SELECT *, tweet.id as 'tweet_id' from tweet INNER JOIN user ON user.id=tweet.id_user ORDER BY tweet.id DESC";
            $smt = $pdo->prepare($query);
            
            $smt->execute();
            print_r($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * Get all tweets of user
     * 
     */
    public static function getTweetsUserData($user_id){
        try{
            $pdo = Database::connect();
            $query = "SELECT *, tweet.id as 'tweet_id' from tweet INNER JOIN user ON user.id=tweet.id_user WHERE user.id = :user_id ORDER BY tweet.id DESC";

            $smt = $pdo->prepare($query);
            $smt->bindParam(":user_id", $user_id);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get count tweets of user
     * 
     */
    public static function getCountTweetsUser($user_id){
        try{
            $pdo = Database::connect();
            $query = "SELECT count(*) as 'nombre' from tweet WHERE id_user = :user_id";
            
            $smt = $pdo->prepare($query);
            $smt->bindParam(":user_id", $user_id);
            $smt->execute();
            return($smt->fetchAll(\PDO::FETCH_ASSOC));

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * Post a tweet
     * 
     */
    public static function postTweet($id_user, $content, $media1, $media2, $media3, $media4){
        try{
            $pdo = Database::connect();
            $query = "INSERT INTO tweet (id_user, content, media1, media2, media3, media4) VALUES (:id_user, :content, :media1, :media2, :media3, :media4)";

            $smt = $pdo->prepare($query);
            $smt->bindParam(":id_user", $id_user);
            $smt->bindParam(":content", $content);
            $smt->bindParam(":media1", $media1);
            $smt->bindParam(":media2", $media2);
            $smt->bindParam(":media3", $media3);
            $smt->bindParam(":media4", $media4);
            $smt->execute();

        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

?>