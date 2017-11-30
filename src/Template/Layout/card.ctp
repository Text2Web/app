<?php
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
    <?= $this->Html->css('/font-awesome/css/font-awesome.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?= $this->Html->script('jquery-3.2.1.min.js') ?>
    <?= $this->Html->script('popper.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
</head>


<body>
<section class="workstation-body">
    <div class="user-profile">

        <div class="card">
            <?= $this->Html->image('hmtmcse.jpg', ['alt' => 'hmtmcse', 'class' => 'card-img-top', 'url' => '/']) ?>
            <div class="card-body text-center">
                <h4 class="card-title">H.M.Touhid Mia (HMTMCSE)</h4>
                <span class="card-subtitle text-muted">Manager System & Research <br> Bit Mascot Pvt. Ltd.</span>
            </div>
            <div class="card-body text-center">
                <a href="https://www.facebook.com/hmtmcsecom" class="card-link"><i class="fa  fa-facebook-official fa-lg"></i></a>
                <a href="https://plus.google.com/communities/104475733572137131423" class="card-link"><i class="fa  fa-google-plus-official fa-lg"></i></a>
                <a href="https://www.linkedin.com/in/hmtmcse/" class="card-link"><i class="fa fa-linkedin fa-lg"></i></a>
                <a href="https://github.com/hmtmcse" class="card-link"><i class="fa fa-github fa-lg"></i></a>
                <a href="https://www.youtube.com/channel/UCdm33qs7-m6n5Bw5gyFvuPQ" class="card-link"><i class="fa fa-youtube fa-lg"></i></a>
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
            </div>
            <div class="container-fluid">
                <div class="card-columns">
                    <?= $this->Menu->getHomeMenu() ?>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
