<?php

namespace frontend\models;

use app\models\Parametros;
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

        $token = Parametros::findOne([
            'parNombre' => 'ebayApplicationToken'
        ]);

        $headers = [
            "Authorization: Bearer " . $token->parValor,
            "Accept-Encoding: application/json",
            "X-EBAY-C-MARKETPLACE-ID: EBAY_US",
            "X-EBAY-C-ENDUSERCTX: affiliateCampaignId=<ePNCampaignId>,affiliateReferenceId=<referenceId>",
        ];

        $response = self::getApi($uri,'GET',$headers);

        if(isset($response["itemSummaries"])){
            return $response["itemSummaries"];

        }else{

            $request = self::requestToken();
            if(isset($request["access_token"])){
                $token->parValor = $request["access_token"];
                $token->save();
                self::browseItemsEbayApi($query, $limit);
            }
        }
    
    }

    public static function requestToken(){
        $uri = 'https://api.ebay.com/identity/v1/oauth2/token';

        // $parameters = [
        //     'grant_type' => 'authorization_code',
        //     'code' => 'v^1.1#i^1#f^0#r^1#p^3#I^3#t^Ul4xMF83OjAyQjA2Mjg2MEIyNzExRkVBNDRFRUU2NEYyNDMzMTk5XzJfMSNFXjI2MA==',
        //     'redirect_uri' => 'Joel_Males-JoelMale-bittad-fbeyxtn'
        // ];

        $parameters = [
            'grant_type' => 'client_credentials',
            'scope' => 'https://api.ebay.com/oauth/api_scope'
            ];

        $encodedCredentials = base64_encode('JoelMale-bittadvi-PRD-aa26b07b1-076faaeb:PRD-a26b07b190be-e520-44c7-82a1-ed5d');
        $headers = [
            'Cache-Control: no-cache',
            'Accept: application/json',
            "content-type: application/x-www-form-urlencoded",
            "Authorization: Basic " . $encodedCredentials,
        ];

        $response = UtilServices::getApi($uri,'POST',$headers,$parameters);
        return $response;
    }

    public static function getApi($uri, $type,$httpheaders,$postFields=[]){

        $query = http_build_query($postFields);
        $curl = curl_init();

        if($type === 'POST'){
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
        }else{
            curl_setopt_array($curl, [
                CURLOPT_URL => $uri,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $type,
                CURLOPT_HTTPHEADER => $httpheaders,
            ]);
        }

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $response = json_decode($response, true);
            return $response;
        }

    }
}
