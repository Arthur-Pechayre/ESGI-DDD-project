<?php

namespace App\Model\ProfilTechnique;

use App\Common\Exception\PropertyShouldNotBeEmptyException;

class ProfilTechnique
{
    /**
     * @var array
     */
    private array $competences;

    /**
     * @var int
     */
    private int $anneesXP;

    /**
     * @var array
     */
    private array $softSkills;

    /**
     * ProfilTechnique constructor.
     * @param array $competences
     * @param int $anneesXP
     * @param array $softSkills
     * @throws AgeOutOfRangeException
     * @throws PropertyShouldNotBeEmptyException
     */
    public function __construct(array $competences, int $anneesXP, array $softSkills)
    {
        if ($anneesXP < 0 || $anneesXP > 50) {
            throw new AgeOutOfRangeException("Age must be between 0 and 50");
        }

        if (empty($competences)) {
            throw new PropertyShouldNotBeEmptyException("Competences are empty");
        }

        if (empty($softSkills)) {
            throw new PropertyShouldNotBeEmptyException("SoftSkills are empty");
        }

        $this->competences = $competences;
        $this->anneesXP = $anneesXP;
        $this->softSkills = $softSkills;
    }

    /**
     * @param ProfilTechnique $other
     * @return bool
     */
    public function couvre(ProfilTechnique $other): bool
    {
        if ($this->anneesXP < $other->getAnneesXP()) {
            return false;
        }

        foreach ($other->getCompetences() as $skill) {
            if (!in_array($skill, $this->getCompetences())) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function getCompetences(): array
    {
        return $this->competences;
    }

    /**
     * @return int
     */
    public function getAnneesXP(): int
    {
        return $this->anneesXP;
    }

    /**
     * @return array
     */
    public function getSoftSkills(): array
    {
        return $this->softSkills;
    }
}
