<?php

namespace App\Model;

use App\Exception\BadEmailFormatException;
use App\Exception\PropertyShouldNotBeEmptyException;;

abstract class Personne
{
    /**
     * @var string
     */
    private string $nom;

    /**
     * @var string
     */
    private string $prenom;

    /**
     * @var string
     */
    private string $email;

    public function __construct(string $email, string $nom, string $prenom)
    {
        if (empty($email)) {
            throw new PropertyShouldNotBeEmptyException("Email should not be empty");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new BadEmailFormatException("Email : '$email' is not a valid email address");
        }

        if (empty($nom)) {
            throw new PropertyShouldNotBeEmptyException("Nom should not be empty");
        }

        if (empty($prenom)) {
            throw new PropertyShouldNotBeEmptyException("Prenom should not be empty");
        }

        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
    }
}
