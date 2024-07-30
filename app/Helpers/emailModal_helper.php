<?php


// options(['name' => 'gender'], ['M' => 'Male', 'F' => 'Female'], ['input_field', 'default'])
    function emailModal($judul='',$message ='', $idButton='deleteModalButton') 
    {
        $html = '';

        $html .='<div class="modal fade rounded" id="emailModal" tabindex="-1" data-backdrop="false" style="margin-top: 150px;" aria-labelledby="emailModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="emailModalLabel">Konfirmasi ?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body " id="modalBody">
                    <div class="row col-md-12">
                        <div class ="col-md-6" id="fotoConfirmation">
                            
                        </div>
                        <div class ="col-md-6">
                            <p><b style = "color:black;">Anda Berminat Melakukan Proses Rekruitment Kepada <a id="nama_konfirmasi"></a> ? </b></p>
                            <br>
                            <a id="text_komunikasi"></a>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success" id="confirmInterest">Proccess</button>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>';

return $html;
}
?>