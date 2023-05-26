<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* use App\Http\Controllers\Carbon; */
// use Carbon\Carbon as CarbonCarbon;

use Carbon\Carbon;

class AnuncioController extends Controller
{
    //
    public function index(){
        // return ' <h1>Hola mundo desde el conntrolador</h1>';
         /*      $idPaginaFB = env('FB_PAGE_ID');
        $appId = env('FB_APP_ID');
        $appSecret = env('FB_APP_SECRET');
        $me = env('FB_ME'); */
        $act_account=env('ACT');
/*         $graphVersion = env('FB_GRAPH_VERSION', 'v16.0'); */
        $accessToken = env('ACCES_TOKEN');
        // Consulta que trai todos los anuncios
        //  $url = "https://graph.facebook.com/v16.0/$act_account/ads?fields=name,created_time,spend&access_token=$accessToken";
        // act_322548194581565/ads?fields=name,created_time&date_preset=last_90d
        $url ="https://graph.facebook.com/v16.0/$act_account/ads?fields=id,name,adset{start_time,end_time},created_time,creative{actor_id,image_url}&access_token=$accessToken";
       /*  $url2="https://graph.facebook.com/v16.0/$act_account/ads?fields=creative{actor_id,image_url}&access_token=$accessToken";
 */
        //  $url="https://graph.facebook.com/v16.0/$act_account/ads?fields=name,created_time,adset{start_time, end_time,promoted_object}&access_token=$accessToken";

    //    $url = "https://graph.facebook.com/v16.0/$act_account?fields=ads{name}&access_token=$accessToken";

        //  solicitud curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        //  dd($url);
        $anuncios= json_decode($result,true);
        // te ayuda aver
        //  dd($anuncios);
        // echo('hola');






    //   $nombre= $anuncios["data"][0]["name"];         //  dd($nombre);
     /*     return view('welcome', ['nombre' => $nombre]  ); */

    /*  return view('anuncio', ['anuncios' => $anuncios]); */
    // return view('welcome') ->with($nombre);
  /*       return view('welcome', compact('nombre') ); */
        // cuando pase arrays

         $timeAdsets=array();
         $max=90;

        // en este ciclo recorrera mi array para obetner lo datos de la data
        // strpos=> busca un cade de texto
        // carbon manipulacion de fechas
        // calcular la diferencia de dias diffdays
        foreach( $anuncios['data'] as $value){
          $fecha_end=$value['adset']['end_time'];
          $fecha_end= substr($fecha_end, 0, strpos($fecha_end, 'T'));
          $fecha_end=  Carbon::parse($fecha_end);
          $fecha_update=  Carbon::parse(Carbon::now('America/Monterrey'));
          $calculo= $fecha_end->diffInDays($fecha_update);
        //   $timeAdsets[]=$value;
        //   validacion
        if ($calculo <=$max) {
            // bracket notation
            $value['image'] =   (isset($value['creative']['image_url'] ) )  ? $value['creative']['image_url'] : "https://img.freepik.com/vector-premium/vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.jpg";
            $fecha_end=$value['adset']['end_time'];
            $fecha_end= substr($fecha_end, 0, strpos($fecha_end, 'T'));
            $value['end_time']= $fecha_end;

            // $value['image']= $value['creative']['image_url'];
            $timeAdsets[]=$value;
            // echo('esta dentro del rango');
        //    $ad_id=$timeAdsets['id'] ;
        }else if($calculo > $max){
            break;
        }
        }
    //    dd($timeAdsets);
    /*     $anun= json_encode( $timeAdsets, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $add= json_decode($anun, true); */

        // dd($add);

        // ordenamiento de fechas del más reciente al más antiguo.
        usort($timeAdsets, function ($a, $b) {
            $fecha_a = Carbon::parse($a['end_time']);
            $fecha_b = Carbon::parse($b['end_time']);
            return $fecha_b <=> $fecha_a; // Orden descendente
        });

      return view('anuncios',compact('timeAdsets'));



    }
}
