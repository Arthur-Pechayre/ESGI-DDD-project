<?php


namespace App\Infrastructure;

use App\Model\RH\RH;
use Faker\Provider\Internet;

class RHMockRepository extends BaseMockRepository
{
    public function __construct()
    {
        parent::__construct();

        $this->collection = [
            new RH(
                uniqid(),
                "hdzqju@free.fr",
                $this->faker->name(),
                $this->faker->firstName(),
            ),
        ];
    }
}
