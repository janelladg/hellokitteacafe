<?php
// Check if $user_id is set
if(isset($user_id)) {
    // Your existing code for displaying messages and header
    if(isset($message)){
        foreach($message as $msg){
            echo '
            <div class="message">
                <span>'.$msg.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
    }

    // Your existing header HTML code with modifications
    ?>
    <header class="header">
    <section class="flex">
        <a href="home.php" class="logo">
            <img src="logoo.png" alt="Hello Kit-Tea Cafe">
</a>
        </div>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="menu.php">Menu</a>
            <a href="orders.php">Orders</a>
            <a href="contact.php">Contact</a>
        </nav>
        <div class="icons">
            <?php
            // Your existing code to count cart items
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
            ?>
            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>
        <div class="profile">
            <?php
            // Your existing code to select and display user profile
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                <p class="name"><?= $fetch_profile['name']; ?></p>
                <div class="flex">
                    <a href="profile.php" class="btn">profile</a>
                    <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
                </div>
                <?php
            } else {
                ?>
                <p class="name">please login first!</p>
                <a href="login.php" class="btn">login</a>
                <?php
            }
            ?>
        </div>
    </section>
</header>

    <?php
} else {
    // If $user_id is not set, you might want to handle it accordingly, e.g., redirect to login page
    header("Location: login.php");
    exit(); // Ensure script execution stops after redirection
}
?>
