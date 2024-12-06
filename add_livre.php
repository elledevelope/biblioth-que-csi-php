<!--  formulaire d’ajour d'un livre (auteur et titre) -->

<?php require './pdo.php';
include "header.php";

@$auteur = strip_tags($_POST['auteur']);
@$titre = strip_tags($_POST['titre']);

$error = null;

// ----------------- Validation
if (isset($_POST["envoyer"])) {

    // Valider "auteur"
    if (empty($auteur)) {
        $error = "<li>L'auteur est obligatoire</li>";
    } elseif (strlen($auteur) < 2 || strlen($auteur) > 50) {
        $error = "<li>Votre saisie d'Auteur n'est pas conforme</li>";
    }

    // Valider "titre"
    if (empty($titre)) {
        $error .= "<li>Le titre est obligatoire</li>";
    } elseif (strlen($titre) < 2 || strlen($titre) > 250) {
        $error .= "<li>Votre saisie du Titre n'est pas conforme</li>";
    }

    // ----------------- Insertion into database
    if (empty($error)) {
        try {
            $sql = "INSERT INTO livre (auteur, titre) 
                        VALUES(:auteur, :titre)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                "auteur" => $auteur,
                "titre" => $titre
            ]);
            header("Location:livres.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>


<main>
    <h1>Ajouter un Livre</h1>
    <!-- Warning -->
    <?php if (!empty($error)) { ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Warning!</h4>
            <p class="mb-0">
                <?php echo $error; ?>
            </p>
        </div>
    <?php } ?>

    <!------------- Form ---------------->
    <form action="" method="post">

        <fieldset>

            <!-- Auteur -->
            <div>
                <label class="form-label mt-4">Auteur :</label>
                <input name="auteur" type="text" value="<?php echo @$_POST['auteur'] ?>" class="form-control" placeholder="Auteur du livre">
            </div>

            <!-- Titre -->
            <div>
                <label class="form-label mt-4">Titre :</label>
                <input name="titre" type="text" value="<?php echo @$_POST['titre'] ?>" class="form-control" placeholder="Titre du livre">
            </div>


            <!-- Btn -->
            <br>
            <button name="envoyer" type="submit" class="btn btn-primary">Ajouter</button>
        </fieldset>
    </form>
</main>

<?php include "footer.php"   ?>