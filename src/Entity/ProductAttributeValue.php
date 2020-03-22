<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductAttributeValueRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="attribute_unique", columns={"product_id", "product_attribute_id"})})
 * @Assert\UniqueEntity(entityClass="App\Entity\ProductAttributeValue", fields={"product", "productAttribute"},
 *     message="This attribute is already set")
 */
class ProductAttributeValue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="productAttributeValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductAttribute", inversedBy="productAttributeValues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productAttribute;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * @param Product|null $product
     * @return $this
     */
    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return ProductAttribute|null
     */
    public function getProductAttribute(): ?ProductAttribute
    {
        return $this->productAttribute;
    }

    /**
     * @param ProductAttribute|null $productAttribute
     * @return $this
     */
    public function setProductAttribute(?ProductAttribute $productAttribute): self
    {
        $this->productAttribute = $productAttribute;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     * @return $this
     */
    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
