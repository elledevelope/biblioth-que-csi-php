<?php
require './pdo.php';
include "header.php";



if (isset($_POST['connexion'])) {
    var_dump($_POST);

    $sql = "SELECT * FROM abonne WHERE email =:email";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        "email" => $_POST['email']
    ]);
    $abonne = $statement->fetch();
    var_dump($abonne);

    // statement for authentication
    if (password_verify($_POST['password'], $abonne['password'])) {
        header("Location: index.php");
        exit; 
    } else {
        echo "<p style='color:red;'>Email ou mdp incorrects.</p>";
    }
}



?>

<main style="width:60%; margin:auto; margin-top: 50px">

    <!------------- Form ---------------->
    <form action="" method="post">
        <fieldset>
            <h1>Connexion</h1>

            <!-- Email -->
            <div>
                <label class="form-label mt-4">Email :</label>
                <input name="email" type="text" class="form-control">
            </div>

            <!-- Password -->
            <div>
                <label class="form-label mt-4">Password :</label>
                <input name="password" type="password" class="form-control">
            </div>

            <!-- Btn -->
            <br>
            <button name="connexion" type="submit" class="btn btn-primary">Connexion</button>
        </fieldset>
    </form>
</main>