<?php

use App\Infrastructure\CandidatsMockRepository;
use App\Infrastructure\ConsultantRecruteursMockRepository;
use App\Infrastructure\RHMockRepository;
use App\Infrastructure\SallesMockRepository;
use App\Model\Candidat\Candidat;
use App\Model\ConsultantRecruteur\ConsultantRecruteur;
use App\Model\Creneau\Creneau;
use App\Model\Entretien\Entretien;
use App\Model\RH\RH;
use App\Model\Salle\Salle;
use PHPUnit\Framework\TestCase;

class EntretienTest extends TestCase
{
    private CandidatsMockRepository $candidatsMockRepository;
    private ConsultantRecruteursMockRepository $consultantRecruteursMockRepository;
    private RHMockRepository $RHMockRepository;
    private SallesMockRepository $sallesMockRepository;

    public function setUp(): void
    {
        $this->candidatsMockRepository = new CandidatsMockRepository();
        $this->consultantRecruteursMockRepository = new ConsultantRecruteursMockRepository();
        $this->RHMockRepository = new RHMockRepository();
        $this->sallesMockRepository = new SallesMockRepository();

    }


    public function testInstanciate()
    {
        $date = \Carbon\Carbon::now();
        if ($date->isWeekend()) {
            $date = $date->addDays(2);
        }

        $entretien = new Entretien(
            $this->RHMockRepository->all()[0],
            $this->consultantRecruteursMockRepository->all()[0],
            $this->candidatsMockRepository->all()[0],
            new Creneau($date),
            $this->sallesMockRepository->all()[0]
        );

        self::assertNotNull($entretien);
    }
}
