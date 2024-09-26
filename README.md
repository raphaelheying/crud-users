# Short Url - RPHE

## Table of Contents

- [Visão geral](#visao-geral)
- [Feito com](#feito-com)
- [Instalação](#instalacao)
- [Rodando o projeto](#rodando-o-projeto)
- [Testando](#testando)

## Visão geral

Esse projeto é uma aplicação web para gerenciar usuários.

### Feito com

- Laravel
- Tailwind
- Pest

## Instalação

`git clone https://github.com/raphaelheying/crud-users.git` => clonar esse repositório

`cd crud-users` => selecionar o repositório do projeto

`cp .env.example .env` => copiar o arquivo .env.example para .env

`composer install` => instalar as dependências PHP

`npm install` => instalar as dependências JS

`php artisan migrate` => rodar as migrações do banco de dados

`php artisan key:generate` => definir a chave do aplicativo

`php artisan db:seed` => cria alguns registros no banco de dados para facilitar a visualização

### Rodando o projeto

`php artisan serve` => inicia o servidor local

`npm run dev` => inicia o servidor js local

Acesse http://localhost:8000

### Testando

Com o projeto rodando, você pode testar o código com pest:
`./vendor/bin/pest`