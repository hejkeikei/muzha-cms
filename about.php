<?php
include 'includes/header.php'; ?>
<div class="container">
    <div class="box">
        <img src="<?php echo get_info('profileimg'); ?>" alt="<?php echo get_info('artist'); ?>'s profile image">
    </div>
    <article>
        <h3><?php echo get_info('artist'); ?></h3>
        <p><?php echo get_info('description'); ?></p>
    </article>
</div>
<?php include 'includes/footer.php'; ?>