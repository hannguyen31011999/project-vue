function previewImages() {
    var preview = document.querySelector('#result');
    var card = document.getElementById('cardResult');
    if (this.files) {
        [].forEach.call(this.files, readAndPreview);
    }

    function readAndPreview(file) {
        var reader = new FileReader();
        reader.addEventListener("load", function() {
            var image = new Image();
            image.id = 'image';
            image.height = 200;
            image.width = 200;
            image.style = "margin-left:5px;border:1px solid #ccc!important;margin-bottom:5px;text-align:center;";
            image.title  = file.name;
            image.src    = this.result;
            $('.cardResult').css('display','block');
            preview.appendChild(image);
        });
        reader.readAsDataURL(file);
    }
}
document.querySelector('#customFile').addEventListener("change", previewImages);

{function preview_image(event) 
    {
    var reader = new FileReader();
    reader.onload = function(){
        let output = document.getElementById('output');
        output.style = "border:1px solid #ccc!important;display:block;";
        $('#card').css('display','block');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}


function fileLoad(event) 
{
    var reader = new FileReader();
    reader.onload = function(){
        let preview = document.getElementById('output-edit');
        preview.style = "border:1px solid #ccc!important;display:block;";
        $('#card').css('display','block');
        preview.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}



var options = {
        filebrowserImageBrowseUrl: '../../ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '../../ckfinder/ckfinder.html?type=Flash',
        filebrowserImageUploadUrl: '../../ckfinder/core/connector/connector.php?command=QuickUpload&type=Images',
        filebrowserBrowseUrl: '../../..laravel-filemanager?type=Files',
        filebrowserFlashUploadUrl: '../../public/ckfinder/core/connector/connector.php?command=QuickUpload&type=Images',
    };
CKEDITOR.replace('ckeditor', options);
CKEDITOR.replace('ckeditorEdit', options);}