<div class="card">
	<div class="card-header bg-danger text-light">
		<h5 class="card-title"><?=$title?></h5> <i><?=$subtitle?></i>
	</div>
	
	<div class="card-body">
		
		<?php
		if (@$data_akun['tanggal_lahir']) {
			$exp = explode('-', $data_akun['tanggal_lahir']);
			$tanggal_lahir = $exp[2] . '-' . $exp[1] . '-' . $exp[0];

			$data_akun['usia'] = intval(date("Y")) - intval($exp[0]) ;
		}
		if (!empty($message)) {
			show_message($message['message'], $message['status'], $message['dismiss']);
		}
		?>
		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="tab-content" id="myTabContent">
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Nama Lengkap</label>
					<div class="col-sm-6 input-group">
						<input class="form-control" type="text" name="namadepan" value="<?=set_value('namadepan', @$data_akun['nama_depan'])?>" placeholder="Nama Depan" required="required"/>
						<input class="form-control" type="text" name="namatengah" value="<?=set_value('namatengah', @$data_akun['nama_tengah'])?>" placeholder="Nama Tengah"/>
						<input class="form-control" type="text" name="namabelakang" value="<?=set_value('namabelakang', @$data_akun['nama_belakang'])?>" placeholder="Nama Belakang"/>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Nama Katakana</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="nama_katakana" value="<?=set_value('nama_katakana', @$data_akun['nama_katakana'])?>" placeholder="Nama Katakana" />
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Nama Panggilan</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="nama_panggilan" value="<?=set_value('nama_panggilan', @$data_akun['nama_panggilan'])?>" placeholder="Nama Panggilan" />
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tempat Lahir</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="tempat_lahir" value="<?=set_value('tempat_lahir', @$data_akun['tempat_lahir'])?>" placeholder="Tempat Lahir" required="required"/>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
					<div class="col-sm-6">
						<input class="form-control date-picker" type="text" id="tanggal_lahir" name="tanggal_lahir" value="<?=set_value('tanggal_lahir', @$tanggal_lahir)?>" placeholder="dd-mm-yyyy" required="required" data-date-end-date="0d"/>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Usia</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="usia"  id="usia" value="<?=set_value('usia', @$data_akun['usia'])?>" placeholder="usia" readonly/>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Jenis Kelamin</label>
					<div class="col-sm-6">
                        <select class="form-control" id="sex_option" name="sex"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Status</label>
					<div class="col-sm-6">
                        <select class="form-control" id="status_option" name="status"  required="required">
                            <option value="">Pilih Status</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Bersedia Berkerja Shift ?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="kerja_shift_option"  name="kerja_shift"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Bersedia Lembur ?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="kerja_overtime_option"  name="kerja_overtime"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Bersedia Berkerja Dihari Libur ?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="kerja_offday_option"  name="kerja_offday"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Menggunakan Kacamata ?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="kacamata_option"  name="kacamata"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Ketajaman Mata - Kiri</label>
					<div class="col-sm-6">
                        <select class="form-control" id="mata_kiri_option"  name="mata_kiri"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Ketajaman Mata - Kanan</label>
					<div class="col-sm-6">
                        <select class="form-control" id="mata_kanan_option"  name="mata_kanan"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tinggi Badan (Cm)</label>
					<div class="col-sm-6">
						<input class="form-control" type="number" name="tinggi_badan" value="<?=set_value('tinggi_badan', @$data_akun['tinggi_badan'])?>" placeholder="Tinggi Badan (Cm)" required="required"/>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Berat Badan (Kg)</label>
					<div class="col-sm-6">
						<input class="form-control" type="number" name="berat_badan" value="<?=set_value('berat_badan', @$data_akun['berat_badan'])?>" placeholder="Berat Badan (Kg)" required="required"/>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Golongan Darah</label>
					<div class="col-sm-6">
                        <select class="form-control" id="golongan_darah_option"  name="golongan_darah"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tangan Dominan</label>
					<div class="col-sm-6">
                        <select class="form-control" id="tangan_dominan_option"  name="tangan_dominan"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Agama</label>
					<div class="col-sm-6">
                        <select class="form-control" id="agama_option"  name="agama"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Kelebihan</label>
					<div class="col-sm-6">
                            <textarea maxlength="500" class="form-control" rows="5" name="kelebihan" placeholder="Kelebihan (Maks : 500 Karakter)"><?= @$data_akun['kelebihan'] ?></textarea>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Kekurangan</label>
					<div class="col-sm-6">
                            <textarea maxlength="500" class="form-control" rows="5" name="kekurangan" placeholder="Kekurangan (Maks : 500 Karakter)"><?= @$data_akun['kekurangan'] ?></textarea>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Hobi</label>
					<div class="col-sm-6">
                            <textarea maxlength="500" class="form-control" rows="5" name="hobi" placeholder="Hobi (Maks : 500 Karakter)"><?= @$data_akun['hobi'] ?></textarea>
					</div>
				</div>



				
                <hr>

                <!--batas detail -->
                
                <div class="form-group row mb-0 mt-3">
					<div class="col-sm-6">
						<button type="submit" name="submit" value="submit" class="btn btn-success btn-lg"><i class="far fa-save pr-2"></i> Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
    $(document).ready(function(){

        createOption('sex_option', '7', 'id_group' ,'<?= @$data_akun['sex'] ?>');
        createOption('kerja_shift_option', '12', 'id_group' ,'<?= @$data_akun['kerja_shift'] ?>');
        createOption('kerja_overtime_option', '13', 'id_group' ,'<?= @$data_akun['kerja_overtime'] ?>');
        createOption('kerja_offday_option', '14', 'id_group' ,'<?= @$data_akun['kerja_offday'] ?>');
        createOption('kacamata_option', '15', 'id_group' ,'<?= @$data_akun['kacamata'] ?>');
        createOption('mata_kiri_option', '16', 'id_group' ,'<?= @$data_akun['mata_kiri'] ?>');
        createOption('mata_kanan_option', '16', 'id_group' ,'<?= @$data_akun['mata_kanan'] ?>');
        createOption('tangan_dominan_option', '17', 'id_group' ,'<?= @$data_akun['tangan_dominan'] ?>');
        createOption('agama_option', '18', 'id_group' ,'<?= @$data_akun['agama'] ?>');
        createOption('status_option', '19', 'id_group' ,'<?= @$data_akun['status'] ?>');
        createOption('golongan_darah_option', '20', 'id_group' ,'<?= @$data_akun['golongan_darah'] ?>');

        
        $('#tanggal_lahir').datepicker().on('changeDate', function(e) {
            var hariini = new Date();
            var dob= $("#tanggal_lahir").val();

            if(Number.isInteger(parseInt(dob.split('-')[2])) && dob.split('-')[2].length==4){

                document.getElementById('usia').value = parseInt(hariini.getUTCFullYear()) - parseInt(dob.split('-')[2]) +' Tahun' ;
            }
        });
    });


    function createOption(id_input='', id_parametergroup='',column_parameter='id_parameter', defaultSelected =''){
        
        $.ajax({
            url: "<?= current_url().'/getParameter' ?>",
            method: 'POST',
            data:{
                id : id_parametergroup ,
                column : column_parameter
            },
            dataType: 'json',
            success: function(response) {
                var listOption = $('#'+id_input);
                response.forEach(function(responseData) {
                    var selected = responseData.value_parameter == defaultSelected ? 'selected' : '';
                    listOption.append('<option value="' + responseData.value_parameter + '" ' + selected + '>' + responseData.label_parameter + '</option>');
                });
            }
        });
    }

</script>