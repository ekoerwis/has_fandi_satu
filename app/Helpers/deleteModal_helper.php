<?php


// options(['name' => 'gender'], ['M' => 'Male', 'F' => 'Female'], ['input_field', 'default'])
    function deleteModal($judul='',$message ='', $idButton='deleteModalButton') 
    {
        $html = '';

        $html .='<div class="modal fade" id="deleteModal" tabindex="-1" data-backdrop="false" style="margin-top: 150px;" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modalBody">
					Are you sure you want to delete the selected row?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
				</div>
			</div>
		</div>
	</div>';

        return $html;
    }
?>