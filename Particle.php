<?php

/*
	Author: Silviu Schiau (@sschiau on Twitter)
	Web: www.schiau.co
	File: Particle.php
	Created: 1364036124000 (UNIX Time)
	About: PHP implementation of Twitter Snowflake ID Generator (Extended to 42bits epoch for 96 years 1 month 21 days 16 hours 42 minutes 24 seconds in the future)
	License: Apache License Version 2.0 http://www.apache.org/licenses/LICENSE-2.0.txt

	Thanks to Twitter for Snowflake.
	This header should NOT be removed if you want to use Particle.
*/

class Particle
{
	const EPOCH=1364036124000;
	
	final public function generateParticle($machine_id)
	{
		//Time - 42 bits (millisecond precision w/ a custom epoch gives us 96 years 1 month 21 days 16 hours 42 minutes 24 seconds in the future)
		$time = floor(microtime(true) * 1000);
		
		//Substract custom epoch from current time
		$time -= self::EPOCH;
		
		//Add to base
		$base = pow(2,41);
		$base += $time;
		$base = decbin($base);
		
		//configured machine id - 10 bits - to 1024 machines
		$machineid = decbin($machine_id);
		
		//sequence number - 12 bits - up to 4096 random numbers per machine
		$random = mt_rand(0,pow(2,12)-1);
		$random = decbin($random);
		
		//Pack
		$base = $base.$machineid.$random;
		
		return base_convert($base,2,10);
	}
	
	final public function timeFromParticle($particle)
	{
		return base_convert(substr(base_convert($particle,10,2),0,42),2,10)-pow(2,41)+self::EPOCH;
	}
}

?>