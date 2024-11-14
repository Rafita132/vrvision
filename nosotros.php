<?php include 'header.php' ?>

<main class="about-us">
    <section class="team">
        <h2>Nuestro Equipo</h2>
        <div class="team-member">
            <img src="img/chica2.jpg" alt="Miembro del equipo">
            <h3>Laura Fernández García</h3>
            <p>GERENTE DE TIENDA</p>
        </div>
        <div class="team-member">
            <img src="img/Mi.png" alt="Miembro del equipo">
            <h3>Rafael Quevedo Ibáñez</h3>
            <p>DISEÑADOR WEB PRINCIPAL</p>
        </div>
        <div class="team-member">
            <img src="img/tio1.png" alt="Miembro del equipo">
            <h3>Carlos Méndez López</h3>
            <p>GENERAL MANAGER</p>
        </div>
        <div class="team-member">
            <img src="img/chica1.jpg" alt="Miembro del equipo">
            <h3>Ana Rodríguez Sánchez</h3>
            <p>DEPENDIENTE DE TIENDA</p>
        </div>
        <div class="team-member">
            <img src="img/tio2.jpg" alt="Miembro del equipo">
            <h3>Diego Morales Jiménez</h3>
            <p>DEPENDIENTE DE TIENDA</p>
        </div>
    </section>

    <section class="map">
        <h2>Nuestra Ubicación</h2>
        <div class="map-wrapper">
            <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
                <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div>
                <script>
                (function() {
                    var setting = {
                        "query": "Málaga Centro: Calle Cuarteles número 2",
                        "width": 2000,
                        "height": 600,
                        "center": location,
                        "satellite": false,
                        "zoom": 14,
                        "placeId": "ChIJ0wvPJYlacg0ReUNB8sgw39k",
                        "cid": "0xd9df30c8f2414379",
                        "coords": [36.7176779, -4.280396],
                        "lang": "es",
                        "queryString": "Málaga Centro: Calle Cuarteles número 2",
                        "centerCoord": [36.7176779, -4.280396],
                        "id": "map-9cd199b9cc5410cd3b1ad21cab2e54d3",
                        "embed_id": "1037565"
                    };
                    var d = document;
                    var s = d.createElement('script');
                    s.src = 'https://1map.com/js/script-for-user.js?embed_id=1037565';
                    s.async = true;
                    s.onload = function(e) {
                        window.OneMap.initMap(setting)
                    };
                    var to = d.getElementsByTagName('script')[0];
                    to.parentNode.insertBefore(s, to);
                })();
                </script><a href="https://1map.com/es/map-embed">1 Map</a>
            </div>
        </div>
    </section>
</main>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="js/app.js"></script>
<?php include 'footer.php' ?>