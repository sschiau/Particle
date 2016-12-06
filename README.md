[![Build Status](https://travis-ci.org/sschiau/Particle.svg?branch=master)](https://travis-ci.org/sschiau/Particle)

#Particle
####Language: PHP
####64bits int Time Based ID Generator
PHP implementation of Twitter Snowflake ID Generator

### Uncoordinated
For high availability within and across data centers, machines generating ids should not have to coordinate with each other.

### Solution
* PHP (tested on version 5.5.3)
* id (64 bits) is composed of:
  * time - 42 bits (millisecond precision w/ a custom epoch)
  * configured machine id - 10 bits - up to 1024 machines
  * sequence number - 12 bits - up to 4096 random numbers

### System Clock Dependency
You should use NTP to keep your system clock accurate.

## How to use it
#### Generate Particle ID
Change const EPOCH in particle class to today epoch time w/ miliseconds (13 digits)

```PHP
	$machineID = 0; // Machine ID (aka Server ID no)

	Particle::generateParticle($machineID);
```

#### Time from Particle ID (w/ milisecond precision)
```PHP
	$particleID = '4611692470816737853';

	Particle::timeFromParticle($particleID);
```
