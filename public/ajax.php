<?php

    include(dirname(__DIR__) . "/src/Database.php");
    include(dirname(__DIR__) . "/src/Auth.php");
    include(dirname(__DIR__) . "/src/User.php");
    include(dirname(__DIR__) . "/src/Tweet.php");

    use App\Auth;
    use App\Tweet;
    use App\User;
    if($_POST["nameForm"] == "submitRegisterForm"){

        $firstname = htmlspecialchars($_POST["firstname"]);
        $lastname = htmlspecialchars($_POST["lastname"]);
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $birthdate = htmlspecialchars($_POST["birthdate"]);
        $genre = htmlspecialchars($_POST["genre"]);

        if(empty($firstname) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($birthdate) || empty($genre)){
            exit("Veuillez spécifier tous champs");
        }

        $password = hash("ripemd160", $password);

        
        $auth = Auth::register($firstname, $lastname, $username, $email, $password, $birthdate, $genre);
        
        return;
    }else if($_POST["nameForm"] == "submitLoginForm"){
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        if(empty($email) || empty($password)){
            exit("Veuillez spécifier tous champs");
        }
        $auth = Auth::login($email, $password);
        return;

    }else if($_POST["nameForm"] == "submitFollow"){
        
        $id_user = htmlspecialchars($_POST["id_user"]);
        $id_user_followed = htmlspecialchars($_POST["id_user_followed"]);

        echo("test");
        // $auth = Auth::login($email, $password);
        $auth = User::followUser($id_user, $id_user_followed);
        return;

    }else if($_POST["nameForm"] == "updateTweet"){

        Tweet::updateTweet();
        return;

    }else if($_POST["nameForm"] == "updateSearch"){

        $input = $_POST;
        $search = User::getUserSearch($input["data"]["input"]); 
        return;

    }else if($_POST["nameForm"] == "submitRetweet"){
        
        $tweet_id_rt = htmlspecialchars($_POST["tweet_id_rt"]);
        $id_user_rt = htmlspecialchars($_POST["id_user_rt"]);

        echo("test");
        // $auth = Auth::login($email, $password);
        $auth = Tweet::retweet($id_user_rt, $tweet_id_rt);
        return;

    }

?>