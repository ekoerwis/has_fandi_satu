<div class="card">
	<div class="card-header bg-warning text-light">
		<h5 class="card-title"><?=$title?></h5> <i><?=$subtitle?></i>
	</div>
	<div class="card-body">
		
		<?php

		if (!empty($message)) {
			show_message($message['message'], $message['status'], $message['dismiss']);
		}
		?>
		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
        

			<div class="tab-content" id="myTabContent">

            <!-- bagian Jepang -->
            <div class="card-header rounded mb-2 " style="padding-top: 15px; padding-bottom: 15px; background-color: #ffd191; ">
                    <h5 class="">Bahasa Jepang</h5>
                </div>
				<div class="form-group col-sm-6">
					<input class="form-control" type="text" name="id_jepang" value="<?= @$data_jepang[0]['id'] ?>" placeholder="id Jepang" readonly hidden/>
					<label class="col-form-label">Jenis Sertifikasi</label>
                    <select class="form-control jenis_sertifikat_jepang" name="jenis_sertifikat_jepang"  >
                        <option value="">Pilih Salah Satu</option>
                    </select>
				</div>
				<div class="form-group  col-sm-6">
                    <label class="col-form-label">Bulan Tahun Terbit</label>
                    <div class="input-group">
                        <select class="form-control bulan_terbit_jepang"  name="bulan_terbit_jepang">
                            <option value="">Pilih Salah Satu</option>
                        </select>
                        <input type="number" class="form-control tahun_terbit_jepang"  value="<?= @$data_jepang[0]['tahun_terbit'] ?>"  name="tahun_terbit_jepang" placeholder="Tahun Terbit">
                    </div>
				</div>
                
            <!-- bagian Inggris -->
            <div class="card-header rounded mb-2 " style="padding-top: 15px; padding-bottom: 15px; background-color: #ffd191; ">
                    <h5 class="">Bahasa Inggris</h5>
                </div>
				<div class="form-group col-sm-6">
					<input class="form-control" type="text" name="id_inggris" value="<?= @$data_inggris[0]['id'] ?>" placeholder="id Inggris" readonly hidden />
                    <label class="col-form-label">Jenis Sertifikasi</label>
                    <div class="input-group">
                        <select class="form-control jenis_sertifikat_inggris" name="jenis_sertifikat_inggris"  >
                            <option value="">Pilih Salah Satu</option>
                        </select>
                        <input type="text" class="form-control level_inggris"  value="<?= @$data_inggris[0]['level'] ?>"  name="level_inggris" placeholder="Nilai / Level">
                    </div>
				</div>
				<div class="form-group  col-sm-6">
                    <label class="col-form-label">Bulan Tahun Terbit</label>
                    <div class="input-group">
                        <select class="form-control bulan_terbit_inggris"  name="bulan_terbit_inggris">
                            <option value="">Pilih Salah Satu</option>
                        </select>
                        <input type="number" class="form-control tahun_terbit_inggris"  value="<?= @$data_inggris[0]['tahun_terbit'] ?>"  name="tahun_terbit_inggris" placeholder="Tahun Terbit">
                    </div>
				</div>

                <!-- bagian Lainnya -->
                <div class="card-header rounded mb-2 " style="padding-top: 15px; padding-bottom: 15px; background-color: #ffd191; ">
                    <h5 class="">Lainnya</h5>
                </div>
                <div id="lain-container">
                    <!-- Dynamic Lainnya input will be added here -->
                </div>
                <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                    <button type="button" class="btn btn-success" id="add-lain"><i class="far fa-plus-square pr-2"></i>Tambah Bahasa</button>
                </div>


                
                <!--batas detail -->
                
                <div class="form-group row mb-0 mt-3">
                    <div class="col-sm-5">
						<button type="submit" name="submit" value="submit" class="btn btn-primary"><i class="far fa-save pr-2"></i>Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


