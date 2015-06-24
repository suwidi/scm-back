<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property string $id
 * @property integer $expire
 * @property resource $data
 */
class Session extends \yii\db\ActiveRecord
{
    
    public static function getDb()
    {
       return \Yii::$app->db3;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip', 'referrer'], 'required'],
            [['id'], 'integer'],
            [['startdate'], 'safe'],
            [['ip','username','companycode'], 'string', 'max' => 255],
            [['isadmin'], 'string', 'max' => 1],
            [['appcode'], 'string', 'max' => 3],
            [['referrer'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'username' => 'Username',
            'startdate' => 'Startdate',
            'isadmin' => 'Isadmin',
            'appcode' => 'Appcode',
            'referrer' => 'Referrer',
            'companycode'=> 'Companycode'
        ];
    }
}
