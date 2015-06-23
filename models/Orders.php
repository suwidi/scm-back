<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property string $fullname
 * @property string $companyname
 * @property string $email
 * @property string $phonenumber
 * @property string $orderapp
 * @property string $status
 * @property string $orderplan
 * @property string $orderfrom
 * @property string $orderkey
 * @property string $created
 * @property string $creator
 * @property string $edited
 * @property string $editor
 *
 * @property AppOrderplan $orderplan0
 */
class Orders extends \yii\db\ActiveRecord
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
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'edited'], 'safe'],
            [['fullname', 'companyname', 'email', 'phonenumber'], 'string', 'max' => 150],
            [['orderapp', 'orderplan'], 'string', 'max' => 25],
            [['status'], 'string', 'max' => 15],
            [['orderfrom'], 'string', 'max' => 250],
            [['orderkey', 'creator', 'editor'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'fullname' => 'Fullname',
            'companyname' => 'Companyname',
            'email' => 'Email',
            'phonenumber' => 'Phonenumber',
            'orderapp' => 'Orderapp',
            'status' => 'Status',
            'orderplan' => 'Orderplan',
            'orderfrom' => 'Orderfrom',
            'orderkey' => 'Orderkey',
            'created' => 'Created',
            'creator' => 'Creator',
            'edited' => 'Edited',
            'editor' => 'Editor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppOrderplan()
    {
        return $this->hasOne(AppOrderplan::className(), ['orderplan' => 'orderplan']);
    }
    public function getOrdersDts()
   {
       return $this->hasMany(OrdersDt::className(), ['order_id' => 'order_id']);
   }
    
}
