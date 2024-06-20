<div class="card">
	<div class="card-header bg-danger text-light">
		<h5 class="card-title"><?=$title?></h5>
	</div>
	
	<div class="card-body">
		
		<?php
		// if (@$tgl_lahir) {
		// 	$exp = explode('-', $tgl_lahir);
		// 	$tgl_lahir = $exp[2] . '-' . $exp[1] . '-' . $exp[0];
		// }
		if (!empty($message)) {
			show_message($message['message'], $message['status'], $message['dismiss']);
		}
		?>
		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="tab-content" id="myTabContent">
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Nama Lengkap</label>
					<div class="col-sm-6 input-group">
						<input class="form-control" type="text" name="namadepan" value="<?=set_value('namadepan', @$data_akun['namadepan'])?>" placeholder="Nama Depan" required="required"/>
						<input class="form-control" type="text" name="namatengah" value="<?=set_value('namatengah', @$data_akun['namatengah'])?>" placeholder="Nama Tengah"/>
						<input class="form-control" type="text" name="namabelakang" value="<?=set_value('namabelakang', @$data_akun['namabelakang'])?>" placeholder="Nama Belakang"/>
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
						<input class="form-control date-picker" type="text" id="tanggal_lahir" name="tanggal_lahir" value="<?=set_value('tanggal_lahir', @$data_akun['tanggal_lahir'])?>" placeholder="Tanggal Lahir" required="required" data-date-end-date="0d"/>
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
                            <option value="">Pilih Status</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Status</label>
					<div class="col-sm-6">
                    <!-- <input class="form-control" type="text" name="status" value="<?=set_value('status', @$data_akun['status'])?>" placeholder="Status" required="required"/> -->
                        <select class="form-control" id="status_option" name="status"  required="required">
                            <option value="">Pilih Status</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Bersedia Berkerja Shift ?</label>
					<div class="col-sm-6">
						<!-- <input class="form-control" type="text" name="kerja_shift" value="<?=set_value('kerja_shift', @$data_akun['kerja_shift'])?>" placeholder="Apakah Bersedia Berkerja Shift" required="required"/> -->
                        <select class="form-control" id="kerja_shift_option"  name="kerja_shift"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Bersedia Lembur ?</label>
					<div class="col-sm-6">
						<!-- <input class="form-control" type="text" name="kerja_overtime" value="<?=set_value('kerja_overtime', @$data_akun['kerja_overtime'])?>" placeholder="Apakah Bersedia Lembur ?" required="required"/> -->
                        <select class="form-control" id="kerja_overtime_option"  name="kerja_overtime"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Bersedia Berkerja Dihari Libur ?</label>
					<div class="col-sm-6">
						<!-- <input class="form-control" type="text" name="kerja_offday" value="<?=set_value('kerja_offday', @$data_akun['kerja_offday'])?>" placeholder="Apakah Bersedia Berkerja Dihari Libur ?" required="required"/> -->
                        <select class="form-control" id="kerja_offday_option"  name="kerja_offday"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Menggunakan Kacamata ?</label>
					<div class="col-sm-6">
						<!-- <input class="form-control" type="text" name="kacamata" value="<?=set_value('kacamata', @$data_akun['kacamata'])?>" placeholder="Apakah Menggunakan Kacamata ?" required="required"/> -->
                        <select class="form-control" id="kacamata_option"  name="kacamata"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Ketajaman Mata - Kiri</label>
					<div class="col-sm-6">
						<!-- <input class="form-control" type="text" name="mata_kiri" value="<?=set_value('mata_kiri', @$data_akun['mata_kiri'])?>" placeholder="Ketajaman Mata - Kiri" required="required"/> -->
                        <select class="form-control" id="mata_kiri_option"  name="mata_kiri"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Ketajaman Mata - Kanan</label>
					<div class="col-sm-6">
						<!-- <input class="form-control" type="text" name="mata_kanan" value="<?=set_value('mata_kanan', @$data_akun['mata_kanan'])?>" placeholder="Ketajaman Mata - Kanan" required="required"/> -->
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
						<!-- <input class="form-control" type="text" name="golongan_darah" value="<?=set_value('golongan_darah', @$data_akun['golongan_darah'])?>" placeholder="Golongan Darah" required="required"/> -->
                        <select class="form-control" id="golongan_darah_option"  name="golongan_darah"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tangan Dominan</label>
					<div class="col-sm-6">
						<!-- <input class="form-control" type="text" name="tangan_dominan" value="<?=set_value('tangan_dominan', @$data_akun['tangan_dominan'])?>" placeholder="Tangan Dominan" required="required"/> -->
                        <select class="form-control" id="tangan_dominan_option"  name="tangan_dominan"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Agama</label>
					<div class="col-sm-6">
						<!-- <input class="form-control" type="text" name="agama" value="<?=set_value('agama', @$data_akun['agama'])?>" placeholder="Agama" required="required"/> -->
                        <select class="form-control" id="agama_option"  name="agama"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>



				
                <hr>

                <!--batas detail -->
                
                <div class="form-group row mb-0 mt-3">
					<div class="col-sm-6">
						<button type="submit" name="submit" value="submit" class="btn btn-success"><i class="far fa-save pr-2"></i> Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
    $(document).ready(function(){

        createOption('sex_option', '7', 'id_group' ,'');
        createOption('kerja_shift_option', '12', 'id_group' ,'');
        createOption('kerja_overtime_option', '13', 'id_group' ,'');
        createOption('kerja_offday_option', '14', 'id_group' ,'');
        createOption('kacamata_option', '15', 'id_group' ,'');
        createOption('mata_kiri_option', '16', 'id_group' ,'');
        createOption('mata_kanan_option', '16', 'id_group' ,'');
        createOption('tangan_dominan_option', '17', 'id_group' ,'');
        createOption('agama_option', '18', 'id_group' ,'');
        createOption('status_option', '19', 'id_group' ,'');
        createOption('golongan_darah_option', '20', 'id_group' ,'');

        
        $('#tanggal_lahir').datepicker().on('changeDate', function(e) {
            var hariini = new Date();
            var dob= $("#tanggal_lahir").val();

            if(Number.isInteger(parseInt(dob.split('-')[2])) && dob.split('-')[2].length==4){

                // console.log(parseInt(hariini.getUTCFullYear()) - parseInt(dob.split('-')[2]));
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