<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>
<body>
    <?php wp_body_open(); ?>


    <header>


    <div class="primary_menu">
            <?php
            $menu= array(
                'theme_location' => 'primary_menu',
                'menu_id' => 'primary_menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );

            wp_nav_menu($menu);
            ?>
        </div>

        <div class="secondary_menu">
            <?php
            $menu= array(
                'theme_location' => 'secondary_menu',
                'menu_id' => 'secondary_menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );

            wp_nav_menu($menu);
            ?>
        </div>
    
    </header>

<div class="custom-hero">
    <div class="logo-div">
        <img src="<?php echo get_template_directory_uri(); ?>/resources/images/logo-yellow.png" alt="logo">
    </div>
    <div class="page_title-div">
       <h1> <?php woocommerce_page_title(); ?> </h1>
    </div>
    <div class="breadcrumbs-div">
        <h5> <?php woocommerce_breadcrumb(); ?> </h5>
    </div>

</div>




    <!--<div class="hero-banner">
        <img src="https://s3-alpha-sig.figma.com/img/1461/f3d6/ff74c027a1888544144abe4be6e02cbf?Expires=1708905600&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=bMhobuS~UJYiyn~Qhp7vxkCGnv3RsOfQudrOx~lT7JxNUrdpMRouasYD2VE0DmUuPZHf6-bkmRjef5cWVc5uRxGTjM6LtdemWVHRIStG7lp1CCgPmkntJrX20f0fa8yYX4htmiXasFC2iP2T4cs1IsBSev-5GnDCQzEYS9CTub242cblhOTjuiLKig0MgFQqA1jgmL8hYsRdNexJLuUr0GpNuPQTBrhnNRQ7XVLuLPBOMTpzwzjGKmplxZfqtDXGbFKYfY9ZAgIV3N6sQyrrG~Wiv-vohXGnNxTxbWN7qhm1qOXomTPewjAuZouNmjThO~yHRrVHbFmGJsVYvPhf3Q__ " alt="pic">

    </div>-->

