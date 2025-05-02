<main style="padding-top: 40px; margin-top: 79px;">
  <div class="container">
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="mb-5">
          <h1 style="font-weight: bold; color: #166DB5">Daftar Mitra</h1>
          <?php
            $CI =& get_instance();
            foreach ($mitra->result() as $show) {
          ?>
            <div class="card mt-5">
              <div class="card-header">
                <h2 style="font-weight: bold;"><?= $show->nama_mitra; ?></h2>
              </div>
              <div class="card-body">
                <?php
                  $jumlah_row = $CI->get_detail_mitra($show->id)->num_rows();
                  if ($jumlah_row == 0) {
                ?>
                    <p>Belum mengadakan Program Kegiatan Belajar.</p>
                <?php
                  } else {
                ?>
                    <p><?= $show->nama_mitra; ?> Mengadakan Program Kegiatan Belajar yaitu :
                      <ul>
                        <?php
                          foreach ($CI->get_detail_mitra($show->id)->result() as $detail) {
                            if($detail->id_program == '1') {
                        ?>
                              <li>
                                <p style="margin-bottom: 0px;"><b><?= $detail->nama_kegiatan ?></b></p>
                                <p style="margin-bottom: 0px;"><b>Batas Waktu Pendaftaran : </b><?= $CI->tgl_indo($detail->waktu_mulai); ?> s/d <?= $CI->tgl_indo($detail->waktu_selesai); ?></p>
                                <p style="margin-bottom: 5px;">Matakuliah yang terdaftar :
                                  <ol>
                                    <?php
                                      foreach ($CI->mitra_model->get_matakuliah_pertukaran($detail->id)->result() as $show_mk) {
                                    ?>
                                        <li><?= $show_mk->matakuliah ?> dengan sisa kuota berjumlah <b><?= $show_mk->sisa_kuota; ?></b> Orang</li>
                                    <?php
                                      }
                                    ?>
                                  </ol>
                                </p>
                              </li>
                        <?php
                            } else {
                        ?>
                              <li><p style="margin-bottom: 0px;"><b><?= $detail->nama_kegiatan ?></b> dengan sisa kuota berjumlah <b><?= $detail->sisa_kuota ?></b> Orang</p>
                              <p><b>Batas Waktu Pendaftaran : </b><?= $CI->tgl_indo($detail->waktu_mulai); ?> s/d <?= $CI->tgl_indo($detail->waktu_selesai); ?></p>
                              </li>
                        <?php
                            }
                          }
                        ?>
                      </ul>
                    </p>
                <?php
                  }
                ?>
              </div>
            </div>
          <?php
            }
          ?>
        </div>              
      </div>          
    </div>
  </div>
</main>
