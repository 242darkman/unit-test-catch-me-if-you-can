<?php

use App\Game\Board;
use App\Game\Game;
use App\Game\Player;
use PHPUnit\Framework\TestCase;

/**
 * @author Brandon VOUVOU
 */
final class GameTest extends TestCase
{
  private $game;

  /**
   * Initialise le jeu avec les joueurs et le plateau pour les tests.
   */
  protected function setUp(): void
  {
    parent::setUp();
    $player1 = new Player(5, 5, 'N');
    $player2 = new Player(4, 4, 'S');
    $this->game = new Game($player1, $player2);
  }

  /**
   * Teste les valeurs initiales du jeu pour assurer une bonne initialisation.
   */
  public function testInitialValues(): void
  {
    $player1 = new Player(5, 5, 'N');
    $player2 = new Player(4, 4, 'S');
    $game = new Game($player1, $player2);
    $this->assertInstanceOf(Player::class, $game->getPlayer1());
    $this->assertInstanceOf(Player::class, $game->getPlayer2());
    $this->assertInstanceOf(Board::class, $game->getBoard());

    // on vérifie que les joueurs sont bien placés sur le plateau
    $this->assertEquals(Board::PLAYER1, $game->getBoard()->getCellState($player1->getPosX(), $player1->getPosY()));
    $this->assertEquals(Board::PLAYER2, $game->getBoard()->getCellState($player2->getPosX(), $player2->getPosY()));
  }

  /**
   * Teste le changement d'orientation du joueur vers la gauche.
   */
  public function testPlayTurnLeft(): void
  {
    $this->game->playTurn($this->game->getPlayer1(), 'left');
    $this->assertEquals('W', $this->game->getPlayer1()->getOrientation());
  }

  /**
   * Teste le changement d'orientation du joueur vers la droite.
   */
  public function testPlayTurnRight()
  {
    $this->game->playTurn($this->game->getPlayer1(), 'right');
    $this->assertEquals('E', $this->game->getPlayer1()->getOrientation());
  }

  /**
   * Teste le déplacement du joueur lorsqu'il est au Nord.
   */
  public function testPlayTurnForwardNorth()
  {
    $this->game->playTurn($this->game->getPlayer1(), 'forward', 2);
    $this->assertEquals(3, $this->game->getPlayer1()->getPosY());
  }

  /**
   * Teste le déplacement du joueur lorsqu'il est à l'Est.
   */
  public function testPlayTurnForwardEast()
  {
    $this->game->getPlayer1()->setOrientation('E');
    $this->game->playTurn($this->game->getPlayer1(), 'forward', 2);
    $this->assertEquals(7, $this->game->getPlayer1()->getPosX());
  }

  /**
   * Teste le déplacement du joueur lorsqu'il est au Sud.
   */
  public function testPlayTurnForwardSouth()
  {
    $this->game->getPlayer1()->setOrientation('S');
    $this->game->playTurn($this->game->getPlayer1(), 'forward', 2);
    $this->assertEquals(7, $this->game->getPlayer1()->getPosY());
  }

  /**
   * Teste le déplacement du joueur lorsqu'il est à l'Ouest.
   */
  public function testPlayTurnForwardWest()
  {
    $this->game->getPlayer1()->setOrientation('W');
    $this->game->playTurn($this->game->getPlayer1(), 'forward', 2);
    $this->assertEquals(3, $this->game->getPlayer1()->getPosX());
  }

  /**
   * Teste que les joueurs ne se voient pas vers le Nord.
   */
  public function testCheckVisionNorthNull()
  {
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertNull($distance);
  }

  /**
   * Teste que les joueurs se voient vers le Nord.
   */
  public function testCheckVisionNorthValue()
  {
    $this->game->getPlayer2()->setPosX(5);
    $this->game->getPlayer2()->setPosY(4);
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertEquals(1, $distance);
  }

  /**
   * Teste que les joueurs ne se voient pas vers l'Est'.
   */
  public function testCheckVisionEastNull()
  {
    $this->game->getPlayer1()->setOrientation('E');
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertNull($distance);
  }

  /**
   * Teste que les joueurs se voient vers l'Est.
   */
  public function testCheckVisionEastValue()
  {
    $this->game->getPlayer2()->setPosX(6);
    $this->game->getPlayer2()->setPosY(5);
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertEquals(1, $distance);
  }

  /**
   * Teste que les joueurs ne se voient pas vers le Sud.
   */
  public function testCheckVisionSouthNull()
  {
    $this->game->getPlayer1()->setOrientation('S');
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertNull($distance);
  }

  /**
   * Teste que les joueurs se voient vers le Sud.
   */
  public function testCheckVisionSouthValue()
  {
    $this->game->getPlayer2()->setPosX(5);
    $this->game->getPlayer2()->setPosY(4);
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertEquals(1, $distance);
  }

  /**
   * Teste que les joueurs ne se voient pas vers l'Ouest.
   */
  public function testCheckVisionWestNull()
  {
    $this->game->getPlayer1()->setOrientation('W');
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertNull($distance);
  }

  /**
   * Teste que les joueurs ne se voient pas vers l'Ouest.
   */
  public function testCheckVisionWestValue()
  {
    $this->game->getPlayer2()->setPosX(3);
    $this->game->getPlayer2()->setPosY(5);
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertEquals(2, $distance);
  }

  /**
   * Teste si le jeu est terminé lorsque les joueurs sont dans la même position.
   */
  public function testIsGameOver()
  {
    $this->game->getPlayer2()->setPosX(5);
    $this->game->getPlayer2()->setPosY(5);
    $this->assertTrue($this->game->isGameOver());
  }
}
