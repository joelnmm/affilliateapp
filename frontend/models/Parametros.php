<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametros".
 *
 * @property string $parNombre
 * @property string $parValor
 */
class Parametros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parametros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parNombre', 'parValor'], 'required'],
            [['parValor'], 'string'],
            [['parNombre'], 'string', 'max' => 30],
            [['parNombre'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parNombre' => 'Par Nombre',
            'parValor' => 'Par Valor',
        ];
    }
}
