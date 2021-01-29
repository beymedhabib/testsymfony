<?php

namespace App\Entity;

use App\Repository\CatalogueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CatalogueRepository::class)
 */
class Catalogue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, )
     * @Assert\NotBlank(message="please upload image")
     
     */
    //* @Assert\File(mineTypes={"image/jpeg"})
    private $Icon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nb_produit;

    // /**
    //  * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="catalogue")
    //  */
    // private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->Icon;
    }

    public function setIcon(?string $Icon): self
    {
        $this->Icon = $Icon;

        return $this;
    }

    public function getNbProduit(): ?string
    {
        return $this->nb_produit;
    }

    public function setNbProduit(?string $nb_produit): self
    {
        $this->nb_produit = $nb_produit;

        return $this;
    }

    // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(?User $user): self
    // {
    //     $this->user = $user;

    //     return $this;
    // }
}
