<!--  dashboard -->

<?php require './pdo.php';

try {
    $sql = "SELECT * FROM livre ORDER BY id_livre DESC";
    $statement = $pdo->query($sql);
    $livres = $statement->fetchAll();
    // var_dump($livre);

} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<?php include "header.php" ?>
<main>
    <h1>Livres dashboard </h1>



    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Auteur</th>
                <th scope="col">Titre</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $number = 1;
            foreach ($livres as $livre) { ?>
                <tr class="table-light">
                    <th scope="row"><?php echo $number++; ?></th>
                    <th><?php echo $livre['auteur'] ?></th>
                    <td><?php echo $livre['titre'] ?></td>        
                    <td>
                        <button style="margin-bottom:3px" name="envoyer" type="submit" class="btn btn-success">
                            <a style="color:white;" href="./update.php?id_livre=<?php echo $livre['id_livre'] ?>">Modifier</a>
                        </button>
                        <button name="envoyer" type="submit" class="btn btn-primary">
                            <a style="color:white;" href="./supprimer.php?id_livre=<?php echo $livre['id_livre'] ?>"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">Supprimer</a>
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tr>
    </table>

</main>

<?php include "footer.php"   ?>