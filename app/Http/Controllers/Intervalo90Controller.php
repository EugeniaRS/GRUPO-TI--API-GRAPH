<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class Intervalo90Controller extends Controller
{
    //
    public function index()
    {
        $act_account = env('ACT');

        $accessToken = env('ACCES_TOKEN');
        $url = "https://graph.facebook.com/v16.0/$act_account/ads?fields=name,updated_time,adset{start_time,end_time},created_time&date_preset=last_90d&access_token=$accessToken";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $adsTime= json_decode($result,true);
        //  dd($adsTime);
         $timeAdsets=array();
        $max=90;

        // en este ciclo recorrera mi array para obetner lo datos de la data
        // strpos=> busca un cade de texto
        // carbon manipulacion de fechas
        // calcular la diferencia de dias diffdays
        foreach( $adsTime['data'] as $value){
          $fecha_end=$value['adset']['end_time'];
          $fecha_end= substr($fecha_end, 0, strpos($fecha_end, 'T'));
          $fecha_end= Carbon::parse($fecha_end);
          $fecha_update= Carbon::parse(Carbon::now('America/Monterrey'));
          $calculo= $fecha_end->diffInDays($fecha_update);
          $timeAdsets[]=$value;
        //   validacion
        if ($calculo <=$max) {
            $timeAdsets[]=$value;
            echo('esta dentro del rango');
        }else if($calculo > $max){
            break;
        }

        }
        $anun= json_encode( $timeAdsets, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $add= json_decode($anun, true);

        // dd($add);
        return view('anuncios',compact('add'));

    }

}

