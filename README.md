# Teste FullStack inoc

-> Back-end

* MVC
* Docker
* Laravel10x

->front-end

* inoc vue

## Referência

 - [Laravel](https://laravel.com/docs/10.x)
 - [inoc](https://ionicframework.com/docs/vue/overview)

## Instalação

Se preferi pode roda na sua maquina local, mas vai precisa de no minimo php8 para roda com o laravel.

Meu guia é para rodar com docker:

1. Crie o containeres do laravel,ele ira cria o projeto laravel e o banco mysql, configuração esta no docker-compose.yml, você pode verificar o .env e edita-lo como acha necessario.

```
docker composer up -d
```

2. Eu indico roda proximo comando dentro da imagem docker, assim evitando possiveis conflitos locais e não avento necessidade de instalação de mais nada para roda o projeto.

```
composer install
```

3. Ainda dentro do container rode o comando para roda as migrations junto das seed's, assim já terá um banco de dados com dados facticicios, usei o Factory.

```
php artisan make:migrate --seed
```


## Task's

 * [x] Implementar rotina de Login
    > Ao registra um novo user(premisionario) dispara e-mail com a primeira senha de acesso do mesmo.

 * [x] Implementar rotina para que os novos permissionários possam logar no sistema.

 * [x] Implementar CRUD dos permissionários(Users) para serem consumido via API.

 * [x] Implementar CRUD de Locais para serem consumidos via API.

 * [x] Implementar CRUD de permissionários para serem consumidos via API.
