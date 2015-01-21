


var countImage = 0;
var name="";
var validator=false;
$(function () {
    var $files = $('#files');
    $files.on('change', function () {
        for (var i = 0; i < this.files.length; i++) {
            if (this.files[i].size < 2400000 ) {
                countImage++;
                if (countImage > 4){alert('Solo puedes subir hasta 4 archivos') ; return}
                uploadImage(this.files[i]);

            } else {
                alert("El tamaño de la imagen debe ser inferior a 2MB");
            }
        }
    });
    $files.on('dragover', function () {

        $('.pop-up').addClass('hover-file');
        $('#files').addClass('hover-file1');
        $('#image-file').addClass('hover-file2');
    });
    $files.on('dragleave', removeElement);
    $files.on('drop', removeElement);
});

function removeElement() {
    $('.pop-up').removeClass('hover-file');
    $('#files').removeClass('hover-file1');
    $('#image-file').removeClass('hover-file2');
}
function uploadImage(file) {
        var reader = new FileReader(file);

        reader.readAsDataURL(file);
        ajax(file);
        reader.onload = function (e) {
            var data = e.target.result;
            var nombre = "<p class='p-image'>" + file.name + "</p>";
            switch (file.type) {

                case "image/png":
                    var img = "<img src='img/jpg.png' />";
                    validator=true;
                    break;
                case "image/jpeg":
                    var img = "<img src='img/jpg.png' />";
                    validator=true;
                    break;
                case "application/pdf":
                    var img = "<img src='img/pdf.png' />";
                    validator=true;
                    break;
                case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                    var img = "<img src='img/doc.png' />";
                    validator=true;
                    break;
                case "application/msword":
                    var img = "<img src='img/doc.png' />";

                    break;
                default:
                    alert("invalit");
                    throw new Error('Invalid action.');
                    break;

            }
            if(validator==true){
                name=name+file.name+",";

            }
            document.getElementById("form-files").value=name;
            $('.request-image').append("<div class='img-content'>" + img + nombre + "</div>");
        };

}
function ajax(file) {
    var form = document.querySelector('form');
    var request= new XMLHttpRequest();

        //e.preventDefault();
        //multiple files will be in the form parameter
        var formdata= new FormData(form);
        request.open('post','credito');//route
        request.send(formdata);


}