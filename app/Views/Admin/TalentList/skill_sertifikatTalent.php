<hr>

<div class="table-responsive">
    <!-- table-striped table-bordered table-hover  -->
    <!-- jika ingin memunculkan garis hilankan class table-border karena menggunakan class nya bootstrap -->
    <table id="table1" class="table table-striped table-hover table-border" >
        <thead class="thead-light">
            <tr >
                <!-- <th>No</th> -->
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">Kategori</th>
                <th style="text-align: center;">No. Sertifikat</th>
                <th style="text-align: center;">Bulan Terbit</th>
                <th style="text-align: center;">Tahun Terbit</th>
                <th style="text-align: center;">Keterangan</th>\
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($data_skillsertifikat)){
                    $i=0;
                    foreach($data_skillsertifikat as $data){
                        $i++;
                        echo "<tr>";
                        echo "<td class='text-center'>".$i."</td>";
                        echo "<td>".$data['kategori_label']."</td>";
                        echo "<td>".$data['no_sertifikat']."</td>";
                        echo "<td>".$data['bulan_terbit_label']."</td>";
                        echo "<td>".$data['tahun_terbit']."</td>";
                        echo "<td>".$data['keterangan']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                        echo "<td colspan=6 class='text-center'>Tidak Ada Data</td>";
                        echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>