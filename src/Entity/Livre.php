<?php

namespace App\Entity;

use App\Repository\LivreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreRepository::class)
 */
class Livre
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombrePage;

    /**
     * @ORM\ManyToOne(targetEntity=Saga::class, inversedBy="livre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $saga;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="livre")
     */
    private $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity=ListeDeLecture::class, mappedBy="livre")
     */
    private $listeDeLectures;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->listeDeLectures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getNombrePage(): ?int
    {
        return $this->nombrePage;
    }

    public function setNombrePage(int $nombrePage): self
    {
        $this->nombrePage = $nombrePage;

        return $this;
    }

    public function getSaga(): ?Saga
    {
        return $this->saga;
    }

    public function setSaga(?Saga $saga): self
    {
        $this->saga = $saga;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setLivre($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getLivre() === $this) {
                $commentaire->setLivre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ListeDeLecture[]
     */
    public function getListeDeLectures(): Collection
    {
        return $this->listeDeLectures;
    }

    public function addListeDeLecture(ListeDeLecture $listeDeLecture): self
    {
        if (!$this->listeDeLectures->contains($listeDeLecture)) {
            $this->listeDeLectures[] = $listeDeLecture;
            $listeDeLecture->addLivre($this);
        }

        return $this;
    }

    public function removeListeDeLecture(ListeDeLecture $listeDeLecture): self
    {
        if ($this->listeDeLectures->removeElement($listeDeLecture)) {
            $listeDeLecture->removeLivre($this);
        }

        return $this;
    }
}
