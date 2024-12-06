<?php
include "header.php";
require "./pdo.php"; // Include your database connection file

@$prenom = strip_tags($_POST['prenom']);
@$dateDeNaissance = strip_tags($_POST['dateDeNaissance']);
@$email = strip_tags($_POST['email']);
@$password = strip_tags($_POST['password']);

$error = null;

function valideDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}


if (isset($_POST['connexion'])) {
    // Validation "prenom" 
    if (empty($prenom)) {
        $error .= "<li>Veuillez entrer un prénom</li>";
    } elseif (strlen($prenom) < 2 || strlen($prenom) > 50) {
        $error .= "<li>Veuillez entrer un prénom valide</li>";
    }

    // Validation "Date de naissance"
    if (empty($dateDeNaissance)) {
        $error .= "<li>Veuillez entrer une date de naissance</li>";
    } elseif (!valideDate($dateDeNaissance, 'Y-m-d')) {
        $error .= "<li>La date de naissance doit être au format YYYY-MM-DD et valide</li>";
    }


    // Validation "email" 
    if (empty($email)) {
        $error .= "<li>L'email est obligatoire</li>";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $error .= "<li>L'email n'est pas conforme</li>";
    }

    // Validation "password" 
    if (empty($password)) {
        $error .= "<li>Le mot de pass est obligatoire</li>";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }


    // ----------------- Insertion into database
    if (empty($error)) {
        try {
            $sql = "INSERT INTO abonne (prenom, date_de_naissance, email, password) 
                    VALUES(:prenom, :dateDeNaissance, :email, :password)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                "prenom" => $prenom,
                "dateDeNaissance" => $dateDeNaissance,
                "email" => $email,
                "password" => $hash
            ]);
            // echo "<div class='alert alert-success'>Inscription réussie !</div>";
            header("Location:index.php");
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Erreur lors de l'inscription : " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Veuillez remplir tous les champs.</div>";
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
                <input name="prenom" type="text" value="<?php echo @$_POST['prenom'] ?>" class="form-control" required>
            </div>

            <!-- Date de naissance -->
            <div>
                <label class="form-label mt-4">Date de naissance :</label>
                <input name="dateDeNaissance" type="date" value="<?php echo @$_POST['date_de_naissance'] ?>" class="form-control" required>
            </div>

            <!-- Email -->
            <div>
                <label class="form-label mt-4">Email :</label>
                <input name="email" type="email" value="<?php echo @$_POST['email'] ?>" class="form-control" required>
            </div>

            <!-- Password -->
            <div>
                <label class="form-label mt-4">Password :</label>
                <input name="password" type="password" class="form-control" required>
            </div>

            <!-- Btn -->
            <br>
            <button name="connexion" type="submit" class="btn btn-primary">S'inscrire</button>
        </fieldset>
    </form>
</main>
<?php include "footer.php"; ?>