<?php
$dataVote = $args['tabDataPartie'];
?>
<!DOCTYPE html>
<!--
    Nom Prénom: Jenusiyan Parankirinathan
    Projet: Tu préfères
    Détail: Projet TPI 
    Date: 05.02.24
-->
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Review partie</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'Header.php' ?>
    </header>
    <main class="m-5">
        <?php
        for ($i=0; $i < count($args['tabDataPartie']); $i++) { 
            ?>
            <table class="table border border-secondary-emphasis rounded-5 table-striped">
                <tr>
                    <th>Tu Préfères ...</th>
                </tr>
                <tr>
                    <td><?= $dataVote[$i]->choix1 ?></td>
                </tr>
                <tr>
                    <td><?= $dataVote[$i]->choix2 ?></td>
                </tr>
            </table>
            <?php
        }
        ?>
        <div class="input-group mb-3" style="width: 300px;">
            <a class="btn btn-danger" href="/jeu/quitterPartie" style="width: 100%;">Quitter la partie</a>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>