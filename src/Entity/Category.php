<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $catagory = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    private Collection $productz;

    public function __construct()
    {
        $this->productz = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCatagory(): ?string
    {
        return $this->catagory;
    }

    public function setCatagory(string $catagory): self
    {
        $this->catagory = $catagory;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */

    /**
     * @return Collection<int, Product>
     */
    public function getProductz(): Collection
    {
        return $this->productz;
    }

    public function addProductz(Product $productz): self
    {
        if (!$this->productz->contains($productz)) {
            $this->productz->add($productz);
            $productz->setCategory($this);
        }

        return $this;
    }

    public function removeProductz(Product $productz): self
    {
        if ($this->productz->removeElement($productz)) {
            // set the owning side to null (unless already changed)
            if ($productz->getCategory() === $this) {
                $productz->setCategory(null);
            }
        }

        return $this;
    }

}
