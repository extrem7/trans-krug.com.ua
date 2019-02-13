<?php

class ThemeBase {
	public function __construct() {
		$this->themeSetup();
		$this->enqueueStyles();
		$this->enqueueScripts();
		$this->customHooks();
		//$this->registerWidgets();
		$this->registerNavMenus();
		add_action( 'plugins_loaded', function () {
			$this->ACF();
			$this->GPSI();
			$this->Polylang();
		} );

	}

	private function themeSetup() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'widgets' );
		show_admin_bar( false );
	}

	private function enqueueStyles() {
		add_action( 'wp_print_styles', function () {
			wp_register_style( 'main', path() . 'assets/css/main.css' );
			wp_enqueue_style( 'main' );
		} );
		add_action( 'admin_enqueue_scripts', function () {
			//wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/css/admin.css');
		} );
	}

	private function enqueueScripts() {
		add_action( 'wp_enqueue_scripts', function () {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', path() . 'assets/node_modules/jquery/dist/jquery.min.js' );
			wp_enqueue_script( 'jquery' );
			wp_register_script( 'popper', path() . 'assets/node_modules/popper.js/dist/umd/popper.min.js' );
			wp_enqueue_script( 'popper' );
			wp_register_script( 'bootstrap', path() . 'assets/node_modules/bootstrap/dist/js/bootstrap.min.js' );
			wp_enqueue_script( 'bootstrap' );
			wp_register_script( 'jquery.scrollbar', path() . 'assets/node_modules/jquery.scrollbar/jquery.scrollbar.min.js' );
			wp_enqueue_script( 'jquery.scrollbar' );
			wp_register_script( 'fancybox', path() . 'assets/node_modules/@fancyapps/fancybox/dist/jquery.fancybox.js' );
			wp_enqueue_script( 'fancybox' );
			wp_register_script( 'owl.carousel', path() . '/assets/node_modules/owl.carousel/dist/owl.carousel.min.js' );
			wp_enqueue_script( 'owl.carousel' );
			wp_register_script( 'mask', path() . 'assets/node_modules/jquery.inputmask/dist/jquery.inputmask.bundle.js' );
			wp_enqueue_script( 'mask' );
			wp_register_script( 'wow', path() . 'assets/node_modules/wowjs/dist/wow.min.js' );
			wp_enqueue_script( 'wow' );
			wp_register_script( 'main', path() . 'assets/js/main.js' );
			wp_enqueue_script( 'main' );
			if ( is_front_page() || in_array( get_page_template_slug(), [ 'pages/about.php','pages/guarantee.php' ] ) ) {
				$key = get_field( 'гугл_ключ', 'common' );
				wp_register_script( 'maps', "https://maps.googleapis.com/maps/api/js?key=$key#asyncload" );
				wp_enqueue_script( 'maps' );
			}
			wp_localize_script( 'main', 'AdminAjax',
				admin_url( 'admin-ajax.php' )
			);
		} );
		add_filter( 'clean_url', function ( $url ) {
			if ( strpos( $url, '#asyncload' ) === false ) {
				return $url;
			} else {
				return str_replace( '#asyncload', '', $url ) . "' async defer='defer";
			}
		}, 11, 1 );
	}

	private function customHooks() {
		add_action( 'admin_menu', function () {
			remove_menu_page( 'edit-comments.php' );
		} );

		add_action( 'navigation_markup_template', function ( $content ) {
			$content = str_replace( 'role="navigation"', '', $content );
			$content = preg_replace( '#<h2.*?>(.*?)<\/h2>#si', '', $content );

			return $content;
		} );

		add_filter( 'nav_menu_css_class', function ( $classes, $item ) {
			if ( in_array( 'current-menu-item', $classes ) ) {
				$classes[] = 'active ';
			}

			return $classes;
		}, 10, 2 );

		add_filter( 'body_class', function ( $classes ) {
			if ( ! is_archive() && ( in_array( get_post_type(), [
						'post',
						'service'
					] ) || in_array( get_page_template_slug(), [ 'pages/about.php', 'pages/guarantee.php' ] ) ) ) {
				$classes[] = 'no-padding-content';
			}

			return $classes;
		} );

		add_action( 'template_redirect', function () {
		} );

	}

	private function registerNavMenus() {
		add_action( 'after_setup_theme', function () {
			register_nav_menus( array(
				'header_menu' => 'Меню в шапке',
			) );
		} );

		if ( ! file_exists( plugin_dir_path( __FILE__ ) . '../includes/wp-bootstrap-navwalker.php' ) ) {
			return new WP_Error( 'wp-bootstrap-navwalker-missing', __( 'It appears the wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
		} else {
			require_once plugin_dir_path( __FILE__ ) . '../includes/wp-bootstrap-navwalker.php';
		}

	}

	private function ACF() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			$general = acf_add_options_page( [
				'page_title' => 'Общие',
				'menu_title' => 'Настройки',
				'capability' => 'edit_posts',
				'redirect'   => false,
				'position'   => 2,
				'icon_url'   => 'dashicons-admin-customizer',
				'menu_slug'  => 'settings_common',
				'post_id'    => 'common',
			] );
			acf_add_options_sub_page( [
				'page_title'  => 'Настройки темы',
				'menu_title'  => "Настройки темы",
				'menu_slug'   => 'settings_ru',
				'parent_slug' => $general['menu_slug'],
				'post_id'     => 'ru',
			] );
			acf_add_options_sub_page( [
				'page_title'  => 'Налаштування теми',
				'menu_title'  => 'Налаштування теми',
				'parent_slug' => $general['menu_slug'],
				'menu_slug'   => 'settings_uk',
				'post_id'     => 'uk',
			] );
			acf_add_options_sub_page( [
				'page_title'  => 'Карта',
				'menu_title'  => 'Карта',
				'parent_slug' => $general['menu_slug'],
				'menu_slug'   => 'settings_map',
				'post_id'     => 'map',
			] );
		}
	}

	private function GPSI() {
		add_action( 'after_setup_theme', function () {
			remove_action( 'wp_head', 'wp_print_scripts' );
			remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
			remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
			add_action( 'wp_footer', 'wp_print_scripts', 5 );
			add_action( 'wp_footer', 'wp_enqueue_scripts', 5 );
			add_action( 'wp_footer', 'wp_print_head_scripts', 5 );
		} );

		add_action( 'after_setup_theme', function () {
			remove_action( 'wp_head', 'wp_generator' );                // #1
			remove_action( 'wp_head', 'wlwmanifest_link' );            // #2
			remove_action( 'wp_head', 'rsd_link' );                    // #3
			remove_action( 'wp_head', 'wp_shortlink_wp_head' );        // #4
			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );    // #5
			add_filter( 'the_generator', '__return_false' );            // #6
			add_filter( 'show_admin_bar', '__return_false' );            // #7
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );  // #8
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
		} );

		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	}

	private function Polylang() {
		global $lang;
		$lang = pll_current_language( 'slug' );

		add_action( 'init', function () {
			pll_register_string( 'Портфолио работ', 'Портфолио работ' );
			pll_register_string( 'Видеогалерея', 'Видеогалерея' );
			pll_register_string( 'Карта', 'Карта расположения наших клиентов' );
			pll_register_string( 'Обратная связь', 'Обратная связь' );
			pll_register_string( 'Вопросы', 'У вас к нам есть вопросы или предложения, <br>тогда напишите нам' );
			pll_register_string( 'Ваше имя', 'Ваше имя' );
			pll_register_string( 'Ваше сообщение', 'Ваше сообщение' );
			pll_register_string( 'Отправить', 'Отправить' );
			pll_register_string( 'Следующий шаг', 'Следующий шаг' );
			pll_register_string( 'Продукция', 'Продукция' );
			pll_register_string( 'Услуги', 'Услуги' );
			pll_register_string( 'Ваш заказ', 'Ваш заказ' );
			pll_register_string( 'Ошибка обратной связи', 'Ошибка обратной связи' );
			pll_register_string( 'Попробуйте отправить позже', 'Попробуйте отправить позже' );
			pll_register_string( 'Отзывы наших клиентов', 'Отзывы наших клиентов' );

			pll_register_string( 'Заявка', 'Заявка на изготовление продукции' );
			pll_register_string( 'Отправить заказ', 'Отправить заказ' );
			pll_register_string( 'Скан', 'Посмотреть копию-скан отзыва' );
			pll_register_string( '404', 'Запрашиваемая вами страница не найдена.' );
			pll_register_string( 'Наши награды', 'Наши награды' );
			pll_register_string( 'Последние новости', 'Последние новости' );
			pll_register_string( 'Перейти в раздел новостей', 'Перейти в раздел новостей' );
			pll_register_string( 'Телефоны', 'Телефоны' );
			pll_register_string( 'Адрес', 'Адрес' );
			//footer
			pll_register_string( 'Контактная информация', 'Контактная информация' );
			pll_register_string( 'Продукция', 'Продукция' );
			pll_register_string( 'Услуги', 'Услуги' );
			pll_register_string( 'О нас', 'О нас' );
		} );
	}

	private function postTypePermalink() {
		add_filter( 'post_type_link', function ( $post_link, $post ) {
			if ( 'car' === $post->post_type && 'publish' === $post->post_status ) {
				$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
			}

			return $post_link;
		}, 10, 2 );
		add_action( 'pre_get_posts', function ( $query ) {
			if ( ! $query->is_main_query() ) {
				return;
			}
			if ( ! isset( $query->query['page'] ) || 2 !== count( $query->query ) ) {
				return;
			}
			if ( empty( $query->query['name'] ) ) {
				return;
			}
			$query->set( 'post_type', array( 'post', 'page', 'car' ) );
		} );
	}

	private function registerWidgets() {
		add_action( 'widgets_init', function () {
			register_sidebar( [
				'name'         => "Правая боковая панель сайта",
				'id'           => 'right-sidebar',
				'description'  => 'Эти виджеты будут показаны в правой колонке сайта',
				'before_title' => '<h1>',
				'after_title'  => '</h1>'
			] );
		} );
	}
}