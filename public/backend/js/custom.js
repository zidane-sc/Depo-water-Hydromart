// ACTIVE MENU JS
var path = window.location.href; // because the 'href' property of the DOM element is the absolute path

if (path.includes("users") || path.includes("departements") || path.includes("departements") || path.includes("device") || path.includes("sensor")) {
    path = window.location.origin + '/settings';
}

console.log(path);
$('ul a').each(function () {
    if (this.href === path) {
        $(this).addClass('active');
        $(this).parent().parent().parent().closest('li').find('.with-sub').addClass(
            'show-sub active');
    }
});



// LOAD PROGRESS
loadProgressBar();

// SOCKET JS
// window.socketio = io.connect('https://websocket-modbus.herokuapp.com'); // koneksi ke nodejsnya


// DATATABLE
 
$(document).ready(function () {
    $('#preloader').hide();
    // $(".img-profile").each(function () {
    //     var img = $(this);
    //     var image = new Image();
    //     image.src = $(img).attr("src");
    //     var no_image =
    //         "https://www.ommel.fi/content/uploads/2019/03/dummy-profile-image-male.jpg";
    //     if (image.naturalWidth == 0 || image.readyState == 'uninitialized') {
    //         $(img).unbind("error").attr("src", no_image).css({
    //             height: $(img).css("height"),
    //             width: $(img).css("width"),
    //         });
    //     }
    // });
});

// DELETE DATA

