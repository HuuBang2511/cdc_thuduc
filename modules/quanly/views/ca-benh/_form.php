<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;

?>

<div class="ca-benh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'loaibenh_id')->textInput() ?>

    <?= $form->field($model, 'mabenhnhan')->textInput() ?>

    <?= $form->field($model, 'hoten')->textInput() ?>

    <?= $form->field($model, 'ngaysinh')->textInput() ?>

    <?= $form->field($model, 'gioitinh_id')->textInput() ?>

    <?= $form->field($model, 'madinhdanh')->textInput() ?>

    <?= $form->field($model, 'ten_nguoibaoho')->textInput() ?>

    <?= $form->field($model, 'cothai')->checkbox() ?>

    <?= $form->field($model, 'sodienthoai')->textInput() ?>

    <?= $form->field($model, 'tuanthai')->textInput() ?>

    <?= $form->field($model, 'nghenghiep')->textInput() ?>

    <?= $form->field($model, 'noilamviec')->textInput() ?>

    <?= $form->field($model, 'diachi_noilamviec')->textInput() ?>

    <?= $form->field($model, 'khupho_noilamviec_id')->textInput() ?>

    <?= $form->field($model, 'diachi_noiohientai')->textInput() ?>

    <?= $form->field($model, 'khupho_noiohientai_id')->textInput() ?>

    <?= $form->field($model, 'so_hsba')->textInput() ?>

    <?= $form->field($model, 'coso_dieutri')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hinhthuc_dieutri')->textInput() ?>

    <?= $form->field($model, 'chandoanchinh_id')->textInput() ?>

    <?= $form->field($model, 'phandobenh')->textInput() ?>

    <?= $form->field($model, 'chandoan_bienchung')->textInput() ?>

    <?= $form->field($model, 'doanbenhkem')->textInput() ?>

    <?= $form->field($model, 'benhnen')->textInput() ?>

    <?= $form->field($model, 'ngaykhoiphat')->textInput() ?>

    <?= $form->field($model, 'ngaynhapvien')->textInput() ?>

    <?= $form->field($model, 'ngay_xuatvien_chuyenvien_tuvong')->textInput() ?>

    <?= $form->field($model, 'phanloai_chandoan')->textInput() ?>

    <?= $form->field($model, 'laymau_xetnghiem')->checkbox() ?>

    <?= $form->field($model, 'loaibenhpham')->textInput() ?>

    <?= $form->field($model, 'ngaylaymau')->textInput() ?>

    <?= $form->field($model, 'loaixetnghiem')->textInput() ?>

    <?= $form->field($model, 'ketqua_xetnghiem')->textInput() ?>

    <?= $form->field($model, 'tinhtrang_tiemchung')->textInput() ?>

    <?= $form->field($model, 'somuitiem')->textInput() ?>

    <?= $form->field($model, 'tiensu_dichte')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nguoi_dieutra_dichte')->textInput() ?>

    <?= $form->field($model, 'sdt_nguoi_dieutra_dichte')->textInput() ?>

    <?= $form->field($model, 'donvi_dieutra')->textInput() ?>

    <?= $form->field($model, 'ngay_dieutra_dichte')->textInput() ?>

    <?= $form->field($model, 'email_donvidieutra')->textInput() ?>

    <?= $form->field($model, 'donvi_baocao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tinhthanh_donvibaocao_id')->textInput() ?>

    <?= $form->field($model, 'ngaybaocao')->textInput() ?>

    <?= $form->field($model, 'nguoibaocao')->textInput() ?>

    <?= $form->field($model, 'sdt_nguoibaocao')->textInput() ?>

    <?= $form->field($model, 'email_nguoibaocao')->textInput() ?>

    <?= $form->field($model, 'trangthai_baocao')->textInput() ?>

    <?= $form->field($model, 'danhsach_coso_dieutri')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ngay_chinhsua_gannhat')->textInput() ?>

    <?= $form->field($model, 'ngaycapnhat')->textInput() ?>

    <?= $form->field($model, 'phanloai_cabenh')->textInput() ?>

    <?= $form->field($model, 'ngaygop_trung_cabenh')->textInput() ?>

    <?= $form->field($model, 'so_nha')->textInput() ?>

    <?= $form->field($model, 'ten_duong')->textInput() ?>

    <?= $form->field($model, 'tenduong_id')->textInput() ?>

    <?= $form->field($model, 'truonghoc_id')->textInput() ?>

    <?= $form->field($model, 'truonghoc_khupho_id')->textInput() ?>

    <?= $form->field($model, 'ngaymacbenh')->textInput() ?>

    <?= $form->field($model, 'cabenhtrung_id')->textInput() ?>

    <?= $form->field($model, 'thangbaocao')->textInput() ?>

    <?= $form->field($model, 'loai_ca_benh')->textInput() ?>

    <?= $form->field($model, 'stt')->textInput() ?>

    <?= $form->field($model, 'dantoc_id')->textInput() ?>

    <?= $form->field($model, 'tinhthanh_noilamviec_id')->textInput() ?>

    <?= $form->field($model, 'tinhthanh_noiohientai_id')->textInput() ?>

    <?= $form->field($model, 'tinhthanh_cosodieutri_id')->textInput() ?>

    <?= $form->field($model, 'thongtin_dieutri')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ghichu')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tinhtrang_hiennay')->textInput() ?>

    <?= $form->field($model, 'ngaynhanve')->textInput() ?>

    <?= $form->field($model, 'namnhapvien')->textInput() ?>

    <?= $form->field($model, 'xacminh_cabenh')->textInput() ?>

    <?= $form->field($model, 'diachi_xacminh_cabenh')->textInput() ?>

    <?= $form->field($model, 'tinhthanh_xacminh_cabenh_id')->textInput() ?>

    <?= $form->field($model, 'phuongxa_xacminh_cabenh_id')->textInput() ?>

    <?= $form->field($model, 'khupho_xacminh_cabenh_id')->textInput() ?>

    <?= $form->field($model, 'noikhac_xacminh_cabenh')->textInput() ?>

    <?= $form->field($model, 'tinhtrang_xuatvien')->checkbox() ?>

    <?= $form->field($model, 'loaicabenh_id')->textInput() ?>

    <?= $form->field($model, 'ngaykhoibenh')->textInput() ?>

    <?= $form->field($model, 'lophoc_id')->textInput() ?>

    <?= $form->field($model, 'ngaythongbao_cabenh')->textInput() ?>

    <?= $form->field($model, 'cutru_tainha')->checkbox() ?>

    <?= $form->field($model, 'nha_cabenh')->checkbox() ?>

    <?= $form->field($model, 'songuoi_tronggiadinh_sxh')->textInput() ?>

    <?= $form->field($model, 'songuoi_duoi15_sxh')->textInput() ?>

    <?= $form->field($model, 'nhaco_benhnhan_sxh')->checkbox() ?>

    <?= $form->field($model, 'nhaco_nguoibenh')->checkbox() ?>

    <?= $form->field($model, 'benhvien_phongkham')->checkbox() ?>

    <?= $form->field($model, 'nhatho')->checkbox() ?>

    <?= $form->field($model, 'dinhchua')->checkbox() ?>

    <?= $form->field($model, 'congvien')->checkbox() ?>

    <?= $form->field($model, 'noihoihop')->checkbox() ?>

    <?= $form->field($model, 'noixaydung')->checkbox() ?>

    <?= $form->field($model, 'quancaphe')->checkbox() ?>

    <?= $form->field($model, 'noichannuoi')->checkbox() ?>

    <?= $form->field($model, 'noibancaycanh')->checkbox() ?>

    <?= $form->field($model, 'vuaphelieu')->checkbox() ?>

    <?= $form->field($model, 'noikhac')->checkbox() ?>

    <?= $form->field($model, 'cabenhchidiem')->checkbox() ?>

    <?= $form->field($model, 'dietlangquang')->checkbox() ?>

    <?= $form->field($model, 'giamsat_theodoi')->checkbox() ?>

    <?= $form->field($model, 'xuly_odich_nho')->checkbox() ?>

    <?= $form->field($model, 'cabenhthuphat')->checkbox() ?>

    <?= $form->field($model, 'odichmoi')->checkbox() ?>

    <?= $form->field($model, 'noichandoan')->textInput() ?>

    <?= $form->field($model, 'phuongxa_noiohientai')->textInput() ?>

    <?= $form->field($model, 'phuongxa_noilamviec')->textInput() ?>

    <?= $form->field($model, 'phuongxa_sausapnhap')->textInput() ?>

    <?= $form->field($model, 'phuongxa')->textInput() ?>

    <?= $form->field($model, 'truonghoc_phuongxa')->textInput() ?>

    <?= $form->field($model, 'bi_bandau')->textInput() ?>

    <?= $form->field($model, 'ci_bandau')->textInput() ?>

    <?= $form->field($model, 'songuoi_giadinh_macbenh')->textInput() ?>

    <?= $form->field($model, 'songuoi_giadinh_macbenh_duoi15')->textInput() ?>

    <?= $form->field($model, 'ketluan_tinhtrang')->textInput() ?>

    <?= $form->field($model, 'ketluan_chandoan')->textInput() ?>

    <?= $form->field($model, 'ketluan_ngayxuatvien')->textInput() ?>

    <?= $form->field($model, 'ketluan_benhkhac')->textInput() ?>

    <?= $form->field($model, 'px_daden')->checkbox() ?>

    <?= $form->field($model, 'pxkhac_daden')->checkbox() ?>

    <?= $form->field($model, 'phuongxa_truonghoc')->textInput() ?>

    <?= $form->field($model, 'phuongxa_xacminhcabenh')->textInput() ?>

    <?= $form->field($model, 'donvi_thuchien_xetnghiem')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'benhvien_id')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
