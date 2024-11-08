<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <title>Listagem Produtos</title>
    <style>
        svg {
            width: 20px;
        }

        p {
            margin-top: 15px;
        }

        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5); /* Fundo do modal transparente */
        }

        .modal-content {
            background-color: transparent; /* Torna o conteúdo do modal transparente */
            border: none;
        }

        .modal-body img {
            width: 100%;
            max-height: 80vh;
            object-fit: contain;
        }
        .modal-header {
            border: none;
        }
        .img-celular { 
            transition: 300ms all;
        }
        .img-celular:hover {
            transform: scale(1.15)
        }
    </style>
</head>

<body>

    <section>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 col-12">
                    <h1 class="text-center">Produtos</h1>

                    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="estoque" class="form-label">Em Estoque</label>
                                <select name="estoque" class="form-select" id="estoque">
                                    <option value="">Selecione</option>
                                    <option value="1" {{ request('estoque') == '1' ? 'selected' : '' }}>Em estoque</option>
                                    <option value="0" {{ request('estoque') == '0' ? 'selected' : '' }}>Sem estoque</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="preco_min" class="form-label">Preço Mínimo</label>
                                <input type="number" name="preco_min" class="form-control" id="preco_min" value="{{ request('preco_min') }}" step="0.01">
                            </div>
                            <div class="col-md-3">
                                <label for="preco_max" class="form-label">Preço Máximo</label>
                                <input type="number" name="preco_max" class="form-control" id="preco_max" value="{{ request('preco_max') }}" step="0.01">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Foto</th>
                                <th scope="col">Nome</th>
                                <th scope="col">
                                    <a class="text-black" href="{{ route('products.index', ['sort' => 'price', 'order' => request('order') === 'asc' ? 'desc' : 'asc'] + request()->except('page')) }}">
                                        Preço 
                                        <i class="fas fa-sort"></i>
                                    </a>
                                </th>
                                <th scope="col">Estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <!-- Imagem clicável que abre o modal -->
                                        <img class="img-celular" src="{{ $product->url }}" alt="Imagem do Produto" width="64px" data-bs-toggle="modal"
                                            data-bs-target="#imageModal{{ $product->id }}">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>R$ {{ $product->price }}</td>
                                    <td>
                                        @if ($product->estoque)
                                            Em estoque!
                                        @else
                                            Sem estoque!
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal de Imagem -->
                    @foreach ($products as $product)
                        <div class="modal fade" id="imageModal{{ $product->id }}" tabindex="-1"
                            aria-labelledby="imageModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Imagem grande do produto -->
                                        <h2>{{$product->name}}</h2>
                                        <img src="{{ $product->url }}" alt="Imagem do Produto" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-center align-items-center text-center">
                        {!! $products->appends(request()->query())->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
