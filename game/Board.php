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

  /**
   * Place un joueur sur la grille à une position donnée.
   *
   * Cette méthode place un joueur sur la grille, à la position indiquée par ses coordonnées x et y.
   * Avant de placer le joueur, elle vérifie si la position est valide en utilisant la méthode isValidPosition.
   * Si la position est valide, le joueur est placé sur la grille. Sinon, rien ne se produit.
   * Le numéro du joueur est utilisé pour représenter le joueur sur la grille.
   *
   * @param Player $player Le joueur à placer sur la grille. L'objet joueur doit avoir des coordonnées x et y valides.
   * @param int $playerNum Le numéro du joueur, utilisé pour représenter le joueur sur la grille.
   */
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

  /**
   * Récupère l'état de la cellule aux coordonnées spécifiées.
   *
   * @param int $x La coordonnée x de la cellule.
   * @param int $y La coordonnée y de la cellule.
   * @return int L'état de la cellule. Retourne une des constantes de classe 
   *             EMPTY, PLAYER1, PLAYER2 pour indiquer si la cellule est vide ou contient un joueur.
   */
  public function getCellState(int $x, int $y): int
  {
    return $this->grid[$y][$x];
  }

  /**
   * Affiche la grille de jeu en console.
   *
   * Cette méthode parcourt chaque cellule de la grille de jeu et affiche un caractère correspondant à son état.
   * Si la cellule est vide, elle affiche un '.'. Si la cellule contient le joueur 1, elle affiche '1', 
   * et si elle contient le joueur 2, elle affiche '2'.
   * Chaque ligne de la grille est affichée sur une nouvelle ligne de la console.
   */
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
