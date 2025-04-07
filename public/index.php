<?php
// [Fri Mar 14 14:43:58 2025] [::1]:53988 [200]: GET /index.php?nameForm=sendMessage&content=&receiver=19&sender=18

    session_start();
    use App\Tweet;
    use App\User;
    use App\Auth;
    require_once("./app.php");

    if(!isset(($_SESSION["user"]))){
        header('Location: /pages/register.php');
        exit;
    }

    if(isset($_POST["sendMessage"])){
        User::sendMessage($_POST["content"], $_POST["sender"], $_POST["receiver"]);
    }

    //post form
    if(isset($_POST["logout"])){
        Auth::logout();
        header('Location: /pages/register.php');
        exit;
    }
    if(isset($_POST["updateAccount"])){
        User::updateAccount($_SESSION["user"]["id"], $_POST["biography"], $_POST["firstname"], $_POST["url"], $_POST["city"], $_FILES["header"]["name"], $_FILES["picture"]["name"]);
        $dest = __DIR__ . "/assets/db_banner/" . $_FILES["header"]["name"];
        move_uploaded_file($_FILES["header"]["tmp_name"], $dest);
        $dest = __DIR__ . "/assets/db_logo/" . $_FILES["picture"]["name"];
        move_uploaded_file($_FILES["picture"]["tmp_name"], $dest);
        header('Location: /index.php');
        exit;
    }
    if(isset($_POST["tweet_content"])){
        var_dump($_FILES["media1"]["name"]);

        Tweet::postTweet($_SESSION["user"]["id"], $_POST["tweet_content"], $_FILES["media1"]["name"], $_FILES["media2"]["name"], $_FILES["media3"]["name"], $_FILES["media4"]["name"]);
        $dest = __DIR__ . "/assets/db_tweet/" . $_FILES["media1"]["name"];
        move_uploaded_file($_FILES["media1"]["tmp_name"], $dest);
        $dest = __DIR__ . "/assets/db_tweet/" . $_FILES["media2"]["name"];
        move_uploaded_file($_FILES["media2"]["tmp_name"], $dest);
        $dest = __DIR__ . "/assets/db_tweet/" . $_FILES["media3"]["name"];
        move_uploaded_file($_FILES["media3"]["tmp_name"], $dest);
        $dest = __DIR__ . "/assets/db_tweet/" . $_FILES["media4"]["name"];
        move_uploaded_file($_FILES["media4"]["tmp_name"], $dest);
        header('Location: /index.php');
        exit;
    }
    if(isset($_POST["delete_tweet"])){
        Tweet::deleteTweet($_POST["delete_tweet"]);
    }
    $users = User::getUsers();
    $tweets = Tweet::getTweetsData();

    $tweetsOfUser = Tweet::getTweetsUserData($_SESSION["user"]["id"]);
    $retweetOfUser = Tweet::getRetweetsData($_SESSION["user"]["id"]);
    foreach($retweetOfUser as $rt){
        array_push($tweetsOfUser, $rt);
    }
    $countTweetsUser = Tweet::getCountTweetsUser($_SESSION["user"]["id"]);
    $followOfUser = User::getFollower($_SESSION["user"]["id"]);
    $userFollow = User::getUserFollow($_SESSION["user"]["id"]);
?>

<script>

    
</script>


