<?php

namespace App\Entity;

use App\Repository\SagaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SagaRepository::class)
 */
class Saga
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
    private $nomSaga;

    /**
     * @ORM\Column(type="integer")
     */
    private $volume;

    /**
     * @ORM\OneToMany(targetEntity=Livre::class, mappedBy="saga")
     */
    private $livre;

    public function __construct()
    {
        $this->livre = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nomSaga;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSaga(): ?string
    {
        return $this->nomSaga;
    }

    public function setNomSaga(string $nomSaga): self
    {
        $this->nomSaga = $nomSaga;

        return $this;
    }

    public function getVolume(): ?int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): self
    {
        $this->volume = $volume;

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
            $livre->setSaga($this);
        }

        return $this;
    }

    public function removeLivre(Livre $livre): self
    {
        if ($this->livre->removeElement($livre)) {
            // set the owning side to null (unless already changed)
            if ($livre->getSaga() === $this) {
                $livre->setSaga(null);
            }
        }

        return $this;
    }
}
