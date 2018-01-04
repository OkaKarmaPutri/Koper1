<!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="label"></h4>
              </div>
              <div class="modal-body">
                <!-- form start -->
                <form class="form-horizontal" id="form">
                  <div class="box-body">
                    <input type="hidden" name="id" value="0">
                    <div class="form-group">
                      <label for="us" class="col-sm-2 control-label">Username</label>

                      <div class="col-sm-10">
                        <select name="us" id="us" class="form-control" style="width: 100%;">
                          <option>--Pilih--</option>
                          <?php 
                            $query = mysqli_query($koneksi, "SELECT USERNAME, ID from user") or die(mysqli_error($koneksi));

                            while($a = mysqli_fetch_assoc($query)){
                              ?>
                                <option value="<?php echo $a['ID'] ?>"><?php echo $a['USERNAME'] ?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="tipe_pro" class="col-sm-2 control-label">Tipe Properti</label>

                      <div class="col-sm-10">
                        <select name="tp_pro" id="tipe_pro" class="form-control" style="width: 100%;">
                          <option>--Pilih--</option>
                          <option>Kos</option>
                          <option>Rumah</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="nm_pro" class="col-sm-2 control-label">Nama Properti</label>

                      <div class="col-sm-10">
                        <textarea class="form-control" id="nm_pro" name="nm_pro"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Fasilitas</label>

                      <div class="col-sm-6">
                        <input type="text" class="form-control" name="fasilitas">
                      </div>
                      <label class="col-sm-1 control-label">Jumlah</label>
                      <div class="col-sm-2">
                        <input type="number" class="form-control" name="jumlah">
                      </div>
                      <div class="col-sm-1 control-label">
                        <button id="addFas" type="button" onClick="addFasilitas()">+</button>
                      </div>
                      <div class="col-sm-2"></div>
                      <div class="col-sm-10"><label style="color: red; display: none" class="cek_jum_fas"></label></div>
                    </div>

                    <div id="fas"></div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Harga</label>

                      <div class="col-sm-5">
                        <input type="number" class="form-control harga" name="harga">
                      </div>
                      <label class="col-sm-1 control-label">/</label>
                      <div class="col-sm-3">
                        <select oninput="tpHarga()" name="tipe" class="form-control tipe" style="width: 100%;">
                          <option class="pilih">--Pilih--</option>
                        </select>
                      </div>
                      <div class="col-sm-1 control-label">
                        <button onclick="addHarga()" type="button">+</button>
                      </div>
                      <div class="col-sm-2"></div>
                      <div class="col-sm-10"><label style="color: red; display: none" class="cek_hrg"></label></div>
                    </div>

                    <div id="harga"></div>

                    <div class="form-group">
                      <label for="jumKamar" class="control-label col-sm-2">Jumlah Kamar</label>

                      <div class="col-sm-4">
                        <input type="number" class="form-control" name="jumKamar" id="jumKamar">
                      </div>
                      <label class="col-sm-2" for="kmrSedia">Kamar Tersedia</label>
                      <div class="col-sm-4">
                        <input type="number" class="form-control" name="kmrSedia" id="kmrSedia">
                      </div>
                      <div class="col-sm-2"></div>
                      <div class="col-sm-10"><label style="color: red; display: none" id="cek_kmr"></label></div>
                    </div>

                    <div class="form-group">
                      <label for="al" class="col-sm-2 control-label">Alamat</label>

                      <div class="col-sm-10">
                        <textarea class="form-control" id="al" name="al"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-2 foto" style="display: none"></div>
                      <div class="col-sm-10 foto" style="display: none"><img height="200px"></div>

                      <label class="col-sm-2 control-label">Foto</label>

                      <div class="col-sm-9">
                        <input type="file" class="form-control" name="ft">
                      </div>
                      <div class="col-sm-1 control-label">
                        <button type="button" onclick="addFt()">+</button>
                      </div>
                    </div>

                    <div id="ft"></div>

                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save">Save changes</button>
              </div>
            </div>
          </div>
        </div>