<?php

namespace App\UseCase;

use App\Model\Candidat\Candidat;
use App\Model\Candidat\Candidats;
use App\Model\ConsultantRecruteur\ConsultantRecruteur;
use App\Model\ConsultantRecruteur\ConsultantRecruteurs;
use App\Model\Creneau\Creneau;
use App\Model\Entretien\Entretien;
use App\Model\Entretien\Entretiens;
use App\Model\RH\RH;
use App\Model\Salle\Salle;
use App\Model\Salle\Salles;

class EntretienService
{
    private Entretiens $entretiensRepo;
    private ConsultantRecruteurs $consultantRecruteursRepo;
    private Salles $sallesRepo;

    public function __construct(
        Entretiens $entretiensRepo,
        ConsultantRecruteurs $consultantRecruteursRepo,
        Salles $sallesRepo
    ) {
        $this->entretiensRepo = $entretiensRepo;
        $this->consultantRecruteursRepo = $consultantRecruteursRepo;
        $this->sallesRepo = $sallesRepo;
    }

    private function matchConsultant(Candidat $candidat) {
        $consultants = $this->consultantRecruteursRepo->all();

        /** @var ConsultantRecruteur $consultant */
        foreach ($consultants as $consultant) {
            if ($consultant->peutAuditionner($candidat)) {
                return $consultant;
            }
        }

        return null;
    }

    private function findEmptyRoom(Creneau $creneau) {
        $salles = $this->sallesRepo->all();

        /** @var Salle $salle */
        foreach ($salles as $salle) {
            if ($salle->getPlanning()->estLibre($creneau)) {
                return $salle;
            }
        }

        return null;
    }

    public function planifierEntretien(RH $rh, Candidat $candidat): ?Entretien
    {
        $consultant = $this->matchConsultant($candidat);

        if (!$consultant) {
            throw new \Exception("Pas de consultants pouvant auditionner");
        }

        $crenau = $candidat->getPlanning()->trouvePremierCreneauCommun($consultant->getPlanning());
        $salle = $this->findEmptyRoom($crenau);

        if (!$crenau) {
            throw new \Exception("Pas de salle disponible");
        }

        $neoEntretien = new Entretien(
            $rh,
            $consultant,
            $candidat,
            $crenau,
            $salle
        );

        $this->entretiensRepo->create($neoEntretien);

         return $neoEntretien;
    }

    public function replanifierEntretien()
    {
        //Todo
    }

    public function annulerEntretien()
    {
        //Todo
    }

    public function terminerEntretien()
    {
        //Todo
    }
}
