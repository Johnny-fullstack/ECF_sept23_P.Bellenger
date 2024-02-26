<?php
class User {
    private int $id;
    private string $genre;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $mdp;
    private int $def_nbpers;
    private string $allergies;
    private array $role;

    // Constructeur
    public function __construct(int $id, string $genre , string $nom, string $prenom, string $email, string $mdp, string $def_nbpers, string $allergies, array $role) {
        $this->id = $id;
        $this->genre = $genre;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
        $this->def_nbpers = $def_nbpers;
        $this->allergies = $allergies;
        $this->role = $role;
    }

    // Méthodes get
    public function getId() :int
    {
        return $this->id;
    }

    public function getGenre() :string
    {
        return $this->genre;
    }

    public function getNom() :string
    {
        return $this->nom;
    }

    public function getPrenom() :string
    {
        return $this->prenom;
    }

    public function getEmail() :string
    {
        return $this->email;
    }

    public function getMdp() :string
    {
        return $this->mdp;
    }

    public function getDef_Nbpers() :string
    {
        return $this->def_nbpers;
    }

    public function getAllergies() :string
    {
        return $this->allergies;
    }

    public function addRole($role) 
    {
        $this->role[] = $role;
    }

    public function getRole() :array
    {
        return $this->role;
    }
}