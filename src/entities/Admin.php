<?php
class Admin {
    private int $id;
    private string $userName;
    private string $email;
    private string $password;
    private array $role;

    // Constructeur
    public function __construct($id, $userName, $email, $password, $role) {
        $this->id = $id;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    // Méthodes get
    public function getId() {
        return $this->id;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function addRole($role) {
        $this->role[] = $role;
    }

    public function getRole() {
        return $this->role;
    }
}