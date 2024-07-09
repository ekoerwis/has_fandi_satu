<hr>

<div class="table-responsive">
    <!-- table-striped table-bordered table-hover  -->
    <!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
    <table id="table1" class="table table-striped table-hover table-border" >
        <thead class="thead-light">
            <tr >
                <!-- <th>No</th> -->
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Hubungan</th>
                <th style="text-align: center;">Tanggal Lahir</th>
                <th style="text-align: center;">Umur</th>
                <th style="text-align: center;">Jenis Kelamin</th>
                <th style="text-align: center;">Pendidikan</th>
                <th style="text-align: center;">Profesi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($data_datakeluarga)){
                    $i=0;
                    foreach($data_datakeluarga as $data){
                        $i++;
                        echo "<tr>";
                        echo "<td class='text-center'>".$i."</td>";
                        echo "<td>".$data['tipe_keluarga_label']."</td>";
                        echo "<td>".date_format(date_create($data['tanggal_lahir']),"d-M-Y")."</td>";
                        echo "<td>".$data['umur']."</td>";
                        echo "<td>".$data['jenis_kelamin_label']."</td>";
                        echo "<td>".$data['pendidikan_label']."</td>";
                        echo "<td>".$data['profesi']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                        echo "<td colspan=7 class='text-center'>Tidak Ada Data</td>";
                        echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>