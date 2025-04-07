<?php

require_once("../app.php");
session_start();

if(isset($_SESSION["user"])){
    header("Location: /");
}

?>

<section id="login" class="h-screen">
    <div class="flex items-center justify-center h-full dark:bg-slate-950 dark:text-white">
        <div id="formLogin" class="shadow-1 b-w bg-white/2 rounded px-12 py-8 space-y-2">
            <div class="flex flex-col items-center space-y-1">
                <h1 class="text-4xl font-bold">CONNEXION</h1>
                <p class="dark:text-slate-600 italic">Rejoignez la communauté !</p>
            </div>
            <div>
                <div class="flex space-x-4 ">
                    <div class="flex flex-col w-full">
                        <label class="text-xl" for="email">Email</label>
                        <input class="bg-black/4 b-w p-2 my-2 rounded" type="email" placeholder="example@gmail.com" name="email" id="email">
                    </div>
                </div>
                <div class="flex space-x-4">
                    <div class="flex flex-col w-full">
                        <label class="text-xl" for="password">Password</label>
                        <input class="bg-black/4 b-w p-2 my-2 rounded" type="password" placeholder="********" name="password" id="password">
                    </div>
                </div>
                <input class="bg-black/30 w-full cursor-pointer uppercase p-2 my-6 font-semibold b-w rounded" type="submit" id="submitLoginForm" value="connexion">
            </div>
            <div class="flex flex-col items-center">
                <p class="italic" id="res"></p>
            </div>
            <div class="flex flex-col items-center space-y-1">
                <h1>Vous n'avez pas encore de compte ? <a href="/pages/register.php" class="underline text-blue-600">Inscription</span></h1>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $("#submitLoginForm").on("click", function() {
            $.ajax({
                url: "../ajax.php",
                type: "POST",
                data: {
                    nameForm: "submitLoginForm",
                    email: $("#email").val(),
                    password: $("#password").val(),
                },
            }).then(function(res){
                $("#res").html(res);
            })
        })
    })
</script>