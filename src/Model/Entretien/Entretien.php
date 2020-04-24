<?php

namespace App\Model\Entretien;

use App\Common\Model\Personne\Personne;
use App\Common\Model\UUID;
use App\Model\Candidat\Candidat;
use App\Model\ConsultantRecruteur\ConsultantRecruteur;
use App\Model\Creneau\Creneau;
use App\Model\RH\RH;
use App\Model\Salle\Salle;

class Entretien
{
    public const STATUS_PROPOSED = 'PROPOSED';
    public const STATUS_SCHEDULED = 'SCHEDULED';
    public const STATUS_CANCELED = 'CANCELED';
    public const STATUS_TERMINATED = 'TERMINATED';

    private UUID $id;
    private RH $organisateur;
    private ConsultantRecruteur $consultantRecruteur;
    private Candidat $candidat;
    private bool $consultantRecruteurAcceptation;
    private bool $candidatAcceptation;
    private Creneau $crenau;
    private Salle $salle;
    private string $status;

    /**
     * Entretien constructor.
     * @param RH $organisateur
     * @param ConsultantRecruteur $consultantRecruteur
     * @param Candidat $candidat
     * @param Creneau $crenau
     * @param Salle $salle
     * @param string $status
     * @param bool $consultantRecruteurAcceptation
     * @param bool $candidatAcceptation
     * @param null $id
     * @throws IllegalEntretienStatus
     */
    public function __construct(
        RH $organisateur,
        ConsultantRecruteur $consultantRecruteur,
        Candidat $candidat,
        Creneau $crenau,
        Salle $salle,
        string $status=self::STATUS_PROPOSED,
        $consultantRecruteurAcceptation=false,
        $candidatAcceptation=false,
        $id=null
    ) {
        $this->organisateur = $organisateur;
        $this->consultantRecruteur = $consultantRecruteur;
        $this->candidat = $candidat;
        $this->crenau = $crenau;
        $this->salle = $salle;
        $this->consultantRecruteurAcceptation = $consultantRecruteurAcceptation;
        $this->candidatAcceptation = $candidatAcceptation;

        $this->id = new UUID($id);

        if (!in_array($status, [
            self::STATUS_PROPOSED,
            self::STATUS_SCHEDULED,
            self::STATUS_CANCELED,
            self::STATUS_TERMINATED
        ])) {
            throw new IllegalEntretienStatus("$status is not a valid status");
        }
        $this->status = $status;
    }

    public function enregistrerConfirmation(Personne $participant): string
    {
        if ($participant instanceof Candidat) {
            $this->candidatAcceptation = true;
        } elseif ($participant instanceof ConsultantRecruteur) {
            $this->consultantRecruteurAcceptation = true;
        } else {
            throw new IllegalParticipantException(get_class($participant) . " is not a valid entretien participant");
        }

        if ($this->candidatAcceptation && $this->consultantRecruteurAcceptation) {
            $this->status = self::STATUS_SCHEDULED;
        }

        return $this->status;
    }

    public function annule()
    {
        if (!in_array($this->status, [self::STATUS_CANCELED, self::STATUS_TERMINATED])) {
            throw new IllegalEntretienStatus("Invalid cancel operation for entretien " . $this->status);
        }

        $this->status = self::STATUS_CANCELED;
    }

    public function termine()
    {
        if ($this->status !== self::STATUS_TERMINATED) {
            throw new IllegalEntretienStatus("Invalid terminate operation for entretien " . $this->status);
        }

        $this->status = self::STATUS_TERMINATED;
    }

    /**
     * @return UUID
     */
    public function getId(): UUID
    {
        return $this->id;
    }

    /**
     * @return RH
     */
    public function getOrganisateur(): RH
    {
        return $this->organisateur;
    }

    /**
     * @return ConsultantRecruteur
     */
    public function getConsultantRecruteur(): ConsultantRecruteur
    {
        return $this->consultantRecruteur;
    }

    /**
     * @return Candidat
     */
    public function getCandidat(): Candidat
    {
        return $this->candidat;
    }

    /**
     * @return bool
     */
    public function isConsultantRecruteurAcceptation(): bool
    {
        return $this->consultantRecruteurAcceptation;
    }

    /**
     * @return bool
     */
    public function isCandidatAcceptation(): bool
    {
        return $this->candidatAcceptation;
    }

    /**
     * @return Creneau
     */
    public function getCrenau(): Creneau
    {
        return $this->crenau;
    }

    /**
     * @return Salle
     */
    public function getSalle(): Salle
    {
        return $this->salle;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
