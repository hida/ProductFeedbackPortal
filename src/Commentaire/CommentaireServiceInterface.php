<?php
namespace Commentaire;

use Client\Client;
use Commentaire\Commentaire;

interface CommentaireServiceInterface {
    public function getCommentairesByProduit($produitId, $page, $limit);
    public function addCommentaire(Commentaire $commentaire);
  
}
?>
