@extends('layouts.front')

@section('title', 'Order Details')

@section('breadcrumb')
    @parent
    <li><a href="{{ route('orders.index') }}">Orders</a></li>
    <li class="active">Order Details</li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <!--The div element for the map -->
            <div id="map" style="height: 400px; width: 100%;"></div>
        </div>
    </div>
    <script>
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const location = {
                lat: {{ $delivery->lat }},
                lng: {{ $delivery->lng }}
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }

        window.initMap = initMap;
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDauK3anqrUgL2_1V4dy1Kfau3DeRFyprk&callback=initMap&v=weekly&libraries=marker"
        defer></script>
    <script>
        (g => {
            var h, a, k, p = "The Google Maps JavaScript API",
                c = "google",
                l = "importLibrary",
                q = "__ib__",
                m = document,
                b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}),
                r = new Set,
                e = new URLSearchParams,
                u = () => h || (h = new Promise(async (f, n) => {
                    await (a = m.createElement("script"));
                    e.set("libraries", [...r] + "");
                    for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                    e.set("callback", c + ".maps." + q);
                    a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                    d[q] = f;
                    a.onerror = () => h = n(Error(p + " could not load."));
                    a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                    m.head.append(a)
                }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
                d[l](f, ...n))
        })
        ({
            key: "AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg",
            v: "weekly"
        });
    </script>
@endsection
