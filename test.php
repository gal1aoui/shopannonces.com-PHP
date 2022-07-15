<html>
<head>
</head>
<body>

<div id="new_upload">
    <div class="close_btn"></div>
    <div id="uploads"></div>
    <form action="global.func/file_upload.php" method="post" enctype="multipart/form-data" id="upload_file">
    <fieldset><legend>Upload an image or video</legend>
    <input type="file" id="file" name="file[]" placeholder="Upload Image or Video" multiple /><input type="submit" value="upload file" id="upload_file_btn" required />
    </fieldset>

    <div class="bar">
        <div class="bar_fill" id="pb">
            <div class="bar_fill_text" id="pt"></div>
        </div>
    </div>

    </form>
</div>
<script>
function OnProgress(event, position, total, percentComplete){    
    //Progress bar
    console.log(total);
    $('#pb').width(percentComplete + '%') //update progressbar percent complete
    $('#pt').html(percentComplete + '%'); //update status text
}
function beforeSubmit(){
    console.log('ajax start');
}
function afterSuccess(data){
    console.log(data);
}
$(document).ready(function(e) {
    $('#upload_file').submit(function(event){
        event.preventDefault();
        var filedata = document.getElementById("file");
        formdata = new FormData();
        var i = 0, len = filedata.files.length, file;
         for (i; i < len; i++) {
            file = filedata.files[i];
            formdata.append("file[]", file);
        }
        formdata.append("json",true);
        $.ajax({
            url: "global.func/file_upload.php",
            type: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            dataType:"JSON",
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            beforeSubmit: beforeSubmit,
            uploadProgress:OnProgress, 
            success: afterSuccess,
            resetForm: true
        });
    });
});
</script>
</head>