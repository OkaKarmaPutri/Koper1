<script type="text/javascript">
  //kenapa kupisah ki insert, update dan delete.. karena bermasalah ki kalo mau update password. karena password di encrypt
  viewUser();

  function viewUser(){
    $.ajax({
        type : "post",
        url : "models/crud_user.php",
        data : {
          crud : 'select',
          table : 'user'
        },
        success : function(res){
          var i, j = 1, data = JSON.parse(res);
          //console.log(res);
          var html = '';

          for(i = 0; i < data.length; i++){
            var gambar
            if(data[i].gambar == '')
              gambar = 'user.png';
            else
              gambar = data[i].id+'/'+data[i].gambar;
            html += '<tr>'+
              '<td>'+j+'</td>'+
              '<td>'+data[i].username+'</td>'+
              '<td>'+data[i].email+'</td>'+
              '<td><img src="../images/'+gambar+'" width="100px"></td>'+
              '<td>'+data[i].role+'</td>'+
              '<td>'+
              '<button class="btn btn-warning item-edit" data="'+data[i].id+'">Edit</button>'+
              "&nbsp"+
              '<button class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</button>'+
              '</td>'+
              '</tr>';
              j++;
          }
          $('.data').html(html);
        },
        error : function(res){
          //console.log(res);
        }
      });
  }

  function removeError(){
    var us = $('input[name=us]'), em = $('input[name=em]'), ps = $('input[name=ps]'), reps = $('input[name=reps]');
    us.parent().parent().removeClass('has-error');
    em.parent().parent().removeClass('has-error');
    ps.parent().parent().removeClass('has-error');
    reps.parent().parent().removeClass('has-error');
    $('#cek_us').hide();
    $('#cek_em').hide();
    $('#formUser')[0].reset();
    $('#modalUser').modal('show');
  }

  $('#addData').click(function(){
    $('input[name=result]').val('0');
    $('#formUser').attr('action', 'insert');
    $('.foto').hide();
    removeError();
    $('#modalUser').find('#labelUser').text('Add User');
  })

  $('#saveUser').click(function(){
    //var data = $('#formUser').serialize();
    var us = $('input[name=us]'), em = $('input[name=em]'), ps = $('input[name=ps]'), reps = $('input[name=reps]'), data = new FormData(document.getElementById("formUser")), aksi = $('#formUser').attr('action'), email = em.val(), result = 0;
    //data = data + "&crud=insert&table=user&ft=" + ft;
    data.append("crud", aksi);
    data.append("table", 'user');

    if(us.val() == ""){
      us.parent().parent().addClass('has-error');
      $('#cek_us').hide();
    }
    else{
      $.ajax({
        url     : 'models/crud_user.php',
        method  : 'post',
        async   : false,
        data    : {
          crud    : 'cek_us',
          us      : us.val(),
          table   : 'user',
          us_lama : $('input[name=us_lama]').val()
        },
        success : function(res){
          if(res == 'error'){
            us.parent().parent().addClass('has-error');
            $('#cek_us').show();
            $('#cek_us').html('Username Ada yang Sama');
          }
          else{
            us.parent().parent().removeClass('has-error');
            $('#cek_us').hide();
            result -= -1;
          }
        }
      })
    }

    var atpos = email.indexOf("@"), dotpos = email.lastIndexOf(".");
    if(email == ""){
      em.parent().parent().addClass('has-error');
      $('#cek_em').hide();
    }
    else if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length){
      em.parent().parent().addClass('has-error');
      $('#cek_em').show();
      $('#cek_em').html('Email tidak valid');
    }
    else{
      em.parent().parent().removeClass('has-error');
      $('#cek_em').hide();
      result -= -1;
    }

    if(ps.val() != reps.val()){
      ps.parent().parent().addClass('has-error');
      reps.parent().parent().addClass('has-error');
    }
    else{
      if(ps.val() == "")
        ps.parent().parent().addClass('has-error');

      if(reps.val() == "")
        reps.parent().parent().addClass('has-error');

      if(ps.val() != "" && reps.val() != ""){
        ps.parent().parent().removeClass('has-error');
        reps.parent().parent().removeClass('has-error');
        result -= -1;
      }
    }

    if(result == 3){
      $.ajax({
        url : 'models/crud_user.php',
        method : 'post',
        data : data,
        processData: false,  // tell jQuery not to process the data
        contentType: false,   // tell jQuery not to set contentType
        success : function(res){
          console.log(res);
          $('#modalUser').modal('hide');
          $('#formUser')[0].reset();
          viewUser();    
        },
        error : function(){

        }
      })
    }
  })

  $('tbody').on('click', '.item-edit', function(){
    var id = $(this).attr('data');
    $('#formUser').attr('action', 'update');
    removeError();
    $('#modalUser').find('#labelUser').text('Edit User');

    $.ajax({
      method : 'post',
      url : 'models/crud_user.php',
      data : {
        id : id,
        crud : 'tampil_edit',
        table : 'user'
      },
      success : function(res){
        $('.foto').show();
        var data = JSON.parse(res);
        $('[name=id]').val(data[0].id);
        $('[name=us_lama]').val(data[0].username);
        $('[name=us]').val(data[0].username);
        $('[name=em]').val(data[0].email);
        if(data[0].gambar == "")
          $('.foto').find('img').attr('src', '../images/user.png');  
        else
          $('.foto').find('img').attr('src', '../images/'+data[0].id+'/'+data[0].gambar);
        $('[name=ft_lama]').val(data[0].gambar);
        //console.log(res);
      },
      error : function(){

      }
    })
  })

  $('tbody').on('click', '.item-delete', function(){
    var id = $(this).attr('data');
    swal({
      title: "Are you sure?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
    function(){
      $.ajax({
        method  : 'post',
        url     : 'models/crud_user.php',
        data    : {
          id  : id,
          crud : 'delete',
          table : 'user'
        },
        success : function(res){
          //console.log(res);
          swal("Deleted!", "Your imaginary file has been deleted.", "success");
          viewUser();
        }
      })
      
    });
  })
</script>