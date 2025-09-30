<?php 
    // var_dump($_POST);

    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $location = $_POST['location'] ?? '';
    $reportDate = $_POST['reportDate'] ?? '';
    $reportTime = $_POST['reportTime'] ?? '';
    $waterLevelDesc = $_POST['waterLevelDesc'] ?? '';
    $remarks = $_POST['remarks'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>New Report</title>
    <link rel="icon" type="image/ico" href="../assets/images/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/new_report.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <?php require "../views/dashboard_navbar.php" ?>
    <?php require "../views/sidebar.php" ?>

    <div class="main-content">
        <button class="back-button">
            <a href="../pages/community_reports.php">
                <i class="ri-arrow-left-line"></i>
                Back
            </a>
        </button>
        
        <div class="new-report-container">
            <div class="page-header">
                <div class="page-title">
                    <i class="fa-solid fa-bullhorn"></i>
                    <h1>Submit New Community Reports</h1>
                </div>
                <p>Provide details about river conditions and crossing point status for the community.</p>
            </div>

            <form id="new-report-form" method="POST" action="submit_new_report.php">

                <div class="form-row">
                    <div class="form-column">
                        <label for="firstName">First Name <span style="color: #dc3545;"> *</span></label>
                        <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-column">
                        <label for="lastName">Last Name <span style="color: #dc3545;"> *</span></label>
                        <input type="text" id="lastName" name="lastName" placeholder="Enter your full name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="location">Location <span style="color: #dc3545;"> *</span></label>
                        <select name="location" id="location" required>
                            <option value="" disabled selected>Select crossing point</option>
                            <option value="Crossing Point 1">Crossing Point 1</option>
                            <option value="Crossing Point 2">Crossing Point 2</option>
                            <option value="Crossing Point 3">Crossing Point 3</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="reportDate">Report Date <span style="color: #dc3545;"> *</span></label>
                        <input type="date" id="reportDate" name="reportDate" required>
                    </div>
                    <div class="form-column">
                        <label for="reportTime">Report Time <span style="color: #dc3545;"> *</span></label>
                        <input type="time" id="reportTime" name="reportTime" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="waterLevelDesc">Water Level Description <span style="color: #dc3545;"> *</span></label>
                        <select name="waterLevelDesc" id="waterLevelDesc" required>
                            <option value="" disabled selected>Select water level</option>
                            <option value="Low (Safe for crossing)">Low (Safe for crossing)</option>
                            <option value="Moderate (Exercise caution)">Moderate (Exercise caution)</option>
                            <option value="High (Unsafe for crossing)">High (Unsafe for crossing)</option>
                            <option value="Flooded">Flooded</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="remarks">Additional Remarks</label>
                        <textarea name="remarks" id="remarks" placeholder="Write additional observations, potential hazards, debris, or any other relevant information" rows="4" cols="30"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="uploadPhoto">Upload Photo (optional)</label>
                        <input type="file" name="uploadPhoto" id="uploadPhoto">
                        <p style="color: #666; font-size: 14px; margin-top: 7px;">Upload a clear photo of the river or crossing point (max 5MB).</p>
                    </div>
                </div>
            </form>
        </div>

        <div class="action-buttons">
            <a href="../pages/community_reports.php" class="btn btn-cancel">
                Cancel
            </a>
            <button type="submit" class="btn btn-submit" form="new-report-form">
                Submit Report
            </button>
        </div>

        <div id="reportModal" class="report-container">
           <div class="report-modal">
                <h2>New Report Details</h2>

                <div class="info-row">
                    <span class="info-label"> Full Name: </span>
                    <span class="info-value"><?php echo $firstName . " " . $lastName; ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label"> Location: </span>
                    <span class="info-value"><?php echo $location; ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label"> Report Date: </span>
                    <span class="info-value"><?php echo $reportDate; ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label"> Report Time: </span>
                    <span class="info-value"><?php echo $reportTime; ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label"> Water Level Description: </span>
                    <span class="info-value"><?php echo $waterLevelDesc; ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label"> Additional Remarks: </span>
                    <span class="info-value"><?php echo $remarks; ?></span>
                </div>

                <div class="action-buttons" style="justify-content: space-between; margin: 0;">
                    <a class="btn btn-cancel" id="cancelBtn">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-submit" id="confirmBtn">
                        Confirm
                    </button>
                </div>
            </div>
        </div>

        <?php require "../views/footer.php" ?>
    </div>

    <!-- <script src="../assets/js/community_reports.js"></script> -->
</body>
</html>