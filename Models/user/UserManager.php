<?php
namespace Models\user;

use Models\Database;

class UserManager extends Database 
{
    public function getUser($info) 
    {
        $req = 'SELECT * FROM users WHERE email = ? OR pseudonyme = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$info, $info]);
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }

    public function addUser($nom, $prenom, $pseudonyme, $email, $motdepasse)
    {
        $req= 'INSERT INTO users (nom, prenom, pseudonyme, email, motdepasse) VALUES (?, ?, ?, ?, ?)';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$nom, $prenom, $pseudonyme, $email, $motdepasse]);
    }
    public function updateUser($nom, $prenom, $pseudonyme, $email, $id)
    {
        $req = 'UPDATE users SET nom = ?, prenom = ?, pseudonyme = ?, email = ? WHERE id = ?';
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$nom, $prenom, $pseudonyme, $email, $id]);
    }
}