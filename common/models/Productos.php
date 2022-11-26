<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "productos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $marca
 * @property string $precio
 * @property string $imagen
 * @property string $descripcion
 * @property string $categoria
 * @property string $url
 */
class Productos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'marca', 'precio', 'imagen', 'categoria'], 'required'],
            [['id'], 'integer'],
            [['nombre', 'marca'], 'string', 'max' => 100],
            [['precio'], 'string', 'max' => 50],
            [['imagen'], 'file'],
            [['descripcion', 'url'], 'string', 'max' => 1000],
            [['id'], 'unique'],
            [['categoria'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'marca' => 'Marca',
            'precio' => 'Precio',
            'imagen' => 'Imagen',
            'descripcion' => 'Descripcion',
            'categoria' => 'Categoría',
            'url' => 'Url'
        ];
    }
}
