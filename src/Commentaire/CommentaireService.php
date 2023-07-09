<?php
namespace Commentaire;

use Commentaire\CommentaireRepository; 
use Client\ClientRepository;
use Client\Client;
use Auth\AuthInterface;
use Auth\AuthService;
use Commentaire\Commentaire;

require_once 'CommentaireServiceInterface.php';

class CommentaireService implements CommentaireServiceInterface {
    private $commentaireRepository;
    private $clientRepository;
    private $authService;

    public function __construct(
        CommentaireRepository $commentaireRepository,
        ClientRepository $clientRepository,
        AuthService $authService
    ) {
        $this->commentaireRepository = $commentaireRepository;
        $this->clientRepository = $clientRepository;
        $this->authService = $authService;
    }
    public function getCommentairesByProduit($produitId, $page, $limit) {
        $offset = ($page - 1) * $limit;
        return $this->commentaireRepository->getCommentairesByProduit($produitId,$page, $limit);
    }

    public function addCommentaire(Commentaire $commentaire) {
        $this->commentaireRepository->addCommentaire($commentaire);
    }    
    public function createCommentaire($produitId, $clientId, $contenu) {
        $date = date('Y-m-d H:i:s');
        $commentaire = new Commentaire(null, $produitId, $clientId, $contenu, $date);
        $this->commentaireRepository->addCommentaire($commentaire);
    }
    
}
?>
