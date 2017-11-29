<?php if ($pageData->getLayout() === "default"):?>
<div class="row">
    <?= $this->Menu->getThumbMenu($pageData) ?>
</div>
<?php else :?>
    <div class="row flex-xl-nowrap">
    <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
        <form class="bd-search d-flex align-items-center">
            <input type="search" class="form-control" id="search-input" placeholder="Search..." aria-label="Search for..." autocomplete="off">
            <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation">
                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg>

            </button>
        </form>
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
        </nav>
    </div>
    <main class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content" role="main">
        <h1 class="bd-title" id="content">Introduction</h1>
        <p class="bd-lead">Get started with Bootstrap, the world's most popular framework for building responsive, mobile-first sites, with the Bootstrap CDN and a template starter page.</p>
    </main>
</div>
<?php endif;?>