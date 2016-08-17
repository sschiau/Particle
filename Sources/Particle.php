<?php
/**
 * Copyright 2014-2016 Silviu Schiau.
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

/**
 * @about PHP implementation of Twitter Snowflake ID Generator (64 bit ID)
 * @author Silviu Schiau <pr@silviu.co>
 * @package Schiau
 * @created 1364036124000 (UNIX Time)
 * @version 1.1.1
 * @license Apache License Version 2.0 http://www.apache.org/licenses/LICENSE-2.0.txt
 *
 * Thanks to Twitter for Snowflake.
 */

namespace Schiau\Utilities;

abstract class Particle {
	const EPOCH = 1418801787000;

	public static function generateParticle($machine_id) {
		/*
		* Time - 41 bits
		*/
		$time = floor(microtime(true) * 1000);

		/*
		* Substract custom epoch from current time
		*/
		$time -= self::EPOCH;

		/*
		* Create a base and add time to it
		*/
		$base = decbin(pow(2,40) - 1 + $time);

		/*
		* Configured machine id - 10 bits - up to 512 machines
		*/
		$machineid = decbin(pow(2,9) - 1 + $machine_id);

		/*
		* sequence number - 12 bits - up to 2048 random numbers per machine
		*/
		$random = mt_rand(1, pow(2,11)-1);
		$random = decbin(pow(2,11)-1 + $random);

		/*
		* Pack
		*/
		$base = $base.$machineid.$random;

		/*
		* Return unique time id no
		*/
		return bindec($base);
	}

	public static function timeFromParticle($particle) {
		/*
		* Return time
		*/
		return bindec(substr(decbin($particle),0,41)) - pow(2,40) + 1 + self::EPOCH;
	}
}

?>
