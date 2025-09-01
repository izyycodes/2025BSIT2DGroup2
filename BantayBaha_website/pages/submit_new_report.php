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

            <form id="new-report-form">

                <div class="form-row">
                    <div class="form-column">
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-column">
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" placeholder="Enter your full name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="location">Location</label>
                        <select name="location" id="location" required>
                            <option value="">Select crossing point</option>
                            <option value="cpoint1">Crossing Point 1</option>
                            <option value="cpoint2">Crossing Point 2</option>
                            <option value="cpoint3">Crossing Point 3</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="reportDate">Report Date</label>
                        <input type="date" id="reportDate" name="reportDate" required>
                    </div>
                    <div class="form-column">
                        <label for="reportTime">Report Time</label>
                        <input type="time" id="reportTime" name="reportTime" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-column">
                        <label for="waterLevelDesc">Water Level Description</label>
                        <select name="waterLevelDesc" id="waterLevelDesc" required>
                            <option value="">Select water level</option>
                            <option value="low">Low (Safe for crossing)</option>
                            <option value="moderate">Moderate (Exercise caution)</option>
                            <option value="high">High (Unsafe for crossing)</option>
                            <option value="flooded">Flooded</option>
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
                        <p style="color: #666; font-size: 12px; margin-top: 7px;">Upload a clear photo of the river or crossing point (max 5MB).</p>
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

        <?php require "../views/footer.php" ?>
    </div>

    <script>
        const form = document.getElementById("new-report-form");

        form.addEventListener("submit", function(e) {
            e.preventDefault();

            alert("Report submiited successfully!");
            form.reset();
        });
    </script>
</body>
</html>