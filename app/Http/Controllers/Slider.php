<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Slider extends Controller
{
    //
    public function slider(){
        $act_account=env('ACT');
        $accessToken = env('ACCES_TOKEN');
        $url ="https://graph.facebook.com/v16.0/$act_account/ads?fields=id,name,adset{start_time,end_time},created_time,creative{actor_id,image_url}&access_token=$accessToken";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        //  dd($url);
        $slider= json_decode($result,true);
        //  dd($slider);


    // $slidsDs=[];
    //  $nameSli=[];
   /*  for ($i = 0; $i < count($slider['data']); $i++) {
        $slidsDs[]= $slider['creative']['image_url'];
        $nameSli[]=$slider['name'];

    } */
    $slider2=Array();
    foreach ( $slider['data'] as $item){
        $item['image']=(isset($item['creative']['image_url'] ) )  ? $item['creative']['image_url'] : "https://img.freepik.com/vector-premium/vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.jpg";
        $item['name']=$item['name'];
    $slider2[]=$item;
    }







            return view('/welcome', compact('slider2'));
    }
}
