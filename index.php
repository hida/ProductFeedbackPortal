<?php
require_once 'config.php';
require_once 'src/Commentaire/CommentaireServiceInterface.php';
require_once 'src/Commentaire/CommentaireService.php';
require_once 'src/Commentaire/CommentaireRepositoryInterface.php';
require_once 'src/Commentaire/CommentaireRepository.php';
require_once 'src/Client/ClientRepositoryInterface.php';
require_once 'src/Client/ClientRepository.php';
require_once 'src/Auth/AuthInterface.php';
require_once 'src/Auth/AuthService.php';
require_once 'src/Pagination.php';
require_once 'autoloader.php';
// Connexion à la base de données

Autoloader::register();

$host = 'productfeedbackportal-db-1';
$db_name = 'productfeedbackportal';
$username = 'root';
$password = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

session_start();
$authService = new Auth\AuthService(new Client\ClientRepository($db));
$commentaireRepository = new Commentaire\CommentaireRepository($db);
$clientRepository = new Client\ClientRepository($db);
$commentaireService = new Commentaire\CommentaireService($commentaireRepository, $clientRepository, $authService);
$pagination = new Pagination();

$produitId = 1;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;

$commentaires = $commentaireService->getCommentairesByProduit($produitId, $page, $limit);

$totalPages = $pagination->getTotalPages($commentaireRepository->countCommentairesByProduit($produitId), $limit);

require 'templates/commentaires.php';


?>
