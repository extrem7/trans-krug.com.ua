<? global $lang ?>
</main>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3 col-12">
                <div class="title-thin white"><? pll_e( 'Контактная информация' ) ?></div>
                <address><? the_field( 'адрес', $lang ) ?></address>
                <div class="contact-info">
                    <div class="d-flex align-items-start">
                        <span>Тел.:</span>
                        <div>
							<? while ( have_rows( 'телефоны', 'common' ) ):
								the_row();
								$phone = get_sub_field( 'телефон' );
								?>
                                <div><a href="<?= phoneLink( $phone ) ?>"><?= $phone ?></a></div>
							<? endwhile; ?>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <span>Email:</span>
                        <div>
							<?
							$mail = get_field( 'почта', 'common' );
							?>
                            <div><a href="mailto:<?= $mail ?>"><?= $mail ?></a></div>
                        </div>
                    </div>
                    <div class="media-block mt-4">
						<? while ( have_rows( 'соц_сети', 'common' ) ):the_row();
							$link  = get_sub_field( 'ссылка' );
							$class = get_sub_field( 'класс' );
							$color = get_sub_field( 'цвет' );
							?>
                            <a href="<?= $link ?>" style="background-color: <?= $color ?>" target="_blank"><i
                                        class="fab fa-<?= $class ?>"></i></a>
						<? endwhile; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-12">
                <div class="title-thin white"><? pll_e( 'Продукция' ) ?></div>
                <ul>
					<?
					$products = get_posts( [
						'post_type'      => 'product',
						'posts_per_page' => 5,
					] );
					foreach ( $products as $post ):
						?>
                        <li><a href="<? the_permalink() ?>"><? the_title() ?></a></li>
					<? endforeach;
					wp_reset_query(); ?>
                </ul>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-12">
                <div class="title-thin white"><? pll_e( 'Услуги' ) ?></div>
                <ul>
					<?
					$services = get_posts( [
						'post_type'      => 'service',
						'posts_per_page' => 5,
					] );
					foreach ( $services as $post ):
						?>
                        <li><a href="<? the_permalink() ?>"><? the_title() ?></a></li>
					<? endforeach;
					wp_reset_query(); ?>
                </ul>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3 col-12">
                <div class="title-thin white"><? pll_e( 'О нас' ) ?></div>
                <div><? the_field( 'о_нас', $lang ) ?></div>
            </div>
        </div>
        <div class="copyright"><? the_field( 'копирайт', $lang ) ?></div>
    </div>
</footer>
<? get_template_part( 'views/modals' ) ?>
<? wp_footer() ?>
<? the_field('метрики_в_футере','common') ?>
</body>
</html>