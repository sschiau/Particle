<?php
require 'Sources/Particle.php';

use PHPUnit\Framework\TestCase;
use Schiau\Utilities\Particle;

class ParticleTest extends TestCase
{
    public function __construct() {
        Particle::machineId(0);
    }

    /**
     * @covers Particle::length
     */
    public function testParticleLength()
    {
        $particleId = Particle::generateParticle();
        $this->assertEquals(19, strlen((string)$particleId));
    }

    /**
     * @covers Particle::timeFromParticle
     */
    public function testTimeLengthFromParticle()
    {
        $particleId = Particle::generateParticle();
        $time = Particle::timeFromParticle($particleId);
        $this->assertEquals(13, strlen((string)$time));
    }
}
?>
