<?php
require_once 'src/Auth/AuthService.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Commentaires</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
     <h1>Commentaires du produit</h1>  
    </br>
   
    <div id="comment-list">
    <?php if (is_array($commentaires)) :
            foreach ($commentaires as $commentaire) : ?>
            <div class="card mb-3">
                <div class="card-header">
                    <strong><?= $commentaire->getId(); ?></strong>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $commentaire->getContenu(); ?></p>
                    <small class="text-muted"><?php echo $commentaire->getDate(); ?></small>
                </div>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <ul id="comment-pagination"  class="pagination"></ul> 
</div>
       
        <?php if($authService->isClientLoggedIn()): ?>
            <div class="row mt-4">
                <div class="col-md-6">
                    <form action="ajouter_commentaire.php" method="post">
                        <input type="hidden" name="produitId" value="1">
                        <input type="hidden" name="clientId" value="<?php echo $clientId; ?>">
                        <div class="form-group">
                            <label for="contenu">Ajouter un commentaire :</label>
                            <textarea class="form-control" name="contenu" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="row mt-4">
                <div class="col-md-6">
                    <p>Vous devez être connecté pour ajouter un commentaire.</p>
                    <a href="templates/login.php" class="btn btn-primary">Se connecter</a>
                </div>
            </div>
        <?php endif; ?>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-md-6">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page - 1; ?>">Précédent</a></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php if ($i === $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page + 1; ?>">Suivant</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

