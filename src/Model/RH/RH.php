<?php

namespace App\Model\RH;

use App\Common\Model\Personne\Personne;

class RH extends Personne
{
    /**
     * Candidat constructor.
     * @param string $id
     * @param string $email
     * @param string $nom
     * @param string $prenom
     * @throws \App\Common\Exception\PropertyShouldNotBeEmptyException
     * @throws \App\Common\Model\Personne\BadEmailFormatException
     */
    public function __construct(string $id, string $email, string $nom, string $prenom)
    {
        parent::__construct($id, $email, $nom, $prenom);
    }
}
