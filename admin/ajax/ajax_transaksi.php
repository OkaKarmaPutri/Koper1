<script type="text/javascript">
	viewTransaksi();
	
	function viewTransaksi(){
		$.ajax({
	      type : "post",
	      url : "models/crud_transaksi.php",
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
	            '<td>'+data[i].us+'</td>'+
	            '<td>'+data[i].pembeli+'</td>'+
	            '<td>'+data[i].properti+'</td>'+
	            '<td>'+data[i].status+'</td>'+
	            '<td>'+data[i].rek+'</td>'+
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
	    var id_us = $('select[name=id_us]'), id_pembeli = $('select[name=id_pembeli]'), nm_pro = $('select[name=nm_pro]'), id_st = $('select[name=id_st]'), rek = $('input[name=rek]');
	    id_us.parent().parent().removeClass('has-error');
	    id_pembeli.parent().parent().removeClass('has-error');
	    nm_pro.parent().parent().removeClass('has-error');
	    id_st.parent().parent().removeClass('has-error');
	    rek.parent().parent().removeClass('has-error');
	    $('#modal').modal('show');
	    $('select[name=id_pembeli]').removeAttr('disabled');
	    $('select[name=id_us]').removeAttr('disabled')
	}

	$('#addData').click(function(){
	    $('#form').attr('action', 'insert');
	    $('#form')[0].reset();
	    removeError();
	    $('#modal').find('#label').text('Add Transaksi');
	})

	function dis_pembeli(){
		if($('select[name=id_us]').val() == '--Pilih--')
			$('select[name=id_pembeli]').removeAttr('disabled');
		else
			$('select[name=id_pembeli]').attr('disabled', '');
	}

	function dis_us(){
		if($('select[name=id_pembeli]').val() == '--Pilih--')
			$('select[name=id_us]').removeAttr('disabled')
		else
			$('select[name=id_us]').attr('disabled', '')
	}

	$('#save').click(function(){
	    var data = $('#form').serialize(), id_us = $('select[name=id_us]'), id_pembeli = $('select[name=id_pembeli]'), nm_pro = $('select[name=nm_pro]'), id_st = $('select[name=id_st]'), rek = $('input[name=rek]'), result = 0, aksi = $('#form').attr('action');
	    data = data + "&crud="+aksi;

	    if(id_us.val() == "--Pilih--"){
	    	if(id_pembeli.val() == '--Pilih--')
	    		id_us.parent().parent().addClass('has-error');
	    	else
	    		id_us.parent().parent().removeClass('has-error');
	    }
	    else{
	      id_us.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    if(id_pembeli.val() == '--Pilih--'){
	    	if(id_us.val() == "--Pilih--")
	    		id_pembeli.parent().parent().addClass('has-error');
	    	else
	    		id_pembeli.parent().parent().removeClass('has-error');
	    }
	    else{
	      id_pembeli.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    if(nm_pro.val() == "--Pilih--")
	      nm_pro.parent().parent().addClass('has-error');
	    else{
	      nm_pro.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    if(id_st.val() == '--Pilih--')
	      id_st.parent().parent().addClass('has-error');
	    else{
	      id_st.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    if(rek.val() == '')
	      rek.parent().parent().addClass('has-error');
	  	else if(parseInt(rek.val()) < 0)
	  		rek.parent().parent().addClass('has-error');
	    else{
	      rek.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    console.log(result);

	    if(result == 4){
	      $.ajax({
	        url : 'models/crud_transaksi.php',
	        method : 'post',
	        data : data,
	        success : function(res){
	        	console.log(res);
	        	$('#modal').modal('hide');
	        	$('#form')[0].reset();
	        	$('select[name=id_pembeli]').removeAttr('disabled');
	    		$('select[name=id_us]').removeAttr('disabled')
	            viewTransaksi();
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
	      method 	: 'post',
	      url 		: 'models/crud_transaksi.php',
	      data 		: {
	        id 			: id,
	        crud 		: 'tampil_edit'
	      },
	      success : function(res){
	        var data = JSON.parse(res);
	        $('input[name=id]').val(data[0].id);
	        if(data[0].us == '--Pilih--')
	        	$('select[name=id_us]').attr('disabled', '')
	        else
	        	$('select[name=id_pembeli]').attr('disabled', '');
	        $('select[name=id_us]').val(data[0].us);
	        $('select[name=id_pembeli]').val(data[0].pembeli);
	        $('select[name=nm_pro]').val(data[0].pro);
	        $('select[name=id_st]').val(data[0].status);
	        $('input[name=rek]').val(data[0].rek);
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
	        url     : 'models/crud_transaksi.php',
	        data    : {
	          id  : id,
	          crud : 'delete'
	        },
	        success : function(res){
	          //console.log(res);
	          swal("Deleted!", "Your imaginary data has been deleted.", "success");
	          viewTransaksi();
	        }
	      })
	      
	    });
	})
</script>