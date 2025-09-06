<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Alerts</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/flood_alerts.css">
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
                <i class="ri-alert-fill"></i>
                <h1>Flood Alerts</h1>
            </div>
            <p>Real-time flood risk monitoring and alert system for timely community response</p>
        </div>

         <div class="emergency-banner margin">
             <div class="emergency">
                <div>
                    <i class="ri-alarm-warning-fill"></i>
                </div>
                <div>
                    <p style="font-size: 15px; text-align: left;">
                        <strong style="font-size: 18px;">CRITICAL FLOOD EMERGENCY:</strong> <br>
                        Crossing Point 3 is completely impassable! Water level: 2.1m - Avoid all travel to this area immediately!
                    </p>
                </div>
            </div>
            <div>
                <p style="font-size: 14px;">ACTIVE SINCE <br>
                    <strong>8:30 AM</strong>
               </p>
            </div>
        </div>

        <!-- Auto-updates -->
        <div class="card margin updates">
            <div class="refresh"></div>
            <span style="font-size: 14px; margin-left: 8px;">Auto-updating every 30 seconds • Last update: 9:48 AM</span>
        </div>

        <!-- Rainfall Forecast -->
        <div class="card margin" id="forecast">
            <h3>Rainfall Forecast</h3>
            <div class="rain">
                <div class="rain-header">
                    <h4 style="font-size: 17px;">Next 24 Hours</h4>
                    <p class="heavy-rain">Heavy Rain Expected</p>
                </div>
                <div class="rain-grid">
                    <div class="gauge-column">
                        <p style="font-size: 14px; margin-bottom: 5px;">Now</p>
                        <div class="gauge-bg">
                            <div class="gauge-fill" style="height: 15px;"></div>
                        </div>
                        <p style="font-size: 15px; font-weight: 600; margin-top: 5px;">15mm</p>
                    </div>
                    <div class="gauge-column">
                        <p style="font-size: 14px; margin-bottom: 5px;">+6h</p>
                        <div class="gauge-bg">
                            <div class="gauge-fill" style="height: 25px;"></div>
                        </div>
                        <p style="font-size: 15px; font-weight: 600; margin-top: 5px;">25mm</p>
                    </div>
                    <div class="gauge-column">
                        <p style="font-size: 14px; margin-bottom: 5px;">+12h</p>
                        <div class="gauge-bg">
                            <div class="gauge-fill" style="height: 30px;"></div>
                        </div>
                        <p style="font-size: 15px; font-weight: 600; margin-top: 5px;">30mm</p>
                    </div>
                    <div class="gauge-column">
                        <p style="font-size: 14px; margin-bottom: 5px;">+24h</p>
                        <div class="gauge-bg">
                            <div class="gauge-fill" style="height: 18px;"></div>
                        </div>
                        <p style="font-size: 15px; font-weight: 600; margin-top: 5px;">18mm</p>
                    </div>
                </div>
            </div>
            <div class="forecast-analysis">
                <h4>Forecast Analysis</h4>
                <p style="font-size: 15px; margin-top: 5px;">Heavy rainfall expected between 14:00-20:00 today. Combined with high tide at 16:30, this may cause significant flooding in low-lying areas.</p>
            </div>
        </div>

        <!-- Active Alerts -->
        <div class="card margin" id="alerts">
            <div class="alerts-header">
                <h3>Active Alerts</h3>
                <div class="live-updates">
                    <span style="color: #dc3545;">●</span>
                    Live Updates
                </div>
            </div>

            <div class="filter-tabs">
                <button class="filter-tab active">All Alerts</button>
                <button class="filter-tab">Critical</button>
                <button class="filter-tab">High</button>
                <button class="filter-tab">Moderate</button>
            </div>

            <div class="alert-item alert-critical">
                <div>
                    <div class="alerts-header" style="margin-bottom: 12px;">
                        <h4 style="color: #dc3545; font-size: 16px;">🚨 CRITICAL FLOOD WARNING</h4>
                        <span class="priority-badge priority-critical">CRITICAL</span>
                    </div>

                    <h4 style="margin-bottom: 10px; color: #333; font-size: 18px;">Crossing Point 3 - Completely Impassable</h4>

                    <div style="margin-bottom: 15px; color: #666; font-size: 14px; line-height: 1.6;">
                        <p><strong>Water Level:</strong> 2.1m (Critical threshold exceeded)</p>
                        <p><strong>Location:</strong> Main Bridge Crossing Point 3</p>
                        <p><strong>Active Since:</strong> 8:30 AM (1h 18m ago)</p>
                        <p><strong>Status:</strong> Road closed, all crossing suspended</p>
                    </div>

                    <div style="margin-bottom: 12px;">
                        <span class="status-badge status-active">ACTIVE</span>
                        <span style="font-size: 12px; color: #666; margin-left: 15px;">2,156 residents notified</span>
                    </div>

                    <div style="background: #fff5f5; padding: 12px; border-radius: 8px; border-left: 4px solid #dc3545;">
                        <h4 style="color: #dc3545; font-size: 16px;">⚠️ IMMEDIATE ACTION REQUIRED:</h4>
                        <p style="margin-top: 5px; font-size: 14px; color: #666;">
                            Do not attempt to cross. Use alternative Route via Points 1 or 2. Emergency services on standby.
                        </p>
                    </div>
                </div>
            </div>

            <div class="alert-item alert-high">
                <div>
                    <div class="alerts-header" style="margin-bottom: 12px;">
                        <h4 style="color: #fd7e14; font-size: 16px;">⚠️ HIGH RISK WARNING</h4>
                        <span class="priority-badge priority-high">HIGH</span>
                    </div>

                    <h4 style="margin-bottom: 10px; color: #333; font-size: 18px;">Crossing Point 2 - Rising Water Levels</h4>

                    <div style="margin-bottom: 15px; color: #666; font-size: 14px; line-height: 1.6;">
                        <p><strong>Water Level:</strong> 1.2m (Use extreme caution)</p>
                        <p><strong>Location:</strong> Secondary Bridge Point 2</p>
                        <p><strong>Active Since:</strong> 9:15 AM (33m ago)</p>
                        <p><strong>Status:</strong> Passable with extreme caution</p>
                    </div>

                    <div style="margin-bottom: 12px;">
                        <span class="status-badge status-monitoring">MONITORING</span>
                        <span style="font-size: 12px; color: #666; margin-left: 15px;">1,892 residents notified</span>
                    </div>

                    <div style="background: #fffaf0; padding: 12px; border-radius: 8px; border-left: 4px solid #fd7e14;">
                        <h4 style="color: #fd7e14; font-size: 16px;">🚗  TRAVEL ADVISORY:</h4>
                        <p style="margin-top: 5px; font-size: 14px; color: #666;">
                            Large vehicles should avoid crossing. Light vehicles proceed with extreme caution. Water rising steadily.
                        </p>
                    </div>
                </div>
            </div>

            <div class="alert-item alert-moderate">
                <div>
                    <div class="alerts-header" style="margin-bottom: 12px;">
                        <h4 style="color: #f7b731; font-size: 16px;">🌧 WEATHER ADVISORY</h4>
                        <span class="priority-badge priority-moderate">MODERATE</span>
                    </div>

                    <h4 style="margin-bottom: 10px; color: #333; font-size: 18px;">Heavy Rainfall Expected Tonight</h4>

                    <div style="margin-bottom: 15px; color: #666; font-size: 14px; line-height: 1.6;">
                        <p><strong>Forecast:</strong> Heavy rainfall 6:00 PM - 8:00 PM</p>
                        <p><strong>Coverage:</strong> All crossing points and surrounding areas</p>
                        <p><strong>Valid Until:</strong> 11:59 PM today</p>
                        <p><strong>Impact:</strong> Water levels may rise significantly</p>
                    </div>

                    <div style="margin-bottom: 12px;">
                        <span class="status-badge status-monitoring">MONITORING</span>
                        <span style="font-size: 12px; color: #666; margin-left: 15px;">All residents notified</span>
                    </div>

                    <div style="background: #fffef7; padding: 12px; border-radius: 8px; border-left: 4px solid #f7b731;">
                        <h4 style="color: #f7b731; font-size: 16px;">🌧  PREPARATION ADVICE:</h4>
                        <p style="margin-top: 5px; font-size: 14px; color: #666;">
                            Avoid unnecessary travel after 6 PM. Monitor water levels closely. Prepare emergency supplies.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    
        <?php require "../views/footer.php" ?>
    </div>
</body>
</html>