#Particle
####Language: PHP 
####64bits int Time Based ID Generator
PHP extended implementation of Twitter Snowflake ID Generator

### Uncoordinated
For high availability within and across data centers, machines generating ids should not have to coordinate with each other.

### Solution
* PHP (tested on version 5.5.3)
* id (64 bits) is composed of:
  * time - 41 bits (millisecond precision w/ a custom epoch)
  * configured machine id - 10 bits - up to 512 machines
  * sequence number - 12 bits - up to 2048 random numbers

### System Clock Dependency
You should use NTP to keep your system clock accurate.

## How to use it
#### Generate Particle ID
1. Change const EPOCH in particle class to today epoch time w/ miliseconds (13 digits) 

```PHP
echo (new Particle)->generateParticle(machine_id); //for PHP 5.4.13
```

### Time from Particle ID (w/ milisecond precision)
<code>
	$machineID = 1; // Machine ID (aka Server ID no)
	
	Particle::generateParticle($machineID);
</code>


## License
Apache License Version 2.0
http://www.apache.org/licenses/LICENSE-2.0.txt
