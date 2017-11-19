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
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('docs.min.css') ?>
    <?= $this->Html->css('font-awesome/font-awesome.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?= $this->Html->script('jquery-3.2.1.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
</head>


<body>
<section class="workstation-body">
    <div class="user-profile">
        <div class="user-info">
            <div class="user-profile-block  mb-2">
                <?= $this->Html->image('user.jpg', ['alt' => 'User', 'class' => 'img-thumbnail']) ?>
            </div>
            <div class="user-about">
                <h3 class=" mb-1">H.M. Touhid Mia</h3>
                <p class="sub-name  mb-2"><a href="#">hmtmcse</a></p>
                <p>There are many variations of passages of Lorem Ipsum available.</p>
                <hr>
            </div>
            <div class="user-contact">
                <ul class="lists">
                    <li class="lists-item"><i class="fa fa-map-marker" aria-hidden="true"></i>Rampura, Dhaka-1219</li>
                    <li class="lists-item"><i class="fa fa-link" aria-hidden="true"></i><a href="#">www.yourwebsite.com</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-area">
        <div class="col-md-12">
            <div class="search-part container-fluid">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputinput" aria-describedby="searchHelp" placeholder="Search Here">
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-6">
                        <p>Popular repositories</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p>Customize your pinned repositories</p>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="repository-boxs scrollable-area">
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="right-sidebar">
        <div class="repository-sidebar">
            <?= $this->Menu->getMenu() ?>
        </div>
    </div>
</section>
</body>
</html>
