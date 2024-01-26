<?= get_header(); ?>


<main class="index-main">
    <style>
        .index-section-1{
            background: url(<?= CFS()->get('section_1_background') ?>) center/cover no-repeat;
            @media (max-width: 500px){
                background: url(<?= CFS()->get('section_1_background_mobile') ?>) center/cover no-repeat;
            }
        }
    </style>
    <section class="index-section-1">
        <div class="index-section-1-content-box container">
            <div class="index-section-1-content">
                <div class="header-box index-section-1-content__header-box">
                    <p class="header-box__title"><?= CFS()->get('section_1_sub_title'); ?></p>
                    <h2 class="header-box__main-title"><?= CFS()->get('section_1_main_title'); ?></h2>
                </div>
                <p class="index-section-1-content__text"><?= CFS()->get('section_1_text'); ?></p>
                <a href="#index-section-3" aria-label="<?= CFS()->get('section_1_button'); ?>" class="button"><?= CFS()->get('section_1_button'); ?></a>
            </div>
        </div>
    </section>
    <section id="index-section-2" class="index-section-2 container">
        <div class="index-section-2__header-box header-box">
            <p class="header-box__title"><?= CFS()->get('section_2_sub_title'); ?></p>
            <h2 class="header-box__main-title"><?= CFS()->get('section_2_main_title'); ?></h2>
        </div>
        <div class="diginity-box">
            <?php
                $cards = CFS()->get('section_2_cards');
                foreach($cards as $key => $card){
                    $cardObject = (object)$card;
                    ?>
            <div class="diginity <?= $key % 2 == 0 ? '' : 'diginity_reverse' ?> diginity-box__diginity">
                <img style="width: 400px; height: 250px" class="diginity__image" src="<?= $cardObject->card_image ?>" alt="logo">
                <div class="giginity-description">
                    <h3 class="giginity-description__title"><?= $cardObject->card_header ?> </h3>
                    <p class="giginity-description__text"><?= $cardObject->card_text ?></p>
                </div>
            </div>
            <?php
                }
                ?>
        </div>
        <div class="index-section-2__line"></div>
    </section>
    <section id="index-section-3" style="background:url(<?= CFS()->get('section_3_background'); ?>) center/cover no-repeat;"
        class="index-section-3 container">
        <div class="header-box index-section-3__header-box">
            <p class="header-box__title"><?= CFS()->get('section_3_sub_title'); ?></p>
            <h2 class="header-box__main-title"><?= CFS()->get('section_3_main_title'); ?></h2>
        </div>
        <form class="index-section-3-form" action="<?= esc_url( admin_url('admin-post.php') ); ?>" method="post">
            <input type="hidden" name="action" value="add_bid_action">
            <?php
                $formItems = CFS()->get('form_fields');
                foreach ($formItems as $formItem) {
                    $formItem = (object)$formItem;
                    ?>
                        <input class="index-section-3-form__item" type="text" name="<?= $formItem->field_name ?>" placeholder="<?= $formItem->field_text ?>">
                    <?php
                }
            
            ?>
            <button aria-label="<?= CFS()->get('section_3_button'); ?>" class="button index-section-3-form__button"><?= CFS()->get('section_3_button'); ?></button>
        </form>

        <div class="index-section-3__line"></div>
    </section>
    <section id="index-section-4" class="index-section-4 container">
        <div class="index-section-4-header-image-box">
            <div class="header-box index-section-4-header-image-box__header-box">
                <p class="header-box__title"><?= CFS()->get('section_4_sub_title'); ?></p>
                <h2 class="header-box__main-title"><?= CFS()->get('section_4_main_title'); ?></h2>
            </div>
            <img class="index-section-4-header-image-box__image" src="<?= CFS()->get('section_4_image'); ?>"
                alt="commets">
        </div>
        <div class="FAQ-box">
            <?php 
                $FAQ_items = CFS()->get('section_4_FAQ_items');
                foreach ($FAQ_items as $FAQ_item) {
                    $FAQ_item = (object)$FAQ_item;
                ?>
                    <div class="FAQ-item FAQ-box__item">
                        <div class="FAQ-item-visible">
                            <p class="FAQ-item-visible__title"><?= $FAQ_item->FAQ_questiion ?></p>
                            <div class="FAQ-item-visible__line"></div>
                            <div class="FAQ-item-visible__button arrow-button">
                                <img style="width: 15px; height: 16px" src="<?= get_template_directory_uri() . '/assets/img/arrow.svg' ?>"
                                class="arrow-button__image" alt="arrow">
                        </div>
                    </div>
                    <div class="FAQ-item-invisible">
                        <p class="FAQ-item-invisible__text"><?= $FAQ_item->FAQ_answer ?></p>
                    </div>
        </div>
            <?php
                }
            ?>
        </div>

        <div class="index-section-4__line"></div>
    </section>
</main>

<?= get_footer() ?>