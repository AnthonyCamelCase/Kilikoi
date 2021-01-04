<?php

namespace App\Entity;

use App\Repository\ListeDeLectureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeDeLectureRepository::class)
 */
class ListeDeLecture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomListe;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="listeDeLectures")
     */
    private $utilisateur;

    /**
     * @ORM\ManyToMany(targetEntity=Livre::class, inversedBy="listeDeLectures")
     */
    private $livre;

    public function __construct()
    {
        $this->livre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomListe(): ?string
    {
        return $this->nomListe;
    }

    public function setNomListe(string $nomListe): self
    {
        $this->nomListe = $nomListe;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection|Livre[]
     */
    public function getLivre(): Collection
    {
        return $this->livre;
    }

    public function addLivre(Livre $livre): self
    {
        if (!$this->livre->contains($livre)) {
            $this->livre[] = $livre;
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        $this->livre->removeElement($livre);

        return $this;
    }
}
