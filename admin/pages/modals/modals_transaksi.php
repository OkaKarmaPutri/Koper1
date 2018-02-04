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
                      <label for="id_us" class="col-sm-2 control-label">Username</label>

                      <div class="col-sm-10">
                        <select name="id_us" id="id_us" class="form-control" oninput="dis_pembeli()" style="width: 100%;">
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
                      <label for="id_pembeli" class="col-sm-2 control-label">Pembeli</label>

                      <div class="col-sm-10">
                        <select name="id_pembeli" id="id_pembeli" class="form-control" oninput="dis_us()" style="width: 100%;">
                          <option>--Pilih--</option>
                          <?php 
                            $query = mysqli_query($koneksi, "SELECT NAMA, ID from pembeli") or die(mysqli_error($koneksi));

                            while($a = mysqli_fetch_assoc($query)){
                              ?>
                                <option value="<?php echo $a['ID'] ?>"><?php echo $a['NAMA'] ?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="nm_pro" class="col-sm-2 control-label">Nama Properti</label>

                      <div class="col-sm-10">
                        <select name="nm_pro" id="nm_pro" class="form-control" style="width: 100%;">
                          <option>--Pilih--</option>
                          <?php 
                            $query = mysqli_query($koneksi, "SELECT NAMA_PROPERTI, ID from properti") or die(mysqli_error($koneksi));

                            while($a = mysqli_fetch_assoc($query)){
                              ?>
                                <option value="<?php echo $a['ID'] ?>"><?php echo $a['NAMA_PROPERTI'] ?></option>
                              <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="id_st" class="col-sm-2 control-label">Status</label>

                      <div class="col-sm-10">
                        <select name="id_st" id="id_st" class="form-control" style="width: 100%;">
                          <option>--Pilih--</option>
                          <option value="1">Belum Bayar</option>
                          <option value="2">Sudah Bayar</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="rek" class="col-sm-2 control-label">No Rekening</label>

                      <div class="col-sm-10">
                        <input type="number" class="form-control" name="rek" id="rek">
                      </div>
                    </div>

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