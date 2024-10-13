<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO('mysql:host=localhost;dbname=bancaire', 'root', '');

   
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

  
    $stmt = $pdo->prepare("INSERT INTO client (nom, prenom, telephone, email, mdp) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $telephone, $email, $mdp]);

 
    $clientId = $pdo->lastInsertId();

    
    if (isset($_POST['numeroCompte'], $_POST['typeDeCompte'], $_POST['montantInitial'])) {
   
        $numeroCompte = $_POST['numeroCompte'];
        $typeDeCompte = $_POST['typeDeCompte'];
        $montantInitial = (float)$_POST['montantInitial'];
        $dateOuverture = date('Y-m-d');  

        $stmt = $pdo->prepare("INSERT INTO comptebancaire (numeroCompte, solde, typeDeCompte, dateOuverture, clientId) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$numeroCompte, $montantInitial, $typeDeCompte, $dateOuverture, $clientId]);

        echo "Inscription et création de compte réussies !";
    } else {
        echo "Erreur : informations du compte bancaire manquantes.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inscription Client</title>
</head>
<body>
    <h1>Formulaire d'Inscription</h1>
    <form action="ajouter.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required ><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required ><br>

        <label for="telephone">Téléphone :</label>
        <input type="text" name="telephone" required ><br>

        <label for="email">Email :</label>
        <input type="email" name="email" required ><br>

        <label for="mdp">Mot de passe :</label>
        <input type="password" name="mdp" required ><br>

        <h2>Création de Compte Bancaire</h2>
        <label for="numeroCompte">Numéro de compte :</label>
        <input type="text" name="numeroCompte" required ><br>

        <label for="typeDeCompte">Type de compte :</label>
        <select name="typeDeCompte" required>
            <option value="courant">Courant</option>
            <option value="epargne">Épargne</option>
            <option value="entreprise">Entreprise</option>
        </select><br>

        <label for="montantInitial">Montant initial :</label>
        <input type="number" name="montantInitial" min="10" required ><br>

        <button type="submit" class="btn btn-success mt-3">S'inscrire et créer un compte</button>

        
    </form>
    <form action="index.php">
    <button type="submit" class="btn btn-success mt-3">Accueil</button>
</form>
</body>
</html>
