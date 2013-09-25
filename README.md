#Particle 
###64bits int Time Based ID Generator
PHP extended implementation of Twitter Snowflake ID Generator (Extended to 42bits epoch for 96 years 1 month 21 days 16 hours 42 minutes 24 seconds in the future)


## Uncoordinated
For high availability within and across data centers, machines generating ids should not have to coordinate with each other.

##  Solution
* PHP (tested on version 5.5.3)
* id (64 bits) is composed of:
  * time - 42 bits (millisecond precision w/ a custom epoch gives us 96 years 1 month 21 days 16 hours 42 minutes 24 seconds in the future)
  * configured machine id - 10 bits - up to 1024 machines
  * sequence number - 12 bits - up to 4096 random numbers

### System Clock Dependency
You should use NTP to keep your system clock accurate.

## How to use it
### Generate Particle ID
1. Change const EPOCH in particle class to today epoch time w/ miliseconds (13 digits)
2. Import Particle class
3. <code>
echo (new Particle)->generateParticle(machine_id); //for PHP 5.4.13
</code>

### Time from Particle ID (w/ milisecond precision)
<code>
echo (new Particle)->timeFromParticle(particle_id); //for PHP 5.4.13
</code>


## License
Apache License Version 2.0
http://www.apache.org/licenses/LICENSE-2.0.txt