<section id="index">
    <div class="w-3/4 flex m-auto h-full">
    <?php
        /**
         * 
         * 
         * 
         * 
         * 
            Header
        */
    ?>
        <header class="w-1/6 b-w-r relative">
            <nav class="flex flex-col text-2xl space-y-4 p-4 sticky top-0">
                <div onclick="swapVue('tweet')" class="flex items-center space-x-2 w-max px-4 hover:bg-white/15 duration-150 py-3 rounded-full cursor-pointer">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1nao33i r-lwhw9o r-cnnz9e"><g><path fill="#ffffff" d="M21.591 7.146L12.52 1.157c-.316-.21-.724-.21-1.04 0l-9.071 5.99c-.26.173-.409.456-.409.757v13.183c0 .502.418.913.929.913h6.638c.511 0 .929-.41.929-.913v-7.075h3.008v7.075c0 .502.418.913.929.913h6.639c.51 0 .928-.41.928-.913V7.904c0-.301-.158-.584-.408-.758zM20 20l-4.5.01.011-7.097c0-.502-.418-.913-.928-.913H9.44c-.511 0-.929.41-.929.913L8.5 20H4V8.773l8.011-5.342L20 8.764z"></path></g></svg>
                    <span class="text-lg">Home</span>
                </div>
                <div onclick="swapVue('message')" class="flex items-center space-x-2 w-max px-4 hover:bg-white/15 duration-150 py-3 rounded-full cursor-pointer">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1nao33i r-lwhw9o r-cnnz9e"><g><path fill="#ffffff" d="M1.998 5.5c0-1.381 1.119-2.5 2.5-2.5h15c1.381 0 2.5 1.119 2.5 2.5v13c0 1.381-1.119 2.5-2.5 2.5h-15c-1.381 0-2.5-1.119-2.5-2.5v-13zm2.5-.5c-.276 0-.5.224-.5.5v2.764l8 3.638 8-3.636V5.5c0-.276-.224-.5-.5-.5h-15zm15.5 5.463l-8 3.636-8-3.638V18.5c0 .276.224.5.5.5h15c.276 0 .5-.224.5-.5v-8.037z"></path></g></svg>
                    <span class="text-lg">Messages</span>
                </div>
                <div onclick="swapVue('myaccount')" class="flex items-center space-x-2 w-max px-4 hover:bg-white/15 duration-150 py-3 rounded-full cursor-pointer">
                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1nao33i r-lwhw9o r-cnnz9e"><g><path fill="#ffffff" d="M5.651 19h12.698c-.337-1.8-1.023-3.21-1.945-4.19C15.318 13.65 13.838 13 12 13s-3.317.65-4.404 1.81c-.922.98-1.608 2.39-1.945 4.19zm.486-5.56C7.627 11.85 9.648 11 12 11s4.373.85 5.863 2.44c1.477 1.58 2.366 3.8 2.632 6.46l.11 1.1H3.395l.11-1.1c.266-2.66 1.155-4.88 2.632-6.46zM12 4c-1.105 0-2 .9-2 2s.895 2 2 2 2-.9 2-2-.895-2-2-2zM8 6c0-2.21 1.791-4 4-4s4 1.79 4 4-1.791 4-4 4-4-1.79-4-4z"></path></g></svg>
                    <span class="text-lg">Profile</span>
                </div>
                <div onclick="document.getElementById('postTweet').classList.remove('hidden')" class="bg-white text-black text-base px-4 py-3 rounded-full text-center font-bold cursor-pointer">
                    <span>Post</span>
                </div>
            </nav>
        </header>
    <?php
        /**
         * 
         * 
         * 
         * 
         * 
            Button post tweet
        */
    ?>
        <div class="">
            <div id="postTweet" class="bg-white/20 b-w fixed flex inset-0 z-20 backdrop-blur-xs hidden">
                <div class="p-4 rounded bg-slate-950 m-auto b-w w-4/10 ">
                    <div class="flex items-center space-x-4">
                        <h1 class="cursor-pointer duration-150 hover:bg-white/20 rounded-full h-max p-2" onclick="document.getElementById('postTweet').classList.add('hidden')"><svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-z80fyv r-19wmn03" style="color: rgb(239, 243, 244);"><g><path fill="#ffffff" d="M10.59 12L4.54 5.96l1.42-1.42L12 10.59l6.04-6.05 1.42 1.42L13.41 12l6.05 6.04-1.42 1.42L12 13.41l-6.04 6.05-1.42-1.42L10.59 12z"></path></g></svg></h1>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="p-4">
                            <input maxlength="140" class="w-full" type="text" placeholder="What is happening ?!" name="tweet_content" spellcheck="true" required>
                        </div>

                        <div class="flex flex-col space-y-3 w-full text-gray-400 p-2">
                            <div class="space-x-0.5">
                                <label class="bg-white/10 px-2 py-1 rounded" for="media1"><i class="fa-regular fa-file-image"></i></label>
                                <input class="w-max" type="file" name="media1" accept="image/*">
                            </div>
                            <div class="space-x-0.5">
                                <label class="bg-white/10 px-2 py-1 rounded" for="media2"><i class="fa-regular fa-file-image"></i></label>
                                <input class="w-max" type="file" name="media2" accept="image/*">
                            </div>
                            <div class="space-x-0.5">
                                <label class="bg-white/10 px-2 py-1 rounded" for="media3"><i class="fa-regular fa-file-image"></i></label>
                                <input class="w-max" type="file" name="media3" accept="image/*">
                            </div>
                            <div class="space-x-0.5">
                                <label class="bg-white/10 px-2 py-1 rounded" for="media4"><i class="fa-regular fa-file-image"></i></label>
                                <input class="w-max" type="file" name="media4" accept="image/*">
                            </div>
                        </div>

                        <button class="m-2 bg-white/20 px-6 py-2 rounded" type="submit">Tweet</button>

                    </form>
                </div>
            </div>
        </div>
    <?php
        /**
         * 
         * 
         * 
         * 
         * 
            All
        */
    ?>
        <main class="w-4/6 min-h-screen">
        <?php
            /**
             * 
             * 
             * 
             * 
             * 
                All tweets
            */
        ?>
            <div id="tweet" class="">
                <div class="p-2 b-w-b flex items-center">
                    <img class="h-18" src="./assets/img/logo.png" alt="">
                    <h1 class="text-2xl font-bold uppercase">Tweetly</h1>
                </div>
                <div id="alltweets">

                </div>
            </div>
        <?php
            /**
             * 
             * 
             * 
             * 
             * 
                All privates messages
            */
        ?>                    
            <div id="message" class=" text-white p-6 hidden space-y-4 relative h-max">
                <h1 class="text-4xl font-bold uppercase mb-4">messages</h1>
                <div id="allmessages" class="space-y-4">
                <?php $conversations = User::selectAllMessage($_SESSION["user"]["id"]) ?>
                <?php foreach($conversations as $c): ?>
                    <?php $user = User::getUserById($c["destinataire"]) ?>
                    <div onclick="document.getElementById('<?php echo($user["username"]) ?>').classList.remove('invisible')" class="hover:bg-white/5 rounded b-w duration-100 cursor-pointer flex flex-col p-4 space-x-4">
                        <div class="flex mb-3">
                            <div class="min-h-12 min-w-12 h-12 w-12 items-center">
                                <?php if(isset($user["picture"])): ?>
                                <img class="rounded-full h-full w-full object-cover" src="./assets/db_logo/<?php echo($user["picture"]) ?>" alt="">
                                <?php endif ?>
                            </div>
                            <div class="flex space-x-1 items-center ml-4">
                                <h1 class="text-xl font-bold items-center"><?php echo($user["firstname"]) ?></h1>
                                <h1 class="text-sm items-center">@<?php echo($user["username"]) ?></h1>
                            </div>
                        </div>
                        <div>
                            <p class="truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil alias neque facilis? Voluptate, quidem? Mollitia non, laudantium nesciunt corrupti perspiciatis, dolorum aperiam earum, magni porro nostrum debitis fugit. Recusandae, dolorum?</p>
                        </div>
                    </div>


                    <div class="absolute inset-0 bg-gray-900 invisible h-full" id="<?php echo($user["username"]) ?>">

                        <div class="bg-slate-950 p-2">
                            <button class="bg-white/15 rounded-full px-4 py-2 cursor-pointer b-w" onclick="document.getElementById('<?php echo($user["username"]) ?>').classList.add('invisible')">Retour</button>
                        </div>
                        <div class="flex flex-col justify-center items-center p-4 bg-indigo-700/10 b-w-y">
                            <img class="rounded-full h-20 w-20" src="./assets/db_logo/<?php echo($user["picture"]) ?>" alt="">
                            <div class="flex items-center flex-col">
                                <h1><?php echo($user["firstname"]) ?> <?php echo($user["lastname"]) ?></h1>
                                <h1 class="text-gray-400">@<?php echo($user["username"]) ?></h1>
                                <h1><?php echo($user["biography"]) ?></h1>
                            </div>
                        </div>
                        
                        <?php $messageList = User::showMessage($_SESSION["user"]["id"], $c["destinataire"]); ?>
                        <div class="messaging h-full p-2 bg-gray-900 b-w-x">

                            <?php foreach($messageList as $message): ?>
                            <?php $sender = User::getNamebyId($message["id_sender"]); ?>
                            <div>
                                <h1><span class="uppercase text-xl font-bold"><?php echo($sender[0]["firstname"]) ?></span> : <?php echo( " " . $message["content"]); ?></h1>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <form method="post" class="w-full py-2 px-4 sticky bottom-0 bg-gray-900 b-w">
                            <input type="hidden" name="sendMessage">
                            <input name="sender" type="hidden" value="<?php echo($_SESSION["user"]["id"]) ?>">
                            <input name="receiver" type="hidden" value="<?php echo($c["destinataire"]) ?>">
                            <input name="content" class="content b-w w-full text-xl bg-gray-700 rounded-xl p-2 m-1" name="content" placeholder="Start a new message" type="text">
                            <button type="submit">send</button>
                        </form>
                    </div>
                <?php endforeach ?>
                
                </div>
            </div>


        <?php
            /**
             * 
             * 
             * 
             * 
             * 
                Param account
            */
        ?>
            <div id="myaccount" class="hidden">
                <?php if(isset($_GET["user"])): ?>
                    <?php $user = User::getUser($_GET["user"]) ?>
                    <?php if($user): ?>
                        <?php
                            $tweetsOfUser = Tweet::getTweetsUserData($user["id"]);
                            $followOfUser = User::getFollower($user["id"]);
                            $userFollow = User::getUserFollow($user["id"]);
                        ?>
                        <div class="b-w-b p-2 sticky top-0 bg-[#bedbff] dark:bg-slate-950 z-10 b-w-r">
                            <a href="/">
                                <svg viewBox="0 0 24 24" aria-hidden="true" class="h-10 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-z80fyv r-19wmn03" style="color: rgb(239, 243, 244);"><g><path fill="#ffffff" d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z"></path></g></svg>
                            </a>
                        </div>
                        <div class="relative banner h-64">
                            <div class="h-full w-full bg-white/10">
                                <?php if($user["header"] != ""): ?>
                                <img class="h-full w-full object-cover" src="./assets/db_banner/<?php echo($user["header"]) ?>" alt="">
                                <?php else: ?>
                                <div class="h-64"></div>
                                <?php endif; ?>
                            </div>
                            <div class="h-32 w-32 logo absolute top-48 left-12">
                                <?php if($user["picture"] != ""): ?>
                                <img class="rounded-full h-full w-full object-cover border-gray-950 border-6" src="./assets/db_logo/<?php echo($user["picture"]) ?>" alt="">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="timeline">
                            <div class="px-4 py-8"></div>
                            <div class="py-3 px-6 space-y-2 b-w-b">
                                <div>
                                    <h1><?php echo($user["firstname"]) ?></h1>
                                    <h1 class="text-gray-400">@<?php echo($user["username"]) ?></h1>
                                </div>
                                <div>
                                    <p><?php echo($user["biography"]) ?></p>
                                </div>
                                <div>
                                    <p><?php echo($user["city"]) ?></p>
                                </div>
                                <div>
                                    <p><?php echo($user["country"]) ?></p>
                                </div>
                                <div>
                                    <p><?php echo($user["genre"]) ?></p>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <?php
                                        $date = new DateTime($user["creation_date"]);
                                        $join = $date->format('Y-m-d');
                                    ?>
                                    <svg viewBox="0 0 24 24" aria-hidden="true" class="h-4 r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1bwzh9t r-1gs4q39"><g><path fill="oklch(0.707 0.022 261.325)" d="M7 4V3h2v1h6V3h2v1h1.5C19.89 4 21 5.12 21 6.5v12c0 1.38-1.11 2.5-2.5 2.5h-13C4.12 21 3 19.88 3 18.5v-12C3 5.12 4.12 4 5.5 4H7zm0 2H5.5c-.27 0-.5.22-.5.5v12c0 .28.23.5.5.5h13c.28 0 .5-.22.5-.5v-12c0-.28-.22-.5-.5-.5H17v1h-2V6H9v1H7V6zm0 6h2v-2H7v2zm0 4h2v-2H7v2zm4-4h2v-2h-2v2zm0 4h2v-2h-2v2zm4-4h2v-2h-2v2z"></path></g></svg>
                                    <p class="text-gray-400">Rejoint le <?php echo($join) ?></p>
                                </div>
                                <div class="space-x-4 flex">
                                    <p class="cursor-pointer hover:underline underline-offset-4 text-gray-400"><span class="text-white  font-bold"><?php echo(count($followOfUser)); ?></span> Following</p>
                                    <p class="cursor-pointer hover:underline underline-offset-4 text-gray-400"><span class="text-white font-bold"><?php echo(count($userFollow)); ?></span> Follower</p>
                                </div>
                            </div>
                            <div class="">
                                <?php foreach($tweetsOfUser as $tweet): ?>
                                    <div class="flex b-w-b p-2">
                                        <div class="min-w-12 min-h-12 w-12 h-12">
                                            <img class="rounded-full h-full w-full object-cover" src="./assets/db_logo/<?php echo($tweet["picture"]) ?>" alt="logo user">
                                        </div>
                                        <div class="grow px-4">
                                            <div class="flex space-x-2">
                                                <h1 class="font-bold"><?php echo($tweet["firstname"] . " " . $tweet["lastname"]) ?></h1>
                                                <span class="text-gray-400">@<?php echo($tweet["username"]) ?></span>
                                            </div>
                                            <div>
                                            <p><?php echo($tweet["content"]) ?></p>
                                            <?php if($tweet["media1"] || $tweet["media2"] || $tweet["media3"] || $tweet["media4"]): ?>
                                        <div class="rounded p-2 flex flex-wrap w-full space-x-2">
                                            <?php if($tweet["media1"]): ?>
                                            <img class="b-w p-2 m-1 h-36 rounded" src="./assets/db_tweet/<?php echo($tweet["media1"]) ?>" alt="img_1" srcset="">
                                            <?php endif ?>
                                            <?php if($tweet["media2"]): ?>
                                            <img class="p-2 b-w m-1 h-36 rounded" src="./assets/db_tweet/<?php echo($tweet["media2"]) ?>" alt="img_2" srcset="">
                                            <?php endif ?>
                                            <?php if($tweet["media3"]): ?>
                                            <img class="p-2 b-w m-1 h-36 rounded" src="./assets/db_tweet/<?php echo($tweet["media3"]) ?>" alt="img_3" srcset="">
                                            <?php endif ?>
                                            <?php if($tweet["media4"]): ?>
                                            <img class="p-2 b-w m-1 h-36 rounded" src="./assets/db_tweet/<?php echo($tweet["media4"]) ?>" alt="img_4" srcset="">
                                            <?php endif ?>
                                        </div>
                                        <?php endif ?>
                                            </div>
                                            <div class="toolbar py-2 flex justify-between">
                                                <div><svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg></div>
                                                <div><svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M16.697 5.5c-1.222-.06-2.679.51-3.89 2.16l-.805 1.09-.806-1.09C9.984 6.01 8.526 5.44 7.304 5.5c-1.243.07-2.349.78-2.91 1.91-.552 1.12-.633 2.78.479 4.82 1.074 1.97 3.257 4.27 7.129 6.61 3.87-2.34 6.052-4.64 7.126-6.61 1.111-2.04 1.03-3.7.477-4.82-.561-1.13-1.666-1.84-2.908-1.91zm4.187 7.69c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z"></path></g></svg></div>
                                                <div><svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M4 4.5C4 3.12 5.119 2 6.5 2h11C18.881 2 20 3.12 20 4.5v18.44l-8-5.71-8 5.71V4.5zM6.5 4c-.276 0-.5.22-.5.5v14.56l6-4.29 6 4.29V4.5c0-.28-.224-.5-.5-.5h-11z"></path></g></svg></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <h1 class="p-5">Profile introuvable</h1>
                    <?php endif; ?>
                <?php else: ?>
                <div class="sticky top-0 z-10 bg-[#bedbff] dark:bg-slate-950 b-w-b b-w-r p-4">
                    <h1><?php echo($_SESSION["user"]["firstname"]) ?></h1>
                    <span class="text-sm text-gray-400"><?php echo($countTweetsUser[0]["nombre"]); ?> posts</span>
                </div>
                <div class="relative banner h-64">
                    <div class="h-full w-full bg-white/10">
                        <?php if($_SESSION["user"]["header"] != ""): ?>
                        <img class="h-full w-full object-cover" src="./assets/db_banner/<?php echo($_SESSION["user"]["header"]) ?>" alt="">
                        <?php else: ?>
                        <div class="h-64"></div>
                        <?php endif; ?>
                    </div>
                    <div class="h-32 w-32 logo absolute top-48 left-12">
                        <?php if($_SESSION["user"]["picture"] != ""): ?>
                            <img class="rounded-full h-full w-full object-cover border-gray-950 border-6" src="./assets/db_logo/<?php echo($_SESSION["user"]["picture"]) ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="timeline">
                    <div class="p-4 flex justify-end">
                        <div class="space-x-2 flex font-semibold">
                            <div id="dark-mode-toggle" class="b-w cursor-pointer hover:bg-white/15 duration-150 rounded-full px-4 py-2 w-max">
                                <h1><i class="fa-solid fa-circle-half-stroke"></i></h1>
                            </div>
                            <div onclick="document.getElementById('settings').classList.remove('hidden')" class="b-w cursor-pointer hover:bg-white/15 duration-150 rounded-full px-4 py-2 w-max">
                                <h1><i class="fa-solid fa-gear"></i></h1>
                            </div>
                            <div class="b-w cursor-pointer hover:bg-white/15 duration-150 rounded-full px-4 py-2 w-max">
                                <form method="post" class="cursor-pointer">
                                    <input type="hidden" name="logout">
                                    <input class="cursor-pointer" type="submit" value="Deconnexion">
                                </form>
                            </div>
                        </div>
                        <div class="bg-white/20 b-w fixed flex inset-0 hidden z-20 backdrop-blur-xs" id="settings">
                            <div class="p-4 rounded bg-slate-950 m-auto b-w h-4/5 w-2/4 ">
                                <div class="flex items-center space-x-4">
                                    <h1 class="cursor-pointer duration-150 hover:bg-white/20 rounded-full h-max p-2" onclick="document.getElementById('settings').classList.add('hidden')"><svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-z80fyv r-19wmn03" style="color: rgb(239, 243, 244);"><g><path fill="#ffffff" d="M10.59 12L4.54 5.96l1.42-1.42L12 10.59l6.04-6.05 1.42 1.42L13.41 12l6.05 6.04-1.42 1.42L12 13.41l-6.04 6.05-1.42-1.42L10.59 12z"></path></g></svg></h1>
                                    <h1 class="font-bold">EDITION DE PROFILE</h1>
                                </div>
                                <form action="" method="post" class="space-y-4 scale-95" enctype="multipart/form-data">
                                    <input type="hidden" name="updateAccount">
                                    <div class="flex justify-between">
                                        <div class="flex flex-col">
                                            <label class="font-bold text-lg">Logo</label>
                                            <input class="bg-white/10 b-w rounded px-3 py-2" type="file" name="picture" id="">
                                        </div>
                                        <div class="flex flex-col">
                                            <label class="font-bold text-lg">Bannière</label>
                                            <input class="bg-white/10 b-w rounded px-3 py-2" type="file" name="header">
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="font-bold text-lg">Prénom</label>
                                        <input class="bg-white/10 b-w rounded px-3 py-2" type="text" name="firstname" id="">
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="font-bold text-lg">Bio</label>
                                        <input class="bg-white/10 b-w rounded px-3 py-2" type="text" name="biography" id="biography">
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="font-bold text-lg">Location</label>
                                        <input class="bg-white/10 b-w rounded px-3 py-2" type="text" name="city" id="">
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="font-bold text-lg">Website</label>
                                        <input class="bg-white/10 b-w rounded px-3 py-2" type="text" name="url" id="">
                                    </div>
                                    <div class="bg-white text-gray-950  w-max py-2 rounded px-8 text-center">
                                        <button type="submit" class="font-bold">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="py-3 px-6 space-y-2 b-w-b">
                        <div>
                            <h1><?php echo($_SESSION["user"]["firstname"]) ?></h1>
                            <h1 class="text-gray-400">@<?php echo($_SESSION["user"]["username"]) ?></h1>
                        </div>
                        <div>
                            <p><?php echo($_SESSION["user"]["biography"]) ?></p>
                        </div>
                        <div>
                            <p><?php echo($_SESSION["user"]["city"]) ?></p>
                        </div>
                        <div>
                            <p><?php echo($_SESSION["user"]["country"]) ?></p>
                        </div>
                        <div>
                            <p><?php echo($_SESSION["user"]["genre"]) ?></p>
                        </div>
                        <div class="flex items-center space-x-1">
                            <?php
                                $date = new DateTime($_SESSION["user"]["creation_date"]);
                                $join = $date->format('Y-m-d');
                            ?>
                            <svg viewBox="0 0 24 24" aria-hidden="true" class="h-4 r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1bwzh9t r-1gs4q39"><g><path fill="oklch(0.707 0.022 261.325)" d="M7 4V3h2v1h6V3h2v1h1.5C19.89 4 21 5.12 21 6.5v12c0 1.38-1.11 2.5-2.5 2.5h-13C4.12 21 3 19.88 3 18.5v-12C3 5.12 4.12 4 5.5 4H7zm0 2H5.5c-.27 0-.5.22-.5.5v12c0 .28.23.5.5.5h13c.28 0 .5-.22.5-.5v-12c0-.28-.22-.5-.5-.5H17v1h-2V6H9v1H7V6zm0 6h2v-2H7v2zm0 4h2v-2H7v2zm4-4h2v-2h-2v2zm0 4h2v-2h-2v2zm4-4h2v-2h-2v2z"></path></g></svg>
                            <p class="text-gray-400">Rejoint le <?php echo($join) ?></p>
                        </div>
                        <div class="space-x-4 flex">
                            <p onclick="swapVue('follow')" class="cursor-pointer hover:underline underline-offset-4 text-gray-400"><span class="dark:text-white text-red-500 font-bold"><?php echo(count($followOfUser)); ?></span> Following</p>
                            <p onclick="swapVue('followed')" class="cursor-pointer hover:underline underline-offset-4 text-gray-400"><span class="text-white font-bold"><?php echo(count($userFollow)); ?></span> Follower</p>
                        </div>
                    </div>
                    <div class="">
                        <?php foreach($tweetsOfUser as $tweet): ?>
                            <div class="flex b-w-b p-2">
                                <div class="min-w-12 min-h-12 w-12 h-12 flex-col items-center flex space-y-2">
                                    <img class="rounded-full h-full w-full object-cover" src="./assets/db_logo/<?php echo($tweet["picture"]) ?>" alt="logo user">
                                </div>
                                <div class="grow px-4">
                                    <div class="flex space-x-2 items-center">
                                        <h1 class="font-bold"><?php echo($tweet["firstname"] . " " . $tweet["lastname"]) ?></h1>
                                        <span class="text-gray-400">@<?php echo($tweet["username"]) ?></span>
                                        <?php if(isset($tweet["id_user_of_retweet"])): ?>
                                            <svg viewBox="0 0 24 24" aria-hidden="true" class="h-4 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg>
                                        <?php endif ?>
                                    </div>
                                    <div>
                                    <p><?php echo($tweet["content"]) ?></p>
                                    <?php if($tweet["media1"] || $tweet["media2"] || $tweet["media3"] || $tweet["media4"]): ?>
                                <div class="rounded p-2 flex flex-wrap w-full space-x-2">
                                    <?php if($tweet["media1"]): ?>
                                    <img class="b-w p-2 m-1 h-36 rounded" src="./assets/db_tweet/<?php echo($tweet["media1"]) ?>" alt="img_1" srcset="">
                                    <?php endif ?>
                                    <?php if($tweet["media2"]): ?>
                                    <img class="p-2 b-w m-1 h-36 rounded" src="./assets/db_tweet/<?php echo($tweet["media2"]) ?>" alt="img_2" srcset="">
                                    <?php endif ?>
                                    <?php if($tweet["media3"]): ?>
                                    <img class="p-2 b-w m-1 h-36 rounded" src="./assets/db_tweet/<?php echo($tweet["media3"]) ?>" alt="img_3" srcset="">
                                    <?php endif ?>
                                    <?php if($tweet["media4"]): ?>
                                    <img class="p-2 b-w m-1 h-36 rounded" src="./assets/db_tweet/<?php echo($tweet["media4"]) ?>" alt="img_4" srcset="">
                                    <?php endif ?>
                                </div>
                                <?php endif ?>
                                    </div>
                                    <div class="toolbar py-2 flex justify-between items-center">
                                        <div class="cursor-pointer hover:bg-green-400/20 duration-100 p-2 rounded-full"><svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg></div>
                                        <div class="cursor-pointer hover:bg-red-400/20 duration-100 p-2 rounded-full"><svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M16.697 5.5c-1.222-.06-2.679.51-3.89 2.16l-.805 1.09-.806-1.09C9.984 6.01 8.526 5.44 7.304 5.5c-1.243.07-2.349.78-2.91 1.91-.552 1.12-.633 2.78.479 4.82 1.074 1.97 3.257 4.27 7.129 6.61 3.87-2.34 6.052-4.64 7.126-6.61 1.111-2.04 1.03-3.7.477-4.82-.561-1.13-1.666-1.84-2.908-1.91zm4.187 7.69c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z"></path></g></svg></div>
                                        <div class="cursor-pointer hover:bg-blue-400/20 duration-100 p-2 rounded-full"><svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M4 4.5C4 3.12 5.119 2 6.5 2h11C18.881 2 20 3.12 20 4.5v18.44l-8-5.71-8 5.71V4.5zM6.5 4c-.276 0-.5.22-.5.5v14.56l6-4.29 6 4.29V4.5c0-.28-.224-.5-.5-.5h-11z"></path></g></svg></div>
                                        <?php if(!isset($tweet["id_user_of_retweet"])): ?>
                                        <form class="cursor-pointer hover:bg-yellow-400/20 duration-100 px-3 py-2 rounded-full" action="" method="post">
                                            <input type="hidden" name="delete_tweet" value="<?php echo($tweet['tweet_id']) ?>">
                                            <button type="submit" class="text-white/60 h-5 "><i class="cursor-pointer fa-solid fa-trash-can"></i></button>
                                        </form>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <?php endif ?>

            <div id="profileOfCommunity" class="hidden">
                <h1>salut</h1>
            </div>

            <div id="follow" class="hidden">
                <h1 class="p-4 b-w-b text-5xl font-bold">Liste des follow</h1>
                <?php foreach($followOfUser as $follow): ?>
                    <div class="flex p-4 b-w-b space-x-2">
                        <div class="h-16 w-16">
                            <?php if($follow["picture"]): ?>
                            <img class="object-cover h-full w-full rounded-full" src="./assets/db_logo/<?php echo($follow["picture"]) ?>" alt="">
                            <?php else: ?>
                            <img class="object-cover h-full w-full rounded-full" src="./assets/img/user.png" alt="">
                            <?php endif ?>
                        </div>
                        <div class=" flex-1">
                            <h1><?php echo($follow["firstname"] . " " . $follow["lastname"] ) ?></h1>
                            <h1 class="text-gray-400">@<?php echo($follow["username"]) ?></h1>
                            <h1 class=""><?php echo($follow["biography"]) ?></h1>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div id="followed" class="hidden">
            <h1 class="p-4 b-w-b text-5xl font-bold">Liste des followers</h1>
            <?php foreach($userFollow as $follow): ?>
                <div class="flex p-4 space-x-2">
                    <div class="h-16 w-16">
                        <img class="object-cover h-full w-full rounded-full" src="./assets/db_logo/<?php echo($follow["picture"]) ?>" alt="">
                    </div>
                    <div>
                        <h1><?php echo($follow["firstname"] . " " . $follow["lastname"] ) ?></h1>
                        <h1 class="text-gray-400">@<?php echo($follow["username"]) ?></h1>
                        <h1 class=""><?php echo($follow["biography"]) ?></h1>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>


        </main>
        <?php
            /**
             * 
             * 
             * 
             * 
             * 
                3rd bar
            */
        ?>
       <div class="w-1/6 b-w-l">
            <div class="flex px-4 py-2 rounded-full space-x-1 items-center b-w m-4">
                <div class="flex w-full items-center space-x-1">
                    <button type="submit"><svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1tjplnt r-1bwzh9t r-10ptun7 r-2dysd3 r-1janqcz"><g><path fill="#c2c2c2" d="M10.25 3.75c-3.59 0-6.5 2.91-6.5 6.5s2.91 6.5 6.5 6.5c1.795 0 3.419-.726 4.596-1.904 1.178-1.177 1.904-2.801 1.904-4.596 0-3.59-2.91-6.5-6.5-6.5zm-8.5 6.5c0-4.694 3.806-8.5 8.5-8.5s8.5 3.806 8.5 8.5c0 1.986-.682 3.815-1.824 5.262l4.781 4.781-1.414 1.414-4.781-4.781c-1.447 1.142-3.276 1.824-5.262 1.824-4.694 0-8.5-3.806-8.5-8.5z"></path></g></svg></button>
                    <input class="w-full search" placeholder="Search" type="text" name="search" id="search">
                </div>
            </div>
            <div id="searchResult" class="b-w space-y-1 m-2 p-2 hidden flex flex-col rounded-xl">
            </div>
            <div class="flex flex-col space-y-4 p-4">
                <span class="text-gray-500 font-bold text-2xl">Tendance à suivre</span>
                <span class="text-blue-500 font-bold text-xl mt-4">#Sport</span>
                <span class="text-blue-500 font-bold text-xl mt-4">#Politique</span>
                <span class="text-blue-500 font-bold text-xl mt-4">#Cuisine</span>
                <span class="text-blue-500 font-bold text-xl mt-4">#Mode</span>
                <span class="text-blue-500 font-bold text-xl mt-4">#Cinéma</span>
            </div>
        </div>
    </div>

