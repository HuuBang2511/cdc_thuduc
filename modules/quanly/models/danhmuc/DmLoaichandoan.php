<?php

namespace app\modules\quanly\models\danhmuc;

use Yii;

/**
 * This is the model class for table "dm_loaichandoan".
 *
 * @property int $id
 * @property string|null $ten
 * @property string|null $ghichu
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CaBenh[] $caBenhs
 * @property CaBenh[] $caBenhs0
 */
class DmLoaichandoan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dm_loaichandoan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ten', 'ghichu'], 'string'],
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
            'ten' => 'Ten',
            'ghichu' => 'Ghichu',
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
        return $this->hasMany(CaBenh::className(), ['loaibenh_id' => 'id']);
    }

    /**
     * Gets query for [[CaBenhs0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaBenhs0()
    {
        return $this->hasMany(CaBenh::className(), ['chandoanchinh_id' => 'id']);
    }
}
