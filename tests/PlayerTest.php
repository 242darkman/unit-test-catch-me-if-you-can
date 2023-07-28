<?php
require 'vendor/autoload.php';

use App\Game\Player;
use PHPUnit\Framework\TestCase;

/**
 * @author Brandon VOUVOU
 */
final class PlayerTest extends TestCase
{
  /**
   * @var Player Le joueur utilisé pour les tests.
   */
  protected Player $player;

  /**
   * Méthode de configuration appelée avant chaque test.
   *
   * Cette méthode est utilisée pour initialiser le joueur avec des valeurs par défaut.
   */
  protected function setUp(): void
  {
    $this->player = new Player(5, 5, 'N');
  }

  /**
   * Teste si le joueur est correctement initialisé.
   *
   * Cette méthode vérifie que le joueur est correctement initialisé avec 
   * les valeurs passées au constructeur. Il vérifie que les coordonnées 
   * x et y du joueur sont bien égales à 5, et que son orientation est 'N'.
   */
  public function testPlayerInitialValues(): void
  {
    $this->assertEquals(5, $this->player->getPosX());
    $this->assertEquals(5, $this->player->getPosY());
    $this->assertEquals('N', $this->player->getOrientation());
  }


  /**
   * Teste si le joueur tourne correctement à gauche depuis la position Nord.
   */
  public function testPlayerTurnLeftAtNorthPosition(): void
  {
    $this->player->turnLeft();
    $this->assertEquals('W', $this->player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à gauche depuis la position Est.
   */
  public function testPlayerTurnLeftAtEastPosition(): void
  {
    $this->player->setOrientation('E');
    $this->player->turnLeft();
    $this->assertEquals('N', $this->player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à gauche depuis la position Sud.
   */
  public function testPlayerTurnLeftAtSouthPosition(): void
  {
    $this->player->setOrientation('S');
    $this->player->turnLeft();
    $this->assertEquals('E', $this->player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à gauche depuis la position Ouest.
   */
  public function testPlayerTurnLeftAtWestPosition(): void
  {
    $this->player->setOrientation('W');
    $this->player->turnLeft();
    $this->assertEquals('S', $this->player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à droite depuis la position Nord.
   */
  public function testPlayerTurnRightAtNorthPosition(): void
  {
    $this->player->turnRight();
    $this->assertEquals('E', $this->player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à droite depuis la position Est.
   */
  public function testPlayerTurnRightAtEastPosition(): void
  {
    $this->player->setOrientation('E');
    $this->player->turnRight();
    $this->assertEquals('S', $this->player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à droite depuis la position Sud.
   */
  public function testPlayerTurnRightAtSouthPosition(): void
  {
    $this->player->setOrientation('S');
    $this->player->turnRight();
    $this->assertEquals('W', $this->player->getOrientation());
  }

  /**
   * Teste si le joueur tourne correctement à droite depuis la position Ouest.
   */
  public function testPlayerTurnRightAtWestPosition(): void
  {
    $this->player->setOrientation('W');
    $this->player->turnRight();
    $this->assertEquals('N', $this->player->getOrientation());
  }

  /**
   * Teste si le joueur avance correctement vers le Nord.
   */
  public function testPlayerMoveForwardNorth(): void
  {
    $this->player->moveForward(1);
    $this->assertEquals(4, $this->player->getPosY());
  }

  /**
   * Teste si le joueur avance correctement vers l'Est.
   */
  public function testPlayerMoveForwardEast(): void
  {
    $this->player->setOrientation('E');
    $this->player->moveForward(2);
    $this->assertEquals(7, $this->player->getPosX());
  }

  /**
   * Teste si le joueur avance correctement vers le Sud.
   */
  public function testPlayerMoveForwardSouth(): void
  {
    $this->player->setOrientation('S');
    $this->player->moveForward(2);
    $this->assertEquals(7, $this->player->getPosY());
  }

  /**
   * Teste si le joueur avance correctement vers l'Ouest.
   */
  public function testPlayerMoveForwardWest(): void
  {
    $this->player->setOrientation('W');
    $this->player->moveForward(1);
    $this->assertEquals(4, $this->player->getPosX());
  }
}
