## 3.1.2 (October 24 2026)
- Refresh the README with installation instructions, a working quick-start example, and an API reference.
- Document ID storage, collision handling, clock behavior, security considerations, and deployment requirements.
- Add the test status badge and clarify development and compatibility checks.
- Keep runtime requirements and ID generation behavior unchanged.

## 3.1.1 (October 24 2026)
- Fix unsupported-version CI checks by using exact PHP 8.4.27 and 8.5.11 container images instead of setup-php, which resolves patch versions to a minor release.
- Verify the actual PHP version before running compatibility checks.
- Run the supported PHP 8.5 job with an explicit minimum-version and 64-bit check.
- Keep the PHP 8.5.12 minimum requirement and ID generation behavior unchanged.

## 3.1.0 (October 24 2026)
- Require 64-bit PHP 8.5.12 or newer in Composer and when loading the library directly.
- Enable Composer runtime platform checks and refresh lockfile metadata.
- Run CI on PHP 8.5.12 and verify that PHP 8.4.27 and 8.5.11 are rejected.
- Correct the test workflow filename, load the test suite explicitly, and check dependency security advisories.
- Document the PHP requirement and deployment checks.

## 3.0.0 (November 20 2025)
Added strict types and modern PHP syntax
Added full namespace compliance
Added validation for machineId and runtime environment
Added enforcement of sixty four bit PHP requirement
Added random_int for sequence generation to improve security quality
Added consistent binary layout matching legacy format
Added safer time extraction method with clear error states
Added updated demo page example
Added updated PHPUnit tests using current PHPUnit conventions
Removed deprecated patterns such as loose typing and mt_rand
Removed any silent failure paths

## 2.2.2 (October 19 2017)
Use composer autoload files

## 2.2.1 (August 26 2017)
Fixed Unit Testing for PHPUnit 6.4 plus

## 2.2.0 (December 23 2016)
Cleanup
