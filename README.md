### Server Planning
#### How to run:
##### Running with local php interpreter:
You have to have PHP7.1 or higher version.

Installation:
```bash
composer install
```
Running tests
```bash
./vendor/bin/phpunit
```

##### Running with docker-compose:
```bash
docker-compose up
```

### Quality Metrics:
You can check quality of library from sonarcloud:

https://sonarcloud.io/dashboard?id=volkan_server-planning

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=volkan_server-planning&metric=alert_status)](https://sonarcloud.io/dashboard?id=volkan_server-planning)