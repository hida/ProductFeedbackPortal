<?php
session_start();

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
  <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: rgb(187 187 187 / 53%) !important;">
                <h1 class="display-medium text-white mb-0" style="color: #3b4147 !important;">Ajouter un commentaire</h1>
                <div class="text-right">
                    <a href="../index.php" class="btn btn-outline-light" style="color: #3b4147;
    border-color: #3a5066;">Se déconnecter</a>
                </div>
            </div>
            <div class="card-body">
                <form action="ajouter_commentaire.php" method="post">
                    <input type="hidden" name="produitId" value="123">
                    <input type="hidden" name="clientId" value="<?php echo $clientId; ?>">
                    <div class="form-group">
                        <label for="contenu">Contenu :</label>
                        <textarea class="form-control" name="contenu" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary " data-toggle="modal" data-target="#confirmationModal">Ajouter</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Votre commentaire a été ajouté avec succès.</h5>
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
