<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Licitacao extends Model
{
    // nome da tabela
     protected $table = 'licitacoes';

    public function anexos()
    {
        return $this->hasMany('App\anexos');
    }
    /*
    *param[] array com os filtros recuperados com o request do form na página de busca
    * return retorn um objeto do tipo collection
    */
    public static function buscarLicitacoes($filtros = []){
        // var_dump($filtros);
        $result = DB::Table('licitacoes')
        ->select('*')
        ->where(function ($query) use($filtros){
            foreach($filtros as $key => $value){
                // verifica e aplica um filtr específico para o campo data
                if($key == 'data_abertura' && $value != ""){
                    $query->whereYear('data_abertura','=',$value);
                }else {
                    $query->where($key,'like','%'.$value.'%');
                }     
            }
        });
        return $result;    
    }
}
