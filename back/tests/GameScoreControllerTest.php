<?php

namespace App\Tests;

use App\Entity\Game;
use App\Entity\Team;
use PHPUnit\Framework\TestCase;
use App\Repository\GameRepository;
use App\Repository\TeamRepository;
use App\Controller\Api\GameScoreController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class GameScoreControllerTest extends TestCase
{
	public function testCreateGameOk()
	{
		$expected = new JsonResponse('match created!', 200);
		$data = json_encode(["score" => "4:9", "idTeam1" => 1, "idTeam2" => 2]);

		$gameRepository = $this->createMock(GameRepository::class);
		$teamRepository = $this->createMock(TeamRepository::class);
		$gameScoreController = new GameScoreController($gameRepository, $teamRepository);
		$actual = $gameScoreController->createGame(new Request([], [], [], [], [], [], $data));

		return self::assertEquals($expected, $actual);
	}

	public function testCreateGameWithInvalidInputs()
	{
		$expected = new JsonResponse('Expecting mandatory parameters!', 400);
		$data = json_encode(["score" => null, "idTeams1" => 1, "idTeams2" => 2]);

		$gameRepository = $this->createMock(GameRepository::class);
		$teamRepository = $this->createMock(TeamRepository::class);
		$gameScoreController = new GameScoreController($gameRepository, $teamRepository);
		$actual = $gameScoreController->createGame(new Request([], [], [], [], [], [], $data));

		return self::assertEquals($expected, $actual);
	}

	// public function testUpdateGameOk()
	// {
	// 	return self::assertEquals(true, true);
	// }

	// public function testUpdateGameNotOk()
	// {
	// 	return self::assertEquals(true, true);
	// }

	public function testSummaryWithResults()
	{
		$expected = new JsonResponse(self::GamesListReference());
		$data = [
			[
				"idGame" => 12,
				"idTeam1" => 1,
				"idTeam2" => 2,
				"nameTeam1" => 'Brazil',
				"nameTeam2" => 'England',
				"score" => "8;10"
			],
			[
				"idGame" => 13,
				"idTeam1" => 2,
				"idTeam2" => 1,
				"nameTeam1" => 'England',
				"nameTeam2" => 'Brazil',
				"score" => "4;3"
			]
		];

		$inputs = [];
		foreach ($data as $d) {
			$team1 = new Team();
			$team1->setIdteam($d['idTeam1']);
			$team1->setName($d['nameTeam1']);
			$team2 = new Team();
			$team2->setIdteam($d['idTeam2']);
			$team2->setName($d['nameTeam2']);

			$game = new Game();
			$game
				->setIdgame($d['idGame'])
				->setScore($d['score'])
				->setIdteam1($team1)
				->setIdteam2($team2);
			$inputs[] = $game;
		}

		$gameRepository = $this->createMock(GameRepository::class);
		$gameRepository->expects($this->once())
			->method("findAll")
			->willReturn($inputs);

		$teamRepository = $this->createMock(TeamRepository::class);
		$teamRepository
			->method("find")
			->will($this->onConsecutiveCalls($team1, $team2, $team2, $team1));

		$gameScoreController = new GameScoreController($gameRepository, $teamRepository);
		$actual = $gameScoreController->getGames();

		return self::assertEquals($expected, $actual);
	}

	public function testSummaryWithNoResults()
	{
		$expected = new JsonResponse("No data found!", 400);

		$gameRepository = $this->createMock(GameRepository::class);
		$gameRepository->expects($this->once())
			->method("findAll")
			->willReturn([]);

		$teamRepository = $this->createMock(TeamRepository::class);
		$gameScoreController = new GameScoreController($gameRepository, $teamRepository);
		$actual = $gameScoreController->getGames();

		return self::assertEquals($expected, $actual);
	}

	public static function GamesListReference()
	{
		return [
			[
				'idGame' => 13,
				'idTeam1' => 2,
				'idTeam2' => 1,
				'score' => '4;3',
				'nameTeam1' => 'England',
				'nameTeam2' => 'Brazil'
			],
			[
				'idGame' => 12,
				'idTeam1' => 1,
				'idTeam2' => 2,
				'score' => '8;10',
				'nameTeam1' => 'Brazil',
				'nameTeam2' => 'England'
			]
		];
	}
}
