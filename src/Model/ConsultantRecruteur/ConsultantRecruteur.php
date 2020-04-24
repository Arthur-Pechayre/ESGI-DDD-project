<?php

namespace App\Model\ConsultantRecruteur;

use App\Common\Model\Personne\Personne;
use App\Model\Candidat\Candidat;
use App\Model\Planning\Planning;
use App\Model\ProfilTechnique\ProfilTechnique;

class ConsultantRecruteur extends Personne
{
    /**
     * @var ProfilTechnique
     */
    private ProfilTechnique $profilTechnique;

    /**
     * @var Planning
     */
    private Planning $planning;

    /**
     * Candidat constructor.
     * @param string $id
     * @param string $email
     * @param string $nom
     * @param string $prenom
     * @param array $creneauxPris
     * @param array $competences
     * @param int $anneesXP
     * @param array $softSkills
     * @throws \App\Common\Exception\PropertyShouldNotBeEmptyException
     * @throws \App\Common\Model\Personne\BadEmailFormatException
     * @throws \App\Model\ProfilTechnique\AgeOutOfRangeException
     */
    public function __construct(string $id, string $email, string $nom, string $prenom, array $creneauxPris, array $competences, int $anneesXP, array $softSkills)
    {
        parent::__construct($id, $email, $nom, $prenom);

        $this->planning = new Planning($creneauxPris);
        $this->profilTechnique = new ProfilTechnique($competences, $anneesXP, $softSkills);
    }

    /**
     * @param Candidat $candidat
     * @return bool
     */
    public function peutAuditionner(Candidat $candidat): bool
    {
        return $this->profilTechnique->couvre($candidat->getProfilTechnique());
    }

    /**
     * @return Planning
     */
    public function getPlanning(): Planning
    {
        return $this->planning;
    }

    /**
     * @return ProfilTechnique
     */
    public function getProfilTechnique(): ProfilTechnique
    {
        return $this->profilTechnique;
    }
}
