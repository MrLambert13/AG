## Проект АВТОГИГАНТ v.0.1

###### _php7.3, mariaDB 10, php.xdebug, nginx_

Для разворачивания проекта:  
1) не забываем настроить файл **`vagrant-local.yml`**  
2) имя домена `autogigant.local` (ip: `192.168.83.2)`, нужно добавить в `hosts` (Если само не добавилось)
3) Сделать `vagrant up`
4) В папку `config` добавить файл `db.php` (можно взять образец в папке `/migrations/SQL/`)
5) пробросить `порт` для доступа к `mysql`  
6) Сделать `yii migrate`
7) Выполнить файл `/migrations/SQL/Insert test data.sql` для наполнения базы

