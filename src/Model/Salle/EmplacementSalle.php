<?php

namespace App\Model\Salle;

use App\Common\Exception\PropertyShouldNotBeEmptyException;

class EmplacementSalle
{
    /**
     * @var string
     */
    private string $adresse;

    /**
     * @var string
     */
    private string $etage;

    /**
     * EmplacementSalle constructor.
     * @param string $adresse
     * @param string $etage
     * @throws PropertyShouldNotBeEmptyException
     */
    public function __construct(string $adresse, string $etage)
    {
        if (empty($adresse)) {
            throw new PropertyShouldNotBeEmptyException("Missing adresse");
        }

        if (empty($etage)) {
            throw new PropertyShouldNotBeEmptyException("Missing etage");
        }

        $this->adresse = $adresse;
        $this->etage = $etage;
    }

    /**
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * @return string
     */
    public function getEtage(): string
    {
        return $this->etage;
    }
}
