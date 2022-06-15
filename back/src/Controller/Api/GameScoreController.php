<?php

namespace App\Controller\Api;

use App\Repository\GameRepository;
use App\Repository\TeamRepository;
use App\Mapper\GameMapper;
use App\Mapper\TeamMapper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class GameScoreController
 * @package App\Controller
 * @Route("/api")
 */
class GameScoreController extends AbstractController
{

	private $gameRepository;
	private $teamRepository;

	public function __construct(GameRepository $gameRepository, TeamRepository $teamRepository)
	{
		$this->gameRepository = $gameRepository;
		$this->teamRepository = $teamRepository;
	}

	/**
	 * @Route("/game", methods="POST")
	 */
	public function createGame(Request $request): Response
	{
		$data = json_decode($request->getContent(), true);

		if (empty($data['score']) || empty($data['idTeam1']) || empty($data['idTeam2'])) {
			return new JsonResponse('Expecting mandatory parameters!', 400);
		} elseif ($data['idTeam1'] < 0 || $data['idTeam2'] < 0) {
			return new JsonResponse("Invalid parameter : idTeam1 and idTeam2 must be positive integer", 400);
		}

		try {
			$idTeam1 = $this->teamRepository->findOneBy(['idteam' => $data['idTeam1']]);
			$data['idTeam1'] = $idTeam1;

			$idTeam2 = $this->teamRepository->findOneBy(['idteam' => $data['idTeam2']]);
			$data['idTeam2'] = $idTeam2;

			$newGame = GameMapper::getNewGame($data);
			$lastGame = $this->gameRepository->add($newGame, true);

			return new JsonResponse('match created!', 200);
		} catch (\Exception $e) {
			return new JsonResponse($e->getMessage(), 500);
		}
	}

	/**
	 * @Route("/score/{id}", methods="PATCH")
	 */
	public function updateScore(Request $request, int $id): Response
	{		
		if (!$id) {
			throw new JsonResponse("Invalid id", 400);
		}
		$data = json_decode($request->getContent(), true);

		if (empty($data['score'])) {
			return new JsonResponse('Expecting mandatory parameters!', 400);
		}

		try {
			$game = $this->gameRepository->find(['idgame' => $id]);
			if ($game) {
				$this->gameRepository->updateScore($game, $data['score']);
				return new JsonResponse("game score updated!", 200);
			}
			return new JsonResponse("game not found!", 400);
		} catch (\Exception $e) {
			return new JsonResponse($e->getMessage(), 500);
		}
	}

	/**
	 * @Route("/games", methods="GET")
	 */
	public function getGames(): Response
	{
		$games = $this->gameRepository->findAll();
		rsort($games);

		if (!$games) {
			return new JsonResponse("No data found!", 400);
		}
		$tempResult = GameMapper::transform($games);
		$result = [];

		foreach ($tempResult as $res) {
			$team1 = $this->teamRepository->find(['idteam' => $res['idTeam1']]);
			$res['nameTeam1'] = $team1->getName();
			$team2 = $this->teamRepository->find(['idteam' => $res['idTeam2']]);
			$res['nameTeam2'] = $team2->getName();
			$result[] = $res;
		}

		return new JsonResponse($result);
	}

	/**
	 * @Route("/teams", methods="GET")
	 */
	public function getTeams(): Response
	{
		$teams = $this->teamRepository->findAll();
		$result = TeamMapper::transform($teams);

		return new JsonResponse($result);
	}
}
