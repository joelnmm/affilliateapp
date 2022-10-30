<?php

namespace backend\models;

use BackedEnum;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "backend_user".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 */
class BackendUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'backend_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'username', 'password'], 'required'],
            [['id'], 'integer'],
            [['name', 'username', 'password'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $result = static::findOne([
            'accessToken'=>$token
        ]);
        return new static($result);
    }

    public static function findByUsername($username){
        $result = self::find()
        ->where(['username' => $username])
        ->one();

        return new static($result);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        
    }

    public function validateAuthKey($authKey)
    {
        return $this->authkey === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
