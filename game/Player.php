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
  /**
   * @var int Ancienne position x du joueur sur la grille
   */
  private int $oldX;
  /**
   * @var int Ancienne position y du joueur sur la grille
   */
  private int $oldY;

  /**
   * Constructeur de la classe Player.
   * 
   * @param int $x Position x initiale
   * @param int $y Position y initiale
   * @param string $orientation Orientation initiale
   */
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

  public function getOldPosX()
  {
    return $this->oldX;
  }

  public function getOldPosY()
  {
    return $this->oldY;
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
  public function setPosX(int $posX)
  {
    $this->x = $posX;
  }

  /**
   * @param int $pos la nouvelle position y du joueur
   */
  public function setPosY(int $posY)
  {
    $this->y = $posY;
  }

  /**
   * Change l'ancienne position x du joueur.
   *
   * @param int $oldPosX Nouvelle valeur pour la position x
   */
  public function setOldPosX(int $oldPosX)
  {
    $this->oldX = $oldPosX;
  }

  /**
   * Change l'ancienne position y du joueur.
   *
   * @param int $oldPosY Nouvelle valeur pour la position y
   */
  public function setOldPosY(int $oldPosY)
  {
    $this->oldY = $oldPosY;
  }

  /**
   * @param string $newOrientation la nouvelle orientation du joueur
   */
  public function setOrientation(string $newOrientation)
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
   * Fait avancer le joueur d'un certain nombre de pas.
   * 
   * @param int $steps nombre à effectuer
   */
  public function moveForward(int $steps)
  {
    $this->oldX = $this->x;
    $this->oldY = $this->y;

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
