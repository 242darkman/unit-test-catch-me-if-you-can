<?php

namespace App\Game;

require 'vendor/autoload.php';

use App\Game\Board;
use App\Game\Player;

/**
 * @author Brandon VOUVOU
 */
class Game
{
  /**
   * @var Player Le joueur 1
   */
  private Player $player1;
  /**
   * @var Player Le joueur 2
   */
  private Player $player2;
  /**
   * @var Board Le plateau de jeu
   */
  private Board $board;

  public function __construct(Player $player1, Player $player2)
  {
    $this->player1 = $player1;
    $this->player2 = $player2;
    $this->board = new Board();
    $this->board->placePlayer($this->player1, Board::PLAYER1);
    $this->board->placePlayer($this->player2, Board::PLAYER2);
  }

  /**
   * Joue un tour en effectuant une action.
   *
   * @param Player $player Le joueur effectuant le tour
   * @param string $action L'action à effectuer (left, right, forward)
   * @param int    $steps  Le nombre de pas pour l'action "forward" (par défaut 1)
   */
  public function playTurn(Player $player, string $action, int $steps = 1)
  {
    switch ($action) {
      case 'left':
        $player->turnLeft();
        break;
      case 'right':
        $player->turnRight();
        break;
      case 'forward':
        $oldX = $player->getPosX();
        $oldY = $player->getPosY();
        $player->moveForward($steps);

        if ($steps < 1 || $steps > 2) {
          $steps = 1;
        }

        if (!$this->board->isValidPosition($player->getPosX(), $player->getPosY())) {
          $player->setPosX($oldX);
          $player->setPosY($oldY);
        } else {
          $playerNum = $player === $this->player1 ? Board::PLAYER1 : Board::PLAYER2;
          $this->board->movePlayer($player, $playerNum); // Met à jour la position du joueur sur la grille
        }
        break;
    }
  }

  /**
   * Vérifie que les joueurs peuvent se voir.
   *
   * @param Player $player1 Le premier joueur
   * @param Player $player2 Le deuxième joueur
   *
   * @return int|null La distance entre les joueurs si dans la ligne de vision, sinon null
   */
  public function checkVision(Player $player1, Player $player2)
  {
    $distanceBetweenPlayer = null;


    switch ($player1->getOrientation()) {
      case 'N':
        if ($player1->getPosX() == $player2->getPosX() && $player1->getPosY() > $player2->getPosY()) {
          $distanceBetweenPlayer = $player1->getPosY() - $player2->getPosY();
        }
        break;
      case 'E':
        if ($player1->getPosY() == $player2->getPosY() && $player1->getPosX() < $player2->getPosX()) {
          $distanceBetweenPlayer = $player2->getPosX() - $player1->getPosX();
        }
        break;
      case 'S':
        if ($player1->getPosX() == $player2->getPosX() && $player1->getPosY() < $player2->getPosY()) {
          $distanceBetweenPlayer = $player2->getPosY() - $player1->getPosY();
        }
        break;
      case 'W':
        if ($player1->getPosY() == $player2->getPosY() && $player1->getPosX() > $player2->getPosX()) {
          $distanceBetweenPlayer = $player1->getPosX() - $player2->getPosX();
        }
        break;
    }

    return $distanceBetweenPlayer;
  }

  /**
   * Vérifie si la partie est terminée.
   *
   * @return bool True si la partie est terminée, sinon false
   */
  public function isGameOver(): bool
  {
    $isGameOver = $this->player1->getPosX() == $this->player2->getPosX() && $this->player1->getPosY() == $this->player2->getPosY();
    return $isGameOver;
  }

  /**
   * Récupère le premier joueur.
   *
   * @return Player Le premier joueur
   */
  public function getPlayer1()
  {
    return $this->player1;
  }

  /**
   * Récupère le deuxième joueur.
   *
   * @return Player Le deuxième joueur
   */
  public function getPlayer2()
  {
    return $this->player2;
  }

  /**
   * Récupère le plateau de jeu.
   *
   * @return Board Le plateau de jeu
   */
  public function getBoard()
  {
    return $this->board;
  }

  /**
   * Affiche le plateau de jeu.
   */
  public function printBoard()
  {
    $this->board->display();
  }
}
