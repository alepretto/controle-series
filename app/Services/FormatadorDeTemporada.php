<?php

namespace App\Services;

use App\Models\Serie;

class FormatadorDeTemporada
{
    public function addListaTemporadasFormatadas(Serie $serie)
    {
        $temporadas = $serie->temporadas;
            
        $numTemporadas = [];
        foreach ($temporadas as $temporada) {
            array_push($numTemporadas, $temporada->numero);    
        }
        
        $serie->numTemporadas = $numTemporadas;

        return $serie;
    }
    
    public function addListaTemporadasEpisodios(Serie $serie)
    {
        $temporadas = $serie->temporadas;
            
        $listaTemporadasEpisodios = [];
        foreach ($temporadas as $temporada) {
            $episodios = $temporada->episodios;

            $listaTemporadasEpisodios[$temporada->numero] = [];

            foreach ($episodios as $episodio) {
                array_push($listaTemporadasEpisodios[$temporada->numero], $episodio);
            }

        }
        
        $serie->listaTemporadasEpisodios = $listaTemporadasEpisodios;

        return $serie;
    }
}