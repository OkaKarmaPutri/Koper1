<script type="text/javascript">
	function viewPembeli(){
		$.ajax({
	      type : "post",
	      url : "models/crud_m.php",
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
</script>