<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function alteraEstadoAssistido(Request $request, Episodio $episodio)
    {
        
        $episodio::query()
                    ->where('id', $request->id_episodio)
                    ->update([
                        'assistido' => $request->assistido
                    ]);
    }
}