</section>
<script src="./app.js"></script>

<script>
    // update every 300ms tweets
    $(document).ready(function(){

        setInterval(() => {
            $.ajax({
                url: "../ajax.php",
                type: "POST",
                data: {
                    nameForm: "updateTweet",
                },
            }).then(function(res){
                $("#alltweets").load("process/updateTweet.php")
            })
        }, 2000);

    })

</script>


<script>

    document.body.addEventListener("click", (e) => {
        if($(e.target).attr("id") == "search"){
            $("#searchResult")[0].innerHTML = "Aucun résultat"
            $("#searchResult")[0].classList.remove("hidden")
        }else{
            $("#searchResult")[0].classList.add("hidden")
        }
    })


    $(document).ready(function(){
        $("#search").on(("keyup"), () => {
            let input = $("#search").val()

            $.ajax({
                url: "../ajax.php",
                method: "POST",
                dataType: 'json',
                data: {
                    nameForm: "updateSearch",
                    data: {input:input}
                },
                success:function(data){
                    $("#searchResult")[0].innerHTML = "";
                    console.log(data)
                    if(data[0]){
                        data.slice(-5).forEach(element => {
                            console.log(element.username)
                            $("#searchResult")[0].innerHTML += '<a class="p-2 hover:bg-white/10 duration-50 rounded-xl" href="?user='+element.username+'">' + element.username + '</a>'
                        });
                    }else{
                        $("#searchResult")[0].innerHTML = "Aucun résultat"
                    }
                }
            })
        })

    })

</script>

<?php 
    if(isset($_GET["user"])){
        echo '<script>', 'swapVue("myaccount")', '</script>';
    }
?>
