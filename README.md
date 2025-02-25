# 4nikita

Этот проект предоставляет готовое окружение для выполнения лабораторных работ на PHP с использованием Docker.

## Состав окружения
- **Nginx** – веб-сервер
- **PHP** – интерпретатор
- **MySQL** – база данных

## Установка и запуск
1. Убедитесь, что у вас установлен [Docker](https://www.docker.com/) и [Docker Compose](https://docs.docker.com/compose/).
2. Клонируйте репозиторий:
   ```sh
   git clone https://github.com/aiker1548/4nikita.git
   cd 4nikita
   ```
3. Запустите сервисы:
   ```sh
   docker compose up -d
   ```
4. Откройте в браузере:
   ```
   http://localhost:8080
   ```
   Здесь можно запускать PHP-скрипты.

## Остановка контейнеров
Для остановки контейнеров выполните:
```sh
docker-compose down
```

