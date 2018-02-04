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
                      <label for="nm" class="col-sm-2 control-label">Nama</label>

                      <div class="col-sm-10">
                        <input type="text" name="nm" class="form-control" id="nm">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="al" class="col-sm-2 control-label">Alamat</label>

                      <div class="col-sm-10">
                        <textarea class="form-control" id="al" name="al"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="hp" class="col-sm-2 control-label">Nomor HP</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="hp" id="hp">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="em" class="col-sm-2 control-label">Email</label>

                      <div class="col-sm-10">
                        <input type="email" name="em" class="form-control" id="em" placeholder="tes@tes.tes">
                      </div>
                      <div class="col-sm-2"></div>
                      <div class="col-sm-10"><label style="color: red; display: none" id="cek_em"></label></div>
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