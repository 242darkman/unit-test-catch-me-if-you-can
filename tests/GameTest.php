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
  private $player1;
  private $player2;
  private $game;

  /**
   * Prépare le test en créant les joueurs et le jeu
   * 
   * la méthode initialise les joueurs et le plateau de jeu
   */
  protected function setUp(): void
  {
    parent::setUp();
    $this->player1 = new Player(5, 5, 'N');
    $this->player2 = new Player(4, 4, 'S');
    $this->game = new Game($this->player1, $this->player2);
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
    $this->game->playTurn($this->player1, 'left');
    $this->assertEquals('W', $this->player1->getOrientation());
  }

  public function testPlayTurnRight()
  {
    $this->game->playTurn($this->player1, 'right');
    $this->assertEquals('E', $this->player1->getOrientation());
  }

  public function testPlayTurnForwardNorth()
  {
    $this->game->playTurn($this->player1, 'forward', 2);
    $this->assertEquals(3, $this->player1->getPosY());
  }

  public function testPlayTurnForwardEast()
  {
    $this->player1->setOrientation('E');
    $this->game->playTurn($this->player1, 'forward', 2);
    $this->assertEquals(7, $this->player1->getPosX());
  }

  public function testPlayTurnForwardSouth()
  {
    $this->player1->setOrientation('S');
    $this->game->playTurn($this->player1, 'forward', 2);
    $this->assertEquals(7, $this->player1->getPosY());
  }

  public function testPlayTurnForwardWest()
  {
    $this->player1->setOrientation('W');
    $this->game->playTurn($this->player1, 'forward', 2);
    $this->assertEquals(3, $this->player1->getPosX());
  }

  public function testCheckVisionNorthNull()
  {
    $distance = $this->game->checkVision($this->player1, $this->player2);
    $this->assertNull($distance);
  }

  public function testCheckVisionNorthValue()
  {
    $this->player2->setPosX(5);
    $this->player2->setPosY(4);
    $distance = $this->game->checkVision($this->player1, $this->player2);
    $this->assertEquals(1, $distance);
  }

  public function testCheckVisionEastNull()
  {
    $this->player1->setOrientation('E');
    $distance = $this->game->checkVision($this->player1, $this->player2);
    $this->assertNull($distance);
  }

  public function testCheckVisionEastValue()
  {
    $this->player2->setPosX(6);
    $this->player2->setPosX(5);
    $distance = $this->game->checkVision($this->player1, $this->player2);
    $this->assertEquals(1, $distance);
  }

  public function testCheckVisionSouthNull()
  {
    $this->player1->setOrientation('S');
    $distance = $this->game->checkVision($this->player1, $this->player2);
    $this->assertNull($distance);
  }

  public function testCheckVisionSouthValue()
  {
    $this->player2->setPosX(5);
    $this->player2->setPosY(4);
    $distance = $this->game->checkVision($this->player1, $this->player2);
    $this->assertEquals(1, $distance);
  }

  public function testCheckVisionWestNull()
  {
    $this->player1->setOrientation('W');
    $distance = $this->game->checkVision($this->player1, $this->player2);
    $this->assertNull($distance);
  }

  public function testCheckVisionWestValue()
  {
    $this->player2->setPosX(3);
    $this->player2->setPosY(5);
    $distance = $this->game->checkVision($this->player1, $this->player2);
    $this->assertEquals(2, $distance);
  }
}
