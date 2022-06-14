<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="Game", indexes={@ORM\Index(name="IdTeam2_idx", columns={"IdTeam2"}), @ORM\Index(name="IdTeam_idx", columns={"IdTeam1"})})
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdGame", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgame;

    /**
     * @var string
     *
     * @ORM\Column(name="Score", type="string", length=10, nullable=true)
     */
    private $score;

    /**
     * @var \Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdTeam1", referencedColumnName="IdTeam")
     * })
     */
    private $idteam1;

    /**
     * @var \Team
     *
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdTeam2", referencedColumnName="IdTeam")
     * })
     */
    private $idteam2;

    public function getIdgame(): ?int
    {
        return $this->idgame;
    }

    public function setIdgame(int $id): self
    {
        $this->idgame = $id;

        return $this;
    }

    public function getScore(): string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getIdteam1(): ?int
    {
        return $this->idteam1?->getIdteam();
    }

    public function setIdteam1(?Team $idteam1): self
    {
        $this->idteam1 = $idteam1;

        return $this;
    }

    public function getIdteam2(): ?int
    {
        return $this->idteam2?->getIdteam();
    }

    public function setIdteam2(?Team $idteam2): self
    {
        $this->idteam2 = $idteam2;

        return $this;
    }
}
