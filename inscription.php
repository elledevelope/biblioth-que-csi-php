<!-- formulaire d’inscription :
 nom, prenom, date de naissance, mobile, address -->

<?php
include "header.php";

$motdepass = "azerty";
$hash = password_hash($motdepass, PASSWORD_DEFAULT);
// var_dump($hash);



if (isset($_POST['connexion'])) {
    if (password_verify($_POST['mdp'], $hash)) {
        echo " <div class='alert alert-info'>Hello, <strong> " . $_POST['email'] . "</strong> </div>";
?>
        <a href="inscription.php?flag=true">Déconnexion</a>
<?php
    } else {
        echo "mdp incorrect";
    }
}
?>

<main style="margin:auto; margin-top: 50px">

    <!------------- Form ---------------->
    <form action="" method="post" style="padding-bottom: 60px;">
        <fieldset>
            <h1>Inscription</h1>

            <!-- Prénom -->
            <div>
                <label class="form-label mt-4">Prénom :</label>
                <input name="prenom" type="text" class="form-control">
            </div>

            <!-- Date de naissance -->
            <div>
                <label class="form-label mt-4">Date de naissance :</label>
                <input name="dateDeNaissance" type="date" class="form-control">
            </div>

            <!-- Tel.mobile -->
            <div>
                <label class="form-label mt-4">Tel.mobile :</label>
                <input name="mobile" type="text" class="form-control">
            </div>

            <!-- Address -->
            <div>
                <label class="form-label mt-4">Address :</label>
                <input name="address" type="text" class="form-control">
            </div>


            <!-- Email -->
            <div>
                <label class="form-label mt-4">Email :</label>
                <input name="email" type="text" class="form-control">
            </div>

            <!-- Password -->
            <div>
                <label class="form-label mt-4">Password :</label>
                <input name="mdp" type="password" class="form-control">
            </div>

            <!-- Btn -->
            <br>
            <button name="connexion" type="submit" class="btn btn-primary">S'inscrire</button>
        </fieldset>
    </form>
</main>
<?php include "footer.php"   ?>
