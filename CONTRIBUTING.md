# Contributing
Thank you for your interest in improving Particle. Follow the rules below to ensure consistent and clean contributions.

## Requirements
Use PHP 64-bit  
Use Composer for dependencies  
Follow PSR standards for coding style and autoloading  
Write clear commit messages

## Development setup
Clone the repository  
Run  
composer install

## Tests
All changes must include tests or must not break existing tests  
Run tests with  
vendor/bin/phpunit

## Pull requests
Create a feature branch  
Keep changes focused  
Update documentation when behavior changes  
Ensure the test suite passes before opening a pull request

## Issues
Provide a reproducible example  
Specify PHP version  
Specify operating system  
Specify expected result and actual result

## Security
Do not report security concerns in public issues  
Use private responsible disclosure channels

## Code style
Use strict types  
Use clear naming  
Avoid unnecessary dependencies  
Limit global state

## Release process
Version changes follow semantic versioning  
Update changelog when behavior changes