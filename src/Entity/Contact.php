<?php

namespace App\Entity;
use App\Form\ContactType;
use App\Entity\Property;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OptionRepository")
 */
class Contact
{
      /**
       * @var String|null
       * @Assert\NotBlank()
       * @Assert\Length(min=2,max=255)
     */
    private $firstname;
    
  /**
       * @var Property|null
     */
	private $property;



   /**
       * @var String|null
       * @Assert\Length(min=2,max=255)
     */
    private $lastname;
    
       /**
       * @var String|null
       * @Assert\NotBlank()
       * @Assert\Regex(
       *  pattern="/[0-9]{8}/"

       * )
     */
    private $phone;
    
         /**
       * @var String|null
       * @Assert\NotBlank()
       * @Assert\Email()
     */
    private $email;
    
        /**
       * @var String|null
       * @Assert\NotBlank()
       * @Assert\Length(min=10)
     */
    private $message;

    
    public function getFirstname(): ?String
    {
        return $this->firstname;
    }
    public function setFirstname( ? string $firstname) : Contact{
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?String
    {
        return $this->lastname;
    }
    public function setLastname( ? string $lastname) : Contact{
        $this->$lastname = $lastname;

        return $this;
    }
    public function getEmail(): ?String
    {
        return $this->email;
    }
    public function setEmail( ? string $email) : Contact{
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?String
    {
        return $this->message;
    }
    public function setMessage( ? string $message) : Contact{
        $this->message= $message;

        return $this;
    }

    
    public function getPhone(): ?String
    {
        return $this->phone;
    }
    public function setPhone( ? string $phone) : Contact{
        $this->phone= $phone;

        return $this;
    }


      
    public function getProperty(): ?Property
    {
        return $this->property;
    }
    public function setProperty( ? Property $property) : Contact{
        $this->property= $property;

        return $this;
    }

}
