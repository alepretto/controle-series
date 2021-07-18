<?php

namespace App\Services;

use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{

    public function criaSerie(
        string $nomeSerie,
        int $qtdTemporadas,
        int $qtdEpisodios
    )
    {
        
        DB::beginTransaction();
        $serieCriada = Serie::create([
            'nome' => $nomeSerie
        ]);
        $this->criaTemporadas($qtdTemporadas, $qtdEpisodios, $serieCriada);
        DB::commit();
        
        return $serieCriada;
    }

    public function criaTemporadas(int $qtdTemporadas, int $qtdEpisodios, Serie $serieCriada) 
    {
        for ($idxTemp = 1; $idxTemp <= $qtdTemporadas; $idxTemp++)
        {
            $temporada = $serieCriada->temporadas()->create(['numero' => $idxTemp]);
            $this->criaEpisodios($qtdEpisodios, $temporada);
        }
    }

    public function criaEpisodios(int $qtdEpisodios, Temporada $temporada)
    {
        for ($idxEpi = 1; $idxEpi <= $qtdEpisodios; $idxEpi++)
            {
                $temporada->episodios()->create(['numero' => $idxEpi]);
            }
    }
}