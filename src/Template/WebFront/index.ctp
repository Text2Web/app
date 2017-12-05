<?php if ($pageData->getLayout() === "tutorial"):?>
<div class="row flex-xl-nowrap">
    <?php if (count($pageData->getChapter()) != 0): ?>
    <div class="col-12 col-md-3 col-xl-2 bd-sidebar">
        <form class="bd-search d-flex align-items-center">
            <input type="search" class="form-control" id="search-input" placeholder="Search..." aria-label="Search for..." autocomplete="off">
            <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation">
                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg>

            </button>
        </form>
        <nav class="collapse bd-links" id="bd-docs-nav">
            <?= $this->Menu->getLeftMenu($pageData) ?>
        </nav>
    </div>
    <?php endif; ?>

    <main class="col-12 col-md-9 col-xl-10 py-md-3 pl-md-5 bd-content" role="main">
        <?php $this->UI->getPageContent($pageData)?>
    </main>
</div>
<?php endif;?>