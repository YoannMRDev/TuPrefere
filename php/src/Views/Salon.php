<?php
$groupeInfo = $args['groupeInfo'];
$utilisateursGroupe = $args['utilisateursGroupe'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Home</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'Header.php' ?>
    </header>
    <main class="m-5">
        <h1 class="mb-3">Salon</h1>
        <div class="input-group mb-5" style="width: 300px">
            <input type="text" class="form-control" aria-describedby="button-addon2" id="input2" value="<?= $groupeInfo[0]->code ?>" readonly>
            <button class="btn btn-outline-secondary bg-primary d-flex justify-content-center align-items-center" type="button" id="button-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy text-white" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                </svg></button>
        </div>
        <div class="input-group mb-5" style="width: 300px;">
            <h5 class="text-secondary">Information sur la partie</h5>
            <table class="table border rounded-5">
                <tr>
                    <th>Nombre de joueur</th>
                    <td><?= $groupeInfo[0]->nbJoueur ?></td>
                </tr>
                <tr>
                    <th>Nombre de question</th>
                    <td><?= $groupeInfo[0]->nbQuestion ?></td>
                </tr>
                <tr>
                    <th>Temps de réponse</th>
                    <td><?= $groupeInfo[0]->tempsReponse / 60 ?>min</td>
                </tr>
                <tr>
                    <th>Thème</th>
                    <td><?= $groupeInfo[0]->nom ?></td>
                </tr>
            </table>
        </div>
        <div class="input-group mb-3" style="width: 300px;">
            <h5 class="text-secondary">Liste des joueurs en ligne</h5>
            <table class="table border rounded-5">
                <tr>
                    <th>N°</th>
                    <th>Joueur</th>
                </tr>
                <?php
                for ($i = 0; $i < $groupeInfo[0]->nbJoueur; $i++) {
                ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= key_exists($i, $utilisateursGroupe) ? $utilisateursGroupe[$i]->pseudo : "" ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    // Fonction pour copier la valeur du champ texte dans le presse-papiers
    function copyToClipboard(inputId) {
        // Sélectionne le champ texte
        var input = document.getElementById(inputId);
        // Sélectionne le texte dans le champ texte
        input.select();
        // Copie le texte sélectionné dans le presse-papiers
        document.execCommand("copy");
    }

    // Ajoute un gestionnaire d'événements pour le deuxième bouton
    document.getElementById("button-addon2").addEventListener("click", function() {
        copyToClipboard("input2");
    });
</script>

</html>