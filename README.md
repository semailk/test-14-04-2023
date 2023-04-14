Тестовое задание: [ТЗ.txt](%D0%A2%D0%97.txt)

1. В корневой папке запускаем команду ./vendor/bin/sail up
2. Копируем cp .env.example .env
3. Обновляем покеты ./vendor/bin/sail composer update
4. Гинерируем ключ ./vendor/bin/sail artisan key:generate
5. Запускаем миграции и сиды ./vendor/bin/sail php artisan migrate --seed
6. Для тестирования API "Открываем файл в корневой [openapi.yaml](openapi.yaml)" в которой описаный все роуты.
