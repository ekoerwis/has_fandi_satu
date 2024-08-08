<?php


// options(['name' => 'gender'], ['M' => 'Male', 'F' => 'Female'], ['input_field', 'default'])
    function confirmationModal($judul='',$message ='') 
    {
        $html = '';

        $html .='<div class="modal fade rounded" id="confirmationModal" tabindex="-1" data-backdrop="false" style="margin-top: 150px;" aria-labelledby="confirmationModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body " id="modalBody">
                    <p><b style = "color:black;" id="status_confirmation"></b></p>
                    <br>
                    <a id="text_confirmation"> </a>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal"> OK </button>
                    </div>
				</div>
			</div>
		</div>
	</div>';

return $html;
}
?>