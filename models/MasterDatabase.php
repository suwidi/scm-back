<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "master_database".
 *
 * @property integer $dbid
 * @property string $appcode
 * @property string $dbname
 * @property string $dbipaddress
 * @property string $dbusername
 * @property string $dbpassword
 * @property string $status
 * @property string $created
 */
class MasterDatabase extends \yii\db\ActiveRecord
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
        return 'master_database';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created'], 'safe'],
            [['appcode'], 'string', 'max' => 5],
            [['dbname'], 'string', 'max' => 50],
            [['dbipaddress', 'dbusername', 'dbpassword', 'status'], 'string', 'max' => 32],
            [['dbname'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dbid' => 'Dbid',
            'appcode' => 'Appcode',
            'dbname' => 'Dbname',
            'dbipaddress' => 'Dbipaddress',
            'dbusername' => 'Dbusername',
            'dbpassword' => 'Dbpassword',
            'status' => 'Status',
            'created' => 'Created',
        ];
    }
}
