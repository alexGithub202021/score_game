<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="Customer", indexes={@ORM\Index(name="fk_Customer_1_idx1", columns={"IdSalesperson"})})
 * @ORM\Entity
 */
class Customer
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCustomer", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcustomer;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Society", type="string", length=45, nullable=true)
     */
    private $society;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Credit", type="decimal", precision=9, scale=2, nullable=true)
     */
    private $credit;

    /**
     * @var \Salesperson
     *
     * @ORM\ManyToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdSalesperson", referencedColumnName="idSalesperson")
     * })
     */
    private $idsalesperson;

    public function getIdcustomer(): ?int
    {
        return $this->idcustomer;
    }

    public function getSociety(): ?string
    {
        return $this->society;
    }

    public function setSociety(?string $society): self
    {
        $this->society = $society;

        return $this;
    }

    public function getCredit(): ?string
    {
        return $this->credit;
    }

    public function setCredit(?string $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getIdsalesperson(): ?int
    {
        return $this->idsalesperson?->getIdsalesperson();
    }

    public function setIdsalesperson(?Salesperson $idsalesperson): self
    {
        $this->idsalesperson = $idsalesperson;

        return $this;
    }


}
