# **Propromo** - Project Progress Monitoring

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/postgres-%23316192.svg?style=for-the-badge&logo=postgresql&logoColor=white)
![Redis](https://img.shields.io/badge/redis-%23DD0031.svg?style=for-the-badge&logo=redis&logoColor=white)
![Vite](https://img.shields.io/badge/vite-%23646CFF.svg?style=for-the-badge&logo=vite&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![GitHub Actions](https://img.shields.io/badge/github%20actions-%232671E5.svg?style=for-the-badge&logo=githubactions&logoColor=white)
![Heroku](https://img.shields.io/badge/heroku-%23430098.svg?style=for-the-badge&logo=heroku&logoColor=white)
![AWS](https://img.shields.io/badge/AWS-%23FF9900.svg?style=for-the-badge&logo=amazon-aws&logoColor=white)

> Your client wants to be involved. [Propromo](https://propromo.duckdns.org) makes it possible.

## Development

[![.github/workflows/ci.yml](https://github.com/propromo-software/propromo/actions/workflows/ci.yml/badge.svg)](https://github.com/propromo-software/propromo/actions/workflows/ci.yml)
[![Continuous Deployment/Release - Website](https://github.com/propromo-software/propromo/actions/workflows/release.yml/badge.svg)](https://github.com/propromo-software/propromo/actions/workflows/release.yml)

### Install Dependencies & Run
```bash
start.sh
```

```batch
start.cmd
```

### One By One

#### Database
```bash
docker-compose -f ./docker/postgres.yml up -d
```

#### Cache
```bash
docker-compose -f ./docker/redis.yml up -d
```

#### Website
```bash
php artisan serve --port=80
```

### Testing

![PHP Code Coverage Badge](https://propromo-software.github.io/propromo/coverage.svg)

```bash
php ./vendor/bin/pest
```

## Production

**Deployment URL:**

* https://propromo.duckdns.org
* https://propromo.dnset.com
* https://propromo.simulatan.me
* https://propromo-d08144c627d3.herokuapp.com

[![Better Stack Badge](https://uptime.betterstack.com/status-badges/v1/monitor/zuzz.svg)](https://dub.sh/propromo-status)

## Design

**Wireframes:** [figma.com/propromo](https://dub.sh/propromo-wireframes)
