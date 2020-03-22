<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductAttributeRepository")
 */
class ProductAttribute
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProductAttributeValue", mappedBy="productAttributeId", orphanRemoval=true)
     */
    private $productAttributeValues;

    /**
     * ProductAttribute constructor.
     */
    public function __construct()
    {
        $this->productAttributeValues = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ProductAttributeValue[]
     */
    public function getProductAttributeValues(): Collection
    {
        return $this->productAttributeValues;
    }

    /**
     * @param ProductAttributeValue $productAttributeValue
     * @return $this
     */
    public function addProductAttributeValue(ProductAttributeValue $productAttributeValue): self
    {
        if (!$this->productAttributeValues->contains($productAttributeValue)) {
            $this->productAttributeValues[] = $productAttributeValue;
            $productAttributeValue->setProductAttribute($this);
        }

        return $this;
    }

    /**
     * @param ProductAttributeValue $productAttributeValue
     * @return $this
     */
    public function removeProductAttributeValue(ProductAttributeValue $productAttributeValue): self
    {
        if ($this->productAttributeValues->contains($productAttributeValue)) {
            $this->productAttributeValues->removeElement($productAttributeValue);
            // set the owning side to null (unless already changed)
            if ($productAttributeValue->getProductAttribute() === $this) {
                $productAttributeValue->setProductAttribute(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
