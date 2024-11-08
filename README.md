<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Completo de Web Scraping com Laravel Dusk</title>
</head>
<body>
    <h1>Projeto Completo de Web Scraping com Laravel Dusk</h1>

    <p>Este projeto utiliza Laravel Dusk para realizar web scraping em uma página de e-commerce, coletando informações de produtos e exibindo esses dados em uma interface web.</p>

    <h2>Funcionalidades</h2>
    <ul>
        <li>Coleta automática de dados como nome, preço, descrição e URL da imagem dos produtos.</li>
        <li>Exibe os produtos coletados na página <code>/products</code>.</li>
        <li>Estruturação do projeto no padrão MVC (Model-View-Controller).</li>
        <li>Testes automatizados de scraping usando Laravel Dusk.</li>
    </ul>

    <h2>Tecnologias</h2>
    <ul>
        <li><strong>Laravel 10.x</strong></li>
        <li><strong>Laravel Dusk</strong></li>
        <li><strong>PHP 8.x</strong></li>
        <li><strong>MySQL</strong></li>
    </ul>

    <h2>Instalação e Configuração</h2>

    <p><strong>Instale as dependências do projeto:</strong></p>
    <pre><code>composer update</code></pre>

    <p><strong>Configuração do ambiente:</strong></p>
    <p>Copie o arquivo <code>.env.example</code> e renomeie para <code>.env</code>.</p>
    <p>Configure as variáveis de ambiente no <code>.env</code>, especialmente o banco de dados e o ambiente de execução.</p>

    <p><strong>Gere a chave da aplicação:</strong></p>
    <pre><code>php artisan key:generate</code></pre>

    <p><strong>Crie as tabelas no banco de dados:</strong></p>
    <pre><code>php artisan migrate</code></pre>

    <p><strong>Inicie o servidor de desenvolvimento:</strong></p>
    <pre><code>php artisan serve</code></pre>

    <p><strong>Acesse a página de produtos:</strong></p>
    <p>No navegador, vá para: <a href="http://localhost:8000/products" target="_blank">http://localhost:8000/products</a></p>

    <h2>Executando o Web Scraping</h2>

    <p><strong>Para rodar o processo de scraping e coletar os dados dos produtos:</strong></p>

    <p>Execute o comando Laravel Dusk:</p>
    <pre><code>php artisan dusk</code></pre>

    <p>Esse comando inicia o Laravel Dusk, que navega pela página de e-commerce configurada no projeto, coleta as informações dos produtos e salva os dados no banco de dados.</p>

    <p><strong>Visualize os produtos coletados:</strong></p>
    <p>Acesse a página de produtos na URL <a href="http://localhost:8000/products" target="_blank">http://localhost:8000/products</a> para ver as informações coletadas pelo scraping.</p>

</body>
</html>
