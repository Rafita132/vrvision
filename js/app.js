function seleccionarFecha(fecha) {
    document.getElementById('fecha').value = fecha;
}

function initMap() {
    var location = { lat: 36.7196, lng: -4.4221 }; // Coordenadas de Calle Cuarteles, Málaga
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: location
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: 'Málaga Centro: Calle Cuarteles número 2'
    });
}

window.onload = initMap;
