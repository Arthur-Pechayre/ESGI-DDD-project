<?php

namespace App\Model;

use App\Model\Creneau\Creneau;

/**
 * Class Planning
 * @package App\Model
 */
class Planning
{
    /**
     * @var Creneau[]
     */
    private $creneauxPris;

    /**
     * Planifiable constructor.
     * @param Creneau[] $creneauxPris
     */
    public function __construct(array $creneauxPris)
    {
        $this->creneauxPris = $creneauxPris;
    }

    /**
     * @param Creneau $creneau
     * @return bool
     */
    public function creneauDisponible(Creneau $creneau): bool
    {
        foreach ($this->creneauxPris as $cre) {
            if ($cre->equals($creneau)) {
                return false;
            }
        }

        return true;
    }
}
