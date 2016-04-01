<header>
    <div class="top">
        <a href="">
            <img src="<?php echo \Setting::get('logo_url') ?>" />
        </a>
    </div>

    <div class="banner">
        <a href="">
            <img src="<?php echo \Setting::get('banner_url') ?>" width="100%" />
        </a>
    </div>

    <?php $controller->block('block_widget_menu'); ?>
</header>
