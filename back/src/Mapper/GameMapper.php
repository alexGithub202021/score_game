<?php

namespace App\Mapper;

use App\Entity\Game;

class GameMapper
{
    public static function getNewGame($data): Game
    {
        $newGame = new Game();
        $newGame
            ->setScore($data['score'])
            ->setIdTeam1($data['idTeam1'])
            ->setIdTeam2($data['idTeam2']);

        return $newGame;
    }

    public static function transform(array $games): array
    {
        $result = array();

        if (count($games) > 0) {
            foreach ($games as $game) {
                $result[] = [
                    'idGame' => $game->getIdgame(),
                    'idTeam1' => $game->getIdTeam1(),
                    'idTeam2' => $game->getIdTeam2(),
                    'score' => $game->getScore()
                ];
            }
        }

        return $result;
    }
}
