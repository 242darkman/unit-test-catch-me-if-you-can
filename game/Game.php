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
  private Player $player1;
  private Player $player2;
  private Board $board;

  public function __construct(Player $player1, Player $player2)
  {
    $this->player1 = $player1;
    $this->player2 = $player2;
    $this->board = new Board();
    $this->board->placePlayer($this->player1, Board::PLAYER1);
    $this->board->placePlayer($this->player2, Board::PLAYER2);
  }


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
        $player->moveForward($steps);
        break;
    }

    if (!$this->board->isValidPosition($player->getPosX(), $player->getPosY())) {
      $player->moveForward($steps); // on annule le mouvement du joueur
    }
  }

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
        echo "Player player1 position X ===> " . $player1->getPosX() . "\n";
        echo "Player player2 position X ===> " . $player2->getPosX() . "\n";
        echo "Player player1 position Y ===> " . $player1->getPosY() . "\n";
        echo "Player player2 position Y ===> " . $player2->getPosY() . "\n";
        if ($player1->getPosY() == $player2->getPosY() && $player1->getPosX() > $player2->getPosX()) {
          $distanceBetweenPlayer = $player1->getPosX() - $player2->getPosX();
        }
        break;
    }

    //echo "Distance between player " . $player1->getOrientation() . " -> " . $distanceBetweenPlayer . "\n";
    return $distanceBetweenPlayer;
  }

  public function getPlayer1()
  {
    return $this->player1;
  }

  public function getPlayer2()
  {
    return $this->player2;
  }

  public function getBoard()
  {
    return $this->board;
  }

  public function printBoard()
  {
    $this->board->display();
  }
}
