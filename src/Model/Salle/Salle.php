<?php

namespace App\Model\Salle;

use App\Common\Exception\PropertyShouldNotBeEmptyException;
use App\Common\Model\UUID;
use App\Model\Planning\Planning;

class Salle
{
    /**
     * @var Planning
     */
    private Planning $planning;

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
     * @param string $id
     * @param array $creneauxPris
     * @param string $nom
     * @param string $adresse
     * @param string $etage
     * @throws PropertyShouldNotBeEmptyException
     */
    public function __construct(
        string $id,
        $creneauxPris,
        string $nom,
        string $adresse,
        string $etage
    ) {
        if (empty($id)) {
            throw new PropertyShouldNotBeEmptyException("Missing id");
        }

        if (empty($nom)) {
            throw new PropertyShouldNotBeEmptyException("Missing nom");
        }

        $this->id = new UUID($id);
        $this->planning = new Planning($creneauxPris);
        $this->nom = $nom;
        $this->emplacement = new EmplacementSalle($adresse, $etage);
    }

    /**
     * @return Planning
     */
    public function getPlanning(): Planning
    {
        return $this->planning;
    }

    /**
     * @param Planning $planning
     */
    public function setPlanning(Planning $planning): void
    {
        $this->planning = $planning;
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
