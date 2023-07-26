<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\Game\Player;

/**
 * @author Brandon VOUVOU
 */
final class GameTest extends TestCase
{
  public function testInitialValuesPlayer(): void
  {
    $player = new Player(5, 5, 'N');
    $this->assertEquals(5, $player->getPosX());
    $this->assertEquals(5, $player->getPosY());
    $this->assertEquals('N', $player->getOrientation());
  }

  public function testTurnLeftForPlayerAtNorthPosition(): void
  {
    $player = new Player(5, 5, 'N');
    $player->turnLeft();
    $this->assertEquals('W', $player->getOrientation());
  }

  public function testTurnLeftForPlayerAtEastPosition(): void
  {
    $player = new Player(5, 5, 'E');
    $player->turnLeft();
    $this->assertEquals('N', $player->getOrientation());
  }

  public function testTurnLeftForPlayerAtSouthPosition(): void
  {
    $player = new Player(5, 5, 'S');
    $player->turnLeft();
    $this->assertEquals('E', $player->getOrientation());
  }

  public function testTurnLeftForPlayerAtWestPosition(): void
  {
    $player = new Player(5, 5, 'W');
    $player->turnLeft();
    $this->assertEquals('S', $player->getOrientation());
  }

  public function testTurnRightForPlayerAtNorthPosition(): void
  {
    $player = new Player(5, 5, 'N');
    $player->turnLeft();
    $this->assertEquals('E', $player->getOrientation());
  }

  public function testTurnRightForPlayerAtEastPosition(): void
  {
    $player = new Player(5, 5, 'E');
    $player->turnLeft();
    $this->assertEquals('S', $player->getOrientation());
  }

  public function testTurnRightForPlayerAtSouthPosition(): void
  {
    $player = new Player(5, 5, 'S');
    $player->turnLeft();
    $this->assertEquals('W', $player->getOrientation());
  }

  public function testTurnRightForPlayerAtWestPosition(): void
  {
    $player = new Player(5, 5, 'W');
    $player->turnLeft();
    $this->assertEquals('N', $player->getOrientation());
  }
}
