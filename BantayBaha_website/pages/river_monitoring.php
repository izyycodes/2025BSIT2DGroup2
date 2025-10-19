<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>River Monitoring</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Leaflet.js -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
    <link rel="stylesheet" href="../assets/css/river_monitoring.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <?php require "../views/dashboard_navbar.php" ?>
    <?php require "../views/sidebar.php" ?>

    <div class="main-content">
        <div class="page-header margin">
            <div class="page-title">
                <i class="fa-solid fa-water"></i>
                <h1>River Monitoring</h1>
            </div>
            <p>Real-time water level monitoring and crossing point status for community safety</p>
        </div>

        <!-- River Data Box -->
        <div class="card margin" style="padding: 20px;">
            <h3>River Data</h3>
            <div class="blue-container">
                <div class="blue-card">
                    <div class="icon" style="background:linear-gradient(180deg, #2196F3, #165da4);">
                        <i class="fa-solid fa-ruler-vertical"></i>
                    </div>
                    <div class="info">
                        <h3 style="font-size: 19px;">2.35 m</h3>
                        <p style="font-size: 14px;">Water Level</p>
                    </div>
                </div>
                <div class="blue-card">
                    <div class="icon" style="background:linear-gradient(180deg, #4CAF50, #439446);">
                        <i class="fa-solid fa-gauge"></i>
                    </div>
                    <div class="info">
                        <h3 style="font-size: 19px;">1.5 m/s</h3>
                        <p style="font-size: 14px;">Flow Speed</p>
                    </div>
                </div>
                <div class="blue-card">
                    <div class="icon" style="background:linear-gradient(180deg, #9c27b0, #661b86);">
                        <i class="fa-solid fa-cloud-rain"></i>
                    </div>
                    <div class="info">
                        <h3 style="font-size: 19px;">14 mm/h</h3>
                        <p style="font-size: 14px;">Rainfall</p>
                    </div>
                </div>
                <div class="blue-card">
                    <div class="icon" style="background:linear-gradient(180deg, #f44336, #9e2c2c);">
                        <i class="fa-solid fa-temperature-half"></i>
                    </div>
                    <div class="info">
                        <h3 style="font-size: 19px;">26.8°C</h3>
                        <p style="font-size: 14px;">Temperature</p>
                    </div>
                </div>
                <div class="blue-card">
                    <div class="icon" style="background:linear-gradient(180deg, #607d8b, #3d4e56);">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <div class="info">
                        <h3 style="font-size: 19px;">4.5 NTU</h3>
                        <p style="font-size: 14px;">Turbidity</p>
                    </div>
                </div>
                <div class="blue-card">
                    <div class="icon" style="background:linear-gradient(180deg, #ffb445, #e97804);">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="info">
                        <h3 style="font-size: 19px;">2:45 PM</h3>
                        <p style="font-size: 14px;">Last Updated</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container margin">
            <!-- Water Level Trends -->
            <div class="card">
                <h3>📉 Water Level Trends</h3>
                <div class="chart-container">
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="metric-row">
                    <span>Highest Level Today</span>
                    <span class="metric-value">2.3m at Point 3</span>
                </div>
                <div class="metric-row">
                    <span>Average Level</span>
                    <span class="metric-value">1.2m</span>
                </div>
                <div class="metric-row">
                    <span>Trend</span>
                    <span class="metric-value" style="color: #f44336;">⬆️ Rising</span>
                </div>
            </div>

            <!-- Weather Impact -->
            <div class="card">
                <h3>🌧 Weather Impact</h3>
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
                <div class="metric-row">
                    <span>Current Rainfall</span>
                    <span class="metric-value">12mm/hr</span>
                </div>
                <div class="metric-row">
                    <span>24hr Accumulation</span>
                    <span class="metric-value">45mm</span>
                </div>
                <div class="metric-row">
                    <span>Forecast</span>
                    <span class="metric-value" style="color: #ff9800;">Heavy Rain Expected</span>
                </div>
            </div>
        </div>

        <div class="river-grid margin" id="river-map">
            <!-- River Crossing Points Map -->
            <div class="card">
                <h3>River Crossing Points Map</h3>
                <div id="map"></div>
            </div>

            <!-- Current Status -->
            <div class="card">
                <h3>📊 Current Status</h3>
                <div class="status-item safe">
                    <div class="status-item-header">
                        <div class="status-item-title">Crossing Point 1</div>
                        <div class="status-badge safe">Safe</div>
                    </div>
                    <div class="water-level">0.5m</div>
                    <div class="last-updated">Updated 2 minutes ago</div>
                </div>
                <div class="status-item caution">
                    <div class="status-item-header">
                        <div class="status-item-title">Crossing Point 2</div>
                        <div class="status-badge caution">Caution</div>
                    </div>
                    <div class="water-level">1.2m</div>
                    <div class="last-updated">Updated 5 minutes ago</div>
                </div>
                <div class="status-item danger">
                    <div class="status-item-header">
                        <div class="status-item-title">Crossing Point 3</div>
                        <div class="status-badge danger">Danger</div>
                    </div>
                    <div class="water-level">2.1m</div>
                    <div class="last-updated">Updated 1 minute ago</div>
                </div>
            </div>
        </div>
    
        <?php require "../views/footer.php" ?>
    </div>

    <script>
        window.onload = function() {
            // Line Chart (Water Level Trends)
            const ctxLine = document.getElementById('lineChart');
            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: ['12 AM', '3 AM', '6 AM', '9 AM', '12 PM', '3 PM', '6 PM', '9 PM'],
                    datasets: [{
                        label: 'Water Level (m)',
                        data: [0.8, 1.0, 1.3, 1.5, 1.8, 2.1, 2.3, 2.35],
                        borderColor: '#1386b3',
                        backgroundColor: 'rgba(19, 134, 179, 0.2)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Bar Chart (Rainfall vs Water Level)
            const ctxBar = document.getElementById('barChart');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Point 1', 'Point 2', 'Point 3'],
                    datasets: [
                        {
                            label: 'Rainfall (mm)',
                            data: [10, 18, 25],
                            backgroundColor: 'rgba(33, 150, 243, 0.6)'
                        },
                        {
                            label: 'Water Level (m)',
                            data: [0.5, 1.2, 2.1],
                            backgroundColor: 'rgba(255, 87, 34, 0.6)'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Initialize map centered on Hacienda Sacio, Panaquiao, Isabela
            const map = L.map('map').setView([10.2435, 123.0419], 14);

            // Add OpenStreetMap layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Define crossing points
            const points = [
            { coords: [10.2460, 123.0400], name: "Crossing Point 1", status: "Safe" },
            { coords: [10.2410, 123.0430], name: "Crossing Point 2", status: "Caution" },
            { coords: [10.2380, 123.0450], name: "Crossing Point 3", status: "Danger" }
            ];

            // Create numbered custom markers with hover tooltip
            points.forEach((point, index) => {
            const color =
                point.status === "Safe"
                ? "green"
                : point.status === "Caution"
                ? "orange"
                : "red";

            // Custom HTML marker with number label
            const icon = L.divIcon({
                className: "numbered-marker",
                html: `
                <div class="marker-circle" style="background-color: ${color}; border: 2px solid white;">
                    ${index + 1}
                </div>
                `,
                iconSize: [30, 30],
                iconAnchor: [15, 15],
            });

            const marker = L.marker(point.coords, { icon: icon }).addTo(map);

            // Add tooltip that shows on hover
            marker.bindTooltip(
                `<b>${point.name}</b><br>Status: ${point.status}`,
                { direction: 'top', opacity: 0.9 }
            );
            });

        };
    </script>
</body>
</html>