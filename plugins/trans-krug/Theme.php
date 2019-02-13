<?php
require_once "classes/ThemeBase.php";

class Theme extends ThemeBase {

	public function __construct() {
		parent::__construct();
		add_action( 'init', function () {
			$this->registerTaxonomies();
			$this->registerPostTypes();
			//$this->rewriteUrl();
		} );
		add_action( 'plugins_loaded', function () {
			$this->mapData();
		} );

		add_action( 'wp_ajax_mail', [ $this, 'mail' ] );
		add_action( 'wp_ajax_nopriv_mail', [ $this, 'mail' ] );
	}

	private function registerTaxonomies() {
		register_taxonomy( 'gallery_cat', [ 'gallery' ],
			[
				'label'              => 'gallery_cat',
				'labels'             => [
					'name'              => 'Категория',
					'singular_name'     => 'Категория',
					'search_items'      => 'Искать Категорию',
					'all_items'         => 'Новая Категория',
					'view_item '        => 'Смотреть Категорию',
					'parent_item'       => 'Родитель Категории',
					'parent_item_colon' => 'Родитель Категории:',
					'edit_item'         => 'Редактировать категорию',
					'update_item'       => 'Обновить Категорию',
					'add_new_item'      => 'Добавить новую категорию',
					'new_item_name'     => 'Категории',
					'menu_name'         => 'Категории',
				],
				'public'             => true,
				'publicly_queryable' => false,
				'hierarchical'       => true,
				'show_admin_column'  => true,
			] );

	}

	private function registerPostTypes() {
		register_post_type( 'product', [
			'labels'        => [
				'name'               => pll__( 'Продукция' ),
				'singular_name'      => 'Продукт',
				'add_new'            => 'Добавить продукт',
				'add_new_item'       => 'Добавление продукта',
				'edit_item'          => 'Редактирование продукта',
				'new_item'           => '',
				'view_item'          => 'Смотреть продукт',
				'search_items'       => 'Искать продукт',
				'not_found'          => 'Не найдено',
				'not_found_in_trash' => 'Не найдено в корзине',
				'menu_name'          => pll__( 'Продукция' ),
			],
			'public'        => true,
			'menu_position' => 5,
			'menu_icon'     => 'dashicons-products',
			'supports'      => [ 'title', 'editor', 'custom-fields', 'excerpt', 'thumbnail' ],
			'has_archive'   => true,
		] );
		register_post_type( 'service', [
			'labels'        => [
				'name'               => pll__( 'Услуги' ),
				'singular_name'      => 'Услуга',
				'add_new'            => 'Добавить услугу',
				'add_new_item'       => 'Добавление услуги',
				'edit_item'          => 'Редактирование услуг',
				'new_item'           => '',
				'view_item'          => 'Смотреть услугу',
				'search_items'       => 'Искать услугу',
				'not_found'          => 'Не найдено',
				'not_found_in_trash' => 'Не найдено в корзине',
				'menu_name'          => pll__( 'Услуги' ),
			],
			'public'        => true,
			'menu_position' => 6,
			'menu_icon'     => 'dashicons-hammer',
			'supports'      => [ 'title', 'editor', 'custom-fields', 'thumbnail' ],
			'has_archive'   => true,
		] );
		register_post_type( 'gallery', [
			'labels'        => [
				'name'               => 'Фотогалерея',
				'singular_name'      => 'Альбом',
				'add_new'            => 'Добавить альбом',
				'add_new_item'       => 'Добавление альбома',
				'edit_item'          => 'Редактирование альбома',
				'new_item'           => '',
				'view_item'          => 'Смотреть альбом',
				'search_items'       => 'Искать альбом',
				'not_found'          => 'Не найдено',
				'not_found_in_trash' => 'Не найдено в корзине',
				'menu_name'          => 'Фотогалерея',
			],
			'public'        => true,
			'menu_position' => 7,
			'menu_icon'     => 'dashicons-images-alt2',
			'supports'      => [ 'title', 'editor', 'custom-fields', 'thumbnail' ],
			'has_archive'   => true,
		] );
		register_post_type( 'video', [
			'labels'        => [
				'name'               => pll__( 'Видеогалерея' ),
				'singular_name'      => 'Видео',
				'add_new'            => 'Добавить видео',
				'add_new_item'       => 'Добавление видео',
				'edit_item'          => 'Редактирование видео',
				'new_item'           => '',
				'view_item'          => 'Смотреть видео',
				'search_items'       => 'Искать видео',
				'not_found'          => 'Не найдено',
				'not_found_in_trash' => 'Не найдено в корзине',
				'menu_name'          => pll__( 'Видеогалерея' ),
			],
			'public'        => true,
			'menu_position' => 8,
			'menu_icon'     => 'dashicons-format-video',
			'supports'      => [ 'title', 'editor', 'custom-fields', 'thumbnail' ],
			'has_archive'   => true,
		] );
	}

