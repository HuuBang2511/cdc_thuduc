<?php

namespace app\modules\quanly\models;

use Yii;

/**
 * This is the model class for table "lophoc".
 *
 * @property int $id
 * @property string|null $tenlop
 * @property string|null $malop
 * @property int|null $truonghoc_id
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CaBenh[] $caBenhs
 * @property Truonghoc $truonghoc
 */
class Lophoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lophoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tenlop', 'malop'], 'string'],
            [['truonghoc_id', 'status', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['truonghoc_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['truonghoc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Truonghoc::className(), 'targetAttribute' => ['truonghoc_id' => 'gid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tenlop' => 'Tenlop',
            'malop' => 'Malop',
            'truonghoc_id' => 'Truonghoc ID',
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
        return $this->hasMany(CaBenh::className(), ['lophoc_id' => 'id']);
    }

    /**
     * Gets query for [[Truonghoc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTruonghoc()
    {
        return $this->hasOne(Truonghoc::className(), ['gid' => 'truonghoc_id']);
    }
}
