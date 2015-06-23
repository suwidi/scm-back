<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Customers".
 *
 * @property integer $id
 * @property string $companycode
 * @property string $contactname
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $city
 * @property string $zipcode
 * @property string $billingaddress
 * @property string $billingcity
 * @property string $billingzipcode
 * @property string $status
 * @property string $joiningdate
 * @property string $logo
 * @property string $created
 * @property string $creator
 * @property string $edited
 * @property string $editor
 */
class Customers extends \yii\db\ActiveRecord
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
        return 'Customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['joiningdate', 'created', 'edited'], 'safe'],
            [['companycode', 'status'], 'string', 'max' => 10],
            [['contactname', 'email', 'logo'], 'string', 'max' => 150],
            [['phone'], 'string', 'max' => 100],
            [['address', 'billingaddress'], 'string', 'max' => 250],
            [['city', 'billingcity'], 'string', 'max' => 50],
            [['zipcode', 'billingzipcode'], 'string', 'max' => 6],
            [['creator', 'editor'], 'string', 'max' => 15],
            [['companycode','email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companycode' => 'Companycode',
            'contactname' => 'Contactname',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'city' => 'City',
            'zipcode' => 'Zipcode',
            'billingaddress' => 'Billingaddress',
            'billingcity' => 'Billingcity',
            'billingzipcode' => 'Billingzipcode',
            'status' => 'Status',
            'joiningdate' => 'Joiningdate',
            'logo' => 'Logo',
            'created' => 'Created',
            'creator' => 'Creator',
            'edited' => 'Edited',
            'editor' => 'Editor',
        ];
    }
    public function getApps()
    {
        return $this->hasMany(Customeruseapps::className(), ['customer_id' => 'id']);
    }
}
