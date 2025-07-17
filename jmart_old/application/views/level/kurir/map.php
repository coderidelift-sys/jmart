<?php $this->load->view('layouts/kurir/head'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.fullscreen/dist/leaflet.fullscreen.css">
<script src="https://leaflet.github.io/Leaflet.fullscreen/dist/Leaflet.fullscreen.min.js"></script>
<style>
    ul.timeline {
        list-style-type: none;
        position: relative;
        padding-left: 40px;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 2;
    }

    ul.timeline>li {
        margin: 20px 20px 20px 20px;
        padding-left: 10px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 2;
    }

    .title {
        font-weight: 700;
        margin-bottom: 0;
        color: #2C406E;
    }

    .leaflet-container {
        height: 400px;
        width: 600px;
        max-width: 100%;
        max-height: 100%;
    }
</style>
<?php $this->load->view('layouts/kurir/header'); ?>
<nav class="navbar navbar--show navbar-expand-lg navbar-light" style="background: #2F5596 !important;">
    <div class="container">
        <div class="nav-bar__left">
            <h1 class="nav-bar__center__title" style="font-family: gotham_fonts;color: white;line-height: 1.2;">Map</h1>
        </div>
    </div>
</nav>

<section class="mt-3 mb-4">
    <div class="container">
        <div class="row mb-2">
            <div class="col-8 col-md-8">
                <select name="latLng" id="selectLatLng" class="form-control">
                    <?php foreach ($list as $key => $value) : ?>
                        <option value="<?= $value['koordinat'] ?>"><?= $value['nama_member'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-4 col-md-4">
                <button class="btn btn-sm btn-success text-white mb-2" id="AktifkanRute">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);">
                        <path d="M12 21c4.411 0 8-3.589 8-8 0-3.35-2.072-6.221-5-7.411v2.223A6 6 0 0 1 18 13c0 3.309-2.691 6-6 6s-6-2.691-6-6a5.999 5.999 0 0 1 3-5.188V5.589C6.072 6.779 4 9.65 4 13c0 4.411 3.589 8 8 8z"></path>
                        <path d="M11 2h2v10h-2z"></path>
                    </svg>
                    &nbsp;&nbsp;<span id="toggleButtonText">Aktifkan Rute</span>
                </button>
            </div>
        </div>

        <div id='map'></div>
    </div>
</section>

<div class="row">
    <br><br><br><br>
</div>

<?php $this->load->view('layouts/kurir/menu'); ?>
<?php $this->load->view('layouts/kurir/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<script>
    $(document).ready(function() {
        var customIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png', // URL gambar ikon
            iconSize: [25, 41], // Ukuran ikon [lebar, tinggi]
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41] // Posisi titik anchor untuk popup [x, y] (y adalah tinggi ikon)
        });

        var map = L.map('map', {
            fullscreenControl: {
                pseudoFullscreen: false
            },
            crs: L.CRS.EPSG3857 // Sesuaikan dengan CRS yang Anda perlukan
        }).setView([0, 0], 2);

        // Add a tile layer (e.g., OpenStreetMap)
        L.tileLayer('http://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
        }).addTo(map);

        var userLat;
        var userLng;

        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                userLat = position.coords.latitude;
                userLng = position.coords.longitude;

                // Tambahkan marker ke lokasi pengguna
                L.marker([userLat, userLng], {
                        icon: customIcon
                    }).addTo(map)
                    .bindPopup('Kurir Location');

                // Setel peta ke lokasi pengguna
                map.setView([userLat, userLng], 15);
            });
        } else {
            console.log("Geolocation is not available in this browser.");
        }

        var routingControl = null;

        function enableRouting() {
            if (routingControl !== null) {
                map.removeControl(routingControl);
            }

            var selectedLatLng = document.getElementById('selectLatLng').value;
            var koordinatArray = selectedLatLng.split(',');

            var lat = parseFloat(koordinatArray[0]); // Mendapatkan nilai latitude
            var lng = parseFloat(koordinatArray[1]); // Mendapatkan nilai longitude

            // Buat objek waypoint untuk rute
            routingControl = L.Routing.control({
                waypoints: [
                    L.latLng(userLat, userLng),
                    L.latLng(lat, lng)
                ],
                routeWhileDragging: false, // Menonaktifkan perubahan jalur saat menyeret waypoint
                draggableWaypoints: false, // Menonaktifkan pengubahan jalur dengan menyeret waypoint
                createMarker: function() {
                    return null; // Mengembalikan null untuk mencegah penambahan marker
                },
            }).addTo(map);
        }

        // Tambahkan marker untuk setiap pengguna dari PHP
        <?php foreach ($list as $user) : ?>
            const content = '<div id="bodyContent"><?= $user['koordinat'] ?><div class="view-link"><a target="_blank" jstcache="6" href="https://www.google.com/maps/dir/?api=1&amp;destination=<?= $user['koordinat'] ?>" tabindex="0"> <span>Tampilan di Google Maps</span> </a> </div></div>';
            const marker = L.marker([<?= $user['koordinat'] ?>]).addTo(map).bindPopup(content);
        <?php endforeach; ?>

        document.getElementById('AktifkanRute').addEventListener('click', enableRouting);
    });
</script>
</body>

</html>