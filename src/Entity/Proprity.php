<?php

namespace App\Entity;
use Cocur\Slugify\Slugify;

use App\Repository\ProprityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProprityRepository::class)
 * @Vich\Uploadable()
 */
class Proprity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */

    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     ** @Assert\Positive
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="boolean")
     */
    private $solde=false;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_mise_circul;

    public function __construct()
    {
        $this->date_mise_circul=new \DateTime();
        $this->options = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Positive
     * @Assert\Range(
     *      min = 120,
     *      max = 180,
     *      notInRangeMessage = "You must be between {{ min }} ch and {{ max }} ch tall to enter",
     * )
     */
    private $puissance;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Assert\Positive
     */
    private $tranmission;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Positive
     */
    private $compteur;

    /**
     * @ORM\ManyToMany(targetEntity=Option::class, inversedBy="proprities")
     */
    private $options;

    /**
     *
     * @Vich\UploadableField(mapping="property_image", fileNameProperty="filename")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string",length=255)
     *
     * @var string|null
     */
    private $fileName;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug()
    {
        return (new Slugify())->slugify($this->title);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }
    public function getFormattedPrice(): string
    {
       return number_format($this->price,0,"",' ');
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getSolde(): ?bool
    {
        return $this->solde;
    }

    public function setSolde(bool $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDateMiseCircul(): ?\DateTimeInterface
    {
        return $this->date_mise_circul;
    }

    public function setDateMiseCircul(?\DateTimeInterface $date_mise_circul): self
    {
        $this->date_mise_circul = $date_mise_circul;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(?int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getTranmission(): ?string
    {
        return $this->tranmission;
    }

    public function setTranmission(string $tranmission): self
    {
        $this->tranmission = $tranmission;

        return $this;
    }

    public function getCompteur(): ?string
    {
        return $this->compteur;
    }

    public function setCompteur(?string $compteur): self
    {
        $this->compteur = $compteur;

        return $this;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function removeOption(Option $option): self
    {
        $this->options->removeElement($option);

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Proprity
     */
    public function setImageFile(?File $imageFile): Proprity
    {
        $this->imageFile = $imageFile;
        if($this->imageFile instanceof UploadedFile)
        {
            $this->updated_at=new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * @param string|null $fileName
     * @return Proprity
     */
    public function setFileName(?string $fileName): Proprity
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }





}
