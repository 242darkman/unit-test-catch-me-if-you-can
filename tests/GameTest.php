<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Game\Player;
use App\Game\Board;

/**
 * @author Brandon VOUVOU
 */
final class GameTest extends TestCase
{
  /**
   * Teste si le joueur est correctement initialisé.
   *
   * Cette méthode vérifie que le joueur est correctement initialisé avec 
   * les valeurs passées au constructeur. Il vérifie que les coordonnées 
   * x et y du joueur sont bien égales à 5, et que son orientation est 'N'.
   */
  public function testPlayerInitialValues(): void
  {
    $player = new Player(5, 5, 'N');
    $this->assertEquals(5, $player->getPosX());
    $this->assertEquals(5, $player->getPosY());
    $this->assertEquals('N', $player->getOrientation());
  }


  /**
   * Teste si le joueur tourne correctement à gauche depuis la position Nord.
   */
  public function testPlayerTurnLeftAtNorthPosition(): void
  {
    $player = new Player(5, 5, 'N');
    $player->turnLeft();
    $this->assertEquals('W', $player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à gauche depuis la position Est.
   */
  public function testPlayerTurnLeftAtEastPosition(): void
  {
    $player = new Player(5, 5, 'E');
    $player->turnLeft();
    $this->assertEquals('N', $player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à gauche depuis la position Sud.
   */
  public function testPlayerTurnLeftAtSouthPosition(): void
  {
    $player = new Player(5, 5, 'S');
    $player->turnLeft();
    $this->assertEquals('E', $player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à gauche depuis la position Ouest.
   */
  public function testPlayerTurnLeftAtWestPosition(): void
  {
    $player = new Player(5, 5, 'W');
    $player->turnLeft();
    $this->assertEquals('S', $player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à droite depuis la position Nord.
   */
  public function testPlayerTurnRightAtNorthPosition(): void
  {
    $player = new Player(5, 5, 'N');
    $player->turnRight();
    $this->assertEquals('E', $player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à droite depuis la position Est.
   */
  public function testPlayerTurnRightAtEastPosition(): void
  {
    $player = new Player(5, 5, 'E');
    $player->turnRight();
    $this->assertEquals('S', $player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à droite depuis la position Sud.
   */
  public function testPlayerTurnRightAtSouthPosition(): void
  {
    $player = new Player(5, 5, 'S');
    $player->turnRight();
    $this->assertEquals('W', $player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à droite depuis la position Ouest.
   */
  public function testPlayerTurnRightAtWestPosition(): void
  {
    $player = new Player(5, 5, 'W');
    $player->turnRight();
    $this->assertEquals('N', $player->getOrientation());
  }

  /**
   * Teste si le joueur avance correctement vers le Nord.
   */
  public function testPlayerMoveForwardNorth(): void
  {
    $player = new Player(5, 5, 'N');
    $player->moveForward(1);
    $this->assertEquals(4, $player->getPosY());
  }

  /**
   * Teste si le joueur avance correctement vers l'Est.
   */
  public function testPlayerMoveForwardEast(): void
  {
    $player = new Player(5, 4, 'E');
    $player->moveForward(2);
    $this->assertEquals(7, $player->getPosX());
  }

  /**
   * Teste si le joueur avance correctement vers le Sud.
   */
  public function testPlayerMoveForwardSouth(): void
  {
    $player = new Player(5, 2, 'S');
    $player->moveForward(2);
    $this->assertEquals(4, $player->getPosY());
  }

  /**
   * Teste si le joueur avance correctement vers l'Ouest.
   */
  public function testPlayerMoveForwardWest(): void
  {
    $player = new Player(5, 5, 'W');
    $player->moveForward(1);
    $this->assertEquals(4, $player->getPosX());
  }


  /**
   * Teste que la grille est correctement initialisée.
   *
   * Cette méthode vérifie les points suivants :
   * 1. La grille a 10 lignes.
   * 2. Chaque ligne a 10 colonnes.
   * 3. Chaque cellule est initialisée à 0.
   *
   * Aucun paramètre d'entrée n'est nécessaire car le tableau est créé à l'intérieur de la méthode.
   * 
   * La méthode ne retourne rien. Au lieu de cela, elle utilise les assertions de PHPUnit
   * pour valider la grille du tableau. Si la grille ne correspond pas aux attentes,
   * PHPUnit lancera une exception et échouera le test.
   */
  public function testGridIsProperlyInitialized()
  {
    $board = new Board();
    $grid = $board->grid;

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
   * La méthode ne prend aucun paramètre en entrée et n'en renvoie aucun. 
   * Au lieu de cela, elle utilise les assertions de PHPUnit pour vérifier 
   * le comportement de la méthode isValidPosition. Si le comportement ne 
   * correspond pas aux attentes, PHPUnit lancera une exception et le test échouera.
   */
  public function testIsValidPosition(): void
  {
    $board = new Board();
    $this->assertTrue($board->isValidPosition(5, 5));
    $this->assertFalse($board->isValidPosition(-2, 5));
    $this->assertFalse($board->isValidPosition(5, 11));
    $this->assertFalse($board->isValidPosition(11, 11));
  }
}
