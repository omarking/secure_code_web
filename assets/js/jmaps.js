function initMap( latitude,  longitude){
    var coordenadas = {lat:latitude, lng:longitude }; 
    var mapa= new google.maps.Map(document.getElementById('gmap'),{zoom:12, center:coordenadas});
    var marker = new google.maps.Marker({position: coordenadas, map:mapa});
  }