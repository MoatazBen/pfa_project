<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NameService = null;

    #[ORM\Column(length: 255)]
    private ?string $StatutService = null;

    #[ORM\Column(length: 255)]
    private ?string $PriceService = null;

    #[ORM\Column]
    private ?int $IdService = null;

    #[ORM\Column(length: 255)]
    private ?string $PrestataireService = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameService(): ?string
    {
        return $this->NameService;
    }

    public function setNameService(string $NameService): static
    {
        $this->NameService = $NameService;

        return $this;
    }

    public function getStatutService(): ?string
    {
        return $this->StatutService;
    }

    public function setStatutService(string $StatutService): static
    {
        $this->StatutService = $StatutService;

        return $this;
    }

    public function getPriceService(): ?string
    {
        return $this->PriceService;
    }

    public function setPriceService(string $PriceService): static
    {
        $this->PriceService = $PriceService;

        return $this;
    }

    public function getIdService(): ?int
    {
        return $this->IdService;
    }

    public function setIdService(int $IdService): static
    {
        $this->IdService = $IdService;

        return $this;
    }

    public function getPrestataireService(): ?string
    {
        return $this->PrestataireService;
    }

    public function setPrestataireService(string $PrestataireService): static
    {
        $this->PrestataireService = $PrestataireService;

        return $this;
    }
}
