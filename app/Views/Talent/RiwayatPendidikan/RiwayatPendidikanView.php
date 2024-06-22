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
                    <div class="form-group form-group-jenjang" id="form-group-1">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="text" class="form-control id-1"  name="id[]" value="<?= @$data_akun[0]['id'] ?>" placeholder="id" readonly hidden>
                                <label class="col-form-label">Jenjang</label>
                                <select class="form-control jenjang-1"   name="jenjang[]"  required="required">
                                    <option value="">Pilih Salah Satu</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-form-label">Nama Instansi</label>
                                <input type="text" class="form-control nama_instansi-1" value="<?= @$data_akun[0]['nama_instansi']?>"  name="nama_instansi[]" placeholder="Nama Sekolah / Universitas / Institut"  required="required">
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label">Jurusan</label>
                                <input type="text" class="form-control jurusan-1"  value="<?= @$data_akun[0]['jurusan'] ?>" name="jurusan[]" placeholder="Jurusan">
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
                                <label class="col-form-label">Bulan Tahun Lulus</label>
                                <div class="input-group">
                                    <select class="form-control bulan_lulus-1"  name="bulan_lulus[]"  required="required">
                                        <option value="">Pilih Salah Satu</option>
                                    </select>
                                    <input type="number" class="form-control tahun_lulus-1" name="tahun_lulus[]"  value="<?=  @$data_akun[0]['tahun_lulus'] ?>" placeholder="Tahun Lulus" required="required">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group  row">
                            <div class="col-sm-1">
                                <label class="col-form-label"></label>
                                <button type="button" name="add" id="add" class="btn btn-success  add-more">Tambah Data</button>
                            </div>
                        </div> -->
                        <hr class="bg-info" >
                    </div>
                </div>
                <!--batas detail -->
                
                <div class="form-group row mb-0 mt-3">
                    <div class="col-sm-5">
                        <button type="button" name="add" id="add" class="btn btn-success add-more">Tambah Riwayat</button>

						<button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
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
            createOption('.jenjang-'+formGroupCount, '8', 'id_group' );
            createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group' );
            createOption('.bulan_lulus-'+formGroupCount, '30', 'id_group' );
        } else {
            for (let i = 0; i < dataParse.length; i++) {
                if(i == 0){
                    createOption('.jenjang-'+formGroupCount, '8', 'id_group' ,dataParse[i]['jenjang']);
                    createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group' ,dataParse[i]['bulan_masuk']);
                    createOption('.bulan_lulus-'+formGroupCount, '30', 'id_group' ,dataParse[i]['bulan_lulus']);
                } else {
                    addFormGroup();
                    createOption('.jenjang-'+formGroupCount, '8', 'id_group' ,dataParse[i]['jenjang']);
                    createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group' ,dataParse[i]['bulan_masuk']);
                    createOption('.bulan_lulus-'+formGroupCount, '30', 'id_group',dataParse[i]['bulan_lulus']);
                    $('.id-'+formGroupCount).val(dataParse[i]['id']) ;
                    $('.nama_instansi-'+formGroupCount).val(dataParse[i]['nama_instansi']) ;
                    $('.jurusan-'+formGroupCount).val(dataParse[i]['jurusan']) ;
                    $('.tahun_masuk-'+formGroupCount).val(dataParse[i]['tahun_masuk']) ;
                    $('.tahun_lulus-'+formGroupCount).val(dataParse[i]['tahun_lulus']) ;
                }
            }
        }

        


        function addFormGroup() {
            formGroupCount++;

            var newFormGroup = `<div class="form-group form-group-jenjang" id="form-group-${formGroupCount}">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="text" class="form-control id-${formGroupCount}"  name="id[]" placeholder="id" readonly hidden>
                                <label class="col-form-label">Jenjang</label>
                                <select class="form-control jenjang-${formGroupCount}"  name="jenjang[]"  required="required">
                                    <option value="">Pilih Salah Satu</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-form-label">Nama Instansi</label>
                                <input type="text" class="form-control nama_instansi-${formGroupCount}"  name="nama_instansi[]" placeholder="Nama Sekolah / Universitas / Institut"  required="required">
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label">Jurusan</label>
                                <input type="text" class="form-control jurusan-${formGroupCount}"  name="jurusan[]" placeholder="Jurusan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-5">
                                <label class="col-form-label">Bulan Tahun Masuk</label>
                                <div class="input-group">
                                    <select class="form-control bulan_masuk-${formGroupCount}"  name="bulan_masuk[]"  required="required">
                                        <option value="">Pilih Salah Satu</option>
                                    </select>
                                    <input type="number" class="form-control tahun_masuk-${formGroupCount}"  name="tahun_masuk[]" placeholder="Tahun Masuk" required="required">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-form-label">Bulan Tahun Lulus</label>
                                <div class="input-group">
                                    <select class="form-control bulan_lulus-${formGroupCount}"   name="bulan_lulus[]"  required="required">
                                        <option value="">Pilih Salah Satu</option>
                                    </select>
                                    <input type="number" class="form-control tahun_lulus-${formGroupCount}"  name="tahun_lulus[]" placeholder="Tahun Lulus" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="form-group  row">
                            <div class="col-sm-1">
                                <label class="col-form-label"></label>
                                <button class="btn btn-danger remove">Hapus</button>
                            </div>
                        </div>
                        <hr  class="bg-info">
                    </div>`;
                    
            $('#dynamic-form').append(newFormGroup);
            
            // updateFormLabels();
        }

        // Add initial form group on button click
        $('.add-more').on('click', function() {
            addFormGroup();
            
            createOption('.jenjang-'+formGroupCount, '8', 'id_group' );
            createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group');
            createOption('.bulan_lulus-'+formGroupCount, '30', 'id_group' );
        });


        // Remove form group on button click
        $('#dynamic-form').on('click', '.remove', function() {
            $(this).closest('.form-group-jenjang').remove();
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