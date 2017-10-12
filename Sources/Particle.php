<?php
/**
 * @author Silviu Schiau <pr@silviu.co>
 * @package Schiau
 * @version 2.2.1
 * @license Apache License Version 2.0 http://www.apache.org/licenses/LICENSE-2.0.txt
 *
 * Copyright 2014-2017 Silviu Schiau.
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

namespace Schiau\Utilities;

abstract class Particle
{
    const EPOCH = 1479533469598;
    const MAX12BIT = 4095;
    const MAX41BIT = 1099511627775;

    protected static $machineId = null;

    public static function machineId($mId)
    {
        self::$machineId = $mId;
    }

    public static function generateParticle()
    {
        /*
		* Time - 42 bits
		*/
        $time = floor(microtime(true) * 1000);

        /*
		* Substract custom epoch from current time
		*/
        $time -= self::EPOCH;

        /*
		* Create a base and add time to it
		*/
        $base = decbin(self::MAX41BIT + $time);

        /*
		* Configured machine id - 10 bits - up to 1024 machines
		*/
        $machineid = str_pad(decbin(self::$machineId), 10, "0", STR_PAD_LEFT);

        /*
		* sequence number - 12 bits - up to 4096 random numbers per machine
		*/
        $random = str_pad(decbin(mt_rand(0, self::MAX12BIT)), 12, "0", STR_PAD_LEFT);

        /*
		* Pack
		*/
        $base = $base.$machineid.$random;

        /*
		* Return unique time id no
		*/
        return bindec($base);
    }

    public static function timeFromParticle($particle)
    {
        /*
		* Return time
		*/
        return bindec(substr(decbin($particle), 0, 41)) - self::MAX41BIT + self::EPOCH;
    }
}
