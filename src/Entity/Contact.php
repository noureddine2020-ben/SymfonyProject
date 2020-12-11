<?php


namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length (min=2,max=100)
     */
    private $firstName;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2,max=100)
     */
    private $lastName;

    /**
     * @var string|null
     * @Assert\Email()
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/[0-9]{8}/")
     */
    private $phoneNumber;


    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Length(min=10)
     */
    private $message;

    /**
     * @var Proprity|null
     */
    private $property;

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     * @return Contact
     */
    public function setFirstName(?string $firstName): Contact
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     * @return Contact
     */
    public function setLastName(?string $lastName): Contact
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Contact
     */
    public function setEmail(?string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     * @return Contact
     */
    public function setPhoneNumber(?string $phoneNumber): Contact
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return Contact
     */
    public function setMessage(?string $message): Contact
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return Proprity|null
     */
    public function getProperty(): ?Proprity
    {
        return $this->property;
    }

    /**
     * @param Proprity|null $property
     * @return Contact
     */
    public function setProperty(?Proprity $property): Contact
    {
        $this->property = $property;
        return $this;
    }







}