<script type="text/javascript">
	viewProperti();

	function viewProperti(){
		$.ajax({
	      type : "post",
	      url : "models/crud_properti.php",
	      data : {
	        crud : 'select'
	      },
	      success : function(res){
	        var i, j = 1, data = JSON.parse(res), html = '', k, html1 = '';
	        
	        console.log(data);

	        for(i = 0; i < data.length; i++){
	        	html += '<tr>'+
		            '<td>'+j+'</td>'+
		            '<td>'+data[i].us+'</td>'+
		            '<td>'+data[i].tipe+'</td>'+
		            '<td>'+data[i].nm_pro+'</td>'+
		            '<td>'+data[i].fas+'</td>'+
		            '<td>'+data[i].jumFas+'</td>'+
		            '<td>'+data[i].harga+'</td>'+
		            '<td>'+
						'<button class="btn btn-warning item-edit" data="'+data[i].id+'">Edit</button>'+
						"&nbsp"+
						'<button class="btn btn-danger item-delete" data="'+data[i].id+'">Delete</button>'+
					'</td>'+
		            '</tr>';

		        html1 += '<tr>'+
		            '<td>'+j+'</td>'+
		            '<td>'+data[i].us+'</td>'+
		            '<td>'+data[i].jumKmr+'</td>'+
		            '<td>'+data[i].kmrSedia+'</td>'+
		            '<td>'+data[i].al+'</td>'+
		            '<td>'+data[i].gambar+'</td>'+
		            '<td>'+data[i].lat+'</td>'+
		            '<td>'+data[i].lon+'</td>'+
		            '</tr>';

		            j++;
	        }
	        $('.data').html(html);
	        $('.detailData').html(html1);
	      },
	      error : function(res){
	        console.log(res);
	      }
	    });
	}

	function removeError(){
	    var us = $('select[name=us]'), tp_pro = $('select[name=tp_pro]'), nm_pro = $('textarea[name=nm_pro]'), al = $('textarea[name=al]'), hrg = $("input[name^='harga']"), fas = $("input[name^='fasilitas']"), jumKmr = $('input[name=jumKamar]');
	    us.parent().parent().removeClass('has-error');
	    tp_pro.parent().parent().removeClass('has-error');
	    nm_pro.parent().parent().removeClass('has-error');
	    al.parent().parent().removeClass('has-error');
	    hrg.parent().parent().removeClass('has-error');
	    fas.parent().parent().removeClass('has-error');
	    jumKmr.parent().parent().removeClass('has-error');
	    $('#cek_kmr').hide();
	    $('.cek_hrg').hide();
    	$('.cek_jum_fas').hide();
    	$('#modal').modal('show');
    	$('.tpharga').remove();
    	$('#harga').find('.form-group').remove();
		$('#fas').find('.form-group').remove();
		$('#ft').find('.form-group').remove();
		$('#gmbr').find('.ftLama').remove();
		$('#form')[0].reset();
		tambah1 = 1;
		$('input[name=kmrSedia]').removeAttr('disabled')
	}

	var select = [];

	$('#addData').click(function(){
		var option = '';
		select = ['bulan', '6 bulan', 'tahun'];

	    $('#form').attr('action', 'insert');
	    
	    removeError();
	    $('#modal').find('#label').text('Add Properti');

	    for(var i = 0; i < select.length; i++){
			option += '<option class="tpharga">'+select[i]+'</option>';
		}
		
		$('.tipe').append(option);
		$('.pilih').html('--Pilih--');
		tambah = 1;
		
	})

	var tambah = 1, tambah1 = 1;

	function tpHarga(){
		var tipe = [];
		$('select[name^="tipe"]').each(function() {
		    var lihat = $(this).val();
		    $(this).find('.pilih').html(lihat);
			tipe.push(lihat);
		});
		select = ['bulan', '6 bulan', 'tahun'];
		for(var i = 0; i < tipe.length; i++){
			select = select.filter(function(e) { return e !== tipe[i] });
		}

		var option = '';

		for(var i = 0; i < select.length; i++){
			option += '<option class="tpharga">'+select[i]+'</option>';
		}
		$('.tpharga').remove();
		$('.tipe').append(option);
	}

	function addHarga(hrg = "", tp_hrg = "", edit_tmbh = ""){
		var option = '';

		for(var i = 0; i < select.length; i++){
			option += '<option class="tpharga">'+select[i]+'</option>';
		}

		if(edit_tmbh >= 1){
			tambah = 0;
			tambah = tambah - (-edit_tmbh);
		}
		else
			tp_hrg = '--Pilih--';

		if(tambah < 3){
			$("#harga").append('<div class="form-group"><div class="col-sm-2"></div><div class="col-sm-5"><input type="number" class="form-control harga" name="harga" value="'+hrg+'"></div><label class="col-sm-1 control-label">/</label><div class="col-sm-3"><select oninput="tpHarga()" name="tipe" class="form-control tipe" style="width: 100%;"><option class="pilih">'+tp_hrg+'</option></select></div><div class="col-sm-1 control-label"><button class="minHarga">-</button></div><div class="col-sm-2"></div><div class="col-sm-10"><label style="color: red; display: none" class="cek_hrg"></label></div></div>');
			tambah -= -1;
			$('.tpharga').remove();
			$('.tipe').append(option);
		}
		else
			swal("Maksimal 3");

		return false;
	}

	$("body").on('click', '.minHarga', function(){
		tambah--;
		
		var input = $(this).parent().parent();
		input.remove();
		var tipe = input.find('select[name=tipe]').val();
		if(tipe != "--Pilih--"){
			select.push(tipe);	
		}

		var option = '';

		for(var i = 0; i < select.length; i++){
			option += '<option class="tpharga">'+select[i]+'</option>';
		}
		$('.tpharga').remove();
		$('.tipe').append(option);

		return false;
	})

	function addFasilitas(fas = "", jumFas = ""){
		$('#fas').append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-6"><input type="text" class="form-control" name="fasilitas" value="'+fas+'"></div><label class="col-sm-1 control-label">Jumlah</label><div class="col-sm-2"><input type="number" class="form-control" name="jumlah" value="'+jumFas+'"></div><div class="col-sm-1 control-label"><button class="minFas" type="button">-</button></div><div class="col-sm-2"></div><div class="col-sm-10"><label style="color: red; display: none" class="cek_jum_fas"></label></div></div>');

		return false;
	}

	$("body").on('click', '.minFas', function(){
		$(this).parent().parent().remove();
		return false;
	})

	function addFt(tambahFt = ""){
		if(tambahFt != "")
			tambah1 = tambahFt

		$('#ft').append('<div class="form-group ft"><div class="col-sm-2 foto" style="display: none"></div><div class="col-sm-10 foto" style="display: none"><img height="200px"></div><label class="col-sm-2 control-label"></label><div class="col-sm-9"><input type="file" class="form-control" name="ft['+tambah1+']"></div><div class="col-sm-1 control-label"><button type="button" class="minFt">-</button></div></div>');
		console.log(tambah1)
		tambah1++;
		return false;
	}

	$("body").on('click', '.minFt', function(){
		$(this).parent().parent().remove();
		tambah1--
		return false;
	})

	$("body").on('click', '.minGmbr', function(){
		$(this).parent().parent().remove()
		return false;
	})

	$('body').on('input', 'select[name=tp_pro]', function(){
		if($(this).val() == '--Pilih--')
			$('input[name=kmrSedia]').removeAttr('disabled')
		else if($(this).val() == 'Kos')
			$('input[name=kmrSedia]').removeAttr('disabled')
		else
			$('input[name=kmrSedia]').attr('disabled', '')
	})

	$('#save').click(function(){
		// var data = $('#form').serialize(), 
		var aksi = $('#form').attr('action'), us = $('select[name=us]'), tp_pro = $('select[name=tp_pro]'), nm_pro = $('textarea[name=nm_pro]'), al = $('textarea[name=al]'), result = 0, result1 = 0, result2 = 0, jumKmr = $('input[name=jumKamar]'), kmrSedia = $('input[name=kmrSedia]'), us_hidden = $('input[name=us_hidden]');

		// if(ft.val() == ""){
		// 	console.log('kosong')
		// 	ft.parent().parent().addClass('has-error');
		// }
		// else{
		// 	console.log(ft.val())
		// }

		var harga = [], tipe = [], fas = [], jumFas = [];

		$("input[name^='harga']").each(function() {
		    var nilaiHarga = $(this).val(), nilaiTipe = $(this).parent().parent().find('select[name=tipe]').val();
    		if(nilaiHarga == '' || nilaiTipe == '--Pilih--'){
		    	$(this).parent().parent().addClass('has-error');
		    	$(this).parent().parent().find('.cek_hrg').hide();
    		}
		    else if(parseInt(nilaiHarga) < 0){
		    	$(this).parent().parent().addClass('has-error');
		    	$(this).parent().parent().find('.cek_hrg').show();
            	$(this).parent().parent().find('.cek_hrg').html('Harga yang anda masukkan minus');
		    }
		    else{
		    	$(this).parent().parent().removeClass('has-error');
		    	$(this).parent().parent().find('.cek_hrg').hide();
		    	result -= -1;
		    	harga.push(nilaiHarga);
		    	tipe.push(nilaiTipe);
		    }
		    result1 -= -1;
		});

		$("input[name^='fasilitas']").each(function() {
		    var nilaiFasilitas = $(this).val(), nilaiJumFas = $(this).parent().parent().find('input[name=jumlah]').val();
    		if(nilaiFasilitas == '' || nilaiJumFas == ''){
		    	$(this).parent().parent().addClass('has-error');
		    	$(this).parent().parent().find('.cek_jum_fas').hide();
    		}
		    else if(parseInt(nilaiJumFas) < 0){
		    	$(this).parent().parent().addClass('has-error');
		    	$(this).parent().parent().find('.cek_jum_fas').show();
            	$(this).parent().parent().find('.cek_jum_fas').html('Jumlah fasilitas yang anda masukkan minus');
		    }
		    else{
		    	$(this).parent().parent().removeClass('has-error');
		    	$(this).parent().parent().find('.cek_jum_fas').hide();
		    	fas.push(nilaiFasilitas);
			    jumFas.push(nilaiJumFas);
			    result -= -1;
		    }
		    result1 -= -1;
		});

		if(aksi == 'insert'){
			$("input[name^='ft']").each(function() {
			    var nilaiFt = $(this).val();
	    		if(nilaiFt == '')
			    	$(this).parent().parent().addClass('has-error');
			    else
			    	result2++;
			});
		}
		else
			result++

		if(result2 > 0){
			$("input[name^='ft']").parent().parent().parent().find('.ft').removeClass('has-error');
			result++;
		}

		var stringHarga = JSON.stringify(harga), stringTipe = JSON.stringify(tipe), stringFas = JSON.stringify(fas), stringJumFas = JSON.stringify(jumFas);

		if(jumKmr.val() == "" || kmrSedia.val() == ""){
			if(tp_pro.val() == 'Rumah')
				result++
			else{
				jumKmr.parent().parent().addClass('has-error');
	      		$('#cek_kmr').hide();
			}
		}
	  	else if(parseInt(jumKmr.val()) < 0 || parseInt(kmrSedia.val()) < 0){
	  		if(tp_pro.val() == 'Rumah')
				result++
	  		else{
	  			jumKmr.parent().parent().addClass('has-error');
		  		$('#cek_kmr').show();
		  		$('#cek_kmr').html('Jumlah atau kamar tersedia yang anda masukkan minus');
	  		}
	  	}
	    else{
	    	if(parseInt(jumKmr.val()) < parseInt(kmrSedia.val())){
	    		if(tp_pro.val() == 'Rumah')
					result++
				else{
					jumKmr.parent().parent().addClass('has-error');
		    		$('#cek_kmr').show();
		  			$('#cek_kmr').html('Jumlah kamar tidak boleh lebih kecil daripada kamar tersedia');
				}
	    	}
	    	else{
	    		if(tp_pro.val() != 'Rumah'){
	    			jumKmr.parent().parent().removeClass('has-error');
			    	$('#cek_kmr').hide();
	    		}
	    		
			    result -= -1;
	    	}		    
	    }

		if(us.val() == "--Pilih--")
	      us.parent().parent().addClass('has-error');
	    else{
	      us.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    if(tp_pro.val() == "--Pilih--")
	      tp_pro.parent().parent().addClass('has-error');
	    else{
	      tp_pro.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    if(nm_pro.val() == "")
	      nm_pro.parent().parent().addClass('has-error');
	    else{
	      nm_pro.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    if(al.val() == "")
	      al.parent().parent().addClass('has-error');
	    else{
	      al.parent().parent().removeClass('has-error');
	      result -= -1;
	    }

	    console.log(result);

		var stringHarga = JSON.stringify(harga), stringTipe = JSON.stringify(tipe);
		
		// data = data + "&crud=" + aksi + "&harga=" + stringHarga + "&tp_harga=" + stringTipe + "&fas=" + stringFas + "&jumFas=" + stringJumFas; 

		var data = new FormData(document.getElementById("form"));
		data.append("crud", aksi);
		data.append("harga", stringHarga);
		data.append("tp_harga", stringTipe);
		data.append("fas", stringFas);
		data.append("jumFas", stringJumFas);

		if(tp_pro.val() == 'Rumah'){
			data.append("us", us.val())
		}

		if(result == result1 + 6){
			$.ajax({
				type : "post",
			    url : "models/crud_properti.php",
			    processData: false,  // tell jQuery not to process the data
        		contentType: false,   // tell jQuery not to set contentType
			    data : data,
			    success : function(res){
			    	console.log(res);
			    	$('#modal').modal('hide');
		        	$('#form')[0].reset();
		            viewProperti();
			    }
			})
		}
	})

	$('tbody').on('click', '.item-edit', function(){
		var id = $(this).attr('data');
	    $('#form').attr('action', 'update');
	    removeError();
    	$('#modal').find('#label').text('Edit Properti');

    	$.ajax({
	      method	: 'post',
	      url 		: 'models/crud_properti.php',
	      data 		: {
	        id : id,
	        crud : 'tampil_edit'
	      },
	      success : function(res){
	        var data = JSON.parse(res), i;
	        $('input[name=id]').val(data[0].id);
	        $('select[name=us]').val(data[0].us);
	        $('select[name=us]').attr('disabled', '')
	        if(data[0].tipe != 'Rumah'){
	        	$('input[name=kmrSedia]').val(data[0].kmrSedia);
	        	$('input[name=kmrSedia]').removeAttr('disabled')

	        }
	        else
	        	$('input[name=kmrSedia]').attr('disabled', '')	        	

	        $('select[name=tp_pro]').val(data[0].tipe);
	        $('textarea[name=nm_pro]').val(data[0].nm_pro);

	        $('input[name=fasilitas]').val(data[0].fas[0].fas);
	        $('input[name=jumlah]').val(data[0].fas[0].jumFas);
	        for(i = 1; i < data[0].fas.length; i++){
	        	addFasilitas(data[0].fas[i].fas, data[0].fas[i].jumFas);
	        }

	        $('input[name=harga]').val(data[0].harga[0].hrg);
	        $('.pilih').html(data[0].harga[0].tp_hrg);
	        for(i = 1; i < data[0].harga.length; i++){
	        	addHarga(data[0].harga[i].hrg, data[0].harga[i].tp_hrg, data[0].harga.length - 1);
	        	tpHarga();
	        }

	        for(i = 0; i < data[0].gambar.length; i++){
	        	$('#gmbr').find('.form-group').append('<div class="ftLama"><input type="hidden" name="ft_lama['+i+']" value="'+data[0].gambar[i].gmbr+'"><div class="col-sm-5"><img src="../images/'+data[0].us+'/'+data[0].gambar[i].gmbr+'" height="100px"></div><div class="col-sm-1 control-label"><button class="minGmbr" type="button">-</button></div></div>')

	        	console.log(i)
	        }
	        // $('.foto').show()
	        // $('.foto').find('img').attr('src', '../images/'+data[0].us+'/'+data[0].gambar[0].gmbr);

	        $('input[name=jumKamar]').val(data[0].jumKmr);
	        
	        $('textarea[name=al]').val(data[0].al);
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
	        url     : 'models/crud_properti.php',
	        data    : {
	          id  : id,
	          crud : 'delete'
	        },
	        success : function(res){
	          //console.log(res);
	          swal("Deleted!", "Your imaginary data has been deleted.", "success");
	          viewProperti();
	        }
	      })
	      
	    });
	})
</script>