<?php

class Resa 
{
    private int $resaId;
    private string $nom;
    private string $mail;
    private string $nbPers;
    private string $jour;
    private string $heureDej;
    private string $heureDin;
    private string $allergies;

    function __construct(int $resaId, string $nom, string $mail, string $nbPers, string $jour, string $heureDej, string $heureDin, string $allergies)
    {
        $this->resaId = $resaId;
        $this->nom = $nom;
        $this->mail = $mail;
        $this->nbPers = $nbPers;
        $this->jour = $jour;
        $this->heureDej = $heureDej;
        $this->heureDin = $heureDin;
        $this->allergies = $allergies;
    }


    function getResaId(): int
    {
        return $this->resaId;
    }

    function getNom(): string
    {
        return $this->nom;
    }

    function getMail(): string
    {
        return $this->mail;
    }

    function getNbPers(): string
    {
        return $this->nbPers;
    }

    function getJour(): string
    {
        return $this->jour;
    }

    function getHeureDej(): string
    {
        return $this->heureDej;
    }

    function getHeureDin(): string
    {
        return $this->heureDin;
    }

    function getAllergies(): string
    {
        return $this->allergies;
    }
}

class UserResa extends Resa
{
    private int $userId;

    function __construct(int $resaId, string $nom, string $mail, string $nbPers, string $jour, string $heureDej, string $heureDin, string $allergies, int $userId)
    {
        parent::__construct($resaId, $nom, $mail, $nbPers, $jour, $heureDej, $heureDin, $allergies);
        $this->userId = $userId;
    }

    function getUserId(): int
    {
        return $this->userId;
    }

    function getResaId(): int
    {
        return parent::getResaId();
    }

    function getNom(): string
    {
        return parent::getNom();
    }

    function getMail(): string
    {
        return parent::getMail();
    }

    function getNbPers(): string
    {
        return parent::getNbPers();
    }

    function getJour(): string
    {
        return parent::getJour();
    }

    function getHeureDej(): string
    {
        return parent::getHeureDej();
    }

    function getHeureDin(): string
    {
        return parent::getHeureDin();
    }

    function getAllergies(): string
    {
        return parent::getAllergies();
    }
}