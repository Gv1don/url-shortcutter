# URL Shortcutter

Сервис для сокращения ссылок с отслеживанием переходов и административной панелью.

## Возможности

- Сокращение длинных URL в короткие коды (6 символов)
- Регистрация и авторизация пользователей (Laravel Breeze)
- Личный кабинет: управление своими ссылками (создание, просмотр, удаление)
- Отслеживание кликов: IP, User-Agent, дата, счётчик на ссылке
- Админ-панель Filament: управление всеми ссылками и кликами

## Технологии

- **PHP 8.3** / Laravel 13
- **MySQL 8.4**
- **Nginx 1.27** (alpine)
- **Docker Compose**
- **FilamentPHP** — админ-панель
- **Laravel Breeze** — Blade-шаблоны + аутентификация
- **PHPUnit** — тесты

## Быстрый запуск

```bash
# Сборка и запуск контейнеров
docker compose up -d --build

# Миграции и сидеры
docker compose exec app php artisan migrate --seed

# Запуск тестов
docker compose exec app php artisan test
```

Зависимости (`vendor`, `node_modules`) и собранные ассеты (`public/build`) вшиты в образ. Для обновления — `docker compose build --no-cache app`.

После запуска:

| Сервис               | URL                         |
|----------------------|-----------------------------|
| Сайт                 | http://localhost:8080       |
| Админ-панель         | http://localhost:8080/admin |
| PHPMyAdmin (бонус)   | http://localhost:8081       |

**Учётные данные (сидеры):**

| Роль   | Email                     | Пароль    |
|--------|---------------------------|-----------|
| Админ  | admin@shortcutter.test    | password  |
| Пользователь | demo@shortcutter.test | password  |

## Эндпоинты

| Метод | URL              | Описание                            |
|-------|------------------|-------------------------------------|
| GET   | `/`              | Главная страница                    |
| POST  | `/links`         | Создать короткую ссылку             |
| GET   | `/links`         | Список моих ссылок                  |
| GET   | `/links/{link}`  | Детали ссылки + история кликов      |
| DELETE| `/links/{link}`  | Удалить ссылку                      |
| GET   | `/{shortCode}`   | Редирект на оригинальный URL        |

Swagger/OpenAPI не подключён.
