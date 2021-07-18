<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSerieRequest;
use App\Models\Serie;
use App\Services\CriadorDeSerie;
use App\Services\FormatadorDeTemporada;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;


class SeriesController extends Controller {
    public function listarSeries(Request $request, FormatadorDeTemporada $temporadaFormater) {
        
        $series = Serie::query()
                ->orderBy('nome')
                ->get();
                
        $logMensagem = $request->session()->get('log');
       
        foreach($series as $serie) {
            $serie = $temporadaFormater->addListaTemporadasFormatadas($serie);
        }
        
        return view('series.index', [
            'series' => $series,
            'logMensagem' => $logMensagem
        ]);
    }

    public function create(Request $request)
    {
        return view('series.create');
    }

    public function store(
        CreateSerieRequest $request,
        CriadorDeSerie $criadorDeSerie
    )
    {
        $serieCriada = $criadorDeSerie->criaSerie(
            $request->serie,
            $request->temporadas,
            $request->episodios
        );
                

        $request->session()->flash(
            "log",
            "A série '$serieCriada->nome' foi criada, com $request->temporadas temporadas, sendo $request->episodios episódios em cada."
        );
        return redirect('/serie');
    }

    public function delete(Request $request, RemovedorDeSerie $removedorSerie)
    {
        $serie = $removedorSerie->excluiSerie($request->id_serie);
                
        $request->session()->flash(
            'log',
            "Série '$serie' deletada com sucesso."
        );
        return redirect('/serie');
    }


    public function infoSerie(Request $request, Serie $serie, FormatadorDeTemporada $temporadaFormater)
    {
        $serieInfo = $serie::query()->where('id', $request->id_serie)->firstOrFail();
        $serieInfo = $temporadaFormater->addListaTemporadasEpisodios($serieInfo);
        
        return view('series.infos', [
            'serie' => $serieInfo
        ]);
    }
}