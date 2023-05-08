<?php

namespace App\Entity;

use App\Entity\Traits\HasDescriptionTrait;
use App\Entity\Traits\HasIdTrait;
use App\Entity\Traits\HasNameTrait;
use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    use HasIdTrait;
    use HasNameTrait;
    use HasDescriptionTrait;
    use TimestampableEntity;

    #[ORM\Column(nullable: true)]
    private ?bool $vegen = null;

    #[ORM\Column(nullable: true)]
    private ?bool $vegetarian = null;

    #[ORM\Column(nullable: true)]
    private ?bool $dailyFree = null;

    #[ORM\Column(nullable: true)]
    private ?bool $gluterFree = null;

    #[ORM\OneToMany(mappedBy: 'ingredient', targetEntity: RecipeHasIngredient::class)]
    private Collection $recipeHasIngredients;

    public function __construct()
    {
        $this->recipeHasIngredients = new ArrayCollection();
    }

    public function isVegen(): ?bool
    {
        return $this->vegen;
    }

    public function setVegen(?bool $vegen): self
    {
        $this->vegen = $vegen;

        return $this;
    }

    public function isVegetarian(): ?bool
    {
        return $this->vegetarian;
    }

    public function setVegetarian(?bool $vegetarian): self
    {
        $this->vegetarian = $vegetarian;

        return $this;
    }

    public function isDailyFree(): ?bool
    {
        return $this->dailyFree;
    }

    public function setDailyFree(?bool $dailyFree): self
    {
        $this->dailyFree = $dailyFree;

        return $this;
    }

    public function isGluterFree(): ?bool
    {
        return $this->gluterFree;
    }

    public function setGluterFree(?bool $gluterFree): self
    {
        $this->gluterFree = $gluterFree;

        return $this;
    }

    /**
     * @return Collection<int, RecipeHasIngredient>
     */
    public function getRecipeHasIngredients(): Collection
    {
        return $this->recipeHasIngredients;
    }

    public function addRecipeHasIngredient(RecipeHasIngredient $recipeHasIngredient): self
    {
        if (!$this->recipeHasIngredients->contains($recipeHasIngredient)) {
            $this->recipeHasIngredients->add($recipeHasIngredient);
            $recipeHasIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeRecipeHasIngredient(RecipeHasIngredient $recipeHasIngredient): self
    {
        if ($this->recipeHasIngredients->removeElement($recipeHasIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeHasIngredient->getIngredient() === $this) {
                $recipeHasIngredient->setIngredient(null);
            }
        }

        return $this;
    }
}
