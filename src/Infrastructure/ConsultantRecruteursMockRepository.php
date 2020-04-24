<?php


namespace App\Infrastructure;

use App\Model\ConsultantRecruteur\ConsultantRecruteur;
use App\Model\ConsultantRecruteur\ConsultantRecruteurs;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Faker\Provider\Internet;

class ConsultantRecruteursMockRepository extends BaseMockRepository implements ConsultantRecruteurs
{
    public function __construct()
    {
        parent::__construct();

        $this->collection = [
            new ConsultantRecruteur(
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
            new ConsultantRecruteur(
                uniqid(),
                $this->faker->email(),
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
