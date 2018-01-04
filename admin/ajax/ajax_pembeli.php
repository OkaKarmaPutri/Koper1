<script type="text/javascript">
	viewPembeli();
	
	function viewPembeli(){
		$.ajax({
	      type : "post",
	      url : "models/crud_pembeli.php",
	      data : {
	        crud : 'select'
	      },
	      success : function(res){
	      	console.log(res);
	        var i, j = 1, data = JSON.parse(res);
	        var html = '';

	        for(i = 0; i < data.length; i++){
	          html += '<tr>'+
	            '<td>'+j+'</td>'+
	            '<td>'+data[i].nama+'</td>'+
	            '<td>'+data[i].alamat+'</td>'+
	            '<td>'+data[i].jns+'</td>'+
	            '<td>'+data[i].no_hp+'</td>'+
	            '<td>'+data[i].email+'</td>'+
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
	        console.log(res);
	      }
	    });
	}

	function removeError(){
	    var nm = $('input[name=nm]'), em = $('input[name=em]'), al = $('textarea[name=al]'), jns = $('select[name=jns]'), hp = $('input[name=hp]');
	    nm.parent().parent().removeClass('has-error');
	    em.parent().parent().removeClass('has-error');
	    al.parent().parent().removeClass('has-error');
	    jns.parent().parent().removeClass('has-error');
	    hp.parent().parent().removeClass('has-error');
	    $('#cek_em').hide();
	    $('#modal').modal('show');
	}

	$('#addData').click(function(){
	    $('#form').attr('action', 'insert');
	    $('#form')[0].reset();
	    removeError();
	    $('#modal').find('#label').text('Add Pembeli');
	})

	$('#save').click(function(){
	    var data = $('#form').serialize(), nm = $('input[name=nm]'), em = $('input[name=em]'), al = $('textarea[name=al]'), jns = $('select[name=jns]'), hp = $('input[name=hp]'), result = 0, aksi = $('#form').attr('action'), email = em.val();
	    data = data + "&crud="+aksi;

	    console.log(data);
	    if(nm.val() == "")
	      nm.parent().parent().addClass('has-error');
	    else{
	      nm.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    var atpos = email.indexOf("@"), dotpos = email.lastIndexOf(".");

	    if(email == ""){
	    	$('#cek_em').hide();
	      	em.parent().parent().addClass('has-error');
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

	    if(al.val() == '')
	      al.parent().parent().addClass('has-error');
	    else{
	      al.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    if(jns.val() == "--Pilih--")
	      jns.parent().parent().addClass('has-error');
	    else{
	      jns.parent().parent().removeClass('has-error');
	      result -= -1;
	    }
	    console.log(hp.val());
	    if(hp.val() == '')
	      hp.parent().parent().addClass('has-error');
	    else{
	      hp.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    console.log(result);

	    if(result == 5){
	      $.ajax({
	        url : 'models/crud_pembeli.php',
	        method : 'post',
	        data : data,
	        success : function(res){
	        	console.log(res);
	        	$('#modal').modal('hide');
	        	$('#form')[0].reset();
	            viewPembeli();
	        },
	        error : function(){

	        }
	      })
	    }
	  })

	$('tbody').on('click', '.item-edit', function(){
		var id = $(this).attr('data');
	    $('#form').attr('action', 'update');
	    removeError();
    	$('#modal').find('#label').text('Edit Pembeli');

    	$.ajax({
	      method : 'post',
	      url : 'models/crud_pembeli.php',
	      data : {
	        id : id,
	        crud : 'tampil_edit'
	      },
	      success : function(res){
	        var data = JSON.parse(res);
	        $('input[name=id]').val(data[0].id);
	        $('input[name=nm]').val(data[0].nama);
	        $('textarea[name=al]').val(data[0].alamat);
	        $('input[name=em]').val(data[0].email);
	        $('select[name=jns]').val(data[0].jns);
	        $('input[name=hp]').val(data[0].no_hp);
	        console.log(res);
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
	        url     : 'models/crud_pembeli.php',
	        data    : {
	          id  : id,
	          crud : 'delete'
	        },
	        success : function(res){
	          //console.log(res);
	          swal("Deleted!", "Your imaginary file has been deleted.", "success");
	          viewPembeli();
	        }
	      })
	      
	    });
	})
</script>