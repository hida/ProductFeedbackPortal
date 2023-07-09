<?php

namespace Commentaire;

class Commentaire {
    private $id;
    private $produitId;
    private $clientId;
    private $contenu;
    private $date;

    public function __construct($id, $produitId, $clientId, $contenu, $date) {
        $this->id = $id;
        $this->produitId = $produitId;
        $this->clientId = $clientId;
        $this->contenu = $contenu;
        $this->date = $date;
    }

    public function getId() {
        return $this->id;
    }

    public function getProduitId() {
        return $this->produitId;
    }

    public function getClientId() {
        return $this->clientId;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getDate() {
        return $this->date;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setProduitId($produitId) {
        $this->produitId = $produitId;
    }

    public function setClientId($clientId) {
        $this->clientId = $clientId;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function setDate($date) {
        $this->date = $date;
    }
}
