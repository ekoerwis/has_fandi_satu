<div class="col mt-3" id="">
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Username </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= $data_profile['username']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0">
            <?= $data_profile['nama']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Email </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0">
            <?= $data_profile['email']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">No Telp </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0">
            <?= $data_profile['phone']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tanggal Pendaftaran Akun </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0">
            <?= date_format(date_create(@$data_profile['created']),"d/M/Y")?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tanggal Verifikasi Akun </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0">
            <?= date_format(date_create(@$data_profile['verified']),"d/M/Y H:i:s")?>
        </div>
    </div>
    <hr>
    <div class="row" >
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Avatar</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" style="height: 100px;">
            <?php 
                $avatar = @$data_profile['avatar'];
                if (!empty($avatar))
                echo '<img src="'.$config->baseURL. '/public/images/user/' . $avatar . '" height=100 width=100 :/>';
                
                ?>
        </div>
    </div>
    <hr>

    <!--batas detail -->

</div>