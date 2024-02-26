<?php
// Vous pouvez utiliser le tableau des questions pour obtenir l'identifiant de chaque question
$questionIds = $args['questionIds'];
$questionCount = count($questionIds);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Jeu</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'Header.php' ?>
    </header>
    <main class="m-5 d-flex justify-content-center" style="width: 95%;">
        <div class="d-flex flex-column" style="width: 95%;">
            <span id="timer">Temps restant : XX secondes</span>

            <div id="questionContainer">
                <?php foreach ($questionIds as $index => $questionId) : ?>
                    <div class="question" id="question<?= $index ?>" style="display: none;">
                        <?php $question = \Core\Models\Question::read($questionId); ?>
                        <p class="fw-bold">Tu préfères ...</p>
                        <div class="d-flex flex-row align-items-center">
                            <button style="width: 30%; height: 100px;" class="btn btn-danger"><?= $question->choix1 ?></button>
                            <p class="fw-bold ms-3 me-3">ou</p>
                            <button style="width: 30%; height: 100px;" class="btn btn-success"><?= $question->choix2 ?></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    // Récupérez le temps de réponse en secondes depuis les données du groupe
    const tempsReponse = <?= $args['groupe'][0]->tempsReponse ?>;
    const questionCount = <?= $questionCount ?>;
    
    let questionIndex = 0;
    let tempsRestant = tempsReponse;
    const timerElement = document.getElementById('timer');

    function showQuestion(index) {
        // Masquer toutes les questions sauf celle avec l'index spécifié
        document.querySelectorAll('.question').forEach((question, i) => {
            if (i === index) {
                question.style.display = 'block';
            } else {
                question.style.display = 'none';
            }
        });
    }

    function updateTimer() {
        timerElement.textContent = `Temps restant : ${tempsRestant} secondes`;
        tempsRestant--;

        if (tempsRestant < 0) {
            // Si le temps est écoulé, passez à la question suivante
            questionIndex++;
            tempsRestant = tempsReponse;
            if (questionIndex < questionCount) {
                showQuestion(questionIndex);
            } else {
                // Toutes les questions ont été posées
                clearInterval(timerInterval);
                // Ajoutez ici le code pour terminer le jeu
                alert('Toutes les questions ont été posées!');
            }
        }
    }

    updateTimer();
    const timerInterval = setInterval(updateTimer, 1000);

    // Afficher la première question au chargement de la page
    showQuestion(questionIndex);
</script>

</html>
