$(function(){
	$(".second-nav a").on("click", "h2", redirectToAllVideoWithSelectedBodyPart);
    initDropZone();
});


function redirectToAllVideoWithSelectedBodyPart() {
    $this = $(this);
    var bodyPart = $this.data("category");
    var url = $("meta[name='asset-base']").attr('content');
    window.location = url + "/fitclub#" + bodyPart;
}

function showOverlay(){
    $("#overlay").show();
}

function hideOverlay(){
    $("#overlay").hide();
}

function initDropZone(){
      var myDropzone = new Dropzone('.image-upload-wrapper', {
        url: '/upload-image',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        paramName: 'profileimage',
        clickable: "#updateImage",
        thumbnailWidth: '275',
        thumbnailHeight: '275',
        acceptedFiles: '.jpg, .jpeg, .png, .bmp',
        addedfile: function(file){
            showOverlay();
        },
       thumbnail: function(file, dataUrl){
            file.xhr.onload = function (e) {
                if (this.status === 200) {
                    jQuery('.user-image').attr('src', dataUrl);
                    hideOverlay();

                } else {
                    console.log(this.status);
                    console.log('This file could not be uploaded');
                    hideOverlay();
                }
            }
       }
    });
}