<?php

namespace App\Game;

require 'vendor/autoload.php';

use App\Game\Board;
use App\Game\Player;

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
