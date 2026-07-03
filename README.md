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
# 1. Скопировать .env
cp .env.example .env

# 2. Сборка и запуск контейнеров
docker compose up -d --build

# 3. Генерация ключа приложения
docker compose exec app php artisan key:generate

# 4. Миграции + сидеры (демо-данные)
docker compose exec app php artisan migrate --seed

# 5. Открыть в браузере
#    http://localhost:8080
```

**Тесты:**
```bash
docker compose exec app php artisan test
```

**Если меняются зависимости (`composer.json` / `package.json`):**
```bash
docker compose build --no-cache app
docker compose up -d
```

**Если меняется `.env`:**
```bash
docker compose exec app php artisan key:generate
```

После запуска:

| Сервис               | URL                         |
|----------------------|-----------------------------|
| Сайт                 | http://localhost:8080       |
| Админ-панель         | http://localhost:8080/admin |

> Админ-панель Filament доступна **любому авторизованному пользователю** (отдельной админ-роли не требуется).

**Учётные данные (сидеры):**

| Роль   | Email                     | Пароль    |
|--------|---------------------------|-----------|
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
