<?php


namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch
{
    /**
     * @var int|null
     * @Assert\Positive
     */
    private $maxPrice;

    /**
     * @var String|null
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     */
    private $typeMateriel;

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice): PropertySearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return String|null
     */
    public function getTypeMateriel(): ?string
    {
        return $this->typeMateriel;
    }

    /**
     * @param String|null $typeMateriel
     * @return PropertySearch
     */
    public function setTypeMateriel(string $typeMateriel): PropertySearch
    {
        $this->typeMateriel = $typeMateriel;
        return $this;
    }




}