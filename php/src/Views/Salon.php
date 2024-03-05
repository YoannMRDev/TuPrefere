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
            <input type="text" class="form-control" aria-describedby="button-addon2" id="input2" value="<?= end($groupeInfo)->code ?>" readonly>
            <button class="btn btn-outline-secondary bg-primary d-flex justify-content-center align-items-center" type="button" id="button-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy text-white" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                </svg></button>
        </div>
        <div class="input-group mb-5" style="width: 300px;">
            <h5 class="text-secondary">Information sur la partie</h5>
            <table class="table border border-secondary-emphasis rounded-5" id="salon-info">
                <!-- Informations sur la partie -->
            </table>
        </div>
        <div class="input-group mb-3" style="width: 300px;">
            <h5 class="text-secondary">Liste des joueurs en ligne</h5>
            <table class="table border border-secondary-emphasis rounded-5">
                <tbody id="user-list">
                    <!-- Tableau pour afficher la liste des joueurs -->
                </tbody>
            </table>
        </div>
        <div class="input-group mb-3" style="width: 300px;">
            <button class="btn btn-danger" id="leave-salon-btn" style="width: 100%;">Quitter le salon</button>
        </div>
        <?php
        if ($_SESSION['idUtilisateur'] == end($groupeInfo)->maitre) {
        ?>
            <div class="input-group mb-3" style="width: 300px;">
                <a class="btn btn-success" id="leave-salon-btn" style="width: 100%;" href="/jeu">Lancer la partie</a>
            </div>
        <?php
        }
        ?>
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

    function updateSalonInfo() {
        fetch('/salon/data')
            .then(response => response.json())
            .then(data => {
                const userList = document.getElementById('user-list');
                const salonInfo = document.getElementById('salon-info');

                // Mise à jour des informations sur la partie
                salonInfo.innerHTML = `
                <tr>
                    <th>Nombre de joueur</th>
                    <td>${data.groupeInfo[data.groupeInfo.length - 1].nbJoueur}</td>
                </tr>
                <tr>
                    <th>Nombre de question</th>
                    <td>${data.groupeInfo[data.groupeInfo.length - 1].nbQuestion}</td>
                </tr>
                <tr>
                    <th>Temps de réponse</th>
                    <td>${data.groupeInfo[data.groupeInfo.length - 1].tempsReponse / 60}min</td>
                </tr>
                <tr>
                    <th>Thème</th>
                    <td>${data.groupeInfo[data.groupeInfo.length - 1].nom}</td>
                </tr>
            `;

                // Mise à jour de la liste des joueurs en ligne
                userList.innerHTML = '';
                data.utilisateursGroupe.forEach((utilisateur, index) => {
                    userList.innerHTML += `
                        <tr>
                            <th>${index + 1}</th>
                            <td>${utilisateur.pseudo}</td>
                        </tr>`;
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des données du salon:', error));

        // Vérifier si la partie a commencé
        fetch('/salon/commencer')
            .then(response => response.json())
            .then(data => {
                // alert(data.commencer);
                if (data.commencer) {
                    // Redirection vers la page de jeu
                    window.location.href = '/jeu';
                }
            })
            .catch(error => console.error('Erreur lors de la récupération de la valeur commencer:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateSalonInfo();
        setInterval(updateSalonInfo, 100);
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Nouvelle requête Fetch pour récupérer userId et groupId
        fetch('/salon/user-info')
            .then(response => response.json())
            .then(data => {
                const userId = data.userId;
                // const groupId = data.groupId;

                // Ensuite, effectuez la requête de suppression du salon en incluant ces valeurs
                document.getElementById('leave-salon-btn').addEventListener('click', function() {
                    fetch('/salon/leave', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                userId: userId,
                                // groupId: groupId
                            })
                        })
                        .then(response => {
                            if (response.ok) {
                                // Redirection vers une autre page ou affichage d'un message de succès
                                window.location.href = '/accueil'; // Redirection vers la page d'accueil
                            } else {
                                // Gérer les erreurs de suppression du salon
                                console.error('Erreur lors de la suppression de l\'utilisateur du salon');
                            }
                        })
                        .catch(error => console.error('Erreur lors de la requête de suppression du salon:', error));
                });
            })
            .catch(error => console.error('Erreur lors de la récupération des informations utilisateur et groupe:', error));

        updateSalonInfo();
        setInterval(updateSalonInfo, 2000);
    });
</script>

</html>