<?php
class User {
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $password;
    private $role;
    private $statusCompte;
    private $photo;
    private $fac;
    private $domaine;

    // Constructor
    public function __construct(
        $id = null,
        $name = null,
        $lastName = null,
        $email = null,
        $password = null,
        $role = null,
        $statusCompte = null,
        $photo = null,
        $fac = null,
        $domaine = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->statusCompte = $statusCompte;
        $this->photo = $photo;
        $this->fac = $fac;
        $this->domaine = $domaine;
    }

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getStatusCompte() {
        return $this->statusCompte;
    }

    public function setStatusCompte($statusCompte) {
        $this->statusCompte = $statusCompte;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function getFac() {
        return $this->fac;
    }

    public function setFac($fac) {
        $this->fac = $fac;
    }

    public function getDomaine() {
        return $this->domaine;
    }

    public function setDomaine($domaine) {
        $this->domaine = $domaine;
    }
}
?>