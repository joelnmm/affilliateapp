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

            var_dump($translatedArr);

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
}
