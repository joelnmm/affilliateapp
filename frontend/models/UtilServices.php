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
                "Authorization: Bearer v^1.1#i^1#p^3#f^0#I^3#r^0#t^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",
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
            return $response["itemSummaries"];
        }
    }
}
