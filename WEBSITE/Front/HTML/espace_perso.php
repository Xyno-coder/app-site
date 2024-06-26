<?php
session_start();
include 'header.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: connexion.php"); // Redirigez vers la page de connexion
    exit();
}

// Vérifiez si les variables de session sont définies
if (!isset($_SESSION['id'], $_SESSION['pseudo'], $_SESSION['email'], $_SESSION['mdp'])) {
    echo "Variables de session non définies.";
    exit();
}

$user_id = $_SESSION['id']; // Assurez-vous d'avoir la colonne d'identifiant utilisateur appropriée

// Connexion à la base de données en utilisant PDO
$servername = "db";
$username = "root";
$password = "";
$dbname = "espace_membres";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Récupérer les informations de l'utilisateur depuis la base de données
$sql = "SELECT pseudo, nom, date_naissance, email FROM users WHERE id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

if($stmt->rowCount() > 0) {
    // Récupérer les données de l'utilisateur
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $pseudo = $row['pseudo'];
    $nom = $row['nom'];
    $date_naissance = $row['date_naissance'];
    $email = $row['email'];
} else {
    echo "Utilisateur non trouvé.";
    exit();
}

// Traitement de la mise à jour des données de l'utilisateur
if(isset($_POST['submit'])) {
    // Récupérer les données envoyées par le formulaire
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $email = $_POST['email'];

    // Préparation de la requête SQL pour la mise à jour
    $sql_update = "UPDATE users SET pseudo = :pseudo, nom = :nom, date_naissance = :date_naissance, email = :email WHERE id = :user_id";
    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':user_id', $user_id);

    // Exécution de la requête
    try {
        $stmt->execute();
        echo "<p>Changements enregistrés avec succès.</p>";
    } catch(PDOException $e) {
        echo "Erreur lors de l'enregistrement des changements: " . $e->getMessage();
    }

    // Redirection
    header("Location: espace_personnel.php");
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
}

$conn = null; // Fermer la connexion à la base de données
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Personnel</title>
</head>
<body>
    <h2>Espace Personnel</h2>
    <?php
    // Afficher un message si des changements ont été enregistrés
    if(isset($_POST['submit'])) {
        echo "<p>Changements enregistrés avec succès.</p>";
    }
    ?>
    <form method="post" action="espace_personnel.php">
        <label for="pseudo">Pseudo:</label>
        <input type="text" id="pseudo" name="pseudo" value="<?php echo htmlspecialchars($pseudo); ?>">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
        <label for="date_naissance">Date de naissance:</label>
        <input type="date" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($date_naissance); ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <label for="old_password">Ancien mot de passe:</label>
        <input type="password" id="old_password" name="old_password">
        <label for="new_password">Nouveau mot de passe:</label>
        <input type="password" id="new_password" name="new_password">
        <button type="submit" name="submit">Enregistrer les changements</button>
    </form>
</body>
</html>
