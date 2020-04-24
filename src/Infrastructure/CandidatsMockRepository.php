<?php


namespace App\Infrastructure;

use App\Model\Candidat\Candidat;
use App\Model\Candidat\Candidats;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Faker\Provider\Internet;

class CandidatsMockRepository extends BaseMockRepository implements Candidats
{
    public function __construct()
    {
        parent::__construct();

        $this->collection = [
            new Candidat(
                uniqid(),
                "hdzqju@free.fr",
                $this->faker->name(),
                $this->faker->firstName(),
                array_filter(
                    CarbonPeriod::create(
                        Carbon::now(),
                        (Carbon::now())->addWeek()
                    )->toArray(),
                    function (Carbon $e) {
                        return !$e->isWeekend();
                    }
                ),
                ['java'],
                1,
                ["Ravagé par le Java"]
            ),
            new Candidat(
                uniqid(),
                "hdzqju@free.fr",
                $this->faker->name(),
                $this->faker->firstName(),
                [],
                ['c', 'go', 'c++'],
                2,
                ["Fait un exellent thé"]
            ),
        ];
    }
}
