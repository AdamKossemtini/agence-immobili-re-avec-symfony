<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//ce fichiers represente le table propertySearch avec ses attributs (avec controle de saisie)
//ceci pour filtrer les donnet

class PropertySearch {

    /**
	* @var ArrayCollection
	 */
	private $options;
 

    /**
	* @var int|null
	 */
	private $maxPrice;

	/**
	 * @var int|null
	 */

    private $minSurface;
    
	/**
	 * @return int|null
	 */
	public function __construct(){
		$this->options=new ArrayCollection();
	}


	
    /**
	 * @return int|null
	 */
    public function getMaxPrice() :  ?int {
		return $this->maxPrice;
    }
    /**
    * @param int|null $maxPrice
     * @return PropertySearch
	 */
	public function setMaxPrice(int $maxPrice) : PropertySearch{
		$this->maxPrice = $maxPrice;

		return $this;
	}
	public function getMinSurface():  ?int {
		return $this->minSurface;
			}
		
		
/**
* @param int|null $minSurface
* @return PropertySearch
*/
public function setMinSurface(int $minSurface) : PropertySearch{
$this->minSurface = $minSurface;
		
return $this;
			}
	/**
	 * @return ArrayCollection
	 */
    public function getOptions() :  ArrayCollection{
		return $this->options;
    }
    /**
    * @param ArrayCollection $options
	 */
	public function setOptions(ArrayCollection $options) : void{
		$this->options = $options;

	}
}