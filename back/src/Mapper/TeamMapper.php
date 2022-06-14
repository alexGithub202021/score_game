<?php

namespace App\Mapper;

use App\Entity\Team;

class TeamMapper
{
    public static function getNewTeam($data): Team
    {
        $newTeam = new Team();

        $newTeam
            ->setName($data['name'])
            ->setIdTeam($data['idteam']);

        return $newTeam;
    }

    public static function transform(array $teams): array
    {
        $result = array();

        if (count($teams) > 0) {
            foreach ($teams as $team) {
                $result[] = [
                    'idteam' => $team->getidteam(),
                    'name' => $team->getName()
                ];
            }
        }

        return $result;
    }
}
