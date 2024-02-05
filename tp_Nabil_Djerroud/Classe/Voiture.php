<?php
class Voiture {
    private $id;
    private $marque;
    private $modele;
    private $annee;
    private $prix_location;

    public function __construct($id, $marque, $modele, $annee, $prix_location) {
        $this->id = $id;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->annee = $annee;
        $this->prix_location = $prix_location;
    }

    public function getId() {
        return $this->id;
    }

    public function getMarque() {
        return $this->marque;
    }

    public function getModele() {
        return $this->modele;
    }

    public function getAnnee() {
        return $this->annee;
    }

    public function getPrixLocation() {
        return $this->prix_location;
    }

    public function setMarque($marque) {
        $this->marque = $marque;
    }

    public function setModele($modele) {
        $this->modele = $modele;
    }

    public function setAnnee($annee) {
        $this->annee = $annee;
    }

    public function setPrixLocation($prix_location) {
        $this->prix_location = $prix_location;
    }
}
?>
