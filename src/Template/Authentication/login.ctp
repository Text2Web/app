<div class="row">
    <div class="col-md-12">
        <div id="global-wrapper">
            <div id="content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-4 mx-auto">
                            <h1 class="text-center login-title">Login Here</h1>
                            <div class="account-wall">
                                <?= $this->Html->image('logo.png', ['alt' => 'hmtmcse', 'class' => 'profile-img', 'url' => '/']) ?>
                                <form action="<?= $this->Url->build(['controller' => 'Authentication', 'action' => 'doLogin'])?>" method="post" class="form-signin">
                                    <input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    <button class="btn btn-lg btn-primary btn-block" name="doLogin" type="submit">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>