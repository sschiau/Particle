[![Latest Stable Version](https://poser.pugx.org/sschiau/particle/v/stable)](https://packagist.org/packages/sschiau/particle)
[![Tests](https://github.com/sschiau/Particle/actions/workflows/tests.yml/badge.svg?branch=main)](https://github.com/sschiau/Particle/actions/workflows/tests.yml)
[![License](https://poser.pugx.org/sschiau/particle/license)](https://packagist.org/packages/sschiau/particle)

# Particle

Particle is a PHP library for generating time-based integer IDs without a central
coordination service. Each ID combines a millisecond timestamp, a configured
machine identifier, and a random 12-bit sequence. The original timestamp can be
extracted from a generated ID.

## Requirements

- **PHP 8.5.12 or newer**, running on a 64-bit platform.
- Composer for package installation.
- A system clock synchronized through NTP or an equivalent service.

Composer enforces the PHP version and architecture requirements during
installation. The library also validates both when its source is loaded,
including when used without Composer.

## Installation

Install Particle in your application:

```sh
composer require "sschiau/particle:^3.1"
composer check-platform-reqs --no-dev
```

For web deployments, verify that PHP-FPM or Apache uses a supported PHP runtime
as well as the CLI. Do not bypass platform checks with `--ignore-platform-reqs`.

## Quick start

Configure the machine identifier once before generating IDs. Valid identifiers
range from `0` to `1023`; assign a different identifier to each machine.

```php
<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Schiau\Utilities\Particle;

Particle::machineId(0);

$id = Particle::generateParticle();
$timestampMs = Particle::timeFromParticle($id);

echo 'Particle ID: ' . $id . PHP_EOL;
echo 'Unix timestamp (milliseconds): ' . $timestampMs . PHP_EOL;
```

## API reference

All methods are static and belong to `Schiau\Utilities\Particle`.

| Method | Description |
| --- | --- |
| `machineId(int $machineId): void` | Configures a machine identifier between `0` and `1023`. |
| `generateParticle(): int` | Generates an ID using the configured machine identifier and current time. |
| `timeFromParticle(int $particle): int` | Extracts a Unix timestamp in milliseconds from an ID. |

Calling `generateParticle()` before configuring a machine identifier throws a
`LogicException`. An out-of-range machine identifier throws an
`InvalidArgumentException`. Loading the library on an unsupported runtime throws
a `RuntimeException`.

## ID format and storage

IDs are represented as PHP integers and combine these fields:

| Field | Purpose |
| --- | --- |
| Timestamp | Millisecond time encoded using the library's fixed custom epoch. |
| Machine identifier | 10 bits, supporting 1,024 distinct machine identifiers. |
| Random sequence | 12 bits, providing 4,096 possible values per machine per millisecond. |

Keep the epoch unchanged so existing IDs retain their timestamp meaning. Store
IDs in a 64-bit integer column. Serialize them as decimal strings when sending
them to JavaScript or another consumer that cannot represent large integers
exactly.

## Operational considerations

**Uniqueness.** Random sequence values can repeat. IDs generated on the same
machine in the same millisecond can therefore collide; 4,096 possible sequence
values do not guarantee 4,096 unique IDs. When using IDs as database keys,
enforce a unique constraint and handle duplicate-key failures with a bounded
regeneration and retry policy.

**Clock behavior.** IDs depend on the system clock. Clock rollback can repeat
timestamp values, and IDs generated within one millisecond are not guaranteed
to be ordered. Generation fails if the current time is before the custom epoch.

**Security.** IDs expose timing information and provide limited randomness. Use
separate cryptographically secure tokens for authentication, password resets,
and other secrets.

## Development

From a checkout of this repository, install dependencies and run the checks:

```sh
composer install
composer check-platform-reqs
vendor/bin/phpunit --bootstrap vendor/autoload.php --do-not-cache-result Tests
php Demo/index.php
composer audit --locked
```

CI runs the test suite and dependency audit on a supported PHP 8.5 runtime.
Separate jobs use exact PHP 8.4.27 and 8.5.11 containers to verify that unsupported
versions are rejected by Composer and direct source loading.

See [CONTRIBUTING.md](CONTRIBUTING.md) for contribution guidelines,
[CHANGELOG.md](CHANGELOG.md) for release history, and
[GitHub Releases](https://github.com/sschiau/Particle/releases) for published versions.

## License

Particle is released under the [MIT License](LICENSE.md).
