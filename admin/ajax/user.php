<script type="text/javascript">
  //kenapa kupisah ki insert, update dan delete.. karena bermasalah ki kalo mau update password. karena password di encrypt

  function viewUser(){
    $.ajax({
        type : "post",
        url : "models/crud_user.php",
        data : {
          crud : 'select',
          table : 'user',
        },
        success : function(res){
          var html = '', i, j = 1;
          console.log(res);
          var data = JSON.parse(res);

          for(i = 0; i < data.length; i++){
            html += '<tr>'+
              '<td>'+j+'</td>'+
              '<td>'+data[i].username+'</td>'+
              '<td>'+data[i].email+'</td>'+
              '<td>'+data[i].gambar+'</td>'+
              '<td>'+data[i].role+'</td>'+
              '<td>'+
          '<button class="btn btn-warning item-edit" data="'+data[i].id+'">Edit</button>'+
          "&nbsp"+
          '<button class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</button>'+
        '</td>'+
              '</tr>';
              j++;
          }
          $('.dataUser').html(html);
        },
        error : function(res){
          console.log(res);
        }
      });
  }

  function removeError(){
    var us = $('input[name=us]'), em = $('input[name=em]'), ps = $('input[name=ps]'), reps = $('input[name=reps]'), ft = $('input[name=ft]');
    us.parent().parent().removeClass('has-error');
    em.parent().parent().removeClass('has-error');
    ps.parent().parent().removeClass('has-error');
    reps.parent().parent().removeClass('has-error');
    ft.parent().parent().removeClass('has-error');
  }

  $('#addData').click(function(){
    $('#formUser')[0].reset();
    removeError();
    $('#modalUser').modal('show');
    $('#modalUser').find('#labelUser').text('Add User');
  })

  $('#saveUser').click(function(){
    //var data = $('#formUser').serialize(), result = 0;
    var us = $('input[name=us]'), em = $('input[name=em]'), ps = $('input[name=ps]'), reps = $('input[name=reps]'), ft = $('input[type=file]');
    var data = new FormData(document.getElementById("formUser"));
    //data = data + "&crud=insert&table=user&ft=" + ft;
    data.append("crud", "insert");
    data.append("table", 'user');

    if(us.val() == "")
      us.parent().parent().addClass('has-error');
    else{
      us.parent().parent().removeClass('has-error');
      result -= -1;
    }

    if(em.val() == "")
      em.parent().parent().addClass('has-error');
    else{
      em.parent().parent().removeClass('has-error');
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

    if(ft.val() == "")
      ft.parent().parent().addClass('has-error');
    else{
      ft.parent().parent().removeClass('has-error');
      result -= -1;
    }

    if(result == 4){
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
    removeError();
    $('#modalUser').modal('show');
    $('#modalUser').find('#labelUser').text('Edit User');

    $.ajax({
      method : 'post',
      url : 'models/crud_user.php',
      data : {
        id : id,
        crud : 'tampil_edit',
        table : 'user',
      },
      success : function(res){
        var data = JSON.parse(res);
        $('[name=id]').val(data[0].id);
        $('[name=us]').val(data[0].username);
        $('[name=em]').val(data[0].email);
        $('[name=ft]').val(data[0].gambar);
        console.log(res);
      },
      error : function(){

      }
    })
  })
</script>