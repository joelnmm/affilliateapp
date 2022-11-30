<?php

namespace frontend\models;

use \Statickidz\GoogleTranslate;
use common\models\Articulos;
use common\models\Productos;

use Yii;

use function PHPUnit\Framework\isEmpty;

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
                "Authorization: Bearer v^1.1#i^1#I^3#r^0#p^3#f^0#t^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",
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

    public static function getApi($uri, $type,$httpheaders,$postFields=[]){

        $query = http_build_query($postFields);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $uri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $type,
            CURLOPT_POSTFIELDS => $query,
            CURLOPT_HTTPHEADER => $httpheaders,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
            
        }

    }
}
