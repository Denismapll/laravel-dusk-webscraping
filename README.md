# Projeto Completo de Web Scraping com Laravel Dusk

Este projeto utiliza Laravel Dusk para realizar web scraping em uma página de e-commerce, coletando informações de produtos e exibindo esses dados em uma interface web.

## Funcionalidades

-   Coleta automática de dados como nome, preço, descrição e URL da imagem dos produtos.
-   Exibe os produtos coletados na página `/products`.
-   Estruturação do projeto no padrão MVC (Model-View-Controller).
-   Testes automatizados de scraping usando Laravel Dusk.

## Tecnologias

-   **Laravel 10.x**
-   **Laravel Dusk**
-   **PHP 8.x**
-   **MySQL**

## Instalação e Configuração

1. Instale as dependências do projeto executando o comando:

```bash
composer update
```

## Configuração do Ambiente

1. Copie o arquivo `.env.example` e renomeie para `.env`.
2. Configure as variáveis de ambiente no `.env`, especialmente o banco de dados e o ambiente de execução.

### Gere a chave da aplicação

Execute o comando:

```bash
php artisan key:generate
```

### Criação das tabelas no banco de dados

Execute o comando:

```bash
php artisan migrate
```

### Inicie o servidor de desenvolvimento

Execute o comando:

```bash
php artisan serve
```

## Acesse a página de produtos

No navegador, vá para: [http://localhost:8000/products](http://localhost:8000/products).

## Executando o Web Scraping

Para rodar o processo de scraping e coletar os dados dos produtos, execute o comando:

```bash
php artisan dusk
```

Esse comando inicia o Laravel Dusk, que navega pela página de e-commerce configurada no projeto, coleta as informações dos produtos e salva os dados no banco de dados.

## Visualize os produtos coletados

Acesse a página de produtos na URL [http://localhost:8000/products](http://localhost:8000/products) para ver as informações coletadas pelo scraping.
