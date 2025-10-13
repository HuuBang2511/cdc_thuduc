<?php

namespace app\modules\quanly\models;

use Yii;

/**
 * This is the model class for table "truonghoc".
 *
 * @property int $gid
 * @property string|null $geom
 * @property float|null $objectid
 * @property string|null $dia_chi
 * @property string|null $ten_duong
 * @property string|null $ten_phuong
 * @property string|null $ten_quan
 * @property string|null $dien_thoai
 * @property string|null $ten_dv
 * @property string|null $ma_truong
 * @property string|null $ten_mien
 * @property float|null $x
 * @property float|null $y
 * @property string|null $doi_tuong
 * @property string|null $gd_cu
 * @property int|null $checked
 * @property float|null $phong_hoc
 * @property float|null $lop_hoc
 * @property float|null $giao_vien
 * @property float|null $hoc_sinh
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $maphuong
 * @property string|null $maquan
 *
 * @property CaBenh[] $caBenhs
 */
class Truonghoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'truonghoc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gid'], 'required'],
            [['gid', 'checked'], 'default', 'value' => null],
            [['gid', 'checked'], 'integer'],
            [['geom'], 'string'],
            [['objectid', 'x', 'y', 'phong_hoc', 'lop_hoc', 'giao_vien', 'hoc_sinh'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['dia_chi', 'ten_duong', 'ten_dv', 'ma_truong', 'ten_mien'], 'string', 'max' => 254],
            [['ten_phuong', 'ten_quan'], 'string', 'max' => 100],
            [['dien_thoai'], 'string', 'max' => 200],
            [['doi_tuong', 'maphuong', 'maquan'], 'string', 'max' => 50],
            [['gd_cu'], 'string', 'max' => 10],
            [['gid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'geom' => 'Geom',
            'objectid' => 'Objectid',
            'dia_chi' => 'Dia Chi',
            'ten_duong' => 'Ten Duong',
            'ten_phuong' => 'Ten Phuong',
            'ten_quan' => 'Ten Quan',
            'dien_thoai' => 'Dien Thoai',
            'ten_dv' => 'Ten Dv',
            'ma_truong' => 'Ma Truong',
            'ten_mien' => 'Ten Mien',
            'x' => 'X',
            'y' => 'Y',
            'doi_tuong' => 'Doi Tuong',
            'gd_cu' => 'Gd Cu',
            'checked' => 'Checked',
            'phong_hoc' => 'Phong Hoc',
            'lop_hoc' => 'Lop Hoc',
            'giao_vien' => 'Giao Vien',
            'hoc_sinh' => 'Hoc Sinh',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'maphuong' => 'Maphuong',
            'maquan' => 'Maquan',
        ];
    }

    /**
     * Gets query for [[CaBenhs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCaBenhs()
    {
        return $this->hasMany(CaBenh::className(), ['truonghoc_id' => 'gid']);
    }
}
