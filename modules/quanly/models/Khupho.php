<?php

namespace app\modules\quanly\models;

use Yii;

/**
 * This is the model class for table "khupho".
 *
 * @property int $id
 * @property string|null $ten_dvhc
 * @property string|null $ma_dvhc
 * @property string|null $geom
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $maphuong
 * @property int|null $phuongxa_id
 * @property int|null $id_khupho
 *
 * @property CaBenh[] $caBenhs
 * @property CaBenh[] $caBenhs0
 * @property CaBenh[] $caBenhs1
 */
class Khupho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'khupho';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten_dvhc', 'ma_dvhc', 'geom', 'maphuong'], 'string'],
            [['status', 'created_by', 'updated_by', 'phuongxa_id', 'id_khupho'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by', 'phuongxa_id', 'id_khupho'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ten_dvhc' => 'Tên DVHC',
            'ma_dvhc' => 'Mã DVHC',
            'geom' => 'Geom',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'maphuong' => 'Maphuong',
            'phuongxa_id' => 'Phường xã',
            'id_khupho' => 'Id Khupho',
        ];
    }

    /**
     * Gets query for [[CaBenhs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaBenhs()
    {
        return $this->hasMany(CaBenh::className(), ['khupho_noilamviec_id' => 'id']);
    }

    /**
     * Gets query for [[CaBenhs0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaBenhs0()
    {
        return $this->hasMany(CaBenh::className(), ['khupho_noiohientai_id' => 'id']);
    }

    /**
     * Gets query for [[CaBenhs1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaBenhs1()
    {
        return $this->hasMany(CaBenh::className(), ['truonghoc_khupho_id' => 'id']);
    }

    public function getPhuongxa()
    {
        return $this->hasOne(Phuongxa::className(), ['id' => 'phuongxa_id']);
    }
}
