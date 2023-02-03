<?php

namespace frontend\models;

use common\models\Parametros;
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
    //computers categories
    public const COMPUTERS_CATEGORY = 'computers';
    public const APPLE_LAPTOP_CATEGORY = 'apple_laptop';
    public const HP_LAPTOP_CATEGORY = 'hp_laptop';
    public const ASUS_LAPTOP_CATEGORY = 'asus_laptop';
    public const COMPUTERS_NEW_CATEGORY = 'computers_new';
    public const COMPUTERS_USED_CATEGORY = 'computers_used';

    //brand categories
    public const APPLE_CATEGORY = 'apple';

    //cellphones categories
    public const CELLPHONES_CATEGORY = 'cellphones';
    public const CELLPHONES_NEW_CATEGORY = 'cellphones_new';
    public const CELLPHONES_USED_CATEGORY = 'cellphones_used';
    public const APPLE_IPHONE_CATEGORY = 'apple_iphone';

    //samrtwatch categories
    public const SMARTWATCHES_CATEGORY = 'smartwatches';
    public const SPEAKERS_CATEGORY = 'speakers';
    public const HEADPHONES_CATEGORY = 'headphones';

    public static function translateByView($target, $view, $id, $titulo, $subtitulo)
    {
        if($view == 'productos'){

            $data = UtilServices::getEbayProductData();
            $dataArticulos = Articulos::find()->all();

            //TRANSLATES TITLE AND SUBTITLE
            $titulo = self::actionTranslate($titulo, $target);
            $subtitulo = self::actionTranslate($subtitulo, $target);
            $subtituloProducto = self::actionTranslate("Today's choice", $target);

            foreach($dataArticulos as $articulo){ //TRANSLATES ARTICLES
                $articulo->titulo = self::actionTranslate($articulo->titulo, $target);
                $articulo->subtitulo = self::actionTranslate($articulo->subtitulo, $target);
                $articulo->fecha = self::actionTranslate($articulo->fecha, $target);
            }

            // $items = [];
            // foreach($data as $producto){ // TRANSLATE PRODUCTS
            //     $producto["nombre"] = self::actionTranslate($producto["nombre"], $target);
            //     array_push($items, $producto);
            //     // $producto->descripcion = self::actionTranslate($producto->descripcion, $target);
            // }

            return [
                'data' => $data,
                'dataArticulos' => $dataArticulos,
                'titulo' => $titulo,
                'subtitulo' =>  $subtitulo,
                'subtituloProducto' => $subtituloProducto
            ];
        
        }elseif($view == 'article'){

            $model = Articulos::findOne(['id' => $id]);
            $dataArticulos = Articulos::find()->all();

            // Translates actual article
            $model->titulo = self::actionTranslate($model->titulo, $target);
            $model->subtitulo = self::actionTranslate($model->subtitulo, $target);
            $model->fecha = self::actionTranslate($model->fecha, $target);
            $model->texto = self::actionTranslate($model->texto, $target);

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

    public static function browseItemsEbayApi($query,$limit,$priceRange="",$condition=""){

        //Browse api
        $uri = 'https://api.ebay.com/buy/browse/v1/item_summary/search?q=' . $query . '&limit=' . $limit;

        if($priceRange!=="" && $condition!==""){
            $uri = 'https://api.ebay.com/buy/browse/v1/item_summary/search?q=' . $query . '&limit=' . $limit . '&filter=price%3A%5B' . $priceRange . '%5D%2CpriceCurrency%3AUSD%2Cconditions%3A%7B' . $condition . '%7D';
        }else if($priceRange!=="" && $condition==""){
            $uri = 'https://api.ebay.com/buy/browse/v1/item_summary/search?q=' . $query . '&limit=' . $limit . '&filter=price%3A%5B' . $priceRange . '%5D%2CpriceCurrency%3AUSD%2';
        }

        $token = Parametros::findOne(['parNombre' => 'ebayApplicationToken']);

        $headers = [
            "Authorization:Bearer " . $token->parValor,
            "Accept-Encoding:application/json",
            "X-EBAY-C-MARKETPLACE-ID:EBAY_US",
            "X-EBAY-C-ENDUSERCTX:affiliateCampaignId=<ePNCampaignId>,affiliateReferenceId=<referenceId>",
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

    public static function getEbayProductData(){

        $productObject = Productos::find()->where(['esTemporalEbay' => "si"])->one();

        if(isset($productObject)){
            $fechaExpiracion = date("Y-m-d", strtotime($productObject->lastFetchedEbay . "+ 1 days"));
            $dateTimeActual = date("Y-m-d");
        }else{
            $fechaExpiracion = 0;
            $dateTimeActual = 0;
        }

        if($dateTimeActual >= $fechaExpiracion ){

            // Eliminamos los registros anteriores para aactualizar con los nuevos
            $productosEliminar = Productos::find()->where(['esTemporalEbay' => "si"])->all();
    
            if(!isEmpty($productosEliminar)){
                foreach($productosEliminar as $p){
                    $p->delete();
                }
            }

            // Llamamos la api de ebay por diferentes busquedas
            $dataLaptopsHp = UtilServices::browseItemsEbayApi('Hp+laptop', '10', '200..2000', 'NEW');
            $dataLaptopsAsus = UtilServices::browseItemsEbayApi('Asus+laptop', '10', '200..2000', 'NEW');
            $dataMacbookNew = UtilServices::browseItemsEbayApi('macbook', '10','700..2000','NEW');
            $dataMacbookUsed = UtilServices::browseItemsEbayApi('macbook', '10','300..1000','USED');
            $dataCellPhones = UtilServices::browseItemsEbayApi('cellphones', '10');
            $dataIphonesNew = UtilServices::browseItemsEbayApi('iphone', '10','600..1500','NEW');
            $dataIphonesUsed = UtilServices::browseItemsEbayApi('iphone', '10', '300..9000','USED');
            $dataSpeakersNew = UtilServices::browseItemsEbayApi('portable+speakers', '10', '50..500','NEW');
            $dataHeadphonesNew = UtilServices::browseItemsEbayApi('wireless+headphones', '10', '20..500','NEW');
            $smartWatch = UtilServices::browseItemsEbayApi('smartwatch', '20');

            // Agregamos la categoria a cada resultado de las busquedas
            if(isset($dataLaptopsHp[0]["title"])){

                foreach($dataLaptopsHp as $key => $item){
                    $dataLaptopsHp[$key] += ["category" => [self::COMPUTERS_CATEGORY, self::HP_LAPTOP_CATEGORY, self::COMPUTERS_NEW_CATEGORY]];
                }
                foreach($dataLaptopsAsus as $key => $item){
                    $dataLaptopsAsus[$key] += ["category" => [self::COMPUTERS_CATEGORY, self::ASUS_LAPTOP_CATEGORY ,self::COMPUTERS_NEW_CATEGORY]];
                }
                foreach($dataMacbookNew as $key => $item){
                    $dataMacbookNew[$key] += ["category" => [self::COMPUTERS_CATEGORY, self::APPLE_CATEGORY, self::APPLE_LAPTOP_CATEGORY, self::COMPUTERS_NEW_CATEGORY]];
                }
                foreach($dataMacbookUsed as $key => $item){
                    $dataMacbookUsed[$key] += ["category" => [self::COMPUTERS_CATEGORY, self::APPLE_CATEGORY, self::APPLE_LAPTOP_CATEGORY, self::COMPUTERS_USED_CATEGORY]];
                }
                foreach($dataCellPhones as $key => $item){
                    $dataCellPhones[$key] += ["category" => [self::CELLPHONES_CATEGORY]];
                }
                foreach($dataIphonesNew as $key => $item){
                    $dataIphonesNew[$key] += ["category" => [self::CELLPHONES_CATEGORY, self::APPLE_CATEGORY, self::APPLE_IPHONE_CATEGORY, self::CELLPHONES_NEW_CATEGORY]];
                }
                foreach($dataIphonesUsed as $key => $item){
                    $dataIphonesUsed[$key] += ["category" => [self::CELLPHONES_CATEGORY, self::APPLE_CATEGORY, self::APPLE_IPHONE_CATEGORY, self::CELLPHONES_USED_CATEGORY]];
                }
                foreach($dataSpeakersNew as $key => $item){
                    $dataSpeakersNew[$key] += ["category" => [self::SPEAKERS_CATEGORY]];
                }
                foreach($dataHeadphonesNew as $key => $item){
                    $dataHeadphonesNew[$key] += ["category" => [self::HEADPHONES_CATEGORY]];
                }
                foreach($smartWatch as $key => $item){
                    $smartWatch[$key] += ["category" => [self::SMARTWATCHES_CATEGORY]];
                }

                $combined = array_merge(
                    $dataLaptopsHp,
                    $dataLaptopsAsus,
                    $dataMacbookNew,
                    $dataMacbookUsed, 
                    $dataCellPhones,
                    $dataIphonesNew,
                    $dataIphonesUsed,
                    $dataSpeakersNew, 
                    $dataHeadphonesNew,
                    $smartWatch,
                );


                $affiliateLink = Parametros::findOne(['parNombre' => 'ebayAffiliateLinkGenerator']);
                foreach($combined as $producto){
                    $model = new Productos();
                    $model->id = rand(100,10000);
                    $model->marca = 'Na';
                    $model->imagen = $producto["thumbnailImages"][0]["imageUrl"];
                    $model->precio = $producto['price']['value'];
                    $model->nombre = $producto['title'];
                    // $model->descripcion = $producto["descripcion"];
                    $model->url = $producto["itemWebUrl"] . $affiliateLink->parValor;
                    $model->categoria = implode(',',$producto['category']);
                    $model->condicion = $producto['condition'];
                    $model->esTemporalEbay = "si";
                    $model->lastFetchedEbay = date("Y-m-d");
                    $model->save();
                }
            }

        }

        return 'OK';
    }

    public static function getApi($uri,$type,$httpheaders,$postFields=[]){

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
            if($response === 'Bad Request'){
                return $response;
            }else{
                $response = json_decode($response, true);
                return $response;
            }
        }

    }

    public static function requestToken(){
        $uri = 'https://api.ebay.com/identity/v1/oauth2/token';

        // $parameters = [
        //     'grant_type' => 'authorization_code',
        //     'code' => '',
        //     'redirect_uri' => 'Joel_Males-JoelMale-bittad-fbeyxtn'
        // ];

        $parameters = [
            'grant_type' => 'client_credentials',
            'scope' => 'https://api.ebay.com/oauth/api_scope'
            ];

        $clientId = Parametros::findOne(['parNombre' => 'clientId']);
        $clientSecret = Parametros::findOne(['parNombre' => 'clientSecret']);
        $encodedCredentials = base64_encode($clientId ->parValor . ':' . $clientSecret->parValor);
        $headers = [
            'Cache-Control: no-cache',
            'Accept: application/json',
            "content-type: application/x-www-form-urlencoded",
            "Authorization: Basic " . $encodedCredentials,
        ];

        $response = UtilServices::getApi($uri,'POST',$headers,$parameters);
        return $response;
    }
}
