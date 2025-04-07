<?php

require_once("../app.php");

?>


<section id="register" class="h-screen">
    <div class="flex items-center justify-center h-full dark:bg-slate-950 dark:text-white">
        <div id="formRegister" class="shadow-1 b-w bg-white/2 rounded px-12 py-8 space-y-2">
            <div class="flex flex-col items-center space-y-1">
                <h1 class="text-4xl font-bold">INSCRIPTION</h1>
                <p class="dark:text-slate-600 italic">Rejoignez la communauté !</p>
            </div>
            <div>
                <div class="flex space-x-4">
                    <div class="flex flex-col">
                        <label class="text-xl" for="firstname">Prénom</label>
                        <input class="bg-black/4 b-w p-2 my-2 rounded" type="text" placeholder="prénom" name="firstname" id="firstname">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xl" for="lastname">Nom</label>
                        <input class="bg-black/4 b-w p-2 my-2 rounded" type="text" placeholder="nom" name="lastname" id="lastname">
                    </div>
                </div>
                <div class="flex space-x-4">
                    <div class="flex flex-col">
                        <label class="text-xl" for="username">Pseudo</label>
                        <input class="bg-black/4 b-w p-2 my-2 rounded" type="text" placeholder="pseudo" name="username" id="username">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-xl" for="email">Email</label>
                        <input class="bg-black/4 b-w p-2 my-2 rounded" type="email" placeholder="example@gmail.com" name="email" id="email">
                    </div>
                </div>
                <div class="flex space-x-4">
                    <div class="flex flex-col">
                        <label class="text-xl" for="password">Password</label>
                        <input class="bg-black/4 b-w p-2 my-2 rounded" type="password" placeholder="********" name="password" id="password">
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="text-xl" for="genre">Genre</label>
                        <select name="genre" id="genre" class="b-w p-2 my-2 rounded">
                            <option class="bg-slate-950" value="Homme">Homme</option>
                            <option class="bg-slate-950" value="Femme">Femme</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label class="text-2xl" for="birthdate">Date de naissance</label>
                    <input class="bg-black/4 b-w p-2 my-2 rounded" type="date" name="birthdate" id="birthdate">
                </div>
                <input class="bg-black/30 w-full cursor-pointer uppercase p-2 my-6 font-semibold b-w rounded" type="submit" id="submitRegisterForm" value="s'inscrire">
            </div>
            <div class="flex flex-col items-center">
                <p class="italic" id="res"></p>
            </div>
            <div class="flex flex-col items-center space-y-1">
                <h1>Vous avez déjà un compte ? <a href="/pages/login.php" class="underline text-blue-600">Connexion</span></h1>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $("#submitRegisterForm").on("click", function() {
            $.ajax({
                url: "../ajax.php",
                type: "POST",
                data: {
                    nameForm: "submitRegisterForm",
                    firstname: $("#firstname").val(),
                    lastname: $("#lastname").val(),
                    username: $("#username").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    birthdate: $("#birthdate").val(),
                    genre: $("#genre").val(),
                },
            }).then(function(res){
                $("#res").html(res);
            })
        })
    })

</script>
