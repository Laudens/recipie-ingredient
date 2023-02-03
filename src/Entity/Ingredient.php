<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    /**
     *@Assert\Length(min=2, max=50, minMessage="votre titre est bien trop court l'ami!")
     */
    /**
     *@Assert\NotBlank()
     */
    private ?string $name = null;

    #[ORM\Column]
    /**
     *@Assert\NotNull()
     */
    /**
     *@Assert\Positive()
     */
    /**
     *@Assert\LessThan(200)
     */
    private ?float $price = null;

    #[ORM\Column]
    /**
     *@Assert\NotNull()
    */
    private ?\DateTimeImmutable $creatAt = null;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeImmutable
    {
        return $this->creatAt;
    }

    public function setCreatAt(\DateTimeImmutable $creatAt): self
    {
        $this->creatAt = $creatAt;

        return $this;
    }
}
