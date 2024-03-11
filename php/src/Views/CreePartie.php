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
    <title>Crée une partie</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'Header.php' ?>
    </header>
    <main class="m-5">
        <div>
            <form method="post" action="/creePartie">
                <div class="mb-3">
                    <label for="FormControlInput1NbJoueur" class="form-label">Nombre de joueurs : </label>
                    <input name="nbJoueur" type="number" class="form-control" id="FormControlInput1NbJoueur" max="10" min="2" placeholder="2" required>
                </div>
                <div class="mb-3">
                    <label for="FormControlInput1NbQuestion" class="form-label">Nombre de questions : </label>
                    <input name="nbQuestion" type="number" class="form-control" id="FormControlInput1NbQuestion" max="20" min="5" placeholder="5" required>
                </div>
                <div class="mb-3">
                    <label for="FormControlInput1Time" class="form-label">Temps de réponse : </label>
                    <select name="tempsReponse" class="form-select" aria-label="Default select example" id="FormControlInput1Time" required>
                        <option value="30">30sec</option>
                        <option value="60">1min</option>
                        <option value="90">1min 30sec</option>
                        <option value="120" selected>2min</option>
                        <option value="180">3min</option>
                        <option value="300">5min</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label for="FormControlInput1Categorie" class="form-label">Catégorie : </label>
                    <select name="categorie" class="form-select" aria-label="Default select example" id="FormControlInput1Categorie" required>
                        <?php
                        foreach ($args["categories"] as $categorie) {
                            if ($categorie->archiver == false) {
                                echo "<option value='" . $categorie->idCategorie . "'>" . $categorie->nom . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <button class="btn form-btn form-control bg-primary text-light" name="submit" value="creeParti">Crée la partie</button>
                </div>
            </form>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>