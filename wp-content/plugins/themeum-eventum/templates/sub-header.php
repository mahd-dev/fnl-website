<?php 
    $output = ''; 
    $output = 'style="background-color:#fff;padding: 100px 0 90px;"';
?>

<?php if (!is_front_page()) { ?>

<div class="sub-title" <?php echo $output;?>>
    <div class="container">
        <div class="sub-title-inner">
            <h2><?php the_title(); ?></h2>
            <?php themeum_breadcrumbs(); ?>
        </div>
    </div>
</div>

<?php } ?>
