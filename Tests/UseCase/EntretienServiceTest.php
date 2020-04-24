<?php

use App\Infrastructure\CandidatsMockRepository;
use App\Infrastructure\ConsultantRecruteursMockRepository;
use App\Infrastructure\EntretiensMockRepository;
use App\Infrastructure\RHMockRepository;
use App\Infrastructure\SallesMockRepository;
use App\Model\Candidat\Candidat;
use App\Model\ConsultantRecruteur\ConsultantRecruteur;
use App\Model\Creneau\Creneau;
use App\Model\Entretien\Entretien;
use App\Model\RH\RH;
use App\Model\Salle\Salle;
use PHPUnit\Framework\TestCase;

class EntretienServiceTest extends TestCase
{
    private CandidatsMockRepository $candidatsMockRepository;
    private ConsultantRecruteursMockRepository $consultantRecruteursMockRepository;
    private RHMockRepository $RHMockRepository;
    private SallesMockRepository $sallesMockRepository;
    private EntretiensMockRepository $entretienMockRepository;

    public function setUp(): void
    {
        $this->candidatsMockRepository = new CandidatsMockRepository();
        $this->consultantRecruteursMockRepository = new ConsultantRecruteursMockRepository();
        $this->RHMockRepository = new RHMockRepository();
        $this->sallesMockRepository = new SallesMockRepository();
        $this->entretienMockRepository = new EntretiensMockRepository();
    }

    public function testCreateOneEntretien()
    {
        $entretienSvc = new \App\UseCase\EntretienService(
            $this->entretienMockRepository,
            $this->consultantRecruteursMockRepository,
            $this->sallesMockRepository
        );

        $entretien = $entretienSvc->planifierEntretien(
            $this->RHMockRepository->all()[0],
            $this->candidatsMockRepository->all()[0],
        );

        self::assertNotNull($entretien);
    }
}
