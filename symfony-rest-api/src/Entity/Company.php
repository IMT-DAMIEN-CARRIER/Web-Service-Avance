<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompanyRepository;
use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Company
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $website;

    /**
     * @ORM\OneToMany(targetEntity=Vol::class, mappedBy="company", orphanRemoval=true)
     */
    private Collection $vols;

    /**
     * Company constructor.
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
     * @return Company
     */
    public function setName(string $name): Company
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
     * @return Company
     */
    public function setSlug(string $slug): Company
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     *
     * @return Company
     */
    public function setWebsite(?string $website): Company
    {
        $this->website = $website;

        return $this;
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
     * @return $this
     */
    public function addVol(Vol $vol): Company
    {
        if (!$this->vols->contains($vol)) {
            $this->vols[] = $vol;
            $vol->setCompany($this);
        }

        return $this;
    }

    /**
     * @param Vol $vol
     *
     * @return $this
     */
    public function removeVol(Vol $vol): Company
    {
        if ($this->vols->removeElement($vol)) {
            // set the owning side to null (unless already changed)
            if ($vol->getCompany() === $this) {
                $vol->setCompany(null);
            }
        }

        return $this;
    }
}
