<?php
require 'vendor/autoload.php';

use App\Game\Board;
use App\Game\Player;
use PHPUnit\Framework\TestCase;

/**
 * @author Brandon VOUVOU
 */
final class BoardTest extends TestCase
{

  /**
   * @var Board
   */
  protected $board;

  /**
   * Initialise le contexte de test.
   *
   * Cette méthode est appelée avant l'exécution de chaque test individuel.
   * Elle est utilisée pour initialiser les objets ou ressources nécessaires aux tests.
   * Dans ce cas, elle initialise une nouvelle instance de la classe Board.
   *
   * @return void
   */
  protected function setUp(): void
  {
    $this->board = new Board();
  }

  /**
   * Teste que la grille est correctement initialisée.
   *
   * Cette méthode vérifie les points suivants :
   * 1. La grille a 10 lignes.
   * 2. Chaque ligne a 10 colonnes.
   * 3. Chaque cellule est initialisée à 0.
   *
   */
  public function testGridIsProperlyInitialized()
  {
    $grid = $this->board->getGrid();

    $this->assertCount(10, $grid, 'La grille devrait avoir 10 lignes');

    foreach ($grid as $row) {
      $this->assertCount(10, $row, 'Chaque ligne devrait avoir 10 colonnes');
    }

    foreach ($grid as $row) {
      foreach ($row as $cell) {
        $this->assertEquals(0, $cell, 'Chaque cellule devrait être initialisée avec 0');
      }
    }
  }

  /**
   * Teste si la méthode isValidPosition fonctionne correctement.
   *
   * Cette méthode vérifie que la méthode isValidPosition de la classe Board 
   * renvoie bien true pour une position valide (5,5) sur la grille, et false
   * pour des positions non valides (-2,5), (5,11) et (11,11).
   *
   */
  public function testIsValidPosition(): void
  {
    $this->assertTrue($this->board->isValidPosition(5, 5));
    $this->assertFalse($this->board->isValidPosition(-2, 5));
    $this->assertFalse($this->board->isValidPosition(5, 11));
    $this->assertFalse($this->board->isValidPosition(11, 11));
  }
  public function testPlacePlayer(): void
  {
    $player1 = new Player(1, 1, 'N');
    $player2 = new Player(2, 2, 'N');

    $this->board->placePlayer($player1, Board::PLAYER1);
    $this->board->placePlayer($player2, Board::PLAYER2);

    $grid = $this->board->getGrid();
    $this->assertEquals(Board::PLAYER1, $grid[1][1], "Le joueur 1 doit être placé à la position (1, 1)");
    $this->assertEquals(Board::PLAYER2, $grid[2][2], "Le joueur 2 doit être placé à la position (2, 2)");
  }
}
