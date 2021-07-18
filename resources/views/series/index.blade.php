<style>
    
    .cartao-serie {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
</style>

@extends('layout')


@section('cabecalho')
    Séries
@endsection
        
@section('conteudo')
    @if (!empty($logMensagem))
        <div class="alert alert-success">{{ $logMensagem }}</div>
    @endif

    <a href="/serie/create" class="btn btn-primary mb-2">Adicionar</a>
    <ul class="list-group mb-4">
        @foreach($series as $serie)
            <li class="list-group-item">
                <div class="cartao-serie">
                    <div>
                        <h4>{{$serie->nome}}</h4>
                        <span>Temporadas: {{ max($serie->numTemporadas) }}</span> 
                    </div>
                    
                    <form method="post" action="serie/delete/{{$serie->id}} " class="mb-0"
                        onsubmit="return confirm('Tem certeza que deseja excluir a série \'{{ $serie->nome }}\'?')"
                        >
                        @csrf
                        @method('DELETE')
                        <a href="/serie/{{$serie->id}}/infos" class="btn btn-secondary text-light">Infos</a>
                        <button class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
    