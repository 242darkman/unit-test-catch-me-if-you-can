<?php

namespace App\Game;

/**
 * @author Brandon VOUVOU
 */
class Player
{
  /**
   * @var x Position x du joueur sur la grille
   */
  private int $x;
  /**
   * @var y Position y du joueur sur la grille
   */
  private int $y;
  /**
   * @var orientation orientation du joueur sur la grille
   */
  private string $orientation;

  public function __construct(int $x, int $y, string $orientation)
  {
    $this->x = $x;
    $this->y = $y;
    $this->orientation = $orientation;
  }

  /**
   * @return int la position x du joueur
   */
  public function getPosX()
  {
    return $this->x;
  }

  /**
   * @return int la position y du joueur
   */
  public function getPosY()
  {
    return $this->y;
  }

  /**
   * @return string l'orientation du joueur sur le plateau
   */
  public function getOrientation()
  {
    return $this->orientation;
  }

  /**
   * @param int $pos la nouvelle position x du joueur
   */
  public function setPosX($pos)
  {
    $this->x = $pos;
  }

  /**
   * @param int $pos la nouvelle position y du joueur
   */
  public function setPosY($pos)
  {
    $this->y = $pos;
  }

  /**
   * @param string $newOrientation la nouvelle orientation du joueur
   */
  public function setOrientation($newOrientation)
  {
    $this->orientation = $newOrientation;
  }

  /**
   * @return string la nouvelle orientation du joueur après avoir tourner à gauche
   */
  public function turnLeft()
  {
    switch ($this->orientation) {
      case 'N':
        $this->orientation = 'W';
        break;
      case 'E':
        $this->orientation = 'N';
        break;
      case 'S':
        $this->orientation = 'E';
        break;
      case 'W':
        $this->orientation = 'S';
        break;
    }
  }

  /**
   * @return string la nouvelle orientation du joueur après avoir tourner à droite
   */
  public function turnRight()
  {
    switch ($this->orientation) {
      case 'N':
        $this->orientation = 'E';
        break;
      case 'E':
        $this->orientation = 'S';
        break;
      case 'S':
        $this->orientation = 'W';
        break;
      case 'W':
        $this->orientation = 'N';
        break;
    }
  }

  /**
   * @param int $steps nombre à effectuer
   */
  public function moveForward(int $steps)
  {
    switch ($this->orientation) {
      case 'N':
        $this->y -= $steps;
        break;
      case 'E':
        $this->x += $steps;
        break;
      case 'S':
        $this->y += $steps;
        break;
      case 'W':
        $this->x -= $steps;
        break;
    }
  }
}
