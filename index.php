<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de compte bancaire en ligne</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center">Bienvenue sur votre gestionnaire de compte bancaire</h1>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inscription</h4>
                        <p class="card-text">Créez un nouveau compte bancaire en vous inscrivant dès maintenant.</p>
                        <a href="ajouter.php" class="btn btn-success mt-3">S'inscrire</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Connexion</h4>
                        <p class="card-text">Accédez à votre compte bancaire en ligne.</p>
                        <a href="connexion.php" class="btn btn-success mt-3">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['client_id'])): ?>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Dépôts et Retraits</h4>
                        <p class="card-text">Effectuez des dépôts ou retraits directement depuis votre compte.</p>
                        <a href="operations.php" class="btn btn-success">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Virements</h4>
                        <p class="card-text">Réalisez des virements vers d'autres comptes bancaires.</p>
                        <a href="virement.php" class="btn btn-success">Accéder</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Consultation de solde</h4>
                        <p class="card-text">Consultez votre solde à tout moment.</p>
                        <a href="solde.php" class="btn btn-success">Accéder</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['client_id'])): ?>
        <div class="text-center mt-5">
            <a href="deconnexion.php" class="btn btn-danger">Se déconnecter</a>
        </div>
        <?php endif; ?>
    </div>

</body>
</html>
