<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'HMTMCSE';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= isset($title) ? $title : "...::: HMTMCSE :::..." ?>
    </title>
    <meta name="description" content="<?= isset($metaDescription) ? $metaDescription : "" ?>"/>
    <meta name="keyword" content="<?= isset($keyword) ? $keyword : "" ?>"/>
    <link rel="canonical" href="<?= isset($canonicalName) ? $canonicalName : "" ?>" />

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('docs.min.css') ?>
    <?= $this->Html->css('font-awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->css('/prettify/prettify.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?= $this->Html->script('jquery-3.2.1.min.js') ?>
    <?= $this->Html->script('popper.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('/prettify/prettify.js') ?>
</head>


<body onload="PR.prettyPrint()">

<a id="skippy" class="sr-only sr-only-focusable" href="#content">
    <div class="container">
        <span class="skiplink-text">Skip to main content</span>
    </div>
</a>

<header class="navbar navbar-expand navbar-dark flex-column flex-md-row bd-navbar">
    <a class="navbar-brand mr-0 mr-md-2" href="<?= $this->Url->build('/') ?>" >
        HMTMCSE
    </a>

    <div class="navbar-nav-scroll">
        <?= $this->Menu->getTopNavItem() ?>
    </div>

</header>


<div class="container-fluid">
    <?= $this->fetch('content') ?>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=193886847837547';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>

</div>
</body>
</html>
