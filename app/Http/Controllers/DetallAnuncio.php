<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use function Pest\Laravel\json;

class DetallAnuncio extends Controller
{

    public function  detalle()
    {
        $act_account = env('ACT');
        $act_ads=env('ACT_ADS');
        $accessToken = env('ACCES_TOKEN');
        // url con las fecahs de inicio y end , intereses, y locacion
        $url = "https://graph.facebook.com/v16.0/$act_account/ads?fields=id,name,created_time,adset{start_time,end_time},targeting&access_token=$accessToken";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $detalle = json_decode($result, true);
        //  dd($url);
        //   dd($detalle);
    //   $formateado=array();

    //    foreach ( $detalle['data'] as $value){
    //    //   extrallendo fecha
    //    $fecha_inicio= $value['created_time'];
    //    $fecha_inicio=substr($fecha_inicio ,0, strpos($fecha_inicio, 'T'));
    //    $fecha_end= $value['adset']['end_time'];
    //    $fecha_end= substr($fecha_end,0, strpos($fecha_end, 'T') );

    //   //   formatear fecha
    //   $fecha_inicio= Carbon::parse($fecha_inicio);
    //   $fecha_end= Carbon::parse($fecha_end);
    //   $today= Carbon::parse(Carbon::now('America/Monterrey'));

    // //   $formateado[]=$value;

    //   if (  $fecha_inicio && $fecha_end ){

    //   }


    //    }

        // obtiene el spend del anuncio en epescifico y el año actual

        $url2="https://graph.facebook.com/v16.0/$act_ads/insights?fields=&date_preset=this_year&access_token=$accessToken";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result2 = curl_exec($ch);
        curl_close($ch);
        $fechas_now=json_decode($result2,true);
        //    dd($fechas_now);
/*
          return view('detalle-anuncio', compact('detalle')); */
    }
    // public function  filtro(){

    //     // return view('detalle-anuncio', compact('detalle'));
    // }
}
