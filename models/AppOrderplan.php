<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "app_orderplan".
 *
 * @property integer $planid
 * @property string $appcode
 * @property string $appname
 * @property string $orderplan
 * @property string $plancaption
 * @property string $created
 * @property string $creator
 */
class AppOrderplan extends \yii\db\ActiveRecord
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
        return 'app_orderplan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created'], 'safe'],
            [['appcode'], 'string', 'max' => 10],
            [['appname'], 'string', 'max' => 50],
            [['orderplan'], 'string', 'max' => 15],
            [['plancaption'], 'string', 'max' => 150],
            [['creator'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'planid' => 'Planid',
            'appcode' => 'Appcode',
            'appname' => 'Appname',
            'orderplan' => 'Orderplan',
            'plancaption' => 'Plancaption',
            'created' => 'Created',
            'creator' => 'Creator',
        ];
    }
    public function getOrder()
    {
        return $this->hasMany(AppOrderplan::className(), ['orderplan' => 'orderplan']);
    }
}
