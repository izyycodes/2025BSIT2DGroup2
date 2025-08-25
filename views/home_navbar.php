<header class="navbar">

    <input type="checkbox" id="toggler">
    <label for="toggler"><i class="ri-menu-line"></i></label>

    <a href="../pages/index.php">
        <div class="logo">
            <img src="../images/logo.png" alt="logo">
            <h1 class="logo-name">BantayBaha</h1>
        </div>
    </a>
    
    <?php 
        $date = date("d F Y");
        $day  = date("l");
    ?>

    <div class="nav-text">
        <span><?php echo $date; ?></span>
        <span>|</span>
        <span><?php echo $day; ?></span>
        <span>|</span>
        <span id="time"></span>
        <span>|</span>
        <img src="../icons/bell.png" alt="Bell" style="width: 25px; height: 25px;">
        <span>|</span>
        <img src="../icons/profile.png" alt="Profile" style="width: 30px; height: 30px;">
    </div>
    
</header>

<script src="../js/script.js"></script>