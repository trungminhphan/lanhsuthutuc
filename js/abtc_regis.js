function nhaplieu(){
	$("#id_donvi_xinphep_1").select2({ placeholder: "Chọn đơn vị", allowClear: true });
}
function upload_giaytolienquan(){
	$(".dinhkem_giaytolienquan").change(function() {
      var formData = new FormData($("#themabtcform")[0]);
       $.ajax({
        url: "post.upload.giaytolienquan.php", type: "POST",
        data: formData, async: false,
        success: function(datas) {
            if(datas=='Failed'){
                $.Notify({type: 'alert', caption: 'Thông báo', content: "Không thể Thêm học tập"});
            } else {
                $(".info").remove();
                $("#files_giaytolienquan").append(datas); delete_file();
            }
        },
        cache: false, contentType: false, processData: false
        }).fail(function() {
            $.Notify({type: 'alert', caption: 'Thông báo', content: "Không thể Upload tập tin"});
        });
    });
}
function upload_congvanxinphep(){
    $(".dinhkem_filecongvanxinphep").change(function() {
      var formData = new FormData($("#themabtcform")[0]);
       $.ajax({
        url: "post.upload.congvanxinphep.php", type: "POST",
        data: formData, async: false,
        success: function(datas) {
            if(datas=='Failed'){
                $.Notify({type: 'alert', caption: 'Thông báo', content: "Không thể Thêm học tập"});
            } else {
                $(".info").remove();
                $("#files_congvanxinphep").prepend(datas); delete_file();
            }
        },
        cache: false, contentType: false, processData: false
        }).fail(function() {
            $.Notify({type: 'alert', caption: 'Thông báo', content: "Không thể Upload tập tin"});
        });
    });
}

function delete_file(){
    var link_delete; var _this;
    $(".delete_file").click(function(){
        link_delete = $(this).attr("href"); _this = $(this);
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