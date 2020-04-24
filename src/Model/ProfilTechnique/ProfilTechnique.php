<?php

namespace App\Model\ProfilTechnique;

class ProfilTechnique
{
    private array $specialites;

    private int $anneesXP;

    private array $softSkills;

    /**
     * ProfilTechnique constructor.
     * @param array $specialites
     * @param int $anneesXP
     * @param array $softSkills
     */
    public function __construct(array $specialites, int $anneesXP, array $softSkills)
    {
        if ($anneesXP < 0 || $anneesXP > 50) {
            throw new \OutOfRangeException("");
        }


        $this->specialites = $specialites;
        $this->anneesXP = $anneesXP;
        $this->softSkills = $softSkills;
    }


}
