<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="smallint")
     */
    private $hits;

    /**
     * @ORM\Column(type="integer")
     */
    private $timecreated;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $timemodified;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PageMeta", mappedBy="page")
     */
    private $meta;

    public function __construct()
    {
        $this->meta = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getHits(): ?int
    {
        return $this->hits;
    }

    public function setHits(int $hits): self
    {
        $this->hits = $hits;

        return $this;
    }

    public function getTimecreated(): ?int
    {
        return $this->timecreated;
    }

    public function setTimecreated(int $timecreated): self
    {
        $this->timecreated = $timecreated;

        return $this;
    }

    public function getTimemodified(): ?int
    {
        return $this->timemodified;
    }

    public function setTimemodified(?int $timemodified): self
    {
        $this->timemodified = $timemodified;

        return $this;
    }

    /**
     * @return Collection|PageMeta[]
     */
    public function getMeta(): Collection
    {
        return $this->meta;
    }

    public function addMetum(PageMeta $metum): self
    {
        if (!$this->meta->contains($metum)) {
            $this->meta[] = $metum;
            $metum->setPage($this);
        }

        return $this;
    }

    public function removeMetum(PageMeta $metum): self
    {
        if ($this->meta->contains($metum)) {
            $this->meta->removeElement($metum);
            // set the owning side to null (unless already changed)
            if ($metum->getPage() === $this) {
                $metum->setPage(null);
            }
        }

        return $this;
    }
}
