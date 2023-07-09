<?php

namespace Commentaire;

use Commentaire\Commentaire;
require_once __DIR__ . '/Commentaire.php';
use Commentaire\CommentaireRepositoryInterface; 
require_once 'CommentaireRepositoryInterface.php';
class CommentaireRepository implements CommentaireRepositoryInterface {
   
    private $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function getCommentairesByProduit($produitId, $page, $limit) {
   
       // $offset = 1;
        // ($page - 1) * $limit;        
        $query = "SELECT * FROM commentaires WHERE produit_id = :produitId LIMIT :limit ";
        $stmt = $this->db->prepare($query);        
        $stmt->bindValue(':produitId', $produitId, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
       // $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);       
        $stmt->execute();  

        $commentaires = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $commentaire = new Commentaire(
                $row['id'],
                $row['produit_id'],
                $row['client_id'],
                $row['contenu'],
                $row['date']
            );
            $commentaires[] = $commentaire;
        }      
       
       return $commentaires;
    }

    public function countCommentairesByProduit($produitId) {
        $query = "SELECT COUNT(*) as count FROM commentaires WHERE produit_id = :produitId";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':produitId', $produitId, \PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['count'];
    }

    public function addCommentaire(Commentaire $commentaire) {
        $query = "INSERT INTO commentaires (produit_id, client_id, contenu, date) VALUES (:produitId, :clientId, :contenu, :date)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':produitId', $commentaire->getProduitId(), \PDO::PARAM_INT);
        $stmt->bindValue(':clientId', $commentaire->getClientId(), \PDO::PARAM_INT);
        $stmt->bindValue(':contenu', $commentaire->getContenu(), \PDO::PARAM_STR);
        $stmt->bindValue(':date', $commentaire->getDate(), \PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>
