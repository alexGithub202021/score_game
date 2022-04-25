<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salesperson
 *
 * @ORM\Table(name="Salesperson", indexes={@ORM\Index(name="fk_Salesperson_1_idx", columns={"IdOffice"})})
 * @ORM\Entity
 */
class Salesperson
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSalesperson", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsalesperson;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Age", type="integer", nullable=true)
     */
    private $age;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="BeginDate", type="date", nullable=true)
     */
    private $begindate;

    /**
     * @var \Office
     *
     * @ORM\ManyToOne(targetEntity="Office")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdOffice", referencedColumnName="IdOffice")
     * })
     */
    private $idoffice;

    public function getIdsalesperson(): ?int
    {
        return $this->idsalesperson;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getBegindate(): ?\DateTimeInterface
    {
        return $this->begindate;
    }

    public function setBegindate(?\DateTimeInterface $begindate): self
    {
        $this->begindate = $begindate;

        return $this;
    }

    public function getIdoffice(): ?Office
    {
        return $this->idoffice;
    }

    public function setIdoffice(?Office $idoffice): self
    {
        $this->idoffice = $idoffice;

        return $this;
    }

    public function setIdsalesperson(?int $idsalesperson): self
    {
        $this->idsalesperson = $idsalesperson;

        return $this;
    }    
}
