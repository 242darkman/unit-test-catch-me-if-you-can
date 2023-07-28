<?php

namespace App\Game;

/**
 * @author Brandon VOUVOU
 */
class Board
{
  public array $grid;

  public function __construct()
  {
    /**
     * @var array grid 
     */
    $this->grid = array_fill(0, 10, array_fill(0, 10, 0));
  }
  public function isValidPosition(int $x, int $y): bool
  {
    return $x >= 0 && $x < 10 && $y >= 0 && $y < 10;
  }
}
