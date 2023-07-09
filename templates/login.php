<?php
require_once __DIR__ . '/../src/Auth/AuthInterface.php';
require_once __DIR__ . '/../src/Auth/AuthService.php';
require_once __DIR__ . '/../src/Client/ClientRepositoryInterface.php';
require_once __DIR__ . '/../src/Client/ClientRepository.php';
require_once __DIR__ . '/../config.php'; 

use Auth\AuthService;
use Client\ClientRepository;

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

$authService = new AuthService(new ClientRepository($db));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse']; 
 
    if ($authService->isClientAuthenticated($email, $motDePasse)) {       
    header('Location: templates/ajouter_commentaire.php');
    exit();    
    }else {       
        $_SESSION['error_message'] = "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 40px 0;
        }

        form {
            width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Connexion</h1>
    <form action="login.php" method="post">
        <label for="email">Email :</label>
        <input type="text" name="email" required>
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" name="motDePasse" required>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
