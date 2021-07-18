@extends('layout')

@section('cabecalho')
    Criando série    
@endsection


@section('conteudo')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-md-8 mb-1">
                <label for="nome-serie">Nome</label>
                <input type="text" class="form-control mt-2" id="nome-serie" name="serie" placeholder="Digite o nome da série...">
            </div>
            
            <div class="col-md-2 mb-1">
                <label for="temporadas">N° temporadas</label>
                <input type="number" class="form-control mt-2" id="temporadas" name="temporadas" >
            </div>
            
            <div class="col-md-2 mb-1">
                <label for="espisodios">N° Episódios</label>
                <input type="number" class="form-control mt-2" id="espisodios" name="episodios" >
            </div>
            
        </div>
        <button class="btn btn-success mb-2">Criar</button>
        <a href="/serie" class="btn btn-primary mb-2">Voltar</a>
    </form>
@endsection