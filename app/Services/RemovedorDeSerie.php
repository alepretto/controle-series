<?php

namespace App\Services;

use App\Models\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function excluiSerie(int $id_serie)
    {
        
        DB::beginTransaction();    
        $serieDelete = Serie::query()->where('id', $id_serie)->firstOrFail();
        $nomeSerie = $this->removeSerie($serieDelete);
        DB::commit();
        
        return $nomeSerie;
    }

    public function removeSerie(Serie $serieDelete) 
    {
        $nomeSerie = $serieDelete->nome;
        $this->removeTemporada($serieDelete);        
        $serieDelete->delete();
        return $nomeSerie;
    }

    
    public function removeTemporada(Serie $serie)
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removeEpisodio($temporada);
            $temporada->delete();
        });
    }


    public function removeEpisodio(Temporada $temporada)
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
    
}