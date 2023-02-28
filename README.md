# Simple Symfony (via Docker) Example App
> Basic docker instructions


## How to create app?
> You can change PHP version in `php/Dockerfile`

Run (and build) empty docker container:

```
docker-compose up --build
```

Configure git for creating symfony app:

```
docker-compose exec app git config --global user.name "Your name"
docker-compose exec app git config --global user.email "Your E-mail"
```

Creating a new symfomy app:

```
docker-compose exec app symfony new .
```

Enjoy!