<script>
    $(document).ready(function(){

        createOption('.jenis_sertifikat_jepang', '35', 'id_group',<?= @$data_jepang[0]['jenis_sertifikat'] ?>);
        createOption('.bulan_terbit_jepang', '30', 'id_group',<?= @$data_jepang[0]['bulan_terbit'] ?>);

        createOption('.jenis_sertifikat_inggris', '36', 'id_group',<?= @$data_inggris[0]['jenis_sertifikat'] ?>);
        createOption('.bulan_terbit_inggris', '30', 'id_group',<?= @$data_inggris[0]['bulan_terbit'] ?>);


        // Lain
         // Add initial Lain section
         var lainIndex = 0;

        var data_lain_JSON = '<?php echo json_encode($data_lain); ?>';
        var data_lain_Parse = JSON.parse(data_lain_JSON);

        if(data_lain_Parse.length == 0){
            lainIndex++;
            addLainSection(lainIndex);
            createOption('.bulan_terbit_lain-'+lainIndex, '30', 'id_group');
        } else {
            for (let i = 0; i < data_lain_Parse.length; i++) {
                lainIndex++;
                
                addLainSection(lainIndex);
                $('.id_lain-'+lainIndex).val(data_lain_Parse[i]['id']) ;
                $('.ket_bahasa_lain-'+lainIndex).val(data_lain_Parse[i]['ket_bahasa']) ;
                $('.level_lain-'+lainIndex).val(data_lain_Parse[i]['level']) ;
                $('.no_sertifikat_lain-'+lainIndex).val(data_lain_Parse[i]['no_sertifikat']) ;
                $('.tahun_terbit_lain-'+lainIndex).val(data_lain_Parse[i]['tahun_terbit']) ;
                $('.keterangan_lain-'+lainIndex).val(data_lain_Parse[i]['keterangan']) ;
                
                createOption('.bulan_terbit_lain-'+lainIndex, '30', 'id_group',data_lain_Parse[i]['bulan_terbit']);
            }
        }

        // Add new lain section on button click
        $('#add-lain').click(function() {
            lainIndex++;
            addLainSection(lainIndex);
            createOption('.bulan_terbit_lain-'+lainIndex, '30', 'id_group');
        });

        function addLainSection(index_lain) {
            var LainSection = `
                <div class="form-group lain-section" data-index="${index_lain}">

                <div class="input-group">
                    <div class="form-group col-sm-6 ">
                    <input class="form-control id_lain-${index_lain}" type="text" name="id_lain[]" placeholder="id Lain"  style="width:100%" readonly hidden/>
                    <label class="col-form-label">Bahasa</label>
                        <input class="form-control ket_bahasa_lain-${index_lain}" type="text" name="ket_bahasa_lain[]" style="width:100%;" placeholder="Bahasa" />
                    </div>

                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Level</label>
                        <input class="form-control level_lain-${index_lain}" type="text" name="level_lain[]" style="width:100%;" placeholder="Level / Nilai" />
                    </div>
                </div>

                <div class="input-group">
                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">No Sertifikat</label>
                        <input class="form-control no_sertifikat_lain-${index_lain}" type="text" name="no_sertifikat_lain[]" style="width:100%;" placeholder="No Sertifikat" />
                    </div>

                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Bulan Tahun Terbit</label>
                        <div class="input-group">
                            <select class="form-control bulan_terbit_lain-${index_lain}"  name="bulan_terbit_lain[]">
                                <option value="">Pilih Salah Satu</option>
                            </select>
                            <input type="number" class="form-control tahun_terbit_lain-${index_lain}" name="tahun_terbit_lain[]" placeholder="Tahun Terbit">
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <div class="form-group col-sm-12 ">
                        <label class="col-form-label">Keterangan</label>
                        <input class="form-control keterangan_lain-${index_lain}" type="text" name="keterangan_lain[]" style="width:100%;" placeholder="Keterangan Lainnya" />
                    </div>

                </div>

                    <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                        <button type="button" class="btn btn-danger remove-lain"><i class="far fa-minus-square pr-2"></i>Hapus Bahasa</button>
                    </div>
                <hr class="bg-info" >
                </div>
            `;
            $('#lain-container').append(LainSection);


        }

        // Remove child section on button click
        $(document).on('click', '.remove-lain', function() {
            $(this).closest('.lain-section').remove();
        });

        // batas lain


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