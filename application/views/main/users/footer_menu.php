      <!-- footer start-->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 footer-copyright text-center">
              <p class="mb-0">Copyright 2021 © MBKM Fakultas Ekonomi dan Bisnis (FEB)</p>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- latest jquery-->
  <script src="<?= base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>
  <!-- Bootstrap js-->
  <script src="<?= base_url('assets/js/bootstrap/bootstrap.bundle.min.js'); ?>"></script>
  <!-- feather icon js-->
  <script src="<?= base_url('assets/js/icons/feather-icon/feather.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/icons/feather-icon/feather-icon.js'); ?>"></script>
  <!-- scrollbar js-->
  <script src="<?= base_url('assets/js/scrollbar/simplebar.js'); ?>"></script>
  <script src="<?= base_url('assets/js/scrollbar/custom.js'); ?>"></script>
  <!-- Sidebar jquery-->
  <script src="<?= base_url('assets/js/config.js'); ?>"></script>
  <!-- Plugins JS start-->
  <script src="<?= base_url('assets/js/sidebar-menu.js'); ?>"></script>
  <script src="<?= base_url('assets/js/notify/bootstrap-notify.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/dashboard/default.js'); ?>"></script>
  <script src="<?= base_url('assets/js/notify/index.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datepicker/date-picker/datepicker.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datepicker/date-picker/datepicker.id.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datepicker/date-picker/datepicker.custom.js'); ?>"></script>
  <script src="<?= base_url('assets/js/typeahead/handlebars.js'); ?>"></script>
  <script src="<?= base_url('assets/js/typeahead/typeahead.bundle.js'); ?>"></script>
  <script src="<?= base_url('assets/js/typeahead/typeahead.custom.js'); ?>"></script>
  <script src="<?= base_url('assets/js/typeahead-search/handlebars.js'); ?>"></script>
  <script src="<?= base_url('assets/js/typeahead-search/typeahead-custom.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datatable/datatables/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/datatable/datatables/datatable.custom.js'); ?>"></script>
  <script src="<?= base_url('assets/js/tooltip-init.js'); ?>"></script>
  <script src="<?= base_url('assets/js/sweet-alert/sweetalert.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/sweet-alert/app.js'); ?>"></script>
  <script src="<?= base_url('assets/js/editor/ckeditor/ckeditor.js'); ?>"></script>
  <script src="<?= base_url('assets/js/editor/ckeditor/adapters/jquery.js'); ?>"></script>
  <script src="<?= base_url('assets/js/editor/ckeditor/styles.js'); ?>"></script>
  <script src="<?= base_url('assets/js/editor/ckeditor/ckeditor.custom.js'); ?>"></script>
  <script src="<?= base_url('assets/js/select2/select2.full.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/select2/select2-custom.js'); ?>"></script>
  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="<?= base_url('assets/js/script.js'); ?>"></script>
  <script>
    <?php
      if(isset($show_modal)) {
    ?>
        $(function() {
          $('.add-modal-mbkm').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_update)) {
    ?>
        $(function() {
          $('.edit-modal-mbkm-<?= $show_modal_update; ?>').modal('show');
        });
    <?php
      }
    ?>
    
    <?php
      if(isset($show_modal_pekerjaan)) {
    ?>
        $(function() {
          $('.add-modal-pekerjaan').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_update_pekerjaan)) {
    ?>
        $(function() {
          $('.edit-modal-pekerjaan-<?= $show_modal_update_pekerjaan; ?>').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_jabatan)) {
    ?>
        $(function() {
          $('.add-modal-jabatan').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_update_jabatan)) {
    ?>
        $(function() {
          $('.edit-modal-jabatan-<?= $show_modal_update_jabatan; ?>').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_wirausaha)) {
    ?>
        $(function() {
          $('.add-modal-wirausaha').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_update_wirausaha)) {
    ?>
        $(function() {
          $('.edit-modal-wirausaha-<?= $show_modal_update_wirausaha; ?>').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_seminar)) {
    ?>
        $(function() {
          $('.add-modal-seminar').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_update_seminar)) {
    ?>
        $(function() {
          $('.edit-modal-seminar-<?= $show_modal_update_seminar; ?>').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_prestasi)) {
    ?>
        $(function() {
          $('.add-modal-prestasi').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_update_prestasi)) {
    ?>
        $(function() {
          $('.edit-modal-prestasi-<?= $show_modal_update_prestasi; ?>').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_karya_ilmiah)) {
    ?>
        $(function() {
          $('.add-modal-karya-ilmiah').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_update_karya_ilmiah)) {
    ?>
        $(function() {
          $('.edit-modal-karya-ilmiah-<?= $show_modal_update_karya_ilmiah; ?>').modal('show');
        });
    <?php
      }
    ?>
    
    <?php
      if(isset($show_modal_organisasi)) {
    ?>
        $(function() {
          $('.add-modal-organisasi').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if(isset($show_modal_update_organisasi)) {
    ?>
        $(function() {
          $('.edit-modal-organisasi-<?= $show_modal_update_organisasi; ?>').modal('show');
        });
    <?php
      }
    ?>

    <?php
      if($this->session->flashdata('success_save')){
    ?>
        swal("Sukses", "Data berhasil tersimpan", "success");
    <?php
        $this->session->unset_userdata('success_save');
      } else if($this->session->flashdata('error_save')){
    ?>
        swal("Gagal", "Data gagal tersimpan", "error");
    <?php
        $this->session->unset_userdata('error_save');        
      } else if($this->session->flashdata('success_update')){
    ?>
        swal("Sukses", "Data berhasil terubah", "success");
    <?php
        $this->session->unset_userdata('success_update');
      }  else if($this->session->flashdata('error_update')){
    ?>
        swal("Gagal", "Data gagal terubah", "error");
    <?php
        $this->session->unset_userdata('error_update');
      }
    ?>

    <?php
      if($this->uri->segment(1) == "kegiatan_mbkm_luar" && $this->uri->segment(2) == "add") {
    ?>
        $("#mbkm_kegiatan_container").hide();
    <?php
      }
    ?>

    function tipeChange(tipe) {
      if(tipe =='MBKM Universitas' || tipe =='MBKM Kementrian')  {
        $("#id_program_mbkm").val('');
        $("#uraian").val('');
        $("#mbkm_kegiatan_container").show();
      } else {
        $("#mbkm_kegiatan_container").hide();
      }
    }

    function kegiatan_mbkm(id) {
      let id_mbkm = $("#id_mbkm").val();
      $("#id_kegiatan").val(id);

      var request = $.ajax({
        url: "<?= base_url('pendaftaran/matakuliah') ?>",
        method: "POST",
        data: { id },
        dataType: "json"
      });

      request.done(function( msg ) {
        let error = 0;
        if (msg.status == 'success') {
          // $("#output_matakuliah").empty();
          // // if(msg.count == 0) {
          // //   $("#output_matakuliah").append('<div style="margin-top: 10px;">Matakuliah Konversi belum diinputkan. (Matakuliah dapat diinput belakangan oleh Prodi)</div>');
          // // } else {
          // //   $("#output_matakuliah").append('<div style="margin-top: 10px;">Matakuliah Konversi Kegiatan MBKM yaitu :</div><ul>');
          // //   msg.data.forEach(data => {
          // //     $("#output_matakuliah").append(`<li>(${data.kd_mk}) ${data.matakuliah}</li>`);
          // //   });
          // //   $("#output_matakuliah").append('</ul>');
          // // }

          $("#output_persyaratan").empty();
          $("#submit_syarat").empty();
          if(msg.count_syarat == 0) {
            error++;
            $("#output_persyaratan").append('<div style="margin-top: 10px;">Persyaratan kegiatan belum diinputkan. Silahkan Hub. Prodi yang bersangkutan.</div>');
          } else {
            $("#output_persyaratan").append(`<div style="margin-top: 20px;">Peryaratan Kegiatan (Ukuran file masing-masing tidak boleh melebihi 500 KB, format file harus jpg, jpeg atau png) : <div class="row" style="margin-top: 10px;">`);
            msg.data_syarat.forEach(data => {
              $("#output_persyaratan").append(`
                <div class="col">
                  <div class="mb-3">
                    <label class="form-label">${data.persyaratan}</label>
                    <input class="form-control" type="file" name="syarat_file_${data.id}">
                  </div>
                </div>
              `);
            });
            $("#output_persyaratan").append(`</div>`);

            if(id_mbkm != '1') {
              $("#output_persyaratan").append(`<div style="margin-top: 10px;">Pilih Matakuliah Konversi Untuk Kegiatan ini :</div>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <select name="mk_konversi[]" class="form-select js-example-basic-single">
                      <option label="">- Pilih Matakuliah Konversi -</option>
                      <?php
                        if(isset($matakuliah_konversi)) {
                          foreach ($matakuliah_konversi->result() as $show) {
                            echo "<option value='".$show->kd_mk."'>".$show->matakuliah."</option>";
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class='mt-3'>
                  <a href="javascript:void(0)" class="btn btn-primary" onclick="add_mk_konversi()">Tambah</a>
                </div>
                <div id="matakuliah_konversi_container"></div>
              </div>`);
            }

            if(error == 0) {
              $("#submit_syarat").append(`<div class="card-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>`);
            }
          }
        } else {
          alert('Terdapat Masalah Hub. Admin')
        }
      });
      
      request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
      });
    }

    let dataMK = [];

    function show_mk(semester) {
      let id_kegiatan = $("#id_kegiatan").val();
      let id_mbkm = $("#id_mbkm").val();

      if(id_mbkm == '1') {
        let total_sks=0;
        var request = $.ajax({
          url: "<?= base_url('pendaftaran/matakuliah_pertukaran') ?>",
          method: "POST",
          data: { id_kegiatan, semester },
          dataType: "json"
        });

        request.done(function( msg ) {
          total_sks = msg.total_sks;
          $('#output_mk_pertukaran').append(`
          <div class="mt-3"><b>Total SKS : <span id="total_sks">${total_sks}</span></b></div>
          <div><p style="font-size: 11px;"><i>* Total SKS tidak boleh melebihi 21 SKS, jika ingin mengambil MK dari Universitas lain silahkan submit MK dari universitas ini terlebih dahulu</i></p></div>
          <div id='content-mk'>
            <div style="margin-top: 10px;">Pilih Matakuliah yang akan diambil :</div>
              <div class="row mt-3">
                <div class="col-md-6">
                  <select name="mk_pertukaran[]" class="form-select js-example-basic-single mk_pertukaran0" onchange="get_description(this.value, '0')">
                    <option label="">- Pilih Matakuliah -</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <select name="mk_konversi[]" class="form-select js-example-basic-single" onchange="sum_sks(this.value)">
                    <option label="">- Pilih Matakuliah Konversi -</option>
                    <?php
                      if(isset($matakuliah_konversi)) {
                        foreach ($matakuliah_konversi->result() as $show) {
                          echo "<option value='".$show->kd_mk.",".$show->sks."'>".$show->matakuliah." (".$show->sks." SKS)</option>";
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-12 mt-3">
                  <textarea class="form-control" id="description_0" disabled style="background-color: #ededed"></textarea>
                </div>
              </div>
              <div class='mt-3'>
                <a href="javascript:void(0)" class="btn btn-primary" onclick="add_mk()">Tambah</a>
              </div>
            </div>
            <div id="mk-container"></div>
          </div>`)
          dataMK = msg.data;
          
          msg.data.forEach(data => {
            if(Number(data.sisa_kuota) > 0) {
              $('.mk_pertukaran0').append($('<option>', {
                  value: data.kd_mk,
                  text: `${data.matakuliah} (${data.sks} SKS, Sisa Kuota = ${data.sisa_kuota})`
              }));
            }
          });
        });
        
        request.fail(function( jqXHR, textStatus ) {
          alert( "Request failed: " + textStatus );
        });
      }
    }

    let dataMKInbound = [];
    function show_mk_inbound(semester) {
      let total_sks=0;
      var request = $.ajax({
        url: "<?= base_url('pendaftaran_inbound/matakuliah_inbound') ?>",
        method: "POST",
        data: { semester },
        dataType: "json"
      });

      request.done(function( msg ) {
        total_sks = msg.total_sks;
        $('#output_mk_inbound').append(`
        <div class="mt-3"><b>Total SKS : <span id="total_sks">${total_sks}</span></b></div>
        <div><p style="font-size: 11px;"><i>* Total SKS tidak boleh melebihi 21 SKS, jika ingin mengambil MK dari Universitas lain silahkan submit MK dari universitas ini terlebih dahulu</i></p></div>
        <div id='content-mk'>
          <div style="margin-top: 10px;">Pilih Matakuliah yang akan diambil :</div>
            <div class="row mt-3">
              <div class="col-md-6">
                <select name="mk_inbound[]" class="form-select js-example-basic-single mk_inbound0" onchange="get_description_inbound(this.value, '0')">
                  <option label="">- Pilih Matakuliah -</option>
                </select>
              </div>
              <div class="col-md-12 mt-3">
                <textarea class="form-control" id="description_0" disabled style="background-color: #ededed"></textarea>
              </div>
            </div>
            <div class='mt-3'>
              <a href="javascript:void(0)" class="btn btn-primary" onclick="add_mk_inbound()">Tambah</a>
            </div>
          </div>
          <div id="mk-container"></div>
        </div>`)
        dataMKInbound = msg.data;
        
        msg.data.forEach(data => {
          if(Number(data.sisa_kuota) > 0) {
            $('.mk_inbound0').append($('<option>', {
                value: data.id+ "," +data.sks,
                text: `${data.matakuliah} (${data.sks} SKS, Sisa Kuota = ${data.sisa_kuota})`
            }));
          }
        });

        $("#submit_syarat").append(`<div class="card-footer">
          <button class="btn btn-primary" type="submit">Submit</button>
        </div>`);
      });
      
      request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
      });
    }


    let mk = 0;
    function add_mk() {
      mk++;
      $("#mk-container").append(`
        <div id="mk-${mk}">
          <div class="row mt-3">
            <div class="col-md-6">
              <select name="mk_pertukaran[]" class="form-select js-example-basic-single mk_pertukaran${mk}" onchange="get_description(this.value, '${mk}')">
                <option label="">- Pilih Matakuliah -</option>
              </select>
            </div>
            <div class="col-md-6">
              <select name="mk_konversi[]" class="form-select js-example-basic-single" onchange="sum_sks(this.value)">
                <option label="">- Pilih Matakuliah Konversi -</option>
                <?php
                  if(isset($matakuliah_konversi)) {
                    foreach ($matakuliah_konversi->result() as $show) {
                      echo "<option value='".$show->kd_mk.",".$show->sks."'>".$show->matakuliah." (".$show->sks." SKS)</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="col-md-12 mt-3">
              <textarea class="form-control" id="description_${mk}}" disabled style="background-color: #ededed"></textarea>
            </div>
          </div>
          <div class='mt-3'>
            <a href="javascript:void(0)" class="btn btn-primary" onclick="add_mk()">Tambah</a>
            <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_mk()">Hapus</a>
          </div>
        </div>
      </div>`);
      dataMK.forEach(data => {
        $(`.mk_pertukaran${mk}`).append($('<option>', {
            value: data.kd_mk,
            text: `${data.matakuliah} (${data.sks} SKS)`
        }));
      });
    }

    let mk_inbound = 0;
    function add_mk_inbound() {
      mk_inbound++;
      $("#mk-container").append(`
        <div id="mk-${mk_inbound}">
          <div class="row mt-3">
            <div class="col-md-6">
              <select name="mk_inbound[]" class="form-select js-example-basic-single mk_inbound${mk_inbound}" onchange="get_description_inbound(this.value, '${mk_inbound}')">
                <option label="">- Pilih Matakuliah -</option>
              </select>
            </div>
            <div class="col-md-12 mt-3">
              <textarea class="form-control" id="description_${mk_inbound}" disabled style="background-color: #ededed"></textarea>
            </div>
          </div>
          <div class='mt-3'>
            <a href="javascript:void(0)" class="btn btn-primary" onclick="add_mk_inbound()">Tambah</a>
            <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_mk_inbound()">Hapus</a>
          </div>
        </div>
      </div>`);
      dataMKInbound.forEach(data => {
        $(`.mk_inbound${mk_inbound}`).append($('<option>', {
            value: data.id+ "," +data.sks,
            text: `${data.matakuliah} (${data.sks} SKS, Sisa Kuota = ${data.sisa_kuota})`
        }));
      });
    }

    let mk_konversi = 0;
    function add_mk_konversi() {
      mk_konversi++;
      $("#matakuliah_konversi_container").append(`
        <div id="mk-konversi-${mk_konversi}">
          <div class="row mt-3">
            <div class="col-md-6">
              <select name="mk_konversi[]" class="form-select js-example-basic-single">
                <option label="">- Pilih Matakuliah Konversi -</option>
                <?php
                  if(isset($matakuliah_konversi)) {
                    foreach ($matakuliah_konversi->result() as $show) {
                      echo "<option value='".$show->kd_mk."'>".$show->matakuliah."</option>";
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class='mt-3'>
            <a href="javascript:void(0)" class="btn btn-primary" onclick="add_mk_konversi()">Tambah</a>
            <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_mk_konversi()">Hapus</a>
          </div>
        </div>
      `);
    }

    let mk_lain = 0;
    function add_mk_lain() {
      mk_lain++;
      $("#mk_kegiatan_lain").append(`
        <div id="mk-lain-${mk_lain}">
          <div class="row mt-3">
            <div class="col-md-6">
              <select name="kode_mk[]" class="form-select js-example-basic-single">
                <option label="">- Pilih Matakuliah -</option>
                <?php
                  if(isset($matakuliah)) {
                    foreach ($matakuliah->result() as $show) {
                      echo "<option value='".$show->kd_mk."'>".$show->matakuliah." - (".$show->sks." SKS)</option>";
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class='mt-3'>
            <a href="javascript:void(0)" class="btn btn-primary" onclick="add_mk_lain()">Tambah</a>
            <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_mk_lain()">Hapus</a>
          </div>
        </div>
      `);
    }

    function delete_mk_konversi() {
      $(`#mk-konversi-${mk_konversi}`).remove();
      mk_konversi--;
    }

    function delete_mk_lain() {
      $(`#mk-lain-${mk_lain}`).remove();
      mk_lain--;
    }

    function get_description(kd_mk, number) {
      var request = $.ajax({
        url: "<?= base_url('pendaftaran/get_description') ?>",
        method: "POST",
        data: { kd_mk },
        dataType: "json"
      });

      request.done(function( msg ) {
        $(`#description_${number}`).val(msg.data);
      });
      
      request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
      });
    }

    function get_description_inbound(kd_mk, number) {
      const splitMK = kd_mk.split(",");
      let kd_mk1 = splitMK[0];
      var request = $.ajax({
        url: "<?= base_url('pendaftaran_inbound/get_description') ?>",
        method: "POST",
        data: { kd_mk1 },
        dataType: "json"
      });

      request.done(function( msg ) {
        $(`#description_${number}`).val(msg.data);
        sum_sks(kd_mk);
      });
      
      request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
      });
    }

    function sum_sks(sks) {
      const splitSKS = sks.split(",");
      let sksValue = splitSKS[1];
      const totalSKS = $("#total_sks").text();
            
      const sumSKS = Number(sksValue) + Number(totalSKS);
      $("#total_sks").text(sumSKS);

      if(sumSKS > 21) {
        $("#content-mk").empty();
        $("#content-mk").append(`<div class="row mt-3">
          <div class="col-md-12">
            <h4>Tidak dapat memilih Matakuliah lagi karena telah melebihi 21 SKS, silahkan refresh kembali halaman ini untuk memulai perhitungan SKS kembali</h4>
          </div>
        </div>`);
        $("#submit_syarat").empty();
      }
    }

    function delete_mk() {
      $(`#mk-${mk}`).remove();
      mk--;
    }

    

    function delete_mk_inbound() {
      $(`#mk-${mk_inbound}`).remove();
      mk_inbound--;
    }
    
    function deleteDataOrganisasi(id, menu) {
      swal({
        title: 'Yakin ingin menghapus data?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        buttons: {
          cancel: "Batal",
          deleted: {
            text: "Iya, hapus data!",
            value: "deleted",
                  }
        },
      })
      .then((value) => {
        switch (value) {
          case "deleted":
            var request = $.ajax({
              url: "<?= base_url(); ?>"+ menu + "/delete_organisasi",
              method: "POST",
              data: { id : id },
              dataType: "json"
            });
            
            request.done(function( msg ) {
              if (msg.status == 'success') {
                swal(
                  'Deleted!',
                  'Data berhasil di hapus.',
                  'success'
                )
                .then((success_act) => {
                  window.location = "<?= base_url(); ?>" + menu;
                })
              } else {
                swal(
                  'Failed!',
                  'Data gagal di hapus.',
                  'danger'
                )
              }
            });
            
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
          break;
          default:
            swal("Data batal dihapus!");
        }
      })
    }

    function deleteDataKaryaIlmiah(id, menu) {
      swal({
        title: 'Yakin ingin menghapus data?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        buttons: {
          cancel: "Batal",
          deleted: {
            text: "Iya, hapus data!",
            value: "deleted",
                  }
        },
      })
      .then((value) => {
        switch (value) {
          case "deleted":
            var request = $.ajax({
              url: "<?= base_url(); ?>"+ menu + "/delete_karya_ilmiah",
              method: "POST",
              data: { id : id },
              dataType: "json"
            });
            
            request.done(function( msg ) {
              if (msg.status == 'success') {
                swal(
                  'Deleted!',
                  'Data berhasil di hapus.',
                  'success'
                )
                .then((success_act) => {
                  window.location = "<?= base_url(); ?>" + menu;
                })
              } else {
                swal(
                  'Failed!',
                  'Data gagal di hapus.',
                  'danger'
                )
              }
            });
            
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
          break;
          default:
            swal("Data batal dihapus!");
        }
      })
    }

    function deleteDataPrestasi(id, menu) {
      swal({
        title: 'Yakin ingin menghapus data?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        buttons: {
          cancel: "Batal",
          deleted: {
            text: "Iya, hapus data!",
            value: "deleted",
                  }
        },
      })
      .then((value) => {
        switch (value) {
          case "deleted":
            var request = $.ajax({
              url: "<?= base_url(); ?>"+ menu + "/delete_prestasi",
              method: "POST",
              data: { id : id },
              dataType: "json"
            });
            
            request.done(function( msg ) {
              if (msg.status == 'success') {
                swal(
                  'Deleted!',
                  'Data berhasil di hapus.',
                  'success'
                )
                .then((success_act) => {
                  window.location = "<?= base_url(); ?>" + menu;
                })
              } else {
                swal(
                  'Failed!',
                  'Data gagal di hapus.',
                  'danger'
                )
              }
            });
            
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
          break;
          default:
            swal("Data batal dihapus!");
        }
      })
    }
    
    function deleteDataSeminar(id, menu) {
      swal({
        title: 'Yakin ingin menghapus data?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        buttons: {
          cancel: "Batal",
          deleted: {
            text: "Iya, hapus data!",
            value: "deleted",
                  }
        },
      })
      .then((value) => {
        switch (value) {
          case "deleted":
            var request = $.ajax({
              url: "<?= base_url(); ?>"+ menu + "/delete_seminar",
              method: "POST",
              data: { id : id },
              dataType: "json"
            });
            
            request.done(function( msg ) {
              if (msg.status == 'success') {
                swal(
                  'Deleted!',
                  'Data berhasil di hapus.',
                  'success'
                )
                .then((success_act) => {
                  window.location = "<?= base_url(); ?>" + menu;
                })
              } else {
                swal(
                  'Failed!',
                  'Data gagal di hapus.',
                  'danger'
                )
              }
            });
            
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
          break;
          default:
            swal("Data batal dihapus!");
        }
      })
    }

    function deleteDataWirausaha(id, menu) {
      swal({
        title: 'Yakin ingin menghapus data?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        buttons: {
          cancel: "Batal",
          deleted: {
            text: "Iya, hapus data!",
            value: "deleted",
                  }
        },
      })
      .then((value) => {
        switch (value) {
          case "deleted":
            var request = $.ajax({
              url: "<?= base_url(); ?>"+ menu + "/delete_wirausaha",
              method: "POST",
              data: { id : id },
              dataType: "json"
            });
            
            request.done(function( msg ) {
              if (msg.status == 'success') {
                swal(
                  'Deleted!',
                  'Data berhasil di hapus.',
                  'success'
                )
                .then((success_act) => {
                  window.location = "<?= base_url(); ?>" + menu;
                })
              } else {
                swal(
                  'Failed!',
                  'Data gagal di hapus.',
                  'danger'
                )
              }
            });
            
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
          break;
          default:
            swal("Data batal dihapus!");
        }
      })
    }
    
    function deleteDataJabatan(id, menu) {
      swal({
        title: 'Yakin ingin menghapus data?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        buttons: {
          cancel: "Batal",
          deleted: {
            text: "Iya, hapus data!",
            value: "deleted",
                  }
        },
      })
      .then((value) => {
        switch (value) {
          case "deleted":
            var request = $.ajax({
              url: "<?= base_url(); ?>"+ menu + "/delete_jabatan",
              method: "POST",
              data: { id : id },
              dataType: "json"
            });
            
            request.done(function( msg ) {
              if (msg.status == 'success') {
                swal(
                  'Deleted!',
                  'Data berhasil di hapus.',
                  'success'
                )
                .then((success_act) => {
                  window.location = "<?= base_url(); ?>" + menu;
                })
              } else {
                swal(
                  'Failed!',
                  'Data gagal di hapus.',
                  'danger'
                )
              }
            });
            
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
          break;
          default:
            swal("Data batal dihapus!");
        }
      })
    }

    function deleteDataPekerjaan(id, menu) {
      swal({
        title: 'Yakin ingin menghapus data?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        buttons: {
          cancel: "Batal",
          deleted: {
            text: "Iya, hapus data!",
            value: "deleted",
                  }
        },
      })
      .then((value) => {
        switch (value) {
          case "deleted":
            var request = $.ajax({
              url: "<?= base_url(); ?>"+ menu + "/delete_pekerjaan",
              method: "POST",
              data: { id : id },
              dataType: "json"
            });
            
            request.done(function( msg ) {
              if (msg.status == 'success') {
                swal(
                  'Deleted!',
                  'Data berhasil di hapus.',
                  'success'
                )
                .then((success_act) => {
                  window.location = "<?= base_url(); ?>" + menu;
                })
              } else {
                swal(
                  'Failed!',
                  'Data gagal di hapus.',
                  'danger'
                )
              }
            });
            
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
          break;
          default:
            swal("Data batal dihapus!");
        }
      })
    }

    function deleteData(id, menu) {
      swal({
        title: 'Yakin ingin menghapus data?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        buttons: {
          cancel: "Batal",
          deleted: {
            text: "Iya, hapus data!",
            value: "deleted",
                  }
        },
      })
      .then((value) => {
        switch (value) {
          case "deleted":
            var request = $.ajax({
              url: "<?= base_url(); ?>"+ menu + "/delete",
              method: "POST",
              data: { id : id },
              dataType: "json"
            });
            
            request.done(function( msg ) {
              if (msg.status == 'success') {
                swal(
                  'Deleted!',
                  'Data berhasil di hapus.',
                  'success'
                )
                .then((success_act) => {
                  window.location = "<?= base_url(); ?>" + menu;
                })
              } else {
                swal(
                  'Failed!',
                  'Data gagal di hapus.',
                  'danger'
                )
              }
            });
            
            request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
          break;
          default:
            swal("Data batal dihapus!");
        }
      })
    }
  </script>
  <!-- login js-->
  <!-- Plugin used-->
   <!--ini juga-->
  <?php if ($this->session->flashdata('ulang_tahun')): ?>
  <!-- SweetAlert & Confetti CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

  <script>
    // Tampilkan Confetti
    confetti({
      particleCount: 150,
      spread: 100,
      origin: { y: 0.6 }
    });

    // Tampilkan Popup
    Swal.fire({
      title: '🎉 Selamat Ulang Tahun!',
      text: 'Halo <?= $this->session->flashdata('ulang_tahun'); ?>, semoga selalu sehat dan sukses!',
      icon: 'success',
      confirmButtonText: 'Terima kasih!',
      timer: 6000,
      timerProgressBar: true
    });
  </script>
<?php endif; ?>


</body>