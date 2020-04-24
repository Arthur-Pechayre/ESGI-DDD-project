<?php

namespace App\Model\Salle;

use App\Exception\PropertyShouldNotBeEmptyException;
use App\Model\Creneau\Creneau;
use App\model\UUID;

class Salle
{
    /**
     * @var array
     */
    private array $creneauxPris;

    /**
     * @var UUID
     */
    private UUID $id;

    /**
     * @var EmplacementSalle
     */
    private EmplacementSalle $emplacement;

    /**
     * @var string
     */
    private string $nom;

    /**
     * Salle constructor.
     * @param UUID $id
     * @param array $creneauxPris
     * @param string $nom
     * @param string $adresse
     * @param string $etage
     * @throws PropertyShouldNotBeEmptyException
     */
    public function __construct(
        UUID $id,
        $creneauxPris,
        string $nom,
        string $adresse,
        string $etage
    ) {
        if (empty($this->disponibilite)) {
            throw new PropertyShouldNotBeEmptyException("Missing disponibilite");
        }

        if (empty($this->nom)) {
            throw new PropertyShouldNotBeEmptyException("Missing nom");
        }



        $this->creneauxPris = $creneauxPris;
        $this->nom = $nom;
        $this->emplacement = new EmplacementSalle($adresse, $etage);
    }

    public function estDisponible(Creneau $creneau)
    {

    }

    /**
     * @return array
     */
    public function getDisponibilite(): array
    {
        return $this->disponibilite;
    }

    /**
     * @param array $disponibilite
     */
    public function setDisponibilite(array $disponibilite): void
    {
        $this->disponibilite = $disponibilite;
    }

    /**
     * @return UUID
     */
    public function getId(): UUID
    {
        return $this->id;
    }

    /**
     * @return EmplacementSalle
     */
    public function getEmplacement(): EmplacementSalle
    {
        return $this->emplacement;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }
}
