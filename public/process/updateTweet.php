<?php

    session_start();
    use App\Tweet;
    use App\User;
    use App\Auth;
    require_once("../app.php");


    $tweets = Tweet::getTweetsData();

?>
    <?php foreach($tweets as $tweet): ?>
        <?php 
            $verifFollower = User::verifFollower($tweet["id_user"], $_SESSION["user"]["id"]);
        ?>
        <div class="flex b-w-b p-2">
            <div class="min-w-12 min-h-12 w-12 h-12">
                <img class="rounded-full object-cover h-full w-full" src="./assets/db_logo/<?php echo($tweet["picture"]) ?>" alt="logo user">
            </div>
            <div class="grow px-4 py-2">
                <div class="flex justify-between space-x-2">
                    <div class="flex space-x-2">
                        <h1 class="font-bold"><?php echo($tweet["firstname"] . " " . $tweet["lastname"]) ?></h1>
                        <span onclick="window.location.href = '?user=<?php echo($tweet["username"]) ?>'" class="hover:underline cursor-pointer text-gray-400">@<?php echo($tweet["username"]) ?></span>
                    </div>
                    <div>
                        <?php if($tweet["id"] != $_SESSION["user"]["id"] && count($verifFollower) == 0): ?>
                        <div class=" cursor-pointer">
                            <input type="hidden" name="id_user" id="id_user" value="<?php echo($_SESSION["user"]["id"]) ?>">
                            <input type="hidden" name="id_user_followed" id="id_user_followed" value="<?php echo($tweet["id_user"]) ?>">
                            <button type="submit" name="submitFollow" id="submitFollow" class="duration-200 hover:bg-white/80 bg-white rounded-full text-black py-1 px-6 font-semibold">Follow</button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="">
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
                    <div id="submitRetweet" class="hover:bg-blue-400/20 duration-100 p-2 rounded-full cursor-pointer">
                        <input type="hidden" id="id_user_rt" name="id_user_rt" value="<?php echo($tweet["id_user"]) ?>">
                        <input type="hidden" id="tweet_id_rt" name="tweet_id_rt" value="<?php echo($tweet["tweet_id"]) ?>">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M4.5 3.88l4.432 4.14-1.364 1.46L5.5 7.55V16c0 1.1.896 2 2 2H13v2H7.5c-2.209 0-4-1.79-4-4V7.55L1.432 9.48.068 8.02 4.5 3.88zM16.5 6H11V4h5.5c2.209 0 4 1.79 4 4v8.45l2.068-1.93 1.364 1.46-4.432 4.14-4.432-4.14 1.364-1.46 2.068 1.93V8c0-1.1-.896-2-2-2z"></path></g></svg>
                    </div>
                    <div class="hover:bg-red-400/20 duration-100 p-2 rounded-full cursor-pointer">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M16.697 5.5c-1.222-.06-2.679.51-3.89 2.16l-.805 1.09-.806-1.09C9.984 6.01 8.526 5.44 7.304 5.5c-1.243.07-2.349.78-2.91 1.91-.552 1.12-.633 2.78.479 4.82 1.074 1.97 3.257 4.27 7.129 6.61 3.87-2.34 6.052-4.64 7.126-6.61 1.111-2.04 1.03-3.7.477-4.82-.561-1.13-1.666-1.84-2.908-1.91zm4.187 7.69c-1.351 2.48-4.001 5.12-8.379 7.67l-.503.3-.504-.3c-4.379-2.55-7.029-5.19-8.382-7.67-1.36-2.5-1.41-4.86-.514-6.67.887-1.79 2.647-2.91 4.601-3.01 1.651-.09 3.368.56 4.798 2.01 1.429-1.45 3.146-2.1 4.796-2.01 1.954.1 3.714 1.22 4.601 3.01.896 1.81.846 4.17-.514 6.67z"></path></g></svg>
                    </div>
                    <div class="hover:bg-yellow-400/20 duration-100 p-2 rounded-full cursor-pointer">
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-5 r-4qtqp9 r-yyyyoo r-dnmrzs r-bnwqim r-lrvibr r-m6rgpd r-1xvli5t r-1hdv0qi"><g><path fill="rgb(113, 118, 123)" d="M4 4.5C4 3.12 5.119 2 6.5 2h11C18.881 2 20 3.12 20 4.5v18.44l-8-5.71-8 5.71V4.5zM6.5 4c-.276 0-.5.22-.5.5v14.56l6-4.29 6 4.29V4.5c0-.28-.224-.5-.5-.5h-11z"></path></g></svg>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <h1><?php echo("<pre>"); print_r($tweet); echo("</pre>"); ?></h1>

<script>
    $(document).ready(function(){
        $("#submitFollow").on("click", function() {
            $.ajax({
                url: "../ajax.php",
                type: "POST",
                data: {
                    nameForm: "submitFollow",
                    id_user: $("#id_user").val(),
                    id_user_followed: $("#id_user_followed").val(),
                },
            }).then(function(res){
                console.log(res)
            })
        })

    })


    $(document).ready(function(){
        $("#submitRetweet").on("click", function() {
            $.ajax({
                url: "../ajax.php",
                type: "POST",
                data: {
                    nameForm: "submitRetweet",
                    id_user_rt: $("#id_user_rt").val(),
                    tweet_id_rt: $("#tweet_id_rt").val(),
                },
            }).then(function(res){
                console.log(res)
            })
        })

    })
</script>