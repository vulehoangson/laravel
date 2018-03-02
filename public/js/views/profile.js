$(document).ready(function () {
    var lat = parseFloat($('#lat').val());
    var lng = parseFloat($('#lng').val());
    var find_address = $('#find_address').val();
    var find_phone = $('#find_phone').val();

    var mapProp = {
        center: new vbd.LatLng(lat, lng),
        zoom: 15,
        /*Nếu layer == null là lấy layer mặc định. Nếu layer là [layer1,layer2,.....] khởi động map với nhiều layer*/
        layer:null
    };

    /*Tạo map*/
    var map = new vbd.Map(document.getElementById("vietbando-profile"), mapProp);
    /*var icon=new vbd.Icon();
     icon.url='/images/marker.png';
     icon.size=new vbd.Size(30,40);*/
    var options=new vbd.MarkerOptions();
    options.position = new vbd.LatLng(lat, lng);
    /*options.icon = icon;*/
    var marker=new vbd.Marker(options);
    marker.setMap(map);
    var content = '<div class="MiniPopup"><p class="Content"> <span class="address"><i class="fa fa-home" style="font-size:14px;margin-right: 5px;"></i>' + find_address + '</span> <span class="phone"><i class="fa fa-phone" style="font-size:13px;margin-right: 7px;"></i>' + find_phone + '</span></p> </div>'
    var infowindow = new vbd.InfoWindow();
    infowindow.setContent(content);
    infowindow.open(map, marker);
    vbd.event.addListener(marker, 'click', function (param) {
        infowindow.open(map, marker);
    });

    // stop video playing when click next or pre slide
    $('#myCarousel').on('slide.bs.carousel', function () {
        document.getElementById('video').pause();
    });
});