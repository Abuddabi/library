# library
Простое web приложение с CRUD функционалом.

Для того чтобы поднять приложение необходимо:<br>
&bull; скачать проект<br>
&bull; в консоли выполнить команду composer install (сам композер должен быть установлен)<br>
&bull; переименовать файл .env.template в .env <br>
&bull; вписать в файл .env доступы к базе данных (логин, пароль, название БД для создания) <br>
&bull; выполнить команду php bin/console doctrine:database:create (создаст БД)<br>
&bull; выполнить команду php bin/console doctrine:migrations:migrate (создаст таблицы в БД)<br>

Версии программ окружения:<br>
&bull; OS Ubuntu 18.04<br>
&bull; Symfony 4.4<br>
&bull; PHP 7.3.14<br>
&bull; Apache 2.4.29
