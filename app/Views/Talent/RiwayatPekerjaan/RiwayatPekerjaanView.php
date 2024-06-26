<div class="card">
	<div class="card-header bg-info text-light">
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
                <div id="dynamic-form">

                    <div class="form-group form-group-pekerjaan" id="form-group-1">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="text" class="form-control id-1"  name="id[]" value="<?= @$data_akun[0]['id'] ?>" placeholder="id" readonly hidden>
                                <label class="col-form-label">Tipe Pekerjaan</label>
                                <select class="form-control tipe_pekerjaan-1"   name="tipe_pekerjaan[]"  required="required">
                                    <option value="">Pilih Salah Satu</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Lokasi Pekerjaan</label>
                                <select class="form-control lokasi_pekerjaan-1"   name="lokasi_pekerjaan[]"  required="required">
                                    <option value="">Pilih Salah Satu</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Nama Kota</label>
                                <input type="text" class="form-control nama_kota-1"  value="<?= @$data_akun[0]['nama_kota'] ?>" name="nama_kota[]" placeholder="Nama Kota">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label class="col-form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control nama_perusahaan-1"  value="<?= @$data_akun[0]['nama_perusahaan'] ?>" name="nama_perusahaan[]" placeholder="Nama Perusahaan">
                            </div>
                            <div class="col-sm-5">
                                <label class="col-form-label">Bidang Pekerjaan</label>
                                <input type="text" class="form-control bidang_pekerjaan-1" value="<?= @$data_akun[0]['bidang_pekerjaan']?>"  name="bidang_pekerjaan[]" placeholder="Bidang Pekerjaan"  required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label class="col-form-label">Bulan Tahun Masuk</label>
                                <div class="input-group">
                                    <select class="form-control bulan_masuk-1"  name="bulan_masuk[]"  required="required">
                                        <option value="">Pilih Salah Satu</option>
                                    </select>
                                    <input type="number" class="form-control tahun_masuk-1"  value="<?= @$data_akun[0]['tahun_masuk'] ?>"  name="tahun_masuk[]" placeholder="Tahun Masuk" required="required">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-form-label">Bulan Tahun Keluar</label>
                                <div class="input-group">
                                    <select class="form-control bulan_keluar-1"  name="bulan_keluar[]"  required="required">
                                        <option value="">Pilih Salah Satu</option>
                                    </select>
                                    <input type="number" class="form-control tahun_keluar-1" name="tahun_keluar[]"  value="<?=  @$data_akun[0]['tahun_keluar'] ?>" placeholder="Tahun Keluar" required="required">
                                </div>
                            </div>
                        </div>
                        <hr class="bg-info" >
                    </div>
                </div>
                <!--batas detail -->
                
                <div class="form-group row mb-0 mt-3">
                    <div class="col-sm-5">
                        <button type="button" name="add" id="add" class="btn btn-success add-more">Tambah Riwayat</button>

						<button type="submit" name="submit" value="submit" class="btn btn-primary"><i class="far fa-save pr-2"></i>Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<script>
    $(document).ready(function(){
        
        
        // var jmlDataAkun = parseInt("<?php //count($data_akun);  ?>");
        var formGroupCount = 1;
        
        var dataJSON = '<?php echo json_encode($data_akun); ?>';
        var dataParse=JSON.parse(dataJSON);

        // console.log(dataJSON);
        // console.log('banyak data='+ dataParse.length);

        if(dataParse.length == 0){
            createOption('.tipe_pekerjaan-'+formGroupCount, '31', 'id_group' );
            createOption('.lokasi_pekerjaan-'+formGroupCount, '32', 'id_group' );
            createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group' );
            createOption('.bulan_keluar-'+formGroupCount, '30', 'id_group' );
        } else {
            for (let i = 0; i < dataParse.length; i++) {
                if(i == 0){
                    createOption('.tipe_pekerjaan-'+formGroupCount, '31', 'id_group',dataParse[i]['tipe_pekerjaan'] );
                    createOption('.lokasi_pekerjaan-'+formGroupCount, '32', 'id_group' ,dataParse[i]['lokasi_pekerjaan']);
                    createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group' ,dataParse[i]['bulan_masuk']);
                    createOption('.bulan_keluar-'+formGroupCount, '30', 'id_group' ,dataParse[i]['bulan_keluar']);
                } else {
                    addFormGroup();
                    createOption('.tipe_pekerjaan-'+formGroupCount, '31', 'id_group',dataParse[i]['tipe_pekerjaan'] );
                    createOption('.lokasi_pekerjaan-'+formGroupCount, '32', 'id_group',dataParse[i]['lokasi_pekerjaan'] );
                    createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group' ,dataParse[i]['bulan_masuk']);
                    createOption('.bulan_keluar-'+formGroupCount, '30', 'id_group',dataParse[i]['bulan_keluar']);
                    $('.id-'+formGroupCount).val(dataParse[i]['id']) ;
                    $('.nama_kota-'+formGroupCount).val(dataParse[i]['nama_kota']) ;
                    $('.nama_perusahaan-'+formGroupCount).val(dataParse[i]['nama_perusahaan']) ;
                    $('.bidang_pekerjaan-'+formGroupCount).val(dataParse[i]['bidang_pekerjaan']) ;
                    $('.tahun_masuk-'+formGroupCount).val(dataParse[i]['tahun_masuk']) ;
                    $('.tahun_keluar-'+formGroupCount).val(dataParse[i]['tahun_keluar']) ;
                }
            }
        }

        


        function addFormGroup() {
            formGroupCount++;

            var newFormGroup = `<div class="form-group form-group-pekerjaan" id="form-group-${formGroupCount}">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="text" class="form-control id-${formGroupCount}"  name="id[]" value="<?= @$data_akun[0]['id'] ?>" placeholder="id" readonly hidden>
                                <label class="col-form-label">Tipe Pekerjaan</label>
                                <select class="form-control tipe_pekerjaan-${formGroupCount}"   name="tipe_pekerjaan[]"  required="required">
                                    <option value="">Pilih Salah Satu</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Lokasi Pekerjaan</label>
                                <select class="form-control lokasi_pekerjaan-${formGroupCount}"   name="lokasi_pekerjaan[]"  required="required">
                                    <option value="">Pilih Salah Satu</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="col-form-label">Nama Kota</label>
                                <input type="text" class="form-control nama_kota-${formGroupCount}"  value="<?= @$data_akun[0]['nama_kota'] ?>" name="nama_kota[]" placeholder="Nama Kota">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label class="col-form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control nama_perusahaan-${formGroupCount}"  value="<?= @$data_akun[0]['nama_perusahaan'] ?>" name="nama_perusahaan[]" placeholder="Nama Perusahaan">
                            </div>
                            <div class="col-sm-5">
                                <label class="col-form-label">Bidang Pekerjaan</label>
                                <input type="text" class="form-control bidang_pekerjaan-${formGroupCount}" value="<?= @$data_akun[0]['bidang_pekerjaan']?>"  name="bidang_pekerjaan[]" placeholder="Bidang Pekerjaan"  required="required">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label class="col-form-label">Bulan Tahun Masuk</label>
                                <div class="input-group">
                                    <select class="form-control bulan_masuk-${formGroupCount}"  name="bulan_masuk[]"  required="required">
                                        <option value="">Pilih Salah Satu</option>
                                    </select>
                                    <input type="number" class="form-control tahun_masuk-${formGroupCount}"  value="<?= @$data_akun[0]['tahun_masuk'] ?>"  name="tahun_masuk[]" placeholder="Tahun Masuk" required="required">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-form-label">Bulan Tahun Keluar</label>
                                <div class="input-group">
                                    <select class="form-control bulan_keluar-${formGroupCount}"  name="bulan_keluar[]"  required="required">
                                        <option value="">Pilih Salah Satu</option>
                                    </select>
                                    <input type="number" class="form-control tahun_keluar-${formGroupCount}" name="tahun_keluar[]"  value="<?=  @$data_akun[0]['tahun_keluar'] ?>" placeholder="Tahun Keluar" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="form-group  row">
                            <div class="col-sm-1">
                                <label class="col-form-label"></label>
                                <button class="btn btn-danger remove"><i class="far fa-minus-square pr-2"></i>Hapus</button>
                            </div>
                        </div>
                        <hr class="bg-info" >
                    </div>`;
                    
            $('#dynamic-form').append(newFormGroup);
            
            // updateFormLabels();
        }

        // Add initial form group on button click
        $('.add-more').on('click', function() {
            addFormGroup();
            
            createOption('.tipe_pekerjaan-'+formGroupCount, '31', 'id_group' );
            createOption('.lokasi_pekerjaan-'+formGroupCount, '32', 'id_group' );
            createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group');
            createOption('.bulan_keluar-'+formGroupCount, '30', 'id_group' );
        });


        // Remove form group on button click
        $('#dynamic-form').on('click', '.remove', function() {
            $(this).closest('.form-group-pekerjaan').remove();
            // updateFormLabels();
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
                var listOption = $(id_input);
                response.forEach(function(responseData) {
                    var selected = responseData.value_parameter == defaultSelected ? 'selected' : '';
                    listOption.append('<option value="' + responseData.value_parameter + '" ' + selected + '>' + responseData.label_parameter + '</option>');
                });
            }
        });
    }

</script>