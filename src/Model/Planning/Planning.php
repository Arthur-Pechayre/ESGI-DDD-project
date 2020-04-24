<?php

namespace App\Model\Planning;

use App\Model\Creneau\Creneau;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\This;

/**
 * Class Planning
 * @package App\Model
 */
class Planning
{
    /**
     * @var Carbon[]
     */
    private $creneauxPris;

    /**
     * Planifiable constructor.
     * @param Carbon[] $creneauxPris
     */
    public function __construct(array $creneauxPris)
    {
        $this->creneauxPris = $creneauxPris;
    }

    /**
     * @param Creneau $creneau
     * @return bool
     */
    public function estLibre(Creneau $creneau): bool
    {
        foreach ($this->creneauxPris as $cre) {
            if ($cre->eq($creneau)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param Planning $other
     * @return Creneau|null
     * @throws \App\Model\Creneau\CreneauIsWeekendException
     */
    public function trouvePremierCreneauCommun(Planning $other): ?Creneau
    {
        for ($date = Carbon::now(); ;$date->addDay()) {
            if (!$date->isWeekend() &&
                !in_array($date, $this->creneauxPris) &&
                !in_array($date, $other->creneauxPris)) {
                return new Creneau($date);
            }
        }
    }
}
