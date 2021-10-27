<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $NCL;

    /**
     * @return mixed
     */
    public function getNCL()
    {
        return $this->NCL;
    }

    /**
     * @param mixed $NCL
     */
    public function setNCL($NCL): void
    {
        $this->NCL = $NCL;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=true)
     */
    private $classroom;


    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }
}
