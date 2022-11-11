<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "articulos".
 *
 * @property int $id
 * @property string $titulo
 * @property string $subtitulo
 * @property string $texto
 * @property string $imagen
 * @property string $fecha
 * @property string $autor
 */
class Articulos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articulos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'subtitulo', 'texto', 'imagen', 'fecha', 'autor'], 'required'],
            [['texto'], 'string'],
            [['titulo'], 'string', 'max' => 100],
            [['subtitulo'], 'string', 'max' => 200],
            [['imagen'], 'file'],
            [['id'], 'unique'],
            [['fecha', 'autor'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Título',
            'subtitulo' => 'Subtítulo',
            'texto' => 'Texto',
            'imagen' => 'Imagen',
            'fecha' => 'Fecha',
            'autor' => 'Autor',
        ];
    }
}
