# Documentação API

![GitHub language count](https://img.shields.io/github/languages/top/KSouzaEng/store_api) ![GitHub language count](https://img.shields.io/github/languages/count/KSouzaEng/store_api)  ![GitHub language count](https://img.shields.io/github/last-commit/KSouzaEng/store_api)  




## Roteamento da API

- As funções de roteamento desta API encontram-se dentro da pasta routes no arquivo api.php e contam com as seguintes rotas:

```
Route::post('login', [AuthController::class,'login']);
Route::post('logout',  [AuthController::class,'logout']);
Route::post('refresh',  [AuthController::class,'refresh']);
Route::get('me', [AuthController::class,'me']);


Route::post('register', [UserController::class,'register']);

Route::middleware(['auth'])->group(function () {

Rotas do Usuário

    Route::put('/user/update/{id}', [UserController::class,'update']);
    Route::delete('delete/user/{id}',[UserController::class,'destroy']);

 Rotas do Cliente
        Route::post('register/cliente', [ClienteController::class,'registerCliente']);
        Route::get('get/cliente/{search}',[ClienteController::class,'search']);

        Route::put('/update/cliente/{id}',[ClienteController::class,'updateCliente']);
        Route::delete('delete/cliente/{id}',[ClienteController::class,'destroy']);
    });


```
##  Modelos

- A API conta com os Modelos:  
  
```
  Cliente: App/Models/Cliente
  Telefone: App/Models/Telefone
  TipoCliente: App/Models/TipoCliente
  User: App/Models/User
  VendedorCliente: App/Models/VendedorCliente
```
## As tabelas do banco de dados são:
```
  Clientes: database/migrations/2022_03_28_020414_create_clientes_table.php
  Telefones: database/migrations/2022_03_28_021431_create_telefones_table.php
  Tipo de Clientes:database/migrations/2022_03_28_021505_create_tipo_clientes_table.php
  Vendedores:database/migrations/2022_03_28_023341_create_vendedor_clientes_table.php
  Jobs:database/migrations/2022_03_29_223216_create_jobs_table.php
```
##  Implementando as funções

- As funções descritas nas rotas encontram-se em : 
  
```
  Cliente: App/Htpp/Controllers/ClienteController
   - registerCliente - registra o cliente
   - search -  Faz busca pelo nome do cliente
   - updateCliente - Atualiza os dados do cliente
   - destroy - Deleta o cliente da base de dados

  Usuários: App/Htpp/Controllers/AuthController
  - login - Entrada do usuário na aplicação
  - logout - Saída do usuário da aplicação
  - me - Lista dados de um usuário
  - refresh - atualiza o token da sessão

  Vendedor: App/Htpp/Controllers/UserController
  - register - registra o vendedor no sistema
  - update  - Atualiza os dados do vendedor
  - destroy -  Deleta o vendedor da base de dados
```
## Instalação do projeto
Para iniciar o desenvolvimento, é necessário clonar o projeto do GitHub em um diretório de sua preferência:

 ```
  Caso esteja usando o laragon entre em cd "C:\laragon\www "  e abra o cmd ou terminal nesta pasta e cole o comando a seguir  
    git clone https://github.com/KSouzaEng/store_api.git

Caso esteja usando o laragon entre em cd "C:\xampp\htdocs"  e abra o cmd ou terminal nesta pasta e cole o comando a seguir
   git clone https://github.com/KSouzaEng/store_api.git

Ou cole em sua pasta de preferência
 ```

##  Configurando a aplicação 
  Antes de rodar a aplicação é necessário executar os seguintes commandos.
```
  composer install

  cp .env.example .env

  php artisan key:generate

  php artisan jwt:secret

  php artisan migrate --seed 

```
obs: A flag --seed gera usuarios falasos que podem logar no sistema, senha padrão é  **password**


obs2: caso o jwt não seja reconhecido você pode usar o comendo   php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider", para publicá-lo


## Arquivo de banco de dados

- O arquivo de banco de dados encontra-se na raiz do projeto e tem como nome .env, dentro deste arquivo você configura a sua conexão com a base de dados.
  
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=store
DB_USERNAME=root
DB_PASSWORD=
```
## Envio de email
- Para enviar e-mail da aplicação é necessário adicionar a configuração
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=d6d20ebf6da463
MAIL_PASSWORD=f4daf8aff8fd44
MAIL_ENCRYPTION=tls
```
## Rodando a api
```shell
php artisan serve
```
## Rodando as filas
```shell
  php artisan queue:work --tries=3  

  obs: 3 é o numero de tentativas realizadas para o envio da notificação pode ser alterado para um numero maior de tentativas
```
## Consumir a API 

para consumir a api pode ser usado o Postman ou o Insomnia

- [Postman](https://www.postman.com/downloads/)
- [Insomnia](https://insomnia.rest/download)

## Visualizar o código

[Visual Studio Code: Para editar do projeto ](https://code.visualstudio.com/download)

## Melhorias

```
Implementar  um interface
Implementar testes automatizados
Implementar mais validações de campos
```
