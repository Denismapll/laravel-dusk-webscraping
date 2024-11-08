<?php

namespace Tests\Browser;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Exception;

class ScrapeProductsTest extends DuskTestCase
{
    public function testScrape()
    {
        try {
            $this->browse(function (Browser $browser) {
                // Definindo o número de páginas para percorrer
                $totalPages = 3;

                for ($page = 1; $page <= $totalPages; $page++) {
                    $url = 'https://www.motorola.com.br/smartphones?page=' . $page;
                    $browser->visit($url)
                        ->waitFor('.brmotorolanew-search-result-0-x-galleryItem.brmotorolanew-search-result-0-x-galleryItem--normal.brmotorolanew-search-result-0-x-galleryItem--three.pa4')
                        ->pause(1000);

                    $this->scrapePage($browser, $page);
                }
            });

            // Log de sucesso para indicar que o scraping foi concluído
            Log::info("Scraping concluído com sucesso para todas as páginas.");
        } catch (Exception $e) {
            // Log de erro caso ocorra falha no scraping
            Log::error("Erro no scraping: " . $e->getMessage());
        }
    }

    // Função para fazer o scraping de uma página
    private function scrapePage(Browser $browser, $page)
    {
        try {
            // Obtendo todos os elementos de produtos
            $prices = $browser->elements('.brmotorolanew-motorola-brasil-components-QynAuzddOtECilWCczCK5');
            $names = $browser->elements('.brmotorolanew-motorola-brasil-components-34iB-Thyiy5FVcQlmV3-Dg');
            $images = $browser->elements('.brmotorolanew-search-result-0-x-galleryItem img'); // Supondo que as imagens estejam dentro dessa classe

            // Mapeando os nomes, preços e imagens
            $arrayNames = array_map(function ($name) {
                return $name->getText();
            }, $names);

            $arrayPrices = array_map(function ($price): mixed {
                return $price->getText();
            }, $prices);

            $arrayImages = array_map(function ($image) {
                return $image->getAttribute('src');
            }, $images);

            // Combinando os arrays (nome, preço, imagem)
            $combined = array_map(function ($name, $price, $image) {
                return ['nome' => $name, 'preco' => $price, 'imagem' => $image];
            }, $arrayNames, $arrayPrices, $arrayImages);

            // Verificar se a página possui produtos
            if (empty($combined)) {
                Log::warning("Nenhum produto encontrado na página {$page}.");
                return;
            }

            // Salvando os dados no banco de dados
            foreach ($combined as $produto) {
                $produto['preco'] = preg_replace('/[^\d,]/', '', $produto['preco']);
                $produto['preco'] = str_replace(',', '.', $produto['preco']);
                $valorDecimal = (float) $produto['preco'];

                $estoque = $valorDecimal > 0;

                Product::create([
                    'name' => $produto['nome'],
                    'price' => $valorDecimal,
                    'url' => $produto['imagem'], 
                    'estoque' => $estoque,
                ]);
            }

            // Log de sucesso ao concluir o scraping de uma página
            Log::info("Scraping concluído com sucesso para a página {$page}.");
        } catch (Exception $e) {
            // Log de erro caso ocorra falha na página atual
            Log::error("Erro ao processar a página {$page}: " . $e->getMessage());
        }
    }
}
