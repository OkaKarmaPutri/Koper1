<!-- Modal -->
        <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="labelUser"></h4>
              </div>
              <div class="modal-body">
                <!-- form start -->
                <form class="form-horizontal" id="formUser" enctype="multipart/form-data">
                  <div class="box-body">
                    <input type="hidden" name="id" value="0">
                    <input type="hidden" name="ft_lama">
                    <input type="hidden" name="us_lama">
                    <input type="hidden" name="result" value="0">
                    <div class="form-group">
                      <label for="us" class="col-sm-2 control-label">Username</label>

                      <div class="col-sm-10">
                        <input type="text" name="us" class="form-control" id="us">
                      </div>
                      <div class="col-sm-2"></div>
                      <div class="col-sm-10"><label style="color: red; display: none" id="cek_us"></label></div>
                    </div>

                    <div class="form-group">
                      <label for="em" class="col-sm-2 control-label">Email</label>

                      <div class="col-sm-10">
                        <input type="email" name="em" class="form-control" id="em" placeholder="tes@tes.tes">
                      </div>
                      <div class="col-sm-2"></div>
                      <div class="col-sm-10"><label style="color: red; display: none" id="cek_em"></label></div>
                    </div>
                    <div class="form-group">
                      <label for="ps" class="col-sm-2 control-label">Password</label>

                      <div class="col-sm-10">
                        <input type="password" name="ps" class="form-control" id="ps">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="reps" class="col-sm-2 control-label">Re-type Password</label>

                      <div class="col-sm-10">
                        <input type="password" name="reps" class="form-control" id="reps">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-2 foto" style="display: none"></div>
                      <div class="col-sm-10 foto" style="display: none"><img height="200px"></div>
                      <label for="foto" class="col-sm-2 control-label">Foto</label>

                      <div class="col-sm-10">
                        <input type="file" class="form-control" name="ft" id="foto">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveUser">Save changes</button>
              </div>
            </div>
          </div>
        </div>