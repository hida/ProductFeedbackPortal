<?php
namespace Commentaire;

use Client\Client;
use Commentaire\Commentaire;

interface CommentaireRepositoryInterface {
    public function getCommentairesByProduit($produitId, $page, $limit);
    public function countCommentairesByProduit($produitId);
    public function addCommentaire(Commentaire $commentaire);
}
?>
