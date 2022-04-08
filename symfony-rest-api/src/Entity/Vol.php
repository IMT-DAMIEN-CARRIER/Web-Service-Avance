<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VolRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=VolRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Vol
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTime $date;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="vols")
     * @ORM\JoinColumn(nullable=false)
     */
    private Company $company;

    /**
     * @ORM\ManyToMany(targetEntity=Place::class, mappedBy="vols")
     */
    private Collection $places;

    /**
     * Vol constructor.
     */
    public function __construct()
    {
        $this->places = new ArrayCollection();
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
            $this->slug = $slugify->slugify($this->name);
        }
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Vol
     */
    public function setName(string $name): Vol
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return Vol
     */
    public function setSlug(string $slug): Vol
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Vol
     */
    public function setDate(\DateTime $date): Vol
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     *
     * @return Vol
     */
    public function setCompany(Company $company): Vol
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    /**
     * @param Place $place
     *
     * @return $this
     */
    public function addPlace(Place $place): Vol
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
            $place->addVol($this);
        }

        return $this;
    }

    /**
     * @param Place $place
     *
     * @return $this
     */
    public function removePlace(Place $place): Vol
    {
        if ($this->places->removeElement($place)) {
            $place->removeVol($this);
        }

        return $this;
    }
}
