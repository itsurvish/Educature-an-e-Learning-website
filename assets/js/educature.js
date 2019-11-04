$(document).ready(function() {
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
});

function enableButtons() {

    var elems = document.getElementsByClassName("userinfo")
    for (var i = 0; i < elems.length; i++) {
        elems[i].disabled = false;
    }
}

function disableButtons() {
    var elems = document.getElementsByClassName("userinfo")
    for (var i = 0; i < elems.length; i++) {
        elems[i].disabled = true;
    }
}
$(document).ready(function() {




    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function() {
        readURL(this);
    });

    $(".upload-button").on('click', function() {
        $(".file-upload").click();
    });
});


$(function() {
    $('.filter-select').selectric();
});



$(document).ready(function() {
    // Gets the video src from the data-src on each button
    var $videoSrc;
    $('.video-btn').click(function() {

        $videoSrc = $(this).data("src");
    });
    console.log($videoSrc);

    $('#myModal').on('shown.bs.modal', function(e) {
        e.preventDefault();
        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#video").attr('src', $videoSrc);
    })

    // stop playing the youtube video when I close the modal
    $('#myModal').on('hide.bs.modal', function(e) {
        // a poor man's stop video
        $("#video ").attr('src', '');
    })

    // document ready  
});


$(document).ready(function() {
    "use strict";
    // home contact info
    $(".trggericon").on("click", function(e) {
        $(this).parent('.top-contact').addClass('togglecontact');
    });
    $(".top-contact .close").on("click", function(e) {
        $(this).parent('.top-contact').removeClass('togglecontact');
    });
});


$(document).ready(function() {
    $('.filter-select').selectric();

    /*-------- Filter By Price -----------*/

    jQuery("#slider-range").slider({
        range: true,
        min: 0,
        max: 500,
        values: [75, 300],
        slide: function(event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    jQuery("#amount").val("$" + $("#slider-range").slider("values", 0) +
        " - $" + $("#slider-range").slider("values", 1));

});