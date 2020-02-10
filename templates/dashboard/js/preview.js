$(document).ready(function() {

    // var fileSelect = document.getElementById("fileSelect"),
    //     fileElem = document.getElementById("fileElem");
    //
    // fileSelect.addEventListener("click", function (e) {
    //     if (fileElem) {
    //         fileElem.click();
    //     }
    //     e.preventDefault(); // prevent navigation to "#"
    // }, false);

//$("#other").click(function() {
//  $("#target").click();
//});
    $('.fileSelect1').click(function () {
        $(this).parent().next().click();
    });

    $('.fileElem').change(function(e)
    {

        handleFiles(this.files,$(this).prev());
    });

    function bytesToSize(bytes) {
        var kilobyte = 1024;
        var megabyte = kilobyte * 1024;
        var gigabyte = megabyte * 1024;
        var terabyte = gigabyte * 1024;

        if ((bytes >= 0) && (bytes < kilobyte)) {
            return bytes;

        } else if ((bytes >= kilobyte) && (bytes < megabyte)) {
            return (bytes / kilobyte).toFixed(0) + 'K';

        } else if ((bytes >= megabyte) && (bytes < gigabyte)) {
            return (bytes / megabyte).toFixed(1) + 'M';

        } else if ((bytes >= gigabyte) && (bytes < terabyte)) {
            return (bytes / gigabyte).toFixed(2) + 'G';

        } else if (bytes >= terabyte) {
            return (bytes / terabyte).toFixed(2) + 'T';

        }
    }


    function handleFiles(files,input) {

        for (var i = 0, f; f = files[i]; i++) {

            var reader = new FileReader();

            reader.onload = (function(f) {
                return function(e) {

                    // $(a).append();
                    //
                    // $(a).append("<span class='name'>" + f.name + "</span>");
                    //
                    // $(a).append("<span class='size'>" + bytesToSize(f.size) + "</span>");

                    // $(li).append("<a href='#remove' class='remove'>remove</a>");
                    input.html("<img style='width: 100px; height: 100px' src='"+e.target.result +"'/>");

                };
            })(f);

            reader.readAsDataURL(f);

        }
    }

    $('.remove').live("click", function(event) {
        event.preventDefault();
        alert("Handler for .click() called.");
    });


});