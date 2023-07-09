<?php
namespace Client;

use PDO;
use Client\Client;
use Client\ClientRepositoryInterface;
require_once __DIR__ . '/Client.php';
require_once __DIR__ . '/ClientRepositoryInterface.php';


class ClientRepository implements ClientRepositoryInterface {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getClientByEmail($email) {
        $query = "SELECT * FROM clients WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);      
        if ($row) {
            $client = new Client($row['id'], $row['nom'], $row['email'], $row['motDePasse']);
            return $client;
        } else {
            return null;
        }
    }
}
