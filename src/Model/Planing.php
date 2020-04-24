<?php

namespace App\Model;

use App\Model\Creneau\Creneau;

class Planing
{
    /**
     * @var Creneau[]
     */
    private $creneauxPris;

    /**
     * Planifiable constructor.
     * @param Creneau[] $creneauxPris
     */
    public function __construct($creneauxPris)
    {
        $this->creneauxPris = $creneauxPris;
    }

    /**
     * @return Creneau[]
     */
    public function getCreneauxPris(): array
    {
        return $this->creneauxPris;
    }
}
