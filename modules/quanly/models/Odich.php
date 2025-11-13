<?php

namespace app\modules\quanly\models;
use app\modules\quanly\base\QuanlyBaseModel;
use app\modules\quanly\models\danhmuc\DmGioitinh;
use app\modules\quanly\models\danhmuc\DmDantoc;
use app\modules\quanly\models\danhmuc\DmLoaicabenh;
use app\modules\quanly\models\danhmuc\DmLoaichandoan;
use app\modules\quanly\models\danhmuc\DmLoaiodich;
use Yii;

/**
 * This is the model class for table "odich".
 *
 * @property int $id
 * @property string|null $ca_benh
 * @property int|null $loaiodich_id
 * @property string|null $ngayphathien
 * @property string|null $ngaykiemtra
 * @property string|null $ngaydukien_kiemta
 * @property string|null $ngaybatdau_giamsat
 * @property int|null $bi_bandau
 * @property int|null $ci_bandau
 * @property int|null $hi_bandau
 * @property string|null $nguoithuchien
 * @property string|null $dienthoai
 * @property string|null $nhandinh_gs
 * @property int|null $truonghoc_id
 * @property int|null $loaibenhdich_id
 * @property int|null $lophoc_id
 * @property bool|null $odichmoi
 * @property int|null $tinhtrangxuly_id
 * @property int|null $sauxuly
 * @property string|null $ngaytaoodich
 *
 * @property DmLoaichandoan $loaibenhdich
 * @property DmLoaiodich $loaiodich
 * @property Truonghoc $truonghoc
 */
class Odich extends QuanlyBaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'odich';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ca_benh', 'nguoithuchien', 'dienthoai', 'nhandinh_gs'], 'string'],
            [['loaiodich_id', 'bi_bandau', 'ci_bandau', 'hi_bandau', 'truonghoc_id', 'loaibenhdich_id', 'lophoc_id', 'tinhtrangxuly_id', 'sauxuly'], 'default', 'value' => null],
            [['loaiodich_id', 'bi_bandau', 'ci_bandau', 'hi_bandau', 'truonghoc_id', 'loaibenhdich_id', 'lophoc_id', 'tinhtrangxuly_id', 'sauxuly'], 'integer'],
            [['ngayphathien', 'ngaykiemtra', 'ngaydukien_kiemta', 'ngaybatdau_giamsat', 'ngaytaoodich'], 'safe'],
            [['odichmoi'], 'boolean'],
            [['loaibenhdich_id'], 'exist', 'skipOnError' => true, 'targetClass' => DmLoaichandoan::className(), 'targetAttribute' => ['loaibenhdich_id' => 'id']],
            [['loaiodich_id'], 'exist', 'skipOnError' => true, 'targetClass' => DmLoaiodich::className(), 'targetAttribute' => ['loaiodich_id' => 'id']],
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
            'ca_benh' => 'Ca Benh',
            'loaiodich_id' => 'Loại ổ dịch',
            'ngayphathien' => 'Ngày phát hiện',
            'ngaykiemtra' => 'Ngày kiểm tra',
            'ngaydukien_kiemta' => 'Ngày dự kiến kiểm tra',
            'ngaybatdau_giamsat' => 'Ngày bắt đầu giám sát',
            'bi_bandau' => 'Bi ban đầu',
            'ci_bandau' => 'Ci ban đầu',
            'hi_bandau' => 'Hi ban đầu',
            'nguoithuchien' => 'Người thực hiện',
            'dienthoai' => 'Điện thoại',
            'nhandinh_gs' => 'Nhận định gs',
            'truonghoc_id' => 'Truonghoc ID',
            'loaibenhdich_id' => 'Loại bệnh',
            'lophoc_id' => 'Lophoc ID',
            'odichmoi' => 'Odichmoi',
            'tinhtrangxuly_id' => 'Tình trạng xử lý',
            'sauxuly' => 'Sauxuly',
            'ngaytaoodich' => 'Ngày tạo ổ dịch',
        ];
    }

    /**
     * Gets query for [[Loaibenhdich]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaibenhdich()
    {
        return $this->hasOne(DmLoaichandoan::className(), ['id' => 'loaibenhdich_id']);
    }

    /**
     * Gets query for [[Loaiodich]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiodich()
    {
        return $this->hasOne(DmLoaiodich::className(), ['id' => 'loaiodich_id']);
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
