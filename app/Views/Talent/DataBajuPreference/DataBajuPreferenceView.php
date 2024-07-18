<div class="card">
	<div class="card-header bg-info text-light">
		<h2 class="card-title"><?=$title?></h2> <i><?=$subtitle?></i>
	</div>
	
	<div class="card-body">
		
		<?php
		if (!empty($message)) {
			show_message($message['message'], $message['status'], $message['dismiss']);
		}
		?>
		<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="tab-content" id="myTabContent">
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Ukuran Baju Atasan</label>
					<div class="col-sm-6">
                        <select class="form-control" id="ukuran_baju" name="ukuran_baju"  required="required">
                            <option value="">Pilih Status</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Ukuran Celana</label>
					<div class="col-sm-6">
                        <select class="form-control" id="ukuran_celana" name="ukuran_celana"  required="required">
                            <option value="">Pilih Status</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Ukuran Pinggang</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="ukuran_pinggang"  id="ukuran_pinggang" value="<?=set_value('ukuran_pinggang', @$data_akun['ukuran_pinggang'])?>" placeholder="Ukuran Pinggang" />
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Ukuran Sepatu</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="ukuran_sepatu"  id="ukuran_sepatu" value="<?=set_value('ukuran_sepatu', @$data_akun['ukuran_sepatu'])?>" placeholder="Ukuran Sepatu" />
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Vaksin</label>
					<div class="col-sm-6">
                        <select class="form-control" id="vaksin" name="vaksin"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Merokok ?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="status_merokok" name="status_merokok"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Minum Alkohol ?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="status_alkohol" name="status_alkohol" required="required" >
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Jika Minum Alkohol, Bagaimana Intensitas Minum?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="intensitas_alkohol" name="intensitas_alkohol">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Apakah Bertato ?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="status_tato" name="status_tato"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Kesehatan Badan ?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="kesehatan_badan" name="kesehatan_badan"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-6 col-form-label">Penyakit / Cidera Masa Lalu ?</label>
					<div class="col-sm-6">
                        <select class="form-control" id="status_penyakit" name="status_penyakit"  required="required">
                            <option value="">Pilih Salah Satu</option>
                        </select>
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

        createOption('ukuran_baju', '21', 'id_group' ,'<?= @$data_akun['ukuran_baju'] ?>');
        createOption('ukuran_celana', '22', 'id_group' ,'<?= @$data_akun['ukuran_celana'] ?>');
        createOption('vaksin', '23', 'id_group' ,'<?= @$data_akun['vaksin'] ?>');
        createOption('status_merokok', '24', 'id_group' ,'<?= @$data_akun['status_merokok'] ?>');
        createOption('status_alkohol', '25', 'id_group' ,'<?= @$data_akun['status_alkohol'] ?>');
        createOption('intensitas_alkohol', '26', 'id_group' ,'<?= @$data_akun['intensitas_alkohol'] ?>');
        createOption('status_tato', '27', 'id_group' ,'<?= @$data_akun['status_tato'] ?>');
        createOption('kesehatan_badan', '28', 'id_group' ,'<?= @$data_akun['kesehatan_badan'] ?>');
        createOption('status_penyakit', '29', 'id_group' ,'<?= @$data_akun['status_penyakit'] ?>');

		var status_alkohol = "<?= @$data_akun['status_alkohol'] ?>";
		if(status_alkohol == '0'){
			$('#intensitas_alkohol').prop('disabled', true);
		}

		$('#status_alkohol').change(function() {
			var select1Value = $(this).val();
			if (select1Value != '0') {
				$('#intensitas_alkohol').prop('disabled', false);
			} else {
				$('#intensitas_alkohol').prop('disabled', true);
				$('#intensitas_alkohol').val(''); // Mengosongkan inputan kedua
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