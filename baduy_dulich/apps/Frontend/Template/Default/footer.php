<?php
/** @var SlideShow $widget */
use Flywheel\Document\Html;

/** @var \Menus $menu */

/** @var Html $document */
$document = $this->document();
?>

<footer>
    <?php echo \Setting::get('footer'); ?>
</footer>