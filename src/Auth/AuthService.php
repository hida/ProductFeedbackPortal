<?php
namespace Auth;

use Client\ClientRepositoryInterface;


use Auth\AuthInterface; 
require_once 'AuthInterface.php';

class AuthService implements AuthInterface {
    private $clientRepository;
 
    public function __construct(ClientRepositoryInterface $clientRepository) {
        $this->clientRepository = $clientRepository;        
        @ob_start();
        session_start(); 
    }
    
    public function isClientLoggedIn() {
        return isset($_SESSION['client_id']);
    }
    
    public function isClientAuthenticated($email, $motDePasse) {
        $client = $this->clientRepository->getClientByEmail($email);
        
        if ($client && password_verify($motDePasse, $client->getMotDePasse())) {
            return true;
        } else {
            return false;
        }
    }

    public function loginClient($clientId) {
        $_SESSION['client_id'] = $clientId;
    }

    public function logoutClient() {
        unset($_SESSION['client_id']);
    }
}
