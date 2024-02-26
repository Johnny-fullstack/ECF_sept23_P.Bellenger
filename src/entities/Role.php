<?php

class Role {
    private $id;
    private $name;


    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    // Méthodes get pour accéder aux propriétés
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
}
