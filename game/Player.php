<?php

namespace App\Game;

/**
 * @author Brandon VOUVOU
 */
class Player
{
  private int $x;
  private int $y;
  private string $orientation;

  public function __construct(int $x, int $y, string $orientation)
  {
    $this->x = $x;
    $this->y = $y;
    $this->orientation = $orientation;
  }

  public function getPosX()
  {
    return $this->x;
  }

  public function getPosY()
  {
    return $this->y;
  }

  public function getOrientation()
  {
    return $this->orientation;
  }

  public function setPosX($pos)
  {
    $this->x = $pos;
  }

  public function setPosY($pos)
  {
    $this->y = $pos;
  }

  public function setOrientation($newOrientation)
  {
    $this->orientation = $newOrientation;
  }
}
