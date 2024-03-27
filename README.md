### README.md еще будет дописываться в процессе работы

## CRM APP

Приложение, в котором можно:

* Вести проекты
* Создавать задачи под определенные проекты
* Назначать задачи исполнителям

### Используемые технологии:

* PHP 8.3
* MySQL
* Docker
* Laravel 10

Для скачивания проекта используйте команду:

```
git clone https://github.com/travorpirog/crm_app.git
```

Перед запуском приложения необходимо создать .env файл в корне проекта.
Для простоты работы есть .env.example (его необходимо скопировать и переименовать).
Далее выполнить:

```
sail composer install
```

Для запуска приложения необходимо, чтобы был включен docker и установлен sail

1. **Запуск приложения происходит командой:**
    ```
    sail up
    ```

2. **Для создания ссылки на storage воспользуйтесь командой:**
    ```
    sail artisan storage:link
    ```

3. **Для запуска миграции и сидов воспользуйтесь командой:**
    ```
    sail artisan migrate --seed
    ```
4. **Посмотреть доступные роуты можно командой:**
    ```
   sail artisan route:list
   ```
