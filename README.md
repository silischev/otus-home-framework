home-framework
==============

Развёртывание:

```
composer install
```

```
docker-compose up -d
```

Далее скопировать файл .env.dist в .env со своими настройками подключения к БД.

Примеры маршрутов:
```
/get-films-by-period?from=1922-01-01&to=1931-01-01
/get-films-by-genre?genre=Sci-Fi
/get-films-by-profession?profession=Doctor
/get-films-by-age-range?from=11&to=13
```