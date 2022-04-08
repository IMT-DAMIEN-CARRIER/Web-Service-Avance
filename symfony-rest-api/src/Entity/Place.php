<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlaceRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToMany(targetEntity=Vol::class, inversedBy="places")
     */
    private Collection $vols;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private string $alley;

    /**
     * @ORM\Column(type="integer")
     */
    private int $number;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $affected;

    /**
     * Place constructor.
     */
    public function __construct()
    {
        $this->vols = new ArrayCollection();
    }

    /**
     * Permet d'initialiser le slug.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function initializeSlug()
    {
        if (empty($this->slug)) {
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->alley.$this->number);
        }
    }

    /**
     * @return Collection|Vol[]
     */
    public function getVols(): Collection
    {
        return $this->vols;
    }

    /**
     * @param Vol $vol
     *
     * @return Place
     */
    public function addVol(Vol $vol): PLace
    {
        if (!$this->vols->contains($vol)) {
            $this->vols[] = $vol;
        }

        return $this;
    }

    /**
     * @param Vol $vol
     *
     * @return Place
     */
    public function removeVol(Vol $vol): Place
    {
        $this->vols->removeElement($vol);

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAlley(): string
    {
        return $this->alley;
    }

    /**
     * @param string $alley
     *
     * @return Place
     */
    public function setAlley(string $alley): Place
    {
        $this->alley = $alley;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     *
     * @return Place
     */
    public function setNumber(int $number): Place
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAffected(): bool
    {
        return $this->affected;
    }

    /**
     * @param bool $affected
     *
     * @return Place
     */
    public function setAffected(bool $affected): Place
    {
        $this->affected = $affected;

        return $this;
    }
}
