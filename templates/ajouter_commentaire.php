<?php
require_once __DIR__ . '/../config.php'; 
require_once __DIR__ . '/../src/Commentaire/CommentaireService.php';
require_once __DIR__ . '/../src/Commentaire/CommentaireRepository.php'; 
require_once __DIR__ . '/../src/Client/ClientRepository.php';
require_once __DIR__ . '/../src/Auth/AuthService.php';

use Client\ClientRepository;
use Commentaire\CommentaireService;
use Commentaire\CommentaireRepository;
use Auth\AuthService;

$commentaireRepository = new CommentaireRepository($db);
$clientRepository = new ClientRepository($db);
$authService = new AuthService($clientRepository);
$commentaireService = new CommentaireService($commentaireRepository, $clientRepository, $authService);

$produitId = $_POST['produitId'];
$clientId = $_POST['clientId'];
$contenu = $_POST['contenu'];

$commentaireService->createCommentaire($produitId, $clientId, $contenu);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un commentaire</title>
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Ajouter un commentaire</h1>
        <a href="logout.php">Se déconnecter</a>
        <form action="ajouter_commentaire.php" method="post">
            <input type="hidden" name="produitId" value="123">
            <input type="hidden" name="clientId" value="<?php echo $clientId; ?>">
            <div class="form-group">
                <label for="contenu">Contenu :</label>
                <textarea class="form-control" name="contenu" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#confirmationModal">Ajouter</button>
        </form>
    </div>
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Votre commentaire a été ajouté avec succès.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
      
            $('form').submit(function(event) {
            $('#confirmationModal').modal('show');
             document.getElementById('contenu').value = '';
            });
    
    </script>
</body>
</html>
