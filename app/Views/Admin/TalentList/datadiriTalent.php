<div class="col mt-3" id="">
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama Depan </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['nama_depan']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama Tengah </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['nama_tengah']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama Belakang </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['nama_belakang']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Nama Katakana </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['nama_katakana']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tempat Lahir </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['tempat_lahir']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tanggal Lahir </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= date_format(date_create(@$data_datadiri['tanggal_lahir']),"d/M/Y") ?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Jenis Kelamin </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['sex_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Status Nikah </div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['status_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Bersedia Kerja Shift ?</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['kerja_shift_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Bersedia Kerja Lembur ?</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['kerja_overtime_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Bersedia Kerja Hari Libur ?</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['kerja_offday_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Menggunakan Kacamata ?</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['kacamata_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Ketajaman Mata Kiri</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['mata_kiri_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Ketajaman Mata Kanan</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['mata_kanan_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tinggi Badan (Cm)</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['tinggi_badan']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Berat Badan (Kg)</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['berat_badan']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Golongan Darah</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['golongan_darah_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Tangan Dominan</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['tangan_dominan_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Agama</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" >
            <?= @$data_datadiri['agama_label']?>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Kelebihan</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" style="height: 110px;" >
            <textarea maxlength="500" class="form-control" rows="5" readonly><?= @$data_datadiri['kelebihan']?></textarea>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Kekurangan</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" style="height: 110px;" >
            <textarea maxlength="500" class="form-control" rows="5" readonly><?= @$data_datadiri['kekurangan']?></textarea>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Hobi</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0" style="height: 110px;" >
            <textarea maxlength="500" class="form-control" rows="5" readonly><?= @$data_datadiri['hobi']?></textarea>
        </div>
    </div>
    <hr>

    <!--batas detail -->

</div>