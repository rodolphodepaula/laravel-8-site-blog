<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo', 'descricao', 'conteudo', 'data'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);

    }
    //FORMATAÇÃO DO INPUT DATA.
    public function getDataAttribute($value)
    {
            return Carbon::parse($value)->format('d-m-Y');
    }

    public static function listaArtigos($paginate)
    {

        $listaArtigos = Artigo::select('id','titulo','descricao','user_id','data')->paginate(10);

        foreach ($listaArtigos as $key => $value) {
            $value->user_id = User::find($value->user_id)->name;

            /* OUTRA OPÇÃO PARA TRAZER O NOME DO AUTOR
            $value->user_id = $value->user->name;
            unset($value->user);*/
        }

        return  $listaArtigos;
    }

    public static function listaArtigosDB($paginate)
    {
       $user = auth()->user();
      // dd($user);

      if($user->admin == "S") {
        $listaArtigos = DB::table('artigos')
            ->join('users', 'user_id', '=', 'artigos.user_id')
            ->select('artigos.id','artigos.titulo','artigos.descricao','artigos.user_id','artigos.data')
            ->distinct()
            ->whereNull('deleted_at')
            ->orderBy('artigos.id', 'desc')
            ->paginate($paginate);
      }else{
            $listaArtigos = DB::table('artigos')
            ->join('users', 'user_id', '=', 'artigos.user_id')
            ->select('artigos.id','artigos.titulo','artigos.descricao','artigos.user_id','artigos.data')
            ->distinct()
            ->whereNull('deleted_at')
            ->where('artigos.user_id', '=', $user->id)
            ->orderBy('artigos.id', 'desc')
            ->paginate($paginate);
      }


        return $listaArtigos;

    }

    public static function listaArtigosSite($paginate, $busca = null)
    {
        if($busca){
            $listaArtigos = DB::table('artigos')
            ->join('users', 'users.id', '=', 'artigos.user_id')
            ->select('artigos.id','artigos.titulo','artigos.descricao', 'users.name as autor','artigos.user_id','artigos.data')
            ->distinct()
            ->whereNull('deleted_at')
            ->whereDate('data', '<=',date('Y-m-d'))
            ->where(function($query) use($busca){
                 $query->orWhere('titulo', 'like','%'.$busca.'%')
                        ->orWhere('descricao', 'like','%'.$busca.'%');
            })
            ->orderBy('data', 'DESC')
            ->paginate($paginate);

        }else{
            $listaArtigos = DB::table('artigos')
            ->join('users', 'users.id', '=', 'artigos.user_id')
            ->select('artigos.id','artigos.titulo','artigos.descricao', 'users.name as autor','artigos.user_id','artigos.data')
            ->distinct()
            ->whereNull('deleted_at')
            ->whereDate('data', '<=',date('Y-m-d'))
            ->orderBy('data', 'DESC')
            ->paginate($paginate);

        }


        return $listaArtigos;

    }






}