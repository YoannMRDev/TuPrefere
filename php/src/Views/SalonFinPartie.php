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
    <title>Salon fin de partie</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'Header.php' ?>
    </header>
    <main class="m-5">
        <h1>En attendant que les autres joueurs terminent de répondre</h1>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    // Verifier si tous les joueurs ont répondu
    // Si oui rediriger vers la page de review
    // Si non rester sur cette page
    const interval = setInterval(() => {
        fetch('/jeu/getVerifierAllQuestionsRepondues')
            .then(response => response.json())
            .then(data => {
                console.log(data.allQuestionsRepondues);
                if (data.allQuestionsRepondues) {
                    clearInterval(interval);
                    window.location.href = '/jeu/reviewPartie';
                }else{
                    window.location.href = '/jeu/verifierAllQuestionsRepondues';
                }
            });
    }, 1000);
</script>
</html>