<?
/* Template Name: Главная */
get_header();
global $lang;
?>
    <!--Section we use-->
    <section class="we-make-section base-section decor-both-line">
        <div class="container">
			<? $weUse = get_field( 'мы_используем' ); ?>
            <div class="title-main text-center wow slideInDown"
                 data-wow-delay="0.5s"><?= $weUse['заголовок'] ?></div>
            <div class="sub-title text-center wow slideInLeft"
                 data-wow-delay="0.5s"><?= $weUse['текст'] ?></div>
            <div class="category-md-container mt-5 mb-5">
                <div class="row category-list justify-content-center"
                     data-wow-delay="1.4s">
					<?
					$products = get_posts( [
						'post_type'      => 'product',
						'posts_per_page' => 5,

					] );
					$delay    = .4;
					foreach ( $products as $post ):
						$image = get_attached_file( get_post_thumbnail_id() );
						?>
                        <a href="<? the_permalink() ?>" class="col-md-4 col-sm-6 col-12 category-item wow zoomIn"
                           data-wow-delay="<?= $delay ?>s">
                            <figure>
								<?// the_post_thumbnail( null, [ 'class' => 'img-fluid center-block' ] ) ?>
                                <div class="img-fluid center-block">
									<? echo file_get_contents( $image ) ?>
                                </div>
                                <figcaption>
                                    <div class="title-second"><? the_title() ?></div>
                                    <p><? the_excerpt() ?></p>
                                </figcaption>
                            </figure>
                        </a>
						<? $delay += .2; endforeach;
					wp_reset_query(); ?>
                </div>
            </div>
        </div>
    </section>
    <!--Section company-->
    <section class="company-section base-section text-center d-flex align-items-center justify-content-end flex-column">
		<? $company = get_field( 'тов' ); ?>
        <div class="title-thin"><?= $company['заголовок'] ?></div>
        <div class="title-franklin"><?= $company['подзаголовок'] ?></div>
        <div><?= $company['текст'] ?></div>
    </section>
    <!--Section our services-->
    <section class="services-section base-section decor-both-line">
		<?
		$services = get_field( 'предлагаем_услуги' );
		?>
        <div class="container">
            <div class="title-main text-center wow slideInDown"
                 data-wow-delay="0.5s"><?= $services['заголовок'] ?></div>
            <div class="sub-title text-center wow slideInLeft" data-wow-delay="0.5s"><?= $services['текст'] ?></div>
            <div class="text-center mt-3 mb-4">
                <button class="button btn-bordered wow flipInX" data-wow-delay="1s" data-wow-duration="1.5s"
                        data-toggle="modal"
                        data-target="#order"><? pll_e( 'Отправить заказ' ) ?></button>
            </div>
            <div class="category-md-container mt-5">
                <div class="category-list sm-indent row justify-content-center">
					<?
					$services = get_posts( [
						'post_type'      => 'service',
						'posts_per_page' => 5,

					] );
					$delay    = 1;
					foreach ( $services as $post ):
						$image = get_attached_file( get_post_thumbnail_id() );
                        ?>
                        <a href="<? the_permalink() ?>"
                           class="col-lg-3 col-md-6 col-sm-6 col-12 category-item wow zoomIn"
                           data-wow-delay="<?= $delay ?>s">
                            <figure>
								<?// the_post_thumbnail( null, [ 'class' => 'img-fluid center-block' ] ) ?>
	                            <? echo file_get_contents( $image ) ?>
                                <figcaption class="title-second medium-size"><? the_title() ?></figcaption>
                            </figure>
                        </a>
						<?
						$delay += .2;
					endforeach;
					wp_reset_query(); ?>
                </div>
            </div>
        </div>
    </section>
    <!--Section last reviews-->
<? $Trans->views()->reviews() ?>
    <!--Section partners-->
    <section class="partners-section blue-gradient mt-1">
        <div class="container">
            <div class="owl-carousel owl-theme" id="partners">
				<?
				$partners = get_field( 'партнеры' );
				foreach ( $partners as $img ):
					?>
                    <div><img data-lazysrc="<?= $img['url'] ?>" class="img-fluid" alt="<?= $img['alt'] ?>"></div>
				<? endforeach; ?>
            </div>
        </div>
    </section>
    <!--Section map-->
<? $Trans->views()->map(); ?>
    <!--Section last news-->
    <section class="news-section base-section blue-gradient">
        <div class="container">
            <div class="title-main text-center white wow slideInDown"
                 data-wow-delay="0.5s"><? pll_e( 'Последние новости' ) ?></div>
            <div class="row news mt-5">
				<?
				$newsQuery = new WP_Query( [
					'posts_per_page' => 4,
				] );
				while ( $newsQuery->have_posts() ) {
					$newsQuery->the_post();
					get_template_part( 'views/post' );
				}
				wp_reset_query();
				?>
            </div>
            <div class="text-center mt-2">
                <a href="<?= get_term_link( pll_get_term( 1, $lang ) ) ?>" class="button btn-bordered-white wow flipInX"
                   data-wow-delay="1s"
                   data-wow-duration="2s"><? pll_e( 'Перейти в раздел новостей' ) ?></a>
            </div>
        </div>
    </section>
<? get_footer() ?>