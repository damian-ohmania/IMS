<!-- Modal Search
============================================= -->
<div id="modal-search" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>

        <a class="uk-navbar-item uk-flex-center uk-padding-remove" href="./index.php">
            <img class="uk-logo" src="" alt="" uk-img>
        </a>

        <div class="uk-margin">
            <?php get_search_form(); ?>
        </div>
    </div>
</div> <!-- #modal-search end -->