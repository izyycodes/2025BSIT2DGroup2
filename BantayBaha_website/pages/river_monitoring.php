<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>River Monitoring</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    
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
        <div class="card margin">
            <h3>River Data</h3>
            <div class="blue-container">
                <div class="blue-card">
                    <p>Water Level</p>
                    <h3 style="font-size: 20px;">2.35m</h3>
                </div>
                <div class="blue-card">
                    <p>Flow Speed</p>
                    <h3 style="font-size: 20px;">1.5m/s</h3>
                </div>
                <div class="blue-card">
                    <p>Rainfall</p>
                    <h3 style="font-size: 20px;">14mm</h3>
                </div>
            </div>
        </div>

        <div class="container margin">
            <!-- Water Level Trends -->
            <div class="card">
                <h3>📉 Water Level Trends</h3>
                <div class="chart-placeholder">
                    <p>[Line Chart - 24-hour Water Level History]</p>
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
                <div class="chart-placeholder">
                    <p>[Bar Chart - Rainfall vs Water Level]</p>
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
                <div class="river-map-container">
                    <div class="river-system">
                        <div class="river-line river-main">
                            <div class="crossing-point point1">
                                <span>1</span>
                                <div class="point-label">Crossing Point 1 - Safe</div>
                            </div>
                            <div class="crossing-point point2">
                                <span>2</span>
                                <div class="point-label">Crossing Point 2 - Caution</div>
                            </div>
                            <div class="crossing-point point3">
                                <span>3</span>
                                <div class="point-label">Crossing Point 3 - Impassable</div>
                            </div>
                        </div>
                    </div>
                </div>
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
</body>
</html>