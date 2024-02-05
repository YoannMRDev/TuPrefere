<?php
$mode = $args["login"];
$error = $args["error"];
$msgError = $args["msgError"];
?>
<!DOCTYPE html>
<html lang="fr">
<!--
    Nom Prénom: Jenusiyan Parankirinathan
    Projet: Tu préfères
    Détail: Projet TPI 
    Date: 05.02.24
-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Login</title>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">
    <h1 class="text-center bg-light mt-5">
        Bienvenue sur <br><strong>Tu Préfères</strong>
    </h1>
    <main class="m-5">
        <table class="table table-striped table-hover table-bordered">
            <?php
            if ($error) {
            ?>
                <tr>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-exclamation-triangle-fill"></i><?= $msgError ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </tr>
            <?php
            }
            ?>
            <tr>
                <th class="text-center bg-dark text-light">
                    <h1>Login</h1>
                </th>
            </tr>
            <tr>
                <td>
                    <form method="post" action="<?= $mode ? "/" : "/login/add" ?>">
                        <?php
                        if (!$mode) {
                        ?>
                            <div class="mb-3">
                                <label for="exampleInputPseudo1" class="form-label">Pseudo</label>
                                <input name="pseudo" type="text" class="form-control" id="exampleInputPseudo1" aria-describedby="pseudoHelp">
                                <div id="exampleInputPseudo1" class="form-text"></div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="jenusiyan2005@gmail.com">
                            <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre email avec quelqu’un d’autre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                            <input name="mdp" type="password" class="form-control" id="exampleInputPassword1" aria-describedby="exampleInputPassword1" value="Super2019">
                            <div id="exampleInputPassword1" class="form-text">8 caractères minimum.</div>
                        </div>
                        <?php
                        if (!$mode) {
                        ?>
                            <div class="mb-3">
                                <label for="exampleInputPassword2" class="form-label">Confirmer mot de passe</label>
                                <input name="mdpConfirmation" type="password" class="form-control" id="exampleInputPassword2" aria-describedby="exampleInputPassword2">
                                <div id="exampleInputPassword2" class="form-text">8 caractères minimum.</div>
                            </div>
                        <?php
                        }
                        ?>
                        <button type="submit" class="btn btn-primary"><?= $mode ? "Me connecter" : "S'inscrire" ?></i></button>
                        <a href="<?= $mode ? "/login/add" : "/" ?>" class="ms-5 text-decoration-none"><?= $mode ? "S'inscrire ?" : "Me connecter ?" ?></a>
                    </form>
                </td>
            </tr>
        </table>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>