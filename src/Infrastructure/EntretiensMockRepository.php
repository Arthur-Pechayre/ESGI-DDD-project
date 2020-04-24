<?php


namespace App\Infrastructure;

use App\Model\Entretien\Entretiens;

class EntretiensMockRepository extends BaseMockRepository implements Entretiens
{
    public function __construct()
    {
        parent::__construct();

        $this->collection = [];
    }
}
