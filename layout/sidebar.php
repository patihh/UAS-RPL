<div class="tab-navbar">
    <?php 
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <a href="profile.php" class="opsi-kanan <?= $current_page == 'profile.php' ? 'active' : '' ?>">
        <?php echo $current_page == 'profile.php' ? '<b>Profil saya</b>' : 'Profil saya'; ?>
    </a>
    <a href="wishnew.php" class="opsi-kanan <?= $current_page == 'wishnew.php' ? 'active' : '' ?>">
        <?php echo $current_page == 'wishnew.php' ? '<b>Wishlist</b>' : 'Wishlist'; ?>
    </a>
    <a href="History.php" class="opsi-kanan <?= $current_page == 'History.php' ? 'active' : '' ?>">
        <?php echo $current_page == 'History.php' ? '<b>Daftar Transaksi</b>' : 'Daftar Transaksi'; ?>
    </a>
    <a href="logout.php" class="opsi-kanan">Logout</a>
</div>
