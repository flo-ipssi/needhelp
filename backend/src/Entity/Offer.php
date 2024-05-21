<?php

namespace App\Entity;

use App\Entity\Trait\TimerTrait;
use App\Repository\OfferRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Enum\StatusEnum;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Offer
{
    use TimerTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Job $job = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(StatusEnum::STATUS_ACCEPTED,StatusEnum::STATUS_REFUSED, StatusEnum::STATUS_PENDING_CUSTOMER )]
    private ?string $status = null;

    #[ORM\Column]
    private ?float $amount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }
}
