

<div class="card">
	<div class="card-header bg-info text-light">
		<h5 class="card-title"><?=$title?></h5>
	</div>
	<div class="card-body">
		
        

		<?php
		if ($data_ayah[0]['tanggal_lahir']) {
			$exp = explode('-', $data_ayah[0]['tanggal_lahir']);
			$tanggal_lahir_ayah = $exp[2] . '-' . $exp[1] . '-' . $exp[0];

			$usia_ayah = strval(intval(date("Y")) - intval($exp[0])) . ' Tahun' ;
		}
		if ($data_ibu[0]['tanggal_lahir']) {
			$exp = explode('-', $data_ibu[0]['tanggal_lahir']);
			$tanggal_lahir_ibu = $exp[2] . '-' . $exp[1] . '-' . $exp[0];

			$usia_ibu = strval(intval(date("Y")) - intval($exp[0])) . ' Tahun' ;
		}
		if ($data_pasangan[0]['tanggal_lahir']) {
			$exp = explode('-', $data_pasangan[0]['tanggal_lahir']);
			$tanggal_lahir_pasangan = $exp[2] . '-' . $exp[1] . '-' . $exp[0];

			$usia_pasangan = strval(intval(date("Y")) - intval($exp[0])) . ' Tahun' ;
		}

		if (!empty($message)) {
			show_message($message['message'], $message['status'], $message['dismiss']);
		}
		?>
		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
        

			<div class="tab-content" id="myTabContent">

            <!-- bagian ayah -->
            <div class="card-header bg-secondary text-light border rounded mb-2 " style="padding-top: 15px; padding-bottom: 15px;">
                    <h5 class="">Ayah</h5>
                </div>
				<div class="form-group">
					<input class="form-control" type="text" name="id_ayah" value="<?= $data_ayah[0]['id'] ?>" placeholder="id Ayah" readonly/>
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
					<div class="col-sm-6">
                        <div class="input-group">
						    <input class="form-control date-picker " type="text" id="" name="tanggal_lahir_ayah" value="<?= $tanggal_lahir_ayah?>" placeholder="dd-mm-yyyy" required="required" data-date-end-date="0d"/>
						    <input class="form-control usia-class" type="text" name="usia[]"  value="<?= $usia_ayah ?>" placeholder="usia" readonly/>
                        </div>
                    </div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Profesi</label>
					<div class="col-sm-6">
						<input class="form-control" type="text"  name="profesi_ayah" value="<?= $data_ayah[0]['profesi'] ?>" placeholder="Profesi" />
					</div>
				</div>
                
                <!-- bagian ibu -->
                <div class="card-header bg-secondary text-light border rounded mb-2 " style="padding-top: 15px; padding-bottom: 15px;">
                    <h5 class="">Ibu</h5>
                </div>
				<div class="form-group ">
					<input class="form-control" type="text" name="id_ibu" value="<?= $data_ibu[0]['id'] ?>" placeholder="id Ibu" readonly/>
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
					<div class="col-sm-6">
                        <div class="input-group">
						    <input class="form-control date-picker " type="text" id="" name="tanggal_lahir_ibu" value="<?=set_value('tanggal_lahir_ibu', @$tanggal_lahir_ibu)?>" placeholder="dd-mm-yyyy" required="required" data-date-end-date="0d"/>
						    <input class="form-control usia-class" type="text" name="usia[]"  value="<?= $usia_ibu ?>" placeholder="usia" readonly/>
                        </div>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Profesi</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="profesi_ibu" value="<?= $data_ibu[0]['profesi'] ?>" placeholder="Profesi"/>
					</div>
				</div>

                <!-- bagian pasangan -->
                <div class="card-header bg-secondary text-light border rounded mb-2 " style="padding-top: 15px; padding-bottom: 15px;">
                    <h5 class="">Pasangan (Suami/Istri)</h5>
                </div>
				<div class="form-group ">
					<input class="form-control" type="text" name="id_pasangan" value="<?= $data_pasangan[0]['id'] ?>" placeholder="id Pasangan" readonly/>
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
					<div class="col-sm-6">
                        <div class="input-group">
						    <input class="form-control date-picker " type="text" id="" name="tanggal_lahir_pasangan" value="<?=set_value('tanggal_lahir_pasangan', @$tanggal_lahir_pasangan)?>" placeholder="dd-mm-yyyy"  data-date-end-date="0d"/>
						    <input class="form-control usia-class" type="text" name="usia[]" value="<?= $usia_pasangan ?>" placeholder="usia" readonly/>
                        </div>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Profesi</label>
					<div class="col-sm-6">
						<input class="form-control" type="text"  name="profesi_pasangan" value="<?= $data_pasangan[0]['id'] ?>" placeholder="Profesi"/>
					</div>
				</div>

                


                <!-- bagian anak -->
                <div class="card-header bg-secondary text-light border rounded mb-2" style="padding-top: 15px; padding-bottom: 15px;">
                    <h5 class="">Anak</h5>
                </div>
                <div id="children-container">
                    <!-- Dynamic children input will be added here -->
                </div>
                <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                    <button type="button" class="btn btn-success" id="add-child">Tambah Anak</button>
                </div>

                <!-- bagian saudara kandung -->
                <div class="card-header bg-secondary text-light border rounded mt-3 mb-2" style="padding-top: 15px; padding-bottom: 15px;">
                    <h5 class="">Saudara Kandung</h5>
                </div>
                <div id="sibling-container">
                    <!-- Dynamic saudara kandung input will be added here -->
                </div>
                <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                    <button type="button" class="btn btn-success" id="add-sibling">Tambah Saudara</button>
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

         // Initialize datepicker
         $('.date-picker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        }).on('changeDate', function(e) {
            var dateInput = $(this).val();
            var ageInput = $(this).closest('.input-group').find('.usia-class');
            var hariini = new Date();
            
            // var age = calculateAge(new Date(dateInput.split('-').reverse().join('-')));
            var age = parseInt(hariini.getUTCFullYear()) - parseInt(dateInput.split('-')[2]) +' Tahun' ;
            ageInput.val(age + " Tahun");
        });

        // Calculate age function
        function calculateAge(birthday) {
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs);
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }

        // anak
         // Add initial child section
         var childIndex = 0;
        addChildSection(childIndex);

        // Add new child section on button click
        $('#add-child').click(function() {
            childIndex++;
            addChildSection(childIndex);
        });

        function addChildSection(index_anak) {
            var childSection = `
                <div class="form-group child-section" data-index="${index_anak}">
                
				<div class="form-group ">
					<input class="form-control class_id_anak-${index_anak}" type="text" name="id_anak[]" value="" placeholder="id Anak" readonly/>
                    <label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input class="form-control date-picker " type="text" name="tanggal_lahir_anak[]" placeholder="dd-mm-yyyy" required="required" data-date-end-date="0d"/>
                            <input class="form-control usia-class" type="text" name="usia[]" placeholder="usia" readonly/>
                        </div>
                    </div>
                </div>

                <div class="input-group ">
                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Jenis Kelamin</label>
                        <div class="">
                            <select class="form-control jenis_kelamin_anak-${index_anak}" name="jenis_kelamin_anak[]" required="required">
                                <option value="">Pilih Salah Satu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label class=" col-form-label">Pendidikan</label>
                        <div class="">
                            <select class="form-control pendidikan_anak-${index_anak}" name="pendidikan_anak[]" required="required">
                                <option value="">Pilih Salah Satu</option>
                            </select>
                        </div>
                    </div>
                </div>
                    
                    <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                        <button type="button" class="btn btn-danger remove-child">Hapus Anak</button>
                    </div>
                <hr class="bg-info" >
                </div>
            `;
            $('#children-container').append(childSection);

            // Reinitialize datepicker
            $('.date-picker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            }).on('changeDate', function(e) {
                var dateInput = $(this).val();
                var ageInput = $(this).closest('.input-group').find('.usia-class');
                var hariini = new Date();
                
                // var age = calculateAge(new Date(dateInput.split('-').reverse().join('-')));
                var age = parseInt(hariini.getUTCFullYear()) - parseInt(dateInput.split('-')[2]) +' Tahun' ;
                ageInput.val(age + " Tahun");
            });

            // Load select options with AJAX
            // loadAnakOptions(index);
            createOption('.jenis_kelamin_anak-'+index_anak, '7', 'id_group');
            createOption('.pendidikan_anak-'+index_anak, '8', 'id_group');

        }

        // Remove child section on button click
        $(document).on('click', '.remove-child', function() {
            $(this).closest('.child-section').remove();
        });

        // batas anak


        // saudara kandung
         // Add initial sibling section
         var siblingIndex = 0;
        addSiblingSection(siblingIndex);

        // Add new sibling section on button click
        $('#add-sibling').click(function() {
            siblingIndex++;
            addSiblingSection(siblingIndex);
        });

        function addSiblingSection(index_saudara) {
            var siblingSection = `
                <div class="form-group sibling-section" data-index="${index_saudara}">
                
				<div class="form-group ">
                    <input class="form-control class_id_saudara-${index_saudara}" type="text" name="id_saudara[]" value="" placeholder="id saudara" readonly/>
                    <label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input class="form-control date-picker " type="text" name="tanggal_lahir_saudara[]" placeholder="dd-mm-yyyy" required="required" data-date-end-date="0d"/>
                            <input class="form-control usia-class" type="text" name="usia[]" placeholder="usia" readonly/>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Jenis Kelamin</label>
                        <select class="form-control jenis_kelamin_saudara-${index_saudara}" name="jenis_kelamin_saudara[]" required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Profesi</label>
                        <input class="form-control profesi_saudara-${index_saudara}" type="text" name="profesi_saudara[]" style="width:100%;" placeholder="Profesi saudara" />
                    </div>
                </div>
                    
                    <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                        <button type="button" class="btn btn-danger remove-sibling">Hapus Saudara</button>
                    </div>
                <hr class="bg-info" >
                </div>
            `;
            $('#sibling-container').append(siblingSection);

            // Reinitialize datepicker
            $('.date-picker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            }).on('changeDate', function(e) {
                var dateInput = $(this).val();
                var ageInput = $(this).closest('.input-group').find('.usia-class');
                var hariini = new Date();
                
                // var age = calculateAge(new Date(dateInput.split('-').reverse().join('-')));
                var age = parseInt(hariini.getUTCFullYear()) - parseInt(dateInput.split('-')[2]) +' Tahun' ;
                ageInput.val(age + " Tahun");
            });

            // Load select options with AJAX
            // loadAnakOptions(index);
            createOption('.jenis_kelamin_saudara-'+index_saudara, '7', 'id_group');

        }

        // Remove child section on button click
        $(document).on('click', '.remove-sibling', function() {
            $(this).closest('.sibling-section').remove();
        });

        // batas saudara kandung


        var formGroupCount = 1;
        
        var dataJSON = '<?php echo json_encode($data_anak); ?>';
        var dataParse=JSON.parse(dataJSON);

        // console.log(dataJSON);
        // console.log('banyak data='+ dataParse.length);

        if(dataParse.length == 0){
            // createOption('.pendidikan_ayah', '8', 'id_group' );
            // createOption('.pendidikan_ibu', '8', 'id_group' );
            // createOption('.pendidikan_pasangan', '8', 'id_group' );
        } else {
            // for (let i = 0; i < dataParse.length; i++) {
            //     if(i == 0){
            //         createOption('.tipe_pekerjaan-'+formGroupCount, '31', 'id_group',dataParse[i]['tipe_pekerjaan'] );
            //         createOption('.lokasi_pekerjaan-'+formGroupCount, '32', 'id_group' ,dataParse[i]['lokasi_pekerjaan']);
            //         createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group' ,dataParse[i]['bulan_masuk']);
            //         createOption('.bulan_keluar-'+formGroupCount, '30', 'id_group' ,dataParse[i]['bulan_keluar']);
            //     } else {
            //         addFormGroup();
            //         createOption('.tipe_pekerjaan-'+formGroupCount, '31', 'id_group',dataParse[i]['tipe_pekerjaan'] );
            //         createOption('.lokasi_pekerjaan-'+formGroupCount, '32', 'id_group',dataParse[i]['lokasi_pekerjaan'] );
            //         createOption('.bulan_masuk-'+formGroupCount, '30', 'id_group' ,dataParse[i]['bulan_masuk']);
            //         createOption('.bulan_keluar-'+formGroupCount, '30', 'id_group',dataParse[i]['bulan_keluar']);
            //         $('.id-'+formGroupCount).val(dataParse[i]['id']) ;
            //         $('.nama_kota-'+formGroupCount).val(dataParse[i]['nama_kota']) ;
            //         $('.nama_perusahaan-'+formGroupCount).val(dataParse[i]['nama_perusahaan']) ;
            //         $('.bidang_pekerjaan-'+formGroupCount).val(dataParse[i]['bidang_pekerjaan']) ;
            //         $('.tahun_masuk-'+formGroupCount).val(dataParse[i]['tahun_masuk']) ;
            //         $('.tahun_keluar-'+formGroupCount).val(dataParse[i]['tahun_keluar']) ;
            //     }
            // }
        }

        


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