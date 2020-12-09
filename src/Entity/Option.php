<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OptionRepository::class)
 * @ORM\Table(name="`option`")
 */
class Option
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Proprity::class, mappedBy="options")
     */
    private $proprities;

    public function __construct()
    {
        $this->proprities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Proprity[]
     */
    public function getProprities(): Collection
    {
        return $this->proprities;
    }

    public function addProprity(Proprity $proprity): self
    {
        if (!$this->proprities->contains($proprity)) {
            $this->proprities[] = $proprity;
            $proprity->addOption($this);
        }

        return $this;
    }

    public function removeProprity(Proprity $proprity): self
    {
        if ($this->proprities->removeElement($proprity)) {
            $proprity->removeOption($this);
        }

        return $this;
    }
}
