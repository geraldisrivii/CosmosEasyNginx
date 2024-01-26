<?php

    add_action( 'admin_post_add_bid_action', 'process_custom_form' );
    add_action( 'admin_post_nopriv_add_bid_action', 'process_custom_form' );

    add_action('init', function () {
        register_post_type( 'bid', [
            'label'  => null,
            'labels' => [
                'name'               => 'Заявки', // основное название для типа записи
                'singular_name'      => 'Заявка', // название для одной записи этого типа
                'add_new'            => 'Добавить Заявку', // для добавления новой записи
                'add_new_item'       => 'Добавление Заявки', // заголовка у вновь создаваемой записи в админ-панели.
                'edit_item'          => 'Редактирование Заявки', // для редактирования типа записи
                'new_item'           => 'Новоя Заявка', // текст новой записи
                'view_item'          => 'Смотреть Заявку', // для просмотра записи этого типа.
                'search_items'       => 'Искать Заявку', // для поиска по этим типам записи
                'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
                'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
                'parent_item_colon'  => '', // для родителей (у древовидных типов)
                'menu_name'          => 'Заявки', // название меню
            ],
            'description'            => '',
            'public'                 => true,
            'show_in_menu'           => true, // показывать ли в меню админки
            'show_in_rest'        => null, // добавить в REST API. C WP 4.7
            'rest_base'           => null, // $post_type. C WP 4.7
            'menu_position'       => null,
            'menu_icon'           => null,
            'hierarchical'        => false,
            'supports'            => [ 'title'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'taxonomies'          => [],
            'has_archive'         => false,
            'rewrite'             => true,
            'query_var'           => true,
        ] );
    });
    
    function process_custom_form() {
        // Получите данные из формы
        require_once 'servises/Validator.php';

        $validator = new Validator($_POST);

        $validator->add_rules([
            'name' => '/[a-zA-ZА-Яа-яЁё]+/',
            'phone' => '/^\+?([0-9]-?.?)|\+?[0-9-?.?]+$/'
        ]);
        $result = $validator->get_result();

        if($validator->is_valid() == false){
            return do_action( 'add_bid_form_completed', 'error' );
        }

        ['name' => $name, 'phone' => $phone] = $result;

        $post_id = wp_insert_post([
            'post_title' => 'Заяка: ' . $name,
            'post_type' => 'bid',
            'post_status' => 'publish',
        ]);

        CFS()->save(['phone' => $phone], ['ID' => $post_id]);

        if($result != false){
            return do_action( 'add_bid_form_completed', 'ok' );
        }
        return do_action( 'add_bid_form_completed', 'error' );
    }

    add_action( 'add_bid_form_completed', 'add_bid_form_completed' );

    function add_bid_form_completed($status){
        setcookie('status', $status, time() + 3600, '/');
        header('Location: ' . home_url() );
    }


    add_action('wp_enqueue_scripts', 'add_styles_and_scripts');
    add_theme_support('custom-logo');
    function add_styles_and_scripts() {
        wp_enqueue_script('cookieLib' , get_template_directory_uri() . '/assets/js/cookieLib.js', false, null, 'footer');
        wp_enqueue_script('sweetAlert' , get_template_directory_uri() . '/assets/js/sweetAlert.js', false, null, 'footer');
        wp_enqueue_script('FAQitem' , get_template_directory_uri() . '/assets/js/FAQitem.js', array('cookieLib', 'sweetAlert'), null, 'footer');
        wp_enqueue_script('Gamburger',  get_template_directory_uri() . '/assets/js/Gamburger.js', array('cookieLib', 'sweetAlert'), null, 'footer');

        // styles

        wp_enqueue_style('fonts', get_template_directory_uri() . '/assets/css/fonts.css');
        wp_enqueue_style('main', get_stylesheet_uri());
    }
?>