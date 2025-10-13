<?php

namespace app\modules\quanly\models;

use Yii;

/**
 * This is the model class for table "benh_vien".
 *
 * @property int $id
 * @property string|null $tenbenhvien
 * @property string|null $maso
 * @property string|null $tenvt
 * @property string|null $diachi
 * @property string|null $ma_bv
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CaBenh[] $caBenhs
 */
class BenhVien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'benh_vien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenbenhvien', 'maso', 'tenvt', 'diachi', 'ma_bv'], 'string'],
            [['status', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['status', 'created_by', 'updated_by'], 'integer'],
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
            'tenbenhvien' => 'Tenbenhvien',
            'maso' => 'Maso',
            'tenvt' => 'Tenvt',
            'diachi' => 'Diachi',
            'ma_bv' => 'Ma Bv',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CaBenhs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaBenhs()
    {
        return $this->hasMany(CaBenh::className(), ['benhvien_id' => 'id']);
    }
}
