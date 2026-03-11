<?php
$annuaire[]="Sophie";
$annuaire[]="Solal";
$annuaire[]="Louna";
$motDePasseAdmin="Tyrolium2026";
$ageMinimum=18;
function afficherBadge($nom, $statut){
    echo "Badge generé ".$nom." statut: ".$statut."<br>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['prenom'];
    $statut = $_POST['statut'];
    $age = $_POST['age'];
    $codeSaisi=$_POST["code"];
    }
if (isset($nom)){
    if ($age < $ageMinimum || $statut == "stagiaire") {
        echo "<p style='color:red;'>Erreur : Accès non autorisé pour ce profil.</p>";
    }
    elseif ($age >= $ageMinimum && $codeSaisi == $motDePasseAdmin) {
        // Ajout au tableau
        $annuaire[] = $nom;
        // Affichage du message et appel de la fonction
        echo "<strong>Bienvenue, " . htmlspecialchars($nom) . " a été ajouté !</strong><br>";
        afficherBadge($nom, $statut);
    }

    else {
        echo "<p style='color:red;'>Erreur : Mot de passe administrateur incorrect.</p>";
    }
}
?>
<form action="evaluation.php" method="post">
    <label>Your Name:</label>
    <input name="prenom" id="prenom" type="text" required /><br>
    <label>Your Age:</label>
    <input name="age" id="age" type="number" required /><br>
    <label>Your Password:</label>
    <input name="code" id="code" type="text" required /><br>
    <label for="statut-select">Choisir un statut :</label>

    <select name="statut" id="statut-select" required>
        <option value="">--Veuillez choisir une option--</option>
        <option value="stagiaire">Stagiaire</option>
        <option value="employe">Employé</option>
    </select>
    <br>
    <button type="submit">Ajouter au répertoire</button>
</form>


<H3>Annuaire de l'entreprise </H3>
<?php
foreach ($annuaire as $employe) {
    afficherBadge($employe, "Employé");
}

echo "<br>";
for ($i = 0; $i < 3; $i++) {
    echo " Emplacement bureau vide disponible...<br>";
}

echo "<br>";
$chargement = 0;
while ($chargement < 2) {
    echo " Synchronisation de la base de données...<br>";
    $chargement++; // Incrémentation indispensable pour éviter la boucle infinie
}
?>
</body>
</html>