<?php
namespace Client;

interface ClientRepositoryInterface {
    public function getClientByEmail($email);
}
?>
