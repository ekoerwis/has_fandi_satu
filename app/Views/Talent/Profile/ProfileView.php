<style>
	/* Chrome, Safari, Edge, Opera */
		.phonenumber::-webkit-outer-spin-button,
		.phonenumber::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
		}

	/* Firefox */
	.phonenumber[type=number] {
	-moz-appearance: textfield;
	}
</style>
<div class="card">
	<div class="card-header bg-danger text-light">
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
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Username</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="username" value="<?=set_value('username', @$data_akun['username'])?>" placeholder="Username" required="required" readonly/>
					</div>
				</div>
				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="nama" value="<?=set_value('nama', @$data_akun['nama'])?>" placeholder="Nama" required="required"/>
					</div>
				</div>

				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Email</label>
					<div class="col-sm-6">
						<input class="form-control" type="email" name="email" value="<?=set_value('email', @$data_akun['email'])?>" placeholder="Email" required="required"/>
					</div>
				</div>

				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Phone</label>
					<div class="col-sm-6">
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<div class="input-group-text">+62</div>
							</div>
							<input class="form-control phonenumber" type="number" name="phone" value="<?=set_value('phone', @$data_akun['phone'])?>" placeholder="Phone" />
							<!-- <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username"> -->
						</div>
					</div>
				</div>

				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tanggal Pendaftaran Akun</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="created" value="<?=set_value('created', date_format(date_create(@$data_akun['created']),"d/M/Y"))?>" placeholder="Tanggal Pendaftaran Akun" required="required" readonly/>
					</div>
				</div>

				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tanggal Verifikasi Akun</label>
					<div class="col-sm-6">
						<input class="form-control" type="text" name="verifield" value="<?=set_value('verifield', date_format(date_create(@$data_akun['verified']),"d/M/Y H:i:s"))?>" placeholder="Tanggal Verifikasi Akun" required="required" readonly/>
					</div>
				</div>

				<div class="form-group ">
					<label class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Avatar</label>
					<div class="col-sm-6">
                        <?php 
                            $avatar = @$_FILES['file']['name'] ?: @$data_akun['avatar'];
                            if (!empty($avatar))
                            echo '<div class="list-foto" style="margin:inherit;margin-bottom:10px"><img src="'.$config->baseURL. '/public/images/user/' . $avatar . '"/></div>';
                            
                            ?>
                            <input type="file" class="file" name="avatar">
                                <?php if (!empty($form_errors['avatar'])) echo '<small style="display:block" class="alert alert-danger mb-0">' . $form_errors['avatar'] . '</small>'?>
                            <small class="small" style="display:block">Maksimal 300Kb, Min: 100px x 100px Maks: 300px x 300px, Tipe file: .JPG, .JPEG, .PNG</small>
                            <div class="upload-img-thumb mb-2"><span class="img-prop"></span></div>
					</div>
				</div>

                <hr>

                <!--batas detail -->
                
                <div class="form-group row mb-0 mt-3">
					<div class="col-sm-6">
						<button type="submit" name="submit" value="submit" class="btn btn-success"><i class="far fa-save pr-2"></i> Save</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
    $(document).ready(function(){

});

</script>