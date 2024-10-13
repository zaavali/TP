<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=bancaire', 'root', '');


$clientId = $_SESSION['clientId'];


$stmt = $pdo->prepare("SELECT solde FROM comptebancaire WHERE clientId = ?");
$stmt->execute([$clientId]);
$compte = $stmt->fetch();
$solde = $compte['solde'];


$stmt = $pdo->prepare("SELECT clientId, nom FROM client WHERE clientId != ?");
$stmt->execute([$clientId]);
$comptesDisponibles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Interface Client Bancaire</title>
</head>
<body>
    <h1>Bienvenue, Client n°<?php echo $clientId; ?>!</h1>
    <h2>Votre solde actuel : <?php echo $solde; ?> €</h2>

    <h3>Dépôt d'argent</h3>
    <form action="transaction.php" method="POST">
        <input type="hidden" name="type" value="depot" >
        <label for="montant">Montant à déposer :</label>
        <input type="number" name="montant" required >
        <button type="submit" class="btn btn-success mt-3">Déposer</button>
    </form>

    
    <h3>Retrait d'argent</h3>
    <form action="transaction.php" method="POST">
        <input type="hidden" name="type" value="retrait">
        <label for="montant">Montant à retirer :</label>
        <input type="number" name="montant" required  >
        <button type="submit" class="btn btn-success mt-3">Retirer</button>
    </form>

    <h3>Effectuer un virement</h3>
    <form action="transaction.php" method="POST">
        <input type="hidden" name="type" value="virement" >
        <label for="montant">Montant à virer :</label>
        <input type="number" name="montant" required >

        <label for="compte">Compte destinataire :</label>
        <select name="compte" required>
            <?php foreach ($comptesDisponibles as $compte): ?>
                <option value="<?php echo $compte['clientId']; ?>">
                    <?php echo $compte['nom']; ?> (Client n°<?php echo $compte['clientId']; ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-success mt-3">Effectuer le virement</button>
    </form>
    
    <form action="index.php">
    <button type="submit" class="btn btn-success mt-3">Accueil</button>
</form>


    <script src="js.js"></script>
</body>
</html>
