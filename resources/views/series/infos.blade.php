@extends('layout')

@section('cabecalho')
    Série: {{$serie->nome}}
@endsection

@section('conteudo')
<a href="/serie" class="btn btn-primary">Voltar</a>

<div class="accordion accordion-flush mb-5 mt-3" id="accordionExample">

    @foreach ($serie->listaTemporadasEpisodios as $temporada => $episodios)    
        <div class="accordion-item">
        <h2 class="accordion-header" id="heading{{$temporada}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$temporada}}" aria-expanded="false" 
                aria-controls="collapse{{$temporada}}"
            >
            Temporada: {{$temporada}}
            </button>
        </h2>
        <div id="collapse{{$temporada}}" class="accordion-collapse collapse" aria-labelledby="heading{{$temporada}}" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <ul class="list-group">
                
                @foreach ($episodios as $episodio)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        @csrf
                        <input type="checkbox" class="form-check-input me-1" id="check-{{$temporada}}-{{$episodio->numero}}"
                        oninput="toggleStatusEpisodio({{$episodio->id}}, {{$temporada}}, {{$episodio->numero}})"
                        {{ ($episodio->assistido == 0) ? 'enabled' : 'checked' }}>
                        {{ $episodio->numero }}° Episódio
                    </div>
                    <div>
                        <strong>Status:</strong> 
                        <span id="status-episodio-{{$episodio->id}}">{{ ($episodio->assistido == 0) ? 'Não Assistido' : 'Assistido' }}</span>
                    </div>
                    </li>    
                @endforeach
                </ul>
            </div>
        </div>
        </div>
    @endforeach
    
  </div>


  <script>
      function toggleStatusEpisodio(idEpisodio, temporada, numEpisodio) {
        
        const checkEpisodio = document.getElementById(`check-${temporada}-${numEpisodio}`);
        let estadoAEditar = checkEpisodio.checked ? 1 : 0;
        
        let textoConfirm;
        if (estadoAEditar == 1) {
            textoConfirm = `Deseja marcar o episódio ${numEpisodio} como assistido?`;
        } else {
            textoConfirm = `Deseja marcar o episódio ${numEpisodio} como não assistido?`;
        }
        
        if (confirm(textoConfirm)) {
            const token = document
                            .querySelector(`input[name="_token"]`)
                            .value;
            
                    
            const url = `/episodio/update/${idEpisodio}/assistido`
            fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-Token": token
                    },
                    body: JSON.stringify({
                        assistido: estadoAEditar
                    }),
                    method: 'PUT'
                }
            );

            let statusEpisodio = document.getElementById(`status-episodio-${idEpisodio}`);
            statusEpisodio.innerHTML = (estadoAEditar == 0) ? 'Não Assistido' : 'Assistido';

        } else {
            checkEpisodio.checked = !estadoAEditar
        }

      }
            
  </script>
@endsection