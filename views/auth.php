<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/fontImport.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styleAuth.css">
    <link rel="shortcut icon" href="assets/logo.svg" type="image/x-icon">
    <title>TimeHub : Connectez-vous</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/logo.svg" alt="logo">
        </div>
    </header>
    <main>
        <div class="image">
            <img src="assets/fond.jpeg" alt="fond">
        </div>
        <div class="form">
            <form action="../modeles/gestAuth.php" method="post">
                <h3>Login</h3>
                <?php if(isset($_GET['error']) && $_GET['error'] == 1) : ?>
                    <p class="text-alert">Login ou Mot de passe Incorrect</p>
                <?php endif; ?>
                <label for="login">Login</label><input type="text" id="login" name="login" required><br>
                <label for="password">Password</label><input type="password" id="password" name="password" required><br>
                <button type="submit">Se connecter</button>
                <h4>OU</h4>
                <a href="insc.php"><button type="button" class="btn-insc">Inscription Etudiant</button></a>
            </form>
        </div>
    </main>
</body>