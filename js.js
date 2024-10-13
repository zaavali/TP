document.querySelector('form').addEventListener('submit', function (e) {
    const numeroCompte = document.getElementById('numeroCompte').value;
    const solde = document.getElementById('solde').value;
    const typeDeCompte = document.getElementById('typeDeCompte').value;
    const mdp = document.getElementById('mdp').value;

    if (numeroCompte.length < 5 || numeroCompte.length > 15) {
        alert('Le numéro de compte doit contenir entre 5 et 15 caractères.');
        e.preventDefault();
    }

    if (solde < 10 || solde > 2000) {
        alert('Le solde doit être compris entre 10 et 2000.');
        e.preventDefault();
    }

    if (!['courant', 'epargne', 'entreprise'].includes(typeDeCompte)) {
        alert('Le type de compte doit être courant, épargne ou entreprise.');
        e.preventDefault();
    }

    if (mdp.includes(' ')) {
        alert('Le mot de passe ne doit pas contenir d\'espace.');
        e.preventDefault();
    }
});
