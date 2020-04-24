<?php

namespace App\Infrastructure;

use App\Model\Salle\Salle;
use App\Model\Salle\Salles;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class SallesMockRepository extends BaseMockRepository implements Salles
{
    public function __construct()
    {
        parent::__construct();

        $this->collection = [
            new Salle(
                uniqid(),
                CarbonPeriod::create(
                    Carbon::now(),
                    (Carbon::now())->addWeek()
                )->toArray(),
                "Ophuls",
                "Lorem",
                "2"
            ),
            new Salle(
                uniqid(),
                [],
                "Daniel Auteuil",
                "Lorem",
                "2"
            ),
        ];
    }
}
