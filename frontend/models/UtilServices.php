<?php

namespace frontend\models;

use \Statickidz\GoogleTranslate;
use common\models\Articulos;
use common\models\Productos;

use Yii;

/**
 * UtilServices is a class for services.
 */
class UtilServices 
{
    public static function translateByView($target, $view, $id, $titulo, $subtitulo)
    {
        if($view == 'productos'){

            $data = Productos::find()->all();
            $dataArticulos = Articulos::find()->all();

            //TRANSLATES TITLE AND SUBTITLE
            $titulo = self::actionTranslate($titulo, $target);
            $subtitulo = self::actionTranslate($subtitulo, $target);;

            foreach($dataArticulos as $articulo){ //TRANSLATES ARTICLES
                $articulo->titulo = self::actionTranslate($articulo->titulo, $target);
                $articulo->subtitulo = self::actionTranslate($articulo->subtitulo, $target);
                $articulo->fecha = self::actionTranslate($articulo->fecha, $target);
            }

            foreach($data as $producto){ // TRANSLATE PRODUCTS
                $producto->nombre = self::actionTranslate($producto->nombre, $target);
                $producto->descripcion = self::actionTranslate($producto->descripcion, $target);
            }

            return [
                'data' => $data,
                'dataArticulos' => $dataArticulos,
                'titulo' => $titulo,
                'subtitulo' =>  $subtitulo,
            ];
        
        }elseif($view == 'article'){

            $model = Articulos::findOne(['id' => $id]);
            $dataArticulos = Articulos::find()->all();

            // Translates actual article
            $model->titulo = self::actionTranslate($model->titulo, $target);
            $model->subtitulo = self::actionTranslate($model->subtitulo, $target);
            $model->fecha = self::actionTranslate($model->fecha, $target);
            $model->texto = self::actionTranslate($model->texto, $target);

            // $arrParragraphs= explode('<p>', $model->texto);
            // $translatedArr = [];

            // foreach($arrParragraphs as $parragraph){
            //     $parragraph = self::actionTranslate($parragraph, $target);
            //     array_push($translatedArr, $parragraph);
            //     sleep(1);
            // }

            if(sizeof($dataArticulos) > 1){ //Gets the next article

                foreach($dataArticulos as $articulo){
                    if($articulo->id != $model->id){
                        $nextArticle = $articulo;
                    }
                }

                // Translates next article
                $nextArticle->titulo = self::actionTranslate($nextArticle->titulo, $target);
                $nextArticle->subtitulo = self::actionTranslate($nextArticle->subtitulo, $target);
                $nextArticle->fecha = self::actionTranslate($nextArticle->fecha, $target);

                return [
                    'model' => $model,
                    'nextArticle' => $nextArticle,
                ];
            }


            return [
                'model' => $model
            ];
            
        } 
        
    }

    public static function actionTranslate($text, $target){
        require_once ('../../vendor/autoload.php');

        $source = 'en';

        $trans = new GoogleTranslate();
        $result = $trans->translate($source, $target, $text);

        return $result;
    }

    public static function browseItemsEbayApi($query, $limit){

        //Browse api
        $uri = 'https://api.ebay.com/buy/browse/v1/item_summary/search?q=' . $query . '&limit=' . $limit;

        // data for POST requests
        /*$data = [
            'q' => 'laptops',
            'limit' => '3',
            'source' => 'en'
        ];
        $query = http_build_query($data);*/

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $uri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            // CURLOPT_POSTFIELDS => $query,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer v^1.1#i^1#f^0#r^0#p^3#I^3#t^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",
                "Accept-Encoding: application/json",
                "X-EBAY-C-MARKETPLACE-ID: EBAY_US",
                "X-EBAY-C-ENDUSERCTX: affiliateCampaignId=<ePNCampaignId>,affiliateReferenceId=<referenceId>",
                // "content-type: application/x-www-form-urlencoded"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            
            if(isset($response["itemSummaries"])){
                return $response["itemSummaries"];
            }else{
                return $response;
            }
            
        }
    }
}
