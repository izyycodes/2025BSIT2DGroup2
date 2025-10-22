<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Community Reports</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/community_reports.css">
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
                <i class="fa-solid fa-bullhorn"></i>
                <h1>Community Reports</h1>
            </div>
            <p>Community-submitted river conditions and crossing point status reports</p>
        </div>

        <!-- Report Statistics -->
        <div class="reports-header margin">
            <div class="reports-stats">
                <div class="stat-item">
                    <div class="stat-number">247</div>
                    <div class="stat-label">TOTAL REPORTS</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">12</div>
                    <div class="stat-label">TODAY</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">5</div>
                    <div class="stat-label">PENDING</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">89%</div>
                    <div class="stat-label">VERIFIED</div>
                </div>
            </div>
            <a href="../pages/submit_new_report.php" class="btn btn-primary">
                <img src="../assets/images/file-pen.png" alt="file-pen">
                Submit New Report
            </a>
        </div>

        <!-- Report Filters -->
        <div class="reports-filters margin">
            <!-- Status -->
            <div class="filter-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="filter-select">
                    <option value="all-reports">All Reports</option>
                    <option value="verified">Verified</option>
                    <option value="pending">Pending</option>
                    <option value="flagged">Flagged</option>
                </select>
            </div>

            <!-- Location -->
            <div class="filter-group">
                <label for="location">Location:</label>
                <select name="location" id="location" class="filter-select">
                    <option value="all-locations">All Locations</option>
                    <option value="cpoint1">Crossing Point 1</option>
                    <option value="cpoint2">Crossing Point 2</option>
                    <option value="cpoint3">Crossing Point 3</option>
                </select>
            </div>

            <!-- Search -->
            <div class="filter-group">
                <label for="search">Search:</label>
                <div class="search-box">
                    <i class="ri-search-line"></i>
                    <input type="search" id="search" name="search" placeholder="Search reports...">
                </div>
            </div>
        </div>

        <!-- Reports -->
        <div class="reports-grid margin" id="verify-reports">
            <div class="reports-list">
                <?php
                require 'conn.php';

                // Display newest reports first
                $query = "SELECT * FROM community_reports ORDER BY created_at DESC";
                $result = $conn->query($query);

                if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
                    $avatar = strtoupper(substr($row['first_name'], 0, 1) . substr($row['last_name'], 0, 1));
                ?>
                <div class="report-card <?php echo $row['status']; ?>" 
                    data-status="<?php echo $row['status']; ?>" 
                    data-location="<?php echo strtolower(str_replace(' ', '', $row['location'])); ?>">

                    <div class="report-header">
                    <div class="report-user">
                        <div class="user-avatar"><?php echo $avatar; ?></div>
                        <div class="user-info">
                        <h4><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h4>
                        <div class="report-time">
                            <?php echo date('F j, Y', strtotime($row['report_date'])) . ' ' . date('g:i A', strtotime($row['report_time'])); ?>
                        </div>
                        </div>
                    </div>
                    <div class="report-status status-<?php echo $row['status']; ?>">
                        <?php echo ucfirst($row['status']); ?>
                    </div>
                    </div>

                    <div class="report-content">
                        <div class="report-location">📍 <?php echo htmlspecialchars($row['location']); ?></div>
                        <div class="report-description"><?php echo htmlspecialchars($row['water_level_desc']); ?></div>
                        <?php if (!empty($row['remarks'])): ?>
                            <p class="report-remarks"><?php echo htmlspecialchars($row['remarks']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($row['photo_path']) && file_exists($row['photo_path'])): ?>
                            <div class="report-photo">
                            <img src="<?php echo htmlspecialchars($row['photo_path']); ?>" alt="Report photo">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="report-actions">
                        <form method="POST" action="update_report_status.php" style="display:inline;">
                            <input type="hidden" name="report_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="status" value="verified">
                            <button type="submit" class="btn btn-outline btn-success btn-sm">
                                <i class="ri-check-line"></i>
                                Verify
                            </button>
                        </form>

                        <form method="POST" action="update_report_status.php" style="display:inline;">
                            <input type="hidden" name="report_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="status" value="flagged">
                            <button type="submit" class="btn btn-outline btn-danger btn-sm">
                                <i class="ri-alert-line"></i>
                                Flag
                            </button>
                        </form>
                        <div class="vote-section">
                            <div class="vote-count">
                                <i class="ri-thumb-up-line"></i>
                                0
                            </div>
                            <div class="vote-count">
                                <i class="ri-thumb-down-line"></i>
                                0
                            </div>
                        </div>
                    </div>

                </div>
                <?php endwhile; else: ?>
                <div id="no-reports" class="no-reports">
                    <div class="empty-state">
                    <i class="fa-solid fa-bullhorn"></i>
                    <h3>No reports</h3>
                    <p style="color: #666;">No reports to display.</p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Verified card -->
                <div class="report-card verified" data-status="verified" data-location="cpoint1">
                    <div class="report-header">
                        <div class="report-user">
                            <div class="user-avatar">MS</div>
                            <div class="user-info">
                                <h4>Marisol Samillano</h4>
                                <div class="report-time">5 minutes ago</div>
                            </div>
                        </div>
                        <div class="report-status status-verified">Verified</div>
                    </div>
                    <div class="report-content">
                        <div class="report-location">📍 Crossing Point 1</div>
                        <div class="report-description">Water level is low and safe for crossing. No debris observed. Clear visibility and calm current.</div>
                        <div class="report-photo">
                            <p>[Photo: Safe crossing conditions]</p>
                        </div>
                    </div>
                    <div class="report-actions">
                        <button class="btn btn-outline btn-success btn-sm">
                            <i class="ri-check-line"></i>
                            Verified
                        </button>
                        <div class="vote-section">
                            <div class="vote-count">
                                <i class="ri-thumb-up-line"></i>
                                8
                            </div>
                            <div class="vote-count">
                                <i class="ri-thumb-down-line"></i>
                                0
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending card -->
                <div class="report-card pending" data-status="pending" data-location="cpoint2">
                    <div class="report-header">
                        <div class="report-user">
                            <div class="user-avatar">AD</div>
                            <div class="user-info">
                                <h4>Aizhelle de la Cruz</h4>
                                <div class="report-time">15 minutes ago</div>
                            </div>
                        </div>
                        <div class="report-status status-pending">Pending</div>
                    </div>
                    <div class="report-content">
                        <div class="report-location">📍 Crossing Point 2</div>
                        <div class="report-description">Water level rising due to heavy rain upstream. Becoming muddy and current getting stronger. Use caution.</div>
                        <div class="report-photo">
                            <p>[Photo: Rising water levels]</p>
                        </div>
                    </div>
                    <div class="report-actions">
                        <button class="btn btn-outline btn-success btn-sm">
                            <i class="ri-check-line"></i>
                            Verify
                        </button>
                        <button class="btn btn-outline btn-danger btn-sm">
                            <i class="ri-alert-line"></i>
                            Flag
                        </button>
                        <div class="vote-section">
                            <div class="vote-count">
                                <i class="ri-thumb-up-line"></i>
                                3
                            </div>
                            <div class="vote-count">
                                <i class="ri-thumb-down-line"></i>
                                1
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verified card -->
                 <div class="report-card verified" data-status="verified" data-location="cpoint2">
                    <div class="report-header">
                        <div class="report-user">
                            <div class="user-avatar">JB</div>
                            <div class="user-info">
                                <h4>Janelle Ba-al</h4>
                                <div class="report-time">45 minutes ago</div>
                            </div>
                        </div>
                        <div class="report-status status-verified">Verified</div>
                    </div>
                    <div class="report-content">
                        <div class="report-location">📍 Crossing Point 2</div>
                        <div class="report-description">Strong winds are causing waves at the crossing point. Water level is moderate but debris is starting to gather near the banks. Caution is advised.</div>
                        <div class="report-photo">
                            <p>[Photo: Debris collecting near the river bank]</p>
                        </div>
                    </div>
                    <div class="report-actions">
                        <button class="btn btn-outline btn-success btn-sm">
                            <i class="ri-check-line"></i>
                            Verified
                        </button>
                        <div class="vote-section">
                            <div class="vote-count">
                                <i class="ri-thumb-up-line"></i>
                                7
                            </div>
                            <div class="vote-count">
                                <i class="ri-thumb-down-line"></i>
                                2
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Flagged card -->
                <div class="report-card flagged" data-status="flagged" data-location="cpoint3">
                    <div class="report-header">
                        <div class="report-user">
                            <div class="user-avatar">AY</div>
                            <div class="user-info">
                                <h4>Anne Ynzon</h4>
                                <div class="report-time">1 hour ago</div>
                            </div>
                        </div>
                        <div class="report-status status-flagged">Flagged</div>
                    </div>
                    <div class="report-content">
                        <div class="report-location">📍 Crossing Point 3</div>
                        <div class="report-description">Report flagged for review due to conflicting information with other recent reports from the same location.</div>
                        <div class="report-photo">
                            <p>[Photo under review]</p>
                        </div>
                    </div>
                    <div class="report-actions">
                        <button class="btn btn-outline btn-success btn-sm">
                            <i class="ri-file-search-line"></i>
                            Review
                        </button>
                        <div class="vote-section">
                            <div class="vote-count">
                                <i class="ri-thumb-up-line"></i>
                                2
                            </div>
                            <div class="vote-count">
                                <i class="ri-thumb-down-line"></i>
                                6
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending card -->
                <div class="report-card pending" data-status="pending" data-location="cpoint1">
                    <div class="report-header">
                        <div class="report-user">
                            <div class="user-avatar">EB</div>
                            <div class="user-info">
                                <h4>Eanna Bravo</h4>
                                <div class="report-time">1 hour and 3 minutes ago</div>
                            </div>
                        </div>
                        <div class="report-status status-pending">Pending</div>
                    </div>
                    <div class="report-content">
                        <div class="report-location">📍 Crossing Point 1</div>
                        <div class="report-description">Heavy rainfall earlier caused the water to rise quickly, but it has already started to recede. Current is steady and the path looks clearer now. Locals report it is safe to cross again.</div>
                        <div class="report-photo">
                            <p>[Photo: Water receding and path becoming clearer]</p>
                        </div>
                    </div>
                    <div class="report-actions">
                        <button class="btn btn-outline btn-success btn-sm">
                            <i class="ri-check-line"></i>
                            Verify
                        </button>
                        <button class="btn btn-outline btn-danger btn-sm">
                            <i class="ri-alert-line"></i>
                            Flag
                        </button>
                        <div class="vote-section">
                            <div class="vote-count">
                                <i class="ri-thumb-up-line"></i>
                                5
                            </div>
                            <div class="vote-count">
                                <i class="ri-thumb-down-line"></i>
                                3
                            </div>
                        </div>
                    </div>
                </div>

                <div id="no-reports" class="no-reports" style="display: none;">
                <div class="empty-state">
                    <i class="fa-solid fa-bullhorn"></i>
                    <h3>No reports</h3>
                    <p style="color: #666;">No reports to display.</p>
                </div>
            </div>

            </div>
            <div class="sidebar-panel">
                <!-- Report Trends -->
                <div class="panel-card">
                    <h3>📊 Report Trends</h3>
                    <div class="trend-item">
                        <span class="trend-label">Most Active Point</span>
                        <span class="trend-value">Point 2</span>
                    </div>
                    <div class="trend-item">
                        <span class="trend-label">Peak Reporting Hours</span>
                        <span class="trend-value">6-8 AM</span>
                    </div>
                    <div class="trend-item">
                        <span class="trend-label">Average Daily Reports</span>
                        <span class="trend-value">18</span>
                    </div>
                    <div class="trend-item">
                        <span class="trend-label">Response Rate</span>
                        <span class="trend-value">94%</span>
                    </div>
                </div>

                <!-- Top Contributors -->
                <div class="panel-card">
                    <h3>🏆 Top Contributors</h3>
                    <div class="leaderboard-item">
                        <div class="rank gold">1</div>
                        <div class="user-avatar">MS</div>
                        <div>
                            <div style="font-weight: 600; font-size: 13px; color: #2c3e50;">Marisol Samillano</div>
                            <div style="font-size: 11px; color: #666;">45 verified reports</div>
                        </div>
                    </div>
                    <div class="leaderboard-item">
                        <div class="rank silver">2</div>
                        <div class="user-avatar">AD</div>
                        <div>
                            <div style="font-weight: 600; font-size: 13px; color: #2c3e50;">Aizhelle de la Cruz</div>
                            <div style="font-size: 11px; color: #666;">32 verified reports</div>
                        </div>
                    </div>
                    <div class="leaderboard-item">
                        <div class="rank bronze">3</div>
                        <div class="user-avatar">AY</div>
                        <div>
                            <div style="font-weight: 600; font-size: 13px; color: #2c3e50;">Anne Ynzon</div>
                            <div style="font-size: 11px; color: #666;">28 verified reports</div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="panel-card">
                    <h3>⚡ Recent Activity</h3>
                    <div style="font-size: 13px; color: #666; line-height: 1.6;">
                        <div style="padding: 8px 0; border-bottom: 1px solid #eee;">
                            <strong>Admin</strong>
                            verified Maria's report
                            <div style="font-size: 11px; color: #999;">2 minutes ago</div>
                        </div>
                        <div style="padding: 8px 0; border-bottom: 1px solid #eee;">
                            <strong>5 users</strong>
                            confirmed Juan's report
                            <div style="font-size: 11px; color: #999;">8 minutes ago</div>
                        </div>
                        <div style="padding: 8px 0; border-bottom: 1px solid #eee;">
                            <strong>Roberto's</strong>
                            report was flagged
                            <div style="font-size: 11px; color: #999;">25 minutes ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require "../views/footer.php" ?>
    </div>

    <script src="../assets/js/community_reports.js"></script>
</body>

</html>