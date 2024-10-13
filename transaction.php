<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=bancaire', 'root', '');


$clientId = $_SESSION['clientId'];


$stmt = $pdo->prepare("SELECT compteId, solde FROM comptebancaire WHERE clientId = ?");
$stmt->execute([$clientId]);
$compte = $stmt->fetch();


if (!$compte) {
    echo "Erreur : Aucun compte trouvé pour ce client.";
    exit;
}

$compteId = $compte['compteId'];
$soldeActuel = $compte['solde'];

$type = $_POST['type'];
$montant = (float)$_POST['montant'];


if ($type === 'depot') {
    $nouveauSolde = $soldeActuel + $montant;
}

elseif ($type === 'retrait') {
    if ($montant > $soldeActuel) {
        echo "Erreur : Fonds insuffisants.";
        exit;
    }
    $nouveauSolde = $soldeActuel - $montant;
}

elseif ($type === 'virement') {
    $destinataireId = $_POST['compte']; 

    if ($montant > $soldeActuel) {
        echo "Erreur : Fonds insuffisants pour effectuer le virement.";
        exit;
    }

    $nouveauSolde = $soldeActuel - $montant;

    $stmt = $pdo->prepare("UPDATE comptebancaire SET solde = solde + ? WHERE compteId = ?");
    $stmt->execute([$montant, $destinataireId]);
}


$stmt = $pdo->prepare("UPDATE comptebancaire SET solde = ? WHERE compteId = ?");
$stmt->execute([$nouveauSolde, $compteId]);

echo "Transaction réussie !";
header('Location: interface.php'); 
exit;
?>
