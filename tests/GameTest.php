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
}
