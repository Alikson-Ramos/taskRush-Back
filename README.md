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

## Sobre o Laravel

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Laravel é um framework de aplicações web com sintaxe expressiva e elegante. Acreditamos que o desenvolvimento deve ser uma experiência agradável e criativa para ser verdadeiramente gratificante. O Laravel simplifica o desenvolvimento facilitando tarefas comuns usadas em muitos projetos da web, como:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

O Laravel é acessível, poderoso e fornece as ferramentas necessárias para aplicativos grandes e robustos.

## Learning Laravel

Laravel [documentation](https://laravel.com/docs)
Laracasts [Laracasts](https://laracasts.com)

## Vulnerabilidades de segurança

Se você descobrir uma vulnerabilidade de segurança no Laravel, envie um e-mail para Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). Todas as vulnerabilidades de segurança serão prontamente abordadas.

## Licença

A estrutura Laravel é um software de código aberto licenciado sob a [MIT license](https://opensource.org/licenses/MIT).

http://displaysolutions.samsung.com/docs/display/MS1/Open+API#breadcrumbs
