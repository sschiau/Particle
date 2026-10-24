[![Latest Stable Version](https://poser.pugx.org/sschiau/particle/v/stable)](https://packagist.org/packages/sschiau/particle)
[![License](https://poser.pugx.org/sschiau/particle/license)](https://packagist.org/packages/sschiau/particle)

# Particle
#### Language: PHP
#### 64bits int Time Based ID Generator

### Uncoordinated
For high availability within and across data centers, machines generating ids should not have to coordinate with each other.

### Solution
* 64-bit PHP 8.5.12 or newer. Older versions are rejected by Composer and at runtime,
  including when loading `Sources/Particle.php` directly.
* Composer verifies PHP and extension requirements when loading its autoloader.
  The runtime guard also enforces the minimum version and 64-bit integers.

Install dependencies with `composer install`, then run
`composer check-platform-reqs` in the deployment environment. Do not bypass the
checks with `--ignore-platform-reqs`. Check the PHP-FPM or Apache runtime as well
as CLI PHP when deploying to a web server.
* Particle Id (64 bits) is composed of:
  * time - 42 bits (millisecond precision w/ a custom epoch)
  * configured machine id - 10 bits - up to 1024 machines
  * sequence number - 12 bits - up to 4096 random numbers

### System Clock Dependency
You should use NTP to keep your system clock accurate.

## How to use it
#### Generate Particle ID
Change const EPOCH in particle class to today epoch time w/ millisecond (13 digits)

```PHP
	$machineID = 0; // Machine ID (aka Server ID no.)
	Particle::generateParticle($machineID);
```

#### Time from Particle ID (w/ millisecond precision)
```PHP
	$particleID = '4611691166465789880';
	Particle::timeFromParticle($particleID);
```
