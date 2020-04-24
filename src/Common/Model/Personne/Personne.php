<?php

namespace App\Common\Model\Personne;

use App\Common\Exception\PropertyShouldNotBeEmptyException;
use App\Common\Model\UUID;

abstract class Personne
{
    /**
     * @var UUID
     */
    private UUID $id;

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

    public function __construct(
        string $id,
        string $email,
        string $nom,
        string $prenom
    ) {
        $this->id = new UUID($id);

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

    /**
     * @return UUID
     */
    public function getId(): UUID
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
