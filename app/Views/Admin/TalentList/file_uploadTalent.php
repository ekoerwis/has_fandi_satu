<hr>

<div class="table-responsive">
    <!-- table-striped table-bordered table-hover  -->
    <!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
    <table id="table1" class="table table-striped table-hover table-border" >
        <thead class="thead-light">
            <tr >
                <!-- <th>No</th> -->
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Jenis Dokumen</th>
                <th style="text-align: center;">Keterangan</th>
                <th style="text-align: center;">File</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $id_user_file='';

                if(!empty($data_fileupload)){
                    $id_user_file=$data_fileupload[0]['id_user'];
                    $i=0;
                    foreach($data_fileupload as $data){
                        $i++;
                        echo "<tr>";
                        echo "<td class='text-center'>".$i."</td>";
                        echo "<td>".$data['jenis_dokumen_label']."</td>";
                        echo "<td>".$data['keterangan']."</td>";
                        // echo "<td>".$data['nama_file_new']."</td>";
                        echo '<td class="text-center"><button type="button" class="btn btn-warning rounded download-file-'.$i.'" onclick="downloadFile(this.value)" value="'.$data['nama_file_new'].'"><i class="fas fa-file-download pr-2" ></i>Download</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                        echo "<td colspan=4 class='text-center'>Tidak Ada Data</td>";
                        echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<script>
        
    function downloadFile(value=''){
        // console.log(value);
        url = "<?php echo 'downloadFile?id='.$id_user_file.'&id_file='; ?>"+value ;
        window.open(url, "_self");
    }
</script>