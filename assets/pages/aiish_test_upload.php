

<section class="section-large">
    <?php echo getSessionMsg(); ?>
    <div class="container">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label>Test field</label>
            <input type="text" id="testText" value=''>
            <label>Select a File to Upload</label> 
            <input id="upload_file" type="file" name="upload_file" /> 
            <input type="button" value="Upload" onclick="loadFile()" />
        </form>
        
    </div>
</section>

<script>
    
    function loadFile() {
        // Retrieve the FileList object from the referenced element ID
	//var myFile = document.getElementById('upload_file').files;
        //var formData = new FormData($("#upload_file")[0]);
        var testText = $('#testText').val();
        alert(testText);
        var file_data = $('#upload_file').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        alert(form_data);
        $.ajax({
            url: Root+'assets/ajax/uploadFile.php',
            type: "POST",
            data : {texttest:testText,form_data},
            processData: false,
            contentType: false,
            beforeSend: function() {

            },
            success: function(data){

            alert(data);


            },
            error: function(xhr, ajaxOptions, thrownError) {
               console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
}
</script>