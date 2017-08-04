function doanra_regis(){
	$(".select2").select2();
	$("#id_quocgia").select2({ placeholder : ""});
	$(".ngaythangnam").inputmask();
	$("#ngaydi").change(function(){
		var ngaydi = $("#ngaydi").val();
		var ngayve = $("#ngayve").val();
		var arr_ngaydi = ngaydi.split('/');
		var arr_ngayve = ngayve.split('/');
		var start_date = new Date(arr_ngaydi[2] + '-'+ arr_ngaydi[1] + '-' + arr_ngaydi[0]);
		var end_date = new Date(arr_ngayve[2] + '-'+ arr_ngayve[1] + '-' + arr_ngayve[0]);
		var diff = new Date(end_date - start_date);
		var days = diff/1000/60/60/24;
		$("#songay").val(days+1);
	});
	$("#ngayve").change(function(){
		var ngaydi = $("#ngaydi").val();
		var ngayve = $("#ngayve").val();
		var arr_ngaydi = ngaydi.split('/');
		var arr_ngayve = ngayve.split('/');
		var start_date = new Date(arr_ngaydi[2] + '-'+ arr_ngaydi[1] + '-' + arr_ngaydi[0]);
		var end_date = new Date(arr_ngayve[2] + '-'+ arr_ngayve[1] + '-' + arr_ngayve[0]);
		var diff = new Date(end_date - start_date);
		var days = diff/1000/60/60/24;
		$("#songay").val(days+1);
	});
}
function upload_congvanxinphep_regis(){
	$(".dinhkem_filecongvanxinphep").change(function() {
	  var formData = new FormData($("#regis_doanraform")[0]);
	   $.ajax({
        url: "post.upload.congvanxinphep.php", type: "POST",
        data: formData, async: false,
        success: function(datas) {
            if(datas=='Failed'){
                $.Notify({type: 'alert', caption: 'Thông báo', content: "Không thể Thêm học tập hoặc không phải tập tin PDF"});
            } else {
            	$(".info").remove();
                $("#files_congvanxinphep").prepend(datas); delete_file();
            }
      	},
      	cache: false, contentType: false, processData: false
        }).fail(function() {
            $.Notify({type: 'alert', caption: 'Thông báo', content: "Không thể Thêm học tập hoặc không phải tập tin PDF"});
        });
	});
}

function delete_file(){
	var link_delete; var _this;
	$(".delete_file").click(function(){
		link_delete = $(this).attr("href");	_this = $(this);
		$.ajax({
            url: link_delete,
            type: "GET",
            success: function(datas) {
            	$.Notify({type: 'alert', caption: 'Thông báo', content: datas});
            	_this.parents("div.row").fadeOut("slow", function(){
            		$(this).remove();
            	});
          	}
	    }).fail(function() {
	        $.Notify({type: 'alert', caption: 'Thông báo', content: "Không thể xoá."});
	    });
	});
}
