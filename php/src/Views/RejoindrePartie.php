<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Rejoindre une partie</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <?php include 'Header.php' ?>
    </header>
    <main class="m-5">
        <div>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="FormControlInput1CodeRejoindrePartie" class="form-label">Code pour rejoindre une partie : </label>
                    <input name="codeRejoindrePartie" type="text" class="form-control" id="FormControlInput1CodeRejoindrePartie" placeholder="#46Yh78" required>
                </div>
                <div>
                    <button class="btn form-btn form-control bg-primary text-light" name="submit" value="rejoindrePartie">Rejoindre la partie</button>
                </div>
            </form>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>