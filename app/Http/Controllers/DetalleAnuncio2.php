<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DetalleAnuncio2\curl;
use Illuminate\Http\Request;
use JanuSoftware\Facebook\Facebook;
//  use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Carbon\Carbon;

class DetalleAnuncio2 extends Controller
{
    // public function curl($url){
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $result = curl_exec($ch);
    //     curl_close($ch);
    //     $detalle = json_decode($result, true);
    //     return $detalle;
    // }

    public function filtro($ad_id, Request $request)
    {
// inyeccion de dependencias
            //    $ad_id= $ad_s;

        $appId = '714212166742095';
        //  $act_account = env('ACT');
        // $graphVersion = env('FB_GRAPH_VERSION', 'v16.0');
        // $appSecret = env('FB_APP_SECRET');
        // $accessToken = env('ACCES_TOKEN');
        $act_account = env('ACT');
        $act_ads=env('ACT_ADS');
        $accessToken = env('ACCES_TOKEN');
        // $act_ads=env('ACT_ADS');

        // $adId = $_GET['ad_id'];
        //  echo $_GET['desde'];

// instancia
// $af = new Facebook ([
//     'apId'=>$appId,
//     'ap_secret'=>$appSecret,
//     'graphVersion'=> $graphVersion,
//     'defec_token'=>  $accessToken
// ]);
        // SDK
        // $tm = $af->get("/insights?fields=&date_preset=this_year");
        // $timelife = $tm->getDecodedBody();

        // log_to_console($timelife);
        // $v1 = json_encode($timelife, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        // $timel = json_decode($v1, true);


        // $url = "https://graph.facebook.com/v16.0/$ad_id?fields=id,name,crxeated_time,adset{start_time,end_time},targeting&access_token=$accessToken";
        $url = "https://graph.facebook.com/v16.0/$ad_id/?fields=name,created_time,adset{end_time}&access_token=$accessToken";
//    23853627869640372/insights?fields=&date_preset=this_year
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $detalle = json_decode($result, true);
        // if(empty($detalle['data'])){
        //   echo ('vacio ads');
//    dd($request->desde, $request->hasta);


        $start = $detalle['created_time'];
        $start= substr($start, 0, strpos($start, 'T'));
        // $start= Carbon::createFromFormat('d-m-Y', $start)->format('d-m-Y');
        //   dd(  $start);
        $stop = $detalle['adset']['end_time'];
        $stop= substr($stop, 0, strpos($stop, 'T'));
        // $start= Carbon::createFromFormat('d-m-Y', $stop)->format('d-m-Y');
        // $fecha_update=  Carbon::parse(Carbon::now('America/Monterrey'));


    // dd($stop);

    //     if(isset($_GET['desde']) && isset($_GET['hasta'])){
    //         $desde=$_GET['desde'];
    //         $hasta=$_GET['hasta'];
    //         // dd($desde);
    //         // dd($hasta);
    // // //     // }determina si una variable esta vacia
    //     }

        if ($request->has('desde') && $request->has('hasta')) {
            $desde = $request->input('desde');
            $hasta = $request->input('hasta');
        }


       if(!empty($desde)  && !empty($hasta)){
        // dd($desde);
    //    dd($hasta);
    $url2= "https://graph.facebook.com/v16.0/$ad_id/insights?fields=spend,ad_name,reach&time_range[since]=$desde&time_range[until]=$hasta&access_token=$accessToken";
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url2);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            $aux1 = json_decode($result, true);
            $resp = $aux1;

    //         //    dd($spend);

               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v16.0/$ad_id/insights?fields=&breakdowns=region&time_range[since]=$desde&time_range[until]=$hasta&access_token=$accessToken");
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               $result = curl_exec($ch);
               curl_close($ch);
               $aux2 = json_decode($result, true);
            $lug =$aux2;

              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v16.0/$ad_id?fields=name,adset{start_time,end_time},targeting&time_range[since]=$desde&time_range[until]=$hasta&access_token=$accessToken");
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $result = curl_exec($ch);
              curl_close($ch);
              $aux3 = json_decode($result, true);
            $int = $aux3;

        }  else      {
            // dd($start);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v16.0/$ad_id/insights?fields=spend,ad_name,reach&time_range[since]=$start&time_range[until]=$stop&access_token=$accessToken");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
            $aux1 = json_decode($result, true);
            $resp = $aux1;
        //   dd($resp);



               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v16.0/$ad_id/insights?fields=&breakdowns=region&time_range[since]=$start&time_range[until]=$stop&access_token=$accessToken");
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               $result = curl_exec($ch);
               curl_close($ch);
               $aux2 = json_decode($result, true);
            //    dd($aux3);
            $lug =$aux2;
            //   $lugares = $lug;
//    dd($lug);
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v16.0/$ad_id?fields=name,adset{start_time,end_time},targeting&time_range[since]=$start&time_range[until]=$stop&access_token=$accessToken");
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $result = curl_exec($ch);
              curl_close($ch);
              $aux3 = json_decode($result, true);

            $int = $aux3;
            // dd($int);
            // $intereses = $int;
            // dd($intereses);



        }

// dd($aux3);
    //     //  $datee=empty($desde);
    // //    dd($datee);
    //     // dd($resp);
        // $deta = json_encode($spend, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        // $ad = json_decode($deta, true);
        //  dd($ad);
        // $lug = json_encode($lugares, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        // $lu = json_decode($lug, true);
        // $in = json_encode($int, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        // $inte = json_decode($in, true);
        //  dd($inte);
    //     // dd($inte);
        //  dd($ad);
        // dd($lu);
        //

        // if (empty($ad['data']) & empty($inte['data'])) {
        //     $name = "";
        //     $gasto = "";
        //     $locations = "";
        //     $interests = "";
        //     $ad = "";

        // } else {
            $gasto=[];
            $name=[];
            for ($i = 0; $i < count($resp['data']); $i++) {
                $gasto[] = $resp['data'][$i]['spend'];
                $name[]=$resp['data'][$i]['ad_name'];

            }
            $interests = [];
            for ($i = 0; $i < count($int['targeting']['flexible_spec'][0]['interests']); $i++) {
                $interests[] = $int['targeting']['flexible_spec'][0]['interests'][$i]['name'];
            }
// dd( $interests );
            $locations = [];
            for ($i = 0; $i < count($lug['data']); $i++) {
                $locations[] = $lug['data'][$i]['region'];
            }


//  dd($resp);
            // $gasto=$resp['data'][0]['spend'];
            // $name=$resp['data'][0]['ad_name'];
// dd($locations);

     /*
      $gasto = $ad['data']['spend'];
     $importspend=[];
    for ($i = 0; $i < count($ad['spend']); $i++) {
        $importspend[] = $ad[''][''][0][''][$i]['name'];
    } */
    // $gasto = $ad['data'][0]['spend'];
     /*    $interests = [];
        for ($i = 0; $i < count($inte['targeting']['flexible_spec'][0]['interests']); $i++) {
            $interests[] = $inte['targeting']['flexible_spec'][0]['interests'][$i]['name'];
        } */
        // $tint=$intereses;
        // $locationes = [];
        // for ($i = 0; $i < count($lu['data']); $i++) {
        //     $locations[] = $lu['data'][$i]['region'] ;
        // }
        // $gasto = $ad['data']['spend'];



// compact('gasto')

        // }


    return view('detalle-anuncio', compact( 'interests' ,'locations','gasto','name')) ;

}
}



