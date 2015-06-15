<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "m_lpse".
 *
 * @property integer $id
 * @property string $cd
 * @property integer $cb
 * @property string $ed
 * @property integer $eb
 * @property string $name
 * @property string $link
 * @property integer $id_lpse_inaproc
 *
 * @property LpseDetail[] $lpseDetails
 * @property MLpseProfile[] $mLpseProfiles
 */
class MLpse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_lpse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cd', 'ed'], 'safe'],
            [['cb', 'eb', 'id_lpse_inaproc'], 'integer'],
            [['link'], 'string'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cd' => 'Cd',
            'cb' => 'Cb',
            'ed' => 'Ed',
            'eb' => 'Eb',
            'name' => 'Name',
            'link' => 'Link',
            'id_lpse_inaproc' => 'Id Lpse Inaproc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLpseDetails()
    {
        return $this->hasMany(LpseDetail::className(), ['lpse_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMLpseProfiles()
    {
        return $this->hasMany(MLpseProfile::className(), ['lpse_id' => 'id']);
    }
}