	private function mapData() {
		add_action( 'wp_enqueue_scripts', function () {
			wp_localize_script( 'main', 'MapData',
				get_field( 'клиент', 'map' )
			);
		} );
	}

	public function mail() {
		date_default_timezone_set( 'Europe/Kiev' );

		$headers = "From: TransKrug<admin@" . $_SERVER['SERVER_NAME'] . ">\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";

		$fields = [];

		$phone   = null;
		$email   = null;
		$subject = null;

		if ( isset( $_POST['subject'] ) && $_POST['subject'] ) {
			$subject = $_POST['subject'];
		}

		$fields['Дата заполнения']  = date( 'd.m.Y' );
		$fields['Время заполнения'] = date( 'G:i' );
		if ( isset( $_POST['name'] ) && $_POST['name'] ) {
			$fields['Имя клиента'] = $_POST['name'];
		}
		if ( isset( $_POST['tel'] ) && $_POST['tel'] ) {
			$fields['Телефон клиента'] = $_POST['tel'];
		}

		if ( isset( $_POST['email'] ) && $_POST['email'] ) {
			$fields['Email клиента'] = $_POST['email'];
		}
		if ( isset( $_POST['message'] ) && $_POST['message'] ) {
			$fields['Сообщение'] = $_POST['message'];
		}
		if ( isset( $_POST['products'] ) && ! empty( $_POST['products'] ) ) {
			$products        = $_POST['products'];
			$fields['Заказ'] = "<br>";
			foreach ( $products as $item ) {
				$fields['Заказ'] .= "$item<br>";
			}
		}

		$message = "<html><head></head><body>";
		foreach ( $fields as $key => $field ) {
			$message .= "$key : $field<br>";
		}
		$message .= "<br><p>Данное сообщение сгенерировано автоматически. Пожалуйста, не отвечайте на него.</p>";
		$message .= "</body></html>";

		$mail = mail( get_field( 'почта_заявок', 'common' ), $subject, $message, $headers );

		if ( $mail ) {
			echo json_encode( [ 'status' => 'ok' ] );
		} else {
			echo json_encode( [ 'status' => 'error' ] );
		}
		exit;
	}

	public function views() {
		return new class {
			public function map() {
				get_template_part( 'views/map' );
			}

			public function feedback() {
				get_template_part( 'views/feedback' );
			}

			public function reviews() {
				get_template_part( 'views/reviews' );
			}
		};
	}

	public function albums( $term ) {
		return get_posts( [
			'post_type'      => 'gallery',
			'posts_per_page' => - 1,
			'tax_query'      => [
				[
					'taxonomy' => 'gallery_cat',
					'field'    => 'id',
					'terms'    => [ $term ],
				]
			]
		] );
	}

	private function rewriteUrl() {
		add_filter( 'post_type_link', function ( $post_link, $post, $leavename ) {

			if ( 'product' != $post->post_type && 'service' != $post->post_type || 'publish' != $post->post_status ) {
				return $post_link;
			}

			$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );

			return $post_link;
		}, 10, 3 );


		add_action( 'pre_get_posts', function ( $query ) {

			if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
				return;
			}

			if ( ! empty( $query->query['name'] ) ) {
				$query->set( 'post_type', [ 'post', 'service', 'product', 'page' ] );
			}
		} );
	}

}