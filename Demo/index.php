<?php
/**
 * @author Silviu Schiau <pr@silviu.co>
 * @package Schiau
 * @version 2.2.2
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

require __DIR__ . '/../vendor/autoload.php';

use Schiau\Utilities\Particle;

Particle::machineId(0);
$id = Particle::generateParticle();

var_dump('Particle ID: ' . $id);
var_dump('Time UNIX: ' . Particle::timeFromParticle($id));

?>
