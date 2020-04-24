<?php

namespace App\Model\Creneau;

use Carbon\Carbon;

class Creneau
{
    /**
     * @var Carbon
     */
    private Carbon $date;

    /**
     * Creneau constructor.
     * @param Carbon $date
     */
    public function __construct(Carbon $date)
    {
        if ($date->isWeekend()) {
            throw new CreneauIsWeekendException("A creneau cannot be in weekend");
        }

        $this->date = $date;
    }

    /**
     * @param Creneau $other
     * @return bool
     */
    public function equals(Creneau $other)
    {
        return $other->getDate()->equalTo($this->date);
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }
}
