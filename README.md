# taskRush-Back

## Requisitos do Projeto

- Laravel v10.0.0 
- PHP v8.2.12
- MYSQL v8.0.33
- Composer version 2.6.6
- Docker version 24.0.2

## Ferramentas
- Postman
- Workbench
- VS CODE
- 
## Instalando o Laravel

Instalando versão 8.0
```bash
composer create-project laravel/laravel:^10.  “taskRush”
```
Entre na pasta da projeto e desde a pasta rode o comando.
```bash
php artisan serve
```
No navegador no endereço configurado por padrão **127.0.0.1:8000** será publicado.

## Criando a Base de dados

Apôs instalação do MySQL rodar:
```SQL
CREATE DATABASE taskRush
```
## Configuração env LARAVEL

- Configuração do arquivo “.env” com a base mysql
- Abrir no SUBLIME ou VSCODE

~~~php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=taskRush
DB_USERNAME=root
DB_PASSWORD=root
~~~

Testando o ARTISAN e aplicando migrates:

```bash
php artisan
php artisan migrate:install
php artisan migrate:status
php artisan migrate
php artisan migrate:status
```

## Instalando o **AdminLTE**

Dentro da pasta do projeto LARAVEL rodar os comando a seguir:

Baixar
```bash
composer require jeroennoten/laravel-adminlte
```

### verificar 

```bash
Package fruitcake/laravel-cors is abandoned, you should avoid using it. No replacement was suggested.
Package swiftmailer/swiftmailer is abandoned, you should avoid using it. Use symfony/mailer instead.
```

Instalar
```bash
php artisan adminlte:install
```
Complementos
```bash
composer require laravel/ui
```
Autenticação
```bash
php artisan ui bootstrap --auth
```
Ativando Recursos
```bash
php artisan adminlte:install --only=auth_views
php artisan adminlte:install --only=basic_views
php artisan adminlte:plugins install

php artisan storage:link

```
### Outras configurações:
https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Installation

### Documentação Laravel:
https://laravel.com/

### Mais informações:
Para mudar o idioma de inglês para português altera o arquivo /config→app.php
~~~php
'locale' => 'pt-br',

'timezone' => 'America/Sao_Paulo',
~~~
