<?php
class Location {
    private $id;
    private $date_location;
    private $date_retour;
    private $client_id;

    public function __construct($id, $date_location, $date_retour, $client_id) {
        $this->id = $id;
        $this->date_location = $date_location;
        $this->date_retour = $date_retour;
        $this->client_id = $client_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getDateLocation() {
        return $this->date_location;
    }

    public function setDateLocation($date_location) {
        $this->date_location = $date_location;
    }

    public function getDateRetour() {
        return $this->date_retour;
    }

    public function setDateRetour($date_retour) {
        $this->date_retour = $date_retour;
    }

    public function getClientId() {
        return $this->client_id;
    }

    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }
}
?>
