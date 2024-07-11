<div class="col mt-3" id="">
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Status </div>
        <div class=" col-form-label"> </div>
        <!-- <div class="col-sm-6 form-control  bg-light border-0" > -->
            <?php
                $status = ' &nbsp;<button type="button" class="btn btn-danger rounded" ><i class="far fa-eye-slash pr-2" ></i>Unpublished</button>';
                $expDate = 'Tidak Ada Data';
            
                if(!empty($data_publishtalent)){

                    $exp = explode('-', $data_publishtalent[0]['publish_expired']);
			        $tanggal_new = $exp[2] . '-' . $exp[1] . '-' . $exp[0];

                    $expDate = date_format(date_create(@$data_publishtalent[0]['publish_expired']),"d/M/Y H:i:s");

                    if(date("Y-m-d H:i:s") < $expDate){
                        $status = ' &nbsp;<button type="button" class="btn btn-success rounded" ><i class="far fa-eye pr-2" ></i>published</button>';
                    }
                }
                echo $status;
            ?>
        <!-- </div> -->
    </div>
    <hr>
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Expired Publish</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 form-control  bg-light border-0">
            <?= @$expDate ?>
        </div>
    </div>
    <hr>
    <form method="post" action="publishTalent" class="form-horizontal">
    <div class="row ">
        <div class="col-sm-3 col-md-2 col-lg-3 col-xl-2 col-form-label">Perpanjang Masa Publish</div>
        <div class=" col-form-label">: </div>
        <div class="col-sm-6 ">
                <input class="form-control date-picker" type="text" id="new_expired" name="new_expired" required value="" placeholder="dd-mm-yyyy" data-date-start-date="0d"/>
                <input type="text" id="id_talent" name="id_talent" value="<?= @$data_profile['id_user']; ?>" readonly hidden/>
            </div>
        </div>
        <hr>
        
        <div class="form-group row mb-0 mt-3">
            <div class="col-sm-6">
                <button type="submit" name="submit" value="submit" class="btn btn-success btn-lg"><i class="far fa-save pr-2"></i> Save</button>
            </div>
        </div>
    </form>
    <!--batas detail -->

</div>  

<script>
    $(document).ready(function(){
        $('.date-picker').datepicker({
		format: "dd-mm-yyyy",
		weekStart: 1,
		language: "id",
		autoclose: true
	});
    } );
</script>