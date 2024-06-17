<div class="card">
	<div class="card-header">
		<h5 class="card-title"><?=$title?></h5>
	</div>
	
	<div class="card-body">
		<?php 
			helper ('html');
			
			echo btn_label(['class' => 'btn btn-light btn-xs',
				'url' => $config->baseURL . $current_module['nama_module'],
				'icon' => 'fa fa-arrow-circle-left',
				'label' => $current_module['judul_module']
			]);
		?>
		<hr/>
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
				<div class="form-group row">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Kode Group</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="kode_group" value="<?=set_value('kode_group', @$dataEdit['kode_group'])?>" placeholder="Kode Group Parameter" required="required" readonly/>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama Group</label>
					<div class="col-sm-5">
						<input class="form-control" type="text" name="nama_group" value="<?=set_value('nama_group', @$dataEdit['nama_group'])?>" placeholder="Nama Group Parameter" required="required"/>
					</div>
				</div>

                <hr>
                <!-- detail -->
                <!-- <div class="card-header"> -->
                    <h3 class="card-title mb-3">Detail Parameter</h3>
                <!-- </div> -->
                <div class="tab-content" id="form-container">
                <table  id="dynamicTable">
                    <thead>
                        <tr >
                            <!-- <th>No</th> -->
                            <th style="text-align: center;" width = "50px"> No </th>
                            <th style="text-align: center;">Kode</th>
                            <th style="text-align: center;">Deskripsi</th>
                            <th style="text-align: center;"></th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $val0= '';
                        $val1= '';
                        $val2= '';
                            if(count($dataEdit['dataDetail']) > 0){
                                $val0= $dataEdit['dataDetail'][0]['id_parameter'];
                                $val1= $dataEdit['dataDetail'][0]['value_parameter'];
                                $val2= $dataEdit['dataDetail'][0]['label_parameter'];
                            }
                        ?>
                        <tr>
                            <td style="text-align: center;" >1</td>
                            <td hidden><input class="form-control" type="text" name="id_parameter[]"  value="<?= $val0 ?>" placeholder="" required="required"/></td>
                            <td><input class="form-control" type="text" name="value_parameter[]" size="10" value="<?= $val1 ?>" placeholder="" required="required"/></td>
                            <td><input class="form-control" type="text" name="label_parameter[]" size="50" value="<?= $val2 ?>"  placeholder="" required="required"/></td>
                            <td><button type="button" name="add" id="add" class="btn btn-success" style="width:30px;"><i class="fas fa-plus"></i></button></td>
                        </tr>

                        <?php
                            if(count($dataEdit['dataDetail']) > 1){
                                for($i=1 ; $i < count($dataEdit['dataDetail']) ;$i++ ){
                                    echo'<tr id="row'.$i.'">'; 
                                    echo'<td style="text-align: center;">'.($i+1).'</td>'; 
                                    echo'<td hidden><input class="form-control" type="text" name="id_parameter[]" size="10" value="'. $dataEdit['dataDetail'][$i]['id_parameter'].'"  placeholder="" required="required"/></td>'; 
                                    echo'<td><input class="form-control" type="text" name="value_parameter[]" size="10" value="'. $dataEdit['dataDetail'][$i]['value_parameter'].'"  placeholder="" required="required"/></td>'; 
                                    echo'<td><input class="form-control" type="text" name="label_parameter[]" size="50" value="'. $dataEdit['dataDetail'][$i]['label_parameter'].'"  placeholder="" required="required"/></td>'; 
                                    echo'<td><button type="button" name="remove" id="'.$i.'" class="btn btn-danger btn_remove" style="width:30px;"><i class="fas fa-times"></i></button></td>'; 
                                    echo'</tr>'; 
                                }
                            }
                        ?>
                    </tbody>
                </table>
                </div>
                <!--batas detail -->
                
                <div class="form-group row mb-0 mt-3">
					<div class="col-sm-5">
						<button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
    $(document).ready(function(){
    var i = parseInt("<?=   count($dataEdit['dataDetail']); ?>");
    $('#add').click(function(){
        i++;
        var scriptAddRow = '';

        scriptAddRow += '<tr id="row'+i+'">'; 
        scriptAddRow += '<td style="text-align: center;">'+i+'</td>'; 
        scriptAddRow += '<td><input class="form-control" type="text" name="value_parameter[]" size="10"  placeholder="" required="required"/></td>'; 
        scriptAddRow += '<td><input class="form-control" type="text" name="label_parameter[]" size="50"  placeholder="" required="required"/></td>'; 
        scriptAddRow += '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" style="width:30px;"><i class="fas fa-times"></i></button></td>'; 
        scriptAddRow += '</tr>'; 
        $('#dynamicTable').append(scriptAddRow);
    });

    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
        updateRowNumbers();
    });

    function updateRowNumbers() {
        $('#dynamicTable tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
        i = $('#dynamicTable tbody tr').length;
    }


});

</script>