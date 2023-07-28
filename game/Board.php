<?php

namespace App\Game;

/**
 * @author Brandon VOUVOU
 */
class Board
{
  private array $grid;
  const EMPTY = 0;
  const PLAYER1 = 1;
  const PLAYER2 = 2;

  public function __construct()
  {
    $this->grid = array_fill(0, 10, array_fill(0, 10, self::EMPTY));
  }


  /**
   * Verifie si une position donnée est valide sur la grille.
   *
   * Cette méthode vérifie si les coordonnées x et y fournies sont à l'intérieur
   * des limites de la grille. La grille est définie comme un espace de 10x10, 
   * avec des indices allant de 0 à 9 pour chaque dimension.
   *
   * @param int $x La coordonnée x de la position à vérifier.
   * @param int $y La coordonnée y de la position à vérifier.
   * @return bool Renvoie true si la position est valide, false sinon.
   */
  public function isValidPosition(int $x, int $y): bool
  {
    return $x >= 0 && $x < 10 && $y >= 0 && $y < 10;
  }

  public function placePlayer(Player $player, int $playerNum)
  {
    if ($this->isValidPosition($player->getPosX(), $player->getPosY())) {
      $this->grid[$player->getPosY()][$player->getPosX()] = $playerNum;
    }
  }
  /**
   * Récupère la grille du plateau de jeu.
   *
   * Cette méthode renvoie la grille qui représente le plateau de jeu.
   *
   * @return array La grille du plateau de jeu.
   */
  public function getGrid()
  {
    return $this->grid;
  }
  public function display()
  {
    foreach ($this->grid as $row) {
      foreach ($row as $cell) {
        switch ($cell) {
          case self::EMPTY:
            echo '.';
            break;
          case self::PLAYER1:
            echo '1';
            break;
          case self::PLAYER2:
            echo '2';
            break;
        }
      }
      echo "\n";
    }
  }
}
