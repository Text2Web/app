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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <?= $this->Html->script('popper.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
</head>


<body>
<div class="container-fluid">
    <div class="row flex-xl-nowrap">
        <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
<!--            <form class="bd-search d-flex align-items-center">-->
<!--                <input type="search" class="form-control" id="search-input" placeholder="Search..." aria-label="Search for..." autocomplete="off">-->
<!--                <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg>-->
<!--                </button>-->
<!--            </form>-->

            <nav class="collapse bd-links" id="bd-docs-nav">
                <div class="bd-toc-item active">
                    <ul class="nav bd-sidenav">
                        <li>
                            <a href="/docs/4.0/getting-started/introduction/">Introduction</a>
                        </li>
                    </ul>
                </div>
                <div class="bd-toc-item active">
                    <a class="bd-toc-link" href="/docs/4.0/getting-started/introduction/">
                        Getting started
                    </a>
                    <ul class="nav bd-sidenav">
                        <li>
                            <a href="/docs/4.0/getting-started/introduction/">Introduction</a>
                        </li>
                    </ul>
                </div>


                <div class="bd-toc-item active">
                    <ul class="nav bd-sidenav">
                        <li>
                            <a href="/docs/4.0/getting-started/introduction/">Introduction</a>
                        </li>
                    </ul>
                </div>
                <div class="bd-toc-item active">
                    <ul class="nav bd-sidenav">
                        <li>
                            <a href="/docs/4.0/getting-started/introduction/">Introduction</a>
                        </li>
                    </ul>
                </div>
                <div class="bd-toc-item active">
                    <ul class="nav bd-sidenav">
                        <li>
                            <a href="/docs/4.0/getting-started/introduction/">Introduction</a>
                        </li>
                    </ul>
                </div>
                <div class="bd-toc-item active">
                    <ul class="nav bd-sidenav">
                        <li>
                            <a href="/docs/4.0/getting-started/introduction/">Introduction</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>


        <div class="d-none d-xl-block col-xl-2 bd-toc">
            <ul class="section-nav">
                <li class="toc-entry toc-h2"><a href="#quick-start">Quick start</a>
                    <ul>
                        <li class="toc-entry toc-h3"><a href="#css">CSS</a></li>
                        <li class="toc-entry toc-h3"><a href="#js">JS</a></li>
                    </ul>
                </li>
                <li class="toc-entry toc-h2"><a href="#starter-template">Starter template</a></li>
                <li class="toc-entry toc-h2"><a href="#important-globals">Important globals</a>
                    <ul>
                        <li class="toc-entry toc-h3"><a href="#html5-doctype">HTML5 doctype</a></li>
                        <li class="toc-entry toc-h3"><a href="#responsive-meta-tag">Responsive meta tag</a></li>
                        <li class="toc-entry toc-h3"><a href="#box-sizing">Box-sizing</a></li>
                        <li class="toc-entry toc-h3"><a href="#reboot">Reboot</a></li>
                    </ul>
                </li>
                <li class="toc-entry toc-h2"><a href="#community">Community</a></li>
            </ul>
        </div>


        <main class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content" role="main">
            <h1 class="bd-title" id="content">Introduction</h1>
            <p class="bd-lead">Get started with Bootstrap, the world's most popular framework for building responsive, mobile-first sites, with the Bootstrap CDN and a template starter page.</p>
        </main>


    </div>
</div>
</body>
</html>
