

<div class="card">
	<div class="card-header bg-info text-light">
		<h5 class="card-title"><?=$title?></h5> <i><?=$subtitle?></i>
	</div>
	<div class="card-body">
		
        

		<?php
		if (isset($data_ayah[0]['tanggal_lahir'])) {
			$exp = explode('-', $data_ayah[0]['tanggal_lahir']);
			$tanggal_lahir_ayah = $exp[2] . '-' . $exp[1] . '-' . $exp[0];

			$usia_ayah = strval(intval(date("Y")) - intval($exp[0])) . ' Tahun' ;
		}
		if (isset($data_ibu[0]['tanggal_lahir'])) {
			$exp = explode('-', $data_ibu[0]['tanggal_lahir']);
			$tanggal_lahir_ibu = $exp[2] . '-' . $exp[1] . '-' . $exp[0];

			$usia_ibu = strval(intval(date("Y")) - intval($exp[0])) . ' Tahun' ;
		}
		if (isset($data_pasangan[0]['tanggal_lahir'])) {
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
					<input class="form-control" type="text" name="id_ayah" value="<?= @$data_ayah[0]['id'] ?>" placeholder="id Ayah" readonly hidden/>
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
					<div class="col-sm-6">
                        <div class="input-group">
						    <input class="form-control date-picker " type="text" id="" name="tanggal_lahir_ayah" value="<?= @$tanggal_lahir_ayah?>" placeholder="dd-mm-yyyy" required="required" data-date-end-date="0d"/>
						    <input class="form-control usia-class" type="text" name="usia[]"  value="<?= @$usia_ayah ?>" placeholder="usia" readonly/>
                        </div>
                    </div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Profesi</label>
					<div class="col-sm-6">
						<input class="form-control" type="text"  name="profesi_ayah" value="<?= @$data_ayah[0]['profesi'] ?>" placeholder="Profesi" />
					</div>
				</div>
                
                <!-- bagian ibu -->
                <div class="card-header bg-secondary text-light border rounded mb-2 " style="padding-top: 15px; padding-bottom: 15px;">
                    <h5 class="">Ibu</h5>
                </div>
				<div class="form-group ">
					<input class="form-control" type="text" name="id_ibu" value="<?= @$data_ibu[0]['id'] ?>" placeholder="id Ibu" readonly hidden/>
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
					<div class="col-sm-6">
                        <div class="input-group">
						    <input class="form-control date-picker " type="text" id="" name="tanggal_lahir_ibu" value="<?=set_value('tanggal_lahir_ibu', @$tanggal_lahir_ibu)?>" placeholder="dd-mm-yyyy" required="required" data-date-end-date="0d"/>
						    <input class="form-control usia-class" type="text" name="usia[]"  value="<?= @$usia_ibu ?>" placeholder="usia" readonly/>
                        </div>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Profesi</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="profesi_ibu" value="<?= @$data_ibu[0]['profesi'] ?>" placeholder="Profesi"/>
					</div>
				</div>

                <!-- bagian pasangan -->
                <div class="card-header bg-secondary text-light border rounded mb-2 " style="padding-top: 15px; padding-bottom: 15px;">
                    <h5 class="">Pasangan (Suami/Istri)</h5>
                </div>
				<div class="form-group ">
					<input class="form-control" type="text" name="id_pasangan" value="<?= @$data_pasangan[0]['id'] ?>" placeholder="id Pasangan" readonly hidden/>
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
					<div class="col-sm-6">
                        <div class="input-group">
						    <input class="form-control date-picker " type="text" id="" name="tanggal_lahir_pasangan" value="<?=set_value('tanggal_lahir_pasangan', @$tanggal_lahir_pasangan)?>" placeholder="dd-mm-yyyy"  data-date-end-date="0d"/>
						    <input class="form-control usia-class" type="text" name="usia[]" value="<?= @$usia_pasangan ?>" placeholder="usia" readonly/>
                        </div>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Profesi</label>
					<div class="col-sm-6">
						<input class="form-control" type="text"  name="profesi_pasangan" value="<?= @$data_pasangan[0]['id'] ?>" placeholder="Profesi"/>
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
                    <button type="button" class="btn btn-success" id="add-child"><i class="far fa-plus-square pr-2"></i>Tambah Anak</button>
                </div>

                <!-- bagian saudara kandung -->
                <div class="card-header bg-secondary text-light border rounded mt-3 mb-2" style="padding-top: 15px; padding-bottom: 15px;">
                    <h5 class="">Saudara Kandung</h5>
                </div>
                <div id="sibling-container">
                    <!-- Dynamic saudara kandung input will be added here -->
                </div>
                <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                    <button type="button" class="btn btn-success" id="add-sibling"><i class="far fa-plus-square pr-2"></i>Tambah Saudara</button>
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
            ageInput.val(age);
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

        var data_anak_JSON = '<?php echo json_encode($data_anak); ?>';
        var data_anak_Parse = JSON.parse(data_anak_JSON);

        if(data_anak_Parse.length == 0){
            childIndex++;
            addChildSection(childIndex);
            
            createOption('.jenis_kelamin_anak-'+childIndex, '7', 'id_group');
            createOption('.pendidikan_anak-'+childIndex, '8', 'id_group');
        } else {
            for (let i = 0; i < data_anak_Parse.length; i++) {
                childIndex++;
                // addChildSection(childIndex);
                // $('.id_anak-'+childIndex).val(data_anak_Parse[i]['id']) ;

                var tanggal_lahir_anak='';
                if(data_anak_Parse[i]['tanggal_lahir'].length > 0){
                    var dob_anak = new Date(data_anak_Parse[i]['tanggal_lahir']);
                    var day_anak = String(dob_anak.getDate()).padStart(2, '0');
                    var month_anak = String(dob_anak.getMonth() + 1).padStart(2, '0'); // Bulan di JavaScript 0-11
                    var year_anak = dob_anak.getFullYear();
                    tanggal_lahir_anak = day_anak+"-"+month_anak+"-"+year_anak;

                }
                
                addChildSection(childIndex,tanggal_lahir_anak);
                $('.id_anak-'+childIndex).val(data_anak_Parse[i]['id']) ;
                $('#usia_anak-'+childIndex).val(data_anak_Parse[i]['usia']) ;
                // $('.tanggal_lahir_anak-'+childIndex).val(tanggal_lahir_anak) ;
                
                createOption('.jenis_kelamin_anak-'+childIndex, '7', 'id_group',data_anak_Parse[i]['jenis_kelamin']);
                createOption('.pendidikan_anak-'+childIndex, '8', 'id_group',data_anak_Parse[i]['pendidikan']);
            }
        }


        // Add new child section on button click
        $('#add-child').click(function() {
            childIndex++;
            addChildSection(childIndex);
            
            createOption('.jenis_kelamin_anak-'+childIndex, '7', 'id_group');
            createOption('.pendidikan_anak-'+childIndex, '8', 'id_group');
        });

        function addChildSection(index_anak,tanggal_lahir_anak='') {
            var childSection = `
                <div class="form-group child-section" data-index="${index_anak}">
                
				<div class="form-group ">
					<input class="form-control id_anak-${index_anak}" type="text" name="id_anak[]" value="" placeholder="id Anak" readonly hidden/>
                    <label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input class="form-control tanggal_lahir_anak-${index_anak} date-picker " type="text" value="${tanggal_lahir_anak}" name="tanggal_lahir_anak[]" placeholder="dd-mm-yyyy"  data-date-end-date="0d"/>
                            <input class="form-control usia-class" id= "usia_anak-${index_anak}"  type="text" name="usia[]" placeholder="usia" readonly/>
                        </div>
                    </div>
                </div>

                <div class="input-group ">
                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Jenis Kelamin</label>
                        <div class="">
                            <select class="form-control jenis_kelamin_anak-${index_anak}" id="jenis_kelamin_anak-${index_anak}" name="jenis_kelamin_anak[]" >
                                <option value="">Pilih Salah Satu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-sm-6">
                        <label class=" col-form-label">Pendidikan</label>
                        <div class="">
                            <select class="form-control pendidikan_anak-${index_anak}" name="pendidikan_anak[]">
                                <option value="">Pilih Salah Satu</option>
                            </select>
                        </div>
                    </div>
                </div>
                    
                    <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                        <button type="button" class="btn btn-danger remove-child"><i class="far fa-minus-square pr-2"></i> Hapus Anak</button>
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
                
                var age = parseInt(hariini.getUTCFullYear()) - parseInt(dateInput.split('-')[2]) +' Tahun' ;
                ageInput.val(age);
            });

        }

        // Remove child section on button click
        $(document).on('click', '.remove-child', function() {
            $(this).closest('.child-section').remove();
        });

        // batas anak


        // saudara kandung
         // Add initial sibling section
         var siblingIndex = 0;
        // addSiblingSection(siblingIndex);

        var data_saudara_JSON = '<?php echo json_encode($data_saudara); ?>';
        var data_saudara_Parse = JSON.parse(data_saudara_JSON);

        if(data_saudara_Parse.length == 0){
            siblingIndex++;
            addSiblingSection(siblingIndex);
            createOption('.jenis_kelamin_saudara-'+siblingIndex, '7', 'id_group');
        } else {
            for (let i = 0; i < data_saudara_Parse.length; i++) {
                siblingIndex++;
                // addSiblingSection(siblingIndex);
                // $('.id_saudara-'+siblingIndex).val(data_saudara_Parse[i]['id']) ;

                var tanggal_lahir_saudara='';
                if(data_saudara_Parse[i]['tanggal_lahir'].length > 0){
                    var dob_saudara = new Date(data_saudara_Parse[i]['tanggal_lahir']);
                    var day_saudara = String(dob_saudara.getDate()).padStart(2, '0');
                    var month_saudara = String(dob_saudara.getMonth() + 1).padStart(2, '0'); // Bulan di JavaScript 0-11
                    var year_saudara = dob_saudara.getFullYear();
                    tanggal_lahir_saudara = day_saudara + "-"+ month_saudara +"-"+year_saudara;
                }

                addSiblingSection(siblingIndex,tanggal_lahir_saudara);
                $('.id_saudara-'+siblingIndex).val(data_saudara_Parse[i]['id']) ;
                $('#usia_saudara-'+siblingIndex).val(data_saudara_Parse[i]['usia']) ;
                // $('.tanggal_lahir_saudara-'+siblingIndex).val(tanggal_lahir_saudara) ;
                $('.profesi_saudara-'+siblingIndex).val(data_saudara_Parse[i]['profesi']) ;
                
                createOption('.jenis_kelamin_saudara-'+siblingIndex, '7', 'id_group',data_saudara_Parse[i]['jenis_kelamin']);
            }
        }

        // Add new sibling section on button click
        $('#add-sibling').click(function() {
            siblingIndex++;
            addSiblingSection(siblingIndex);
            createOption('.jenis_kelamin_saudara-'+siblingIndex, '7', 'id_group');
        });

        function addSiblingSection(index_saudara,tanggal_lahir_saudara='') {
            var siblingSection = `
                <div class="form-group sibling-section" data-index="${index_saudara}">
                
				<div class="form-group ">
                    <input class="form-control id_saudara-${index_saudara}" type="text" name="id_saudara[]" value="" placeholder="id saudara" readonly hidden/>
                    <label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input class="form-control date-picker tanggal_lahir_saudara-${index_saudara}" type="text" value="${tanggal_lahir_saudara}" name="tanggal_lahir_saudara[]" placeholder="dd-mm-yyyy"  data-date-end-date="0d"/>
                            <input class="form-control usia-class" id= "usia_saudara-${index_saudara}" type="text" name="usia[]" placeholder="usia" readonly/>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Jenis Kelamin</label>
                        <select class="form-control jenis_kelamin_saudara-${index_saudara}" name="jenis_kelamin_saudara[]" >
                            <option value="">Pilih Salah Satu</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6 ">
                        <label class="col-form-label">Profesi</label>
                        <input class="form-control profesi_saudara-${index_saudara}" type="text" name="profesi_saudara[]" style="width:100%;" placeholder="Profesi saudara" />
                    </div>
                </div>
                    
                    <div class="col-sm-3 col-md-2 col-lg-3 col-xl-6 mt-3">
                        <button type="button" class="btn btn-danger remove-sibling"><i class="far fa-minus-square pr-2"></i> Hapus Saudara</button>
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
                
                var age = parseInt(hariini.getUTCFullYear()) - parseInt(dateInput.split('-')[2]) +' Tahun' ;
                ageInput.val(age);
            });


        }

        // Remove child section on button click
        $(document).on('click', '.remove-sibling', function() {
            $(this).closest('.sibling-section').remove();
        });

        // batas saudara kandung


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