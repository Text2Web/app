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

    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <div class="row">
        <div class="col-lg-12">
            <!-- hmtmcse.com top add -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-4219559396865537"
                 data-ad-slot="6737141894"></ins>
        </div>
    </div>

    <div class="d-none d-xl-block col-xl-2 bd-toc">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- hmtmcse.com Right -->
        <ins class="adsbygoogle"
             style="display:inline-block;width:300px;height:600px"
             data-ad-client="ca-pub-4219559396865537"
             data-ad-slot="6266368609"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>

    <main class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content" role="main">

    <?php if (count($pageData->getChapter()) != 0): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="share-section">
                <div class="fb-share-button"
                     data-href="<?= $pageURL ?>"
                     data-layout="button_count" data-size="small"
                     data-mobile-iframe="true"></div>

                <g:plus action="share"></g:plus>
                </div>
            </div>
        </div>
    <?php endif; ?>


        <?php $this->UI->getPageContent($pageData)?>

        <div class="row">
            <div class="col-lg-12">
                <!-- hmtmcse.com top add -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px"
                     data-ad-client="ca-pub-4219559396865537"
                     data-ad-slot="6737141894"></ins>
            </div>
        </div>

        <?php if (count($pageData->getChapter()) != 0): ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="comments-section">
                    <div class="fb-comments" data-width="100%" data-href="<?= $pageURL ?>" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <?php endif; ?>


    </main>
</div>
<?php endif;?>