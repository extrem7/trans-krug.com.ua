<?
/* Template Name: Контакты */
get_header();
global $lang;
?>
    <div class="container wow zoomIn" data-wow-duration="2s">
        <div class="title-main text-center"><? the_title() ?></div>
        <div class="contact-container">
            <div class="contact-block">
                <img src="<?= path() ?>assets/img/icons/mail.svg" alt="">
                <div class="title-second">E-mail</div>
				<?
				$mail = get_field( 'почта', 'common' );
				?>
                <div><a href="mailto:<?= $mail ?>"><?= $mail ?></a></div>
            </div>
            <div class="contact-block">
                <img src="<?= path() ?>assets/img/icons/phone.svg" alt="">
                <div class="title-second"><? pll_e('Телефоны') ?></div>
                <div>
					<? while ( have_rows( 'телефоны', 'common' ) ):
						the_row();
						$phone = get_sub_field( 'телефон' );
						?>
                        <a href="<?= phoneLink( $phone ) ?>"><?= $phone ?></a>
					<? endwhile; ?>
                </div>
            </div>
            <address class="contact-block">
                <img src="<?= path() ?>assets/img/icons/marker.svg" alt="">
                <div class="title-second"><? pll_e('Адрес') ?></div>
                <div><? the_field( 'адрес', $lang ) ?></div>
            </address>
        </div>
        <div class="row decor-line">
            <div class="col-md-12 col-lg-7 col-xl-7 map-contact"><?= get_post_field( 'post_content', $id ); ?></div>
            <div class="col-md-12 col-lg-5 col-xl-5">
                <div class="contact-form">
                    <div class="title-main text-center"><? pll_e( 'Обратная связь' ) ?></div>
                    <div class="sub-title text-center mb-3"><? pll_e( 'У вас к нам есть вопросы или предложения, <br>тогда напишите нам' ) ?></div>
                    <form>
                        <div class="form-group">
                            <input type="tel" name="email" class="control-form" placeholder="E-mail"
                                   required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="control-form" placeholder="<? pll_e( 'Ваше имя' ) ?>">
                        </div>
                        <div class="form-group">
                            <textarea class="control-form" name="message" placeholder="<? pll_e( 'Ваше сообщение' ) ?>"
                                      rows="4"></textarea>
                        </div>
						<? get_template_part( 'views/recaptcha' ); ?>
                        <div class="form-group text-center">
                            <button class="button btn-bordered"><? pll_e( 'Отправить' ) ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<? get_footer() ?>