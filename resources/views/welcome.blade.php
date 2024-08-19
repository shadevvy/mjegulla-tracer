<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mjegulla Tracer</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    {{-- <script src="/traffic_tracker.js"></script> --}}
    <script src="https://cdn-traffic-tracker-mjegulla.s3.eu-north-1.amazonaws.com/traffic_tracker.js"></script>
    @vite('resources/js/app.js')

    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    <!-- Styles -->
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        :host,
        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            font-feature-settings: normal;
            font-variation-settings: normal;
            -webkit-tap-highlight-color: transparent
        }

        body {
            margin: 0;
            line-height: inherit
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div
            class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="container">
                <main class="mt-6">
                    <div class="row">
                        <div class="col">
                            <h1>Tracking Dashboard</h1>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <table id="trackingTable" class="table">
                                <thead>
                                    <tr>
                                        <th>User IP</th>
                                        <th>Url</th>
                                        <th>Title</th>
                                        <th>Country</th>
                                        <th>Device</th>
                                        <th>User Agent</th>
                                        <th>Browser</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    {{-- @vite('resources/js/app.js') --}}
                    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
                    <script>
                        console.log('Echo initialized##:', window.Echo);
                    </script>
                    <script>


                        async function fetchTrackingData() {
                            const response = await fetch('/tracking-data');
                            const data = await response.json();
                            console.log("Data", data);
                            const tableBody = document.querySelector('#trackingTable tbody');
                            tableBody.innerHTML = '';

                            data.forEach(row => {
                                const tr = document.createElement('tr');
                                tr.innerHTML = `
                                        <td>${row.user_ip}</td>
                                        <td>${row.website_url}</td>
                                        <td>${row.website_title}</td>
                                        <td>${row.country}</td>
                                        <td>${row.device}</td>
                                        <td>${row.user_agent}</td>
                                        <td>${row.browser}</td>
                                        <td>${new Date(row.created_at).toLocaleString()}</td>
                                    `;
                                tableBody.appendChild(tr);
                            });
                        }

                        // Fetch tracking data every 5 seconds
                        setInterval(fetchTrackingData, 5000);

                        // Initial fetch
                        fetchTrackingData();



                        // window.Echo.channel('tracking-data').listen('TrackingDataUpdated', (event) => {
                        //     console.log('New tracking data received:', event.trackingData);
                        // });

                        function startListening() {
                            window.Echo.channel('tracking-data').listen('TrackingDataUpdated', (event) => {
                                console.log('New tracking data received:', event);
                            });
                        }

                        // Wait until Echo is initialized
                        if (window.Echo) {
                            startListening();
                            console.log('Echo initialized:', window.Echo);
                        } else {
                            console.log('Echo not initialized yet');
                            window.addEventListener('vite:connected', () => {
                                startListening();
                            });
                        }
                        if (window.Echo) {
                            startListening();
                        } else {
                            window.addEventListener('vite:connected', () => {
                                if (window.Echo) {
                                    startListening();
                                }
                            });
                        }
                    </script>
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </footer>
            </div>
        </div>
    </div>
</body>

</html>
