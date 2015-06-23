<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customeruseapps".
 *
 * @property integer $order_id
 * @property string $companyname
 *
 * @property string $status
 * @property string $orderplan
 * @property string $orderfrom
 * @property string $orderkey
 * @property string $created
 * @property string $creator
 * @property string $edited
 * @property string $editor
 * @property integer $id
 * @property string $companycode
 * @property string $dbipaddress
 * @property string $dbname
 * @property string $dbusername
 * @property string $dbpassword
 * @property integer $customer_id
 *
 * @property Customers $customer
 * @property Orders $order
 */
class Customeruseapps extends \yii\db\ActiveRecord
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
        return 'customeruseapps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id', 'customer_id'], 'integer'],
            [['created', 'edited'], 'safe'],
            [['companyname'], 'string', 'max' => 150],
            [['orderplan', 'dbipaddress'], 'string', 'max' => 25],
            [['status'], 'string', 'max' => 15],
            [['orderfrom'], 'string', 'max' => 250],
            [['orderkey', 'creator', 'editor', 'dbname', 'dbusername', 'dbpassword'], 'string', 'max' => 50],
            [['companycode'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'companyname' => 'Companyname',
            'status' => 'Status',
            'orderplan' => 'Orderplan',
            'orderfrom' => 'Orderfrom',
            'orderkey' => 'Orderkey',
            'created' => 'Created',
            'creator' => 'Creator',
            'edited' => 'Edited',
            'editor' => 'Editor',
            'id' => 'ID',
            'companycode' => 'Companycode',
            'dbipaddress' => 'Dbipaddress',
            'dbname' => 'Dbname',
            'dbusername' => 'Dbusername',
            'dbpassword' => 'Dbpassword',
            'customer_id' => 'Customer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPlan()
    {
        return $this->hasOne(AppOrderplan::className(), ['orderplan' => 'orderplan']);
    }
}
