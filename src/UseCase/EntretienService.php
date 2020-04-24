<?php

namespace App\UseCase;

use App\Model\Candidat\Candidats;
use App\Model\ConsultantRecruteur\ConsultantRecruteurs;
use Model\Candidat;
use Model\ConsultantRecruteur;
use Model\Entretien;

class EntretienService
{
    private $candidatsRepo;

    public function __construct(Candidats $candidatsRepo, ConsultantRecruteurs $consultantRecruteursRepo, Salles $sallesRepo)
    {
    }

    private function matchConsultantWithCandidat(Candidat $candidat): ?ConsultantRecruteur
    {
        $consultantsR =

        return new
    }

    public function planifierEntretien(Candidat $candidat): ?Entretien
    {
        $neoEntretien = new Entretien($candidat, );

        // Persist entretien

         return $neoEntretien;
    }
}
