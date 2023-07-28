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
   * Prépare le test en créant les joueurs et le jeu
   * 
   * la méthode initialise les joueurs et le plateau de jeu
   */
  protected function setUp(): void
  {
    parent::setUp();
    $player1 = new Player(5, 5, 'N');
    $player2 = new Player(4, 4, 'S');
    $this->game = new Game($player1, $player2);
  }

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

  public function testPlayTurnLeft(): void
  {
    $this->game->playTurn($this->game->getPlayer1(), 'left');
    $this->assertEquals('W', $this->game->getPlayer1()->getOrientation());
  }

  public function testPlayTurnRight()
  {
    $this->game->playTurn($this->game->getPlayer1(), 'right');
    $this->assertEquals('E', $this->game->getPlayer1()->getOrientation());
  }

  public function testPlayTurnForwardNorth()
  {
    $this->game->playTurn($this->game->getPlayer1(), 'forward', 2);
    $this->assertEquals(3, $this->game->getPlayer1()->getPosY());
  }

  public function testPlayTurnForwardEast()
  {
    $this->game->getPlayer1()->setOrientation('E');
    $this->game->playTurn($this->game->getPlayer1(), 'forward', 2);
    $this->assertEquals(7, $this->game->getPlayer1()->getPosX());
  }

  public function testPlayTurnForwardSouth()
  {
    $this->game->getPlayer1()->setOrientation('S');
    $this->game->playTurn($this->game->getPlayer1(), 'forward', 2);
    $this->assertEquals(7, $this->game->getPlayer1()->getPosY());
  }

  public function testPlayTurnForwardWest()
  {
    $this->game->getPlayer1()->setOrientation('W');
    $this->game->playTurn($this->game->getPlayer1(), 'forward', 2);
    $this->assertEquals(3, $this->game->getPlayer1()->getPosX());
  }

  public function testCheckVisionNorthNull()
  {
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertNull($distance);
  }

  public function testCheckVisionNorthValue()
  {
    $this->game->getPlayer2()->setPosX(5);
    $this->game->getPlayer2()->setPosY(4);
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertEquals(1, $distance);
  }

  public function testCheckVisionEastNull()
  {
    $this->game->getPlayer1()->setOrientation('E');
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertNull($distance);
  }

  public function testCheckVisionEastValue()
  {
    $this->game->getPlayer2()->setPosX(6);
    $this->game->getPlayer2()->setPosY(5);
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertEquals(1, $distance);
  }

  public function testCheckVisionSouthNull()
  {
    $this->game->getPlayer1()->setOrientation('S');
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertNull($distance);
  }

  public function testCheckVisionSouthValue()
  {
    $this->game->getPlayer2()->setPosX(5);
    $this->game->getPlayer2()->setPosY(4);
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertEquals(1, $distance);
  }

  public function testCheckVisionWestNull()
  {
    $this->game->getPlayer1()->setOrientation('W');
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertNull($distance);
  }

  public function testCheckVisionWestValue()
  {
    $this->game->getPlayer2()->setPosX(3);
    $this->game->getPlayer2()->setPosY(5);
    $distance = $this->game->checkVision($this->game->getPlayer1(), $this->game->getPlayer2());
    $this->assertEquals(2, $distance);
  }

  public function testIsGameOver()
  {
    $this->game->getPlayer2()->setPosX(5);
    $this->game->getPlayer2()->setPosY(5);
    $this->assertTrue($this->game->isGameOver());
  }
}
