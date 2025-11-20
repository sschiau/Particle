<?php
/**
 * @author Silviu Schiau <pr@silviu.co>
 * @package Schiau
 * @version 3.0
 * @license Apache License Version 2.0 http://www.apache.org/licenses/LICENSE-2.0.txt
 *
 * Copyright 2014-2025 Silviu Schiau.
 *
 * This copyright notice
 * shall be included in all copies or substantial portions of the software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 */

declare(strict_types=1);

namespace Schiau\Utilities;

final class Particle
{
    // Same constants as your original code
    private const EPOCH     = 1763632028001;
    private const MAX_12BIT = 4095;
    private const MAX_41BIT = 1099511627775;

    private static ?int $machineId = null;

    /**
     * Configure machine id in range 0..1023
     */
    public static function machineId(int $machineId): void
    {
        if (PHP_INT_SIZE < 8) {
            throw new \RuntimeException('Particle requires 64 bit PHP');
        }

        if ($machineId < 0 || $machineId > 1023) {
            throw new \InvalidArgumentException('machineId must be between 0 and 1023');
        }

        self::$machineId = $machineId;
    }

    /**
     * Generate id
     */
    public static function generateParticle(): int
    {
        if (self::$machineId === null) {
            throw new \LogicException('machineId must be set before use');
        }

        // Time in milliseconds
        $time = (int) floor(microtime(true) * 1000);

        // Subtract custom epoch
        $time -= self::EPOCH;

        if ($time < 0) {
            throw new \RuntimeException('Current time is before custom epoch');
        }

        // Create a base
        $base = decbin(self::MAX_41BIT + $time);

        // Create machineId - 10 bits - up to 1024 machines
        $machineBits = str_pad(
            decbin(self::$machineId),
            10,
            '0',
            STR_PAD_LEFT
        );

        // Sequence number - 12 bits - up to 4096 random numbers per machine
        $sequenceBits = str_pad(
            decbin(random_int(0, self::MAX_12BIT)),
            12,
            '0',
            STR_PAD_LEFT
        );

        // Pack
        $binary = $base . $machineBits . $sequenceBits;

        // Return time
        return bindec($binary);
    }

    /**
     * Extract time in milliseconds from id
     */
    public static function timeFromParticle(int $particle): int
    {
        $binary = decbin($particle);
        $timeBits = substr($binary, 0, 41);

        if ($timeBits === '' || strlen($timeBits) !== 41) {
            throw new \InvalidArgumentException('Invalid particle id');
        }

        $value = bindec($timeBits);

        return $value - self::MAX_41BIT + self::EPOCH;
    }
}

?>
