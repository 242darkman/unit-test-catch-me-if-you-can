<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Game\Player;

/**
 * @author Brandon VOUVOU
 */
final class GameTest extends TestCase
{
  public function testPlayerInitialValues(): void
  {
    $player = new Player(5, 5, 'N');
    $this->assertEquals(5, $player->getPosX());
    $this->assertEquals(5, $player->getPosY());
    $this->assertEquals('N', $player->getOrientation());
  }

  public function testPlayerTurnLeftAtNorthPosition(): void
  {
    $player = new Player(5, 5, 'N');
    $player->turnLeft();
    $this->assertEquals('W', $player->getOrientation());
  }

  public function testPlayerTurnLeftAtEastPosition(): void
  {
    $player = new Player(5, 5, 'E');
    $player->turnLeft();
    $this->assertEquals('N', $player->getOrientation());
  }

  public function testPlayerTurnLeftAtSouthPosition(): void
  {
    $player = new Player(5, 5, 'S');
    $player->turnLeft();
    $this->assertEquals('E', $player->getOrientation());
  }

  public function testPlayerTurnLeftAtWestPosition(): void
  {
    $player = new Player(5, 5, 'W');
    $player->turnLeft();
    $this->assertEquals('S', $player->getOrientation());
  }

  public function testPlayerTurnRightAtNorthPosition(): void
  {
    $player = new Player(5, 5, 'N');
    $player->turnRight();
    $this->assertEquals('E', $player->getOrientation());
  }

  public function testPlayerTurnRightAtEastPosition(): void
  {
    $player = new Player(5, 5, 'E');
    $player->turnRight();
    $this->assertEquals('S', $player->getOrientation());
  }

  public function testPlayerTurnRightAtSouthPosition(): void
  {
    $player = new Player(5, 5, 'S');
    $player->turnRight();
    $this->assertEquals('W', $player->getOrientation());
  }

  public function testPlayerTurnRightAtWestPosition(): void
  {
    $player = new Player(5, 5, 'W');
    $player->turnRight();
    $this->assertEquals('N', $player->getOrientation());
  }
}
