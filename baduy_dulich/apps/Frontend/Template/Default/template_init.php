<?php
use Flywheel\Document\Html;
$assets_folder = 'assets/';
/** @var Html $document */
$document = $this->document();
$document->cssBaseUrl = $assets_folder;
$document->jsBaseUrl = $assets_folder;
//add Css
$document->addCss('css/bootstrap/bootstrap.min.css');
$document->addCss('css/bootstrap/bootstrap-theme.min.css');
$document->addCss('css/jquery.bxslider.css');
$document->addCss('css/font-awesome.css');
$document->addCss('css/main.css');

$document->addJs('js/libs/jquery-1.11.3.min.js', 'TOP');
$document->addJs('js/libs/bootstrap.min.js', 'TOP');
$document->addJs('js/plugins/jquery.bxslider.js', 'TOP');
$document->addJs('js/process/main.js', 'TOP');
