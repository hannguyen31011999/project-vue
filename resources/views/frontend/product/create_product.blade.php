@extends('frontend.master')

@section('title')
    Kênh thông tin bất động sản quận 9
@endsection

@section('css')
<style>
input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin-left:5px;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>
@endsection

@section('content')
<div id="app">
    <router-view></router-view>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
        $("#customFile").on("change", function(e) {
            var files = e.target.files,
            filesLength = files.length;
            var preview = document.querySelector('#result');
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $('.cardResult').css('display','block');
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\"><i class=\"icon-delete\"></i> xóa ảnh</span>" +
                        "</span>").insertAfter("#result");
                    $(".remove").click(function(){
                        $(this).parent(".pip").remove();
                    });
                });
                fileReader.readAsDataURL(f);
            }
        });
    }else {
        alert("Đã xảy ra lỗi xin thử lại")
    }
// function previewImages() {
//     var preview = document.querySelector('#result');
//     var card = document.getElementById('cardResult');
//     if (this.files) {
//         [].forEach.call(this.files, readAndPreview);
//     }

//     function readAndPreview(file) {
//         var reader = new FileReader();
//         reader.addEventListener("load", function() {
//             var image = new Image();
//             image.id = 'image';
//             image.height = 100;
//             image.width = 100;
//             image.style = "margin-left:5px;border:1px solid #ccc!important;margin-bottom:5px;text-align:center;";
//             image.title  = file.name;
//             image.src    = this.result;
//             $('.cardResult').css('display','block');
//             preview.appendChild(image);
//         });
//         reader.readAsDataURL(file);
//     }
// }
// document.querySelector('#customFile').addEventListener("change", previewImages);
});

</script>
@endsection