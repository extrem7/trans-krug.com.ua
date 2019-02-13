<? global $lang ?>
<div class="modal fade" id="order">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-order">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body d-flex align-items-center flex-column">
                <form>
                    <div class="first-step">
                        <div class="title-main text-center"><? the_field( 'модалка_заголовок', $lang ) ?></div>
                        <div class="sub-title text-center"><? the_field( 'модалка_текст', $lang ) ?></div>
                        <div class="text-center checker title-main mb-4 nav justify-content-between" id="modal-tab">
                            <button class="button btn-bordered active" id="modal-tab1" data-toggle="tab" href="#product"
                                    aria-selected="true"><? pll_e( 'Продукция' ) ?>
                            </button>
                            <button class="button btn-bordered" id="modal-tab2" data-toggle="tab" href="#service"
                                    aria-selected="false"><? pll_e( 'Услуги' ) ?>
                            </button>
                        </div>
                        <div class="tab-content" id="nav-modalContent">
                            <div class="tab-pane fade show active" id="product">
								<?
								$products = get_posts( [
									'post_type'      => 'product',
									'posts_per_page' => - 1,
								] );
								for ( $i = 0; $i < count( $products ); $i ++ ):
									$post = $products[ $i ];
									?>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="product-<?= $i ?>" class="custom-control-input"
                                                   value="<? the_title() ?>">
                                            <label for="product-<?= $i ?>"
                                                   class="custom-control-label accept"><? the_title() ?></label>
                                        </div>
                                    </div>
								<? endfor;
								wp_reset_query(); ?>
                            </div>
                            <div class="tab-pane fade" id="service">
                                <div class="form-group">
									<?
									$services = get_posts( [
										'post_type'      => 'service',
										'posts_per_page' => - 1,
									] );
									for ( $i = 0; $i < count( $services ); $i ++ ):
										$post = $services[ $i ];
										?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" id="service-<?= $i ?>"
                                                       class="custom-control-input" value="<? the_title() ?>">
                                                <label for="service-<?= $i ?>"
                                                       class="custom-control-label accept"><? the_title() ?></label>
                                            </div>
                                        </div>
									<? endfor;
									wp_reset_query(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button id="next" class="button btn-bordered"><? pll_e( 'Следующий шаг' ) ?></button>
                        </div>
                    </div>
                    <div class="second-step" style="display: none;">
                        <div class="title-main text-center"><? the_field( 'модалка_заказ_заголовок', $lang ) ?></div>
                        <div class="order-block mb-4" style="display: none">
                            <div class="title-second"><? pll_e( 'Ваш заказ' ) ?>:</div>
                            <div class="order-list"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="control-form" placeholder="<? pll_e( 'Ваше имя' ) ?>">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="control-form" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input type="text" name="tel" class="control-form phone" required
                                   placeholder="+38 (___) ___-__-__">
                        </div>
	                    <? get_template_part( 'views/recaptcha' ); ?>
                        <div class="form-group text-center mt-4">
                            <button type="submit" class="button btn-bordered"><? pll_e( 'Отправить' ) ?></button>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button id="prev" class="button btn-bordered">Назад</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="thanks">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-order">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex align-items-center flex-column">
                <div class="title-main text-center"><? the_field( 'модалка_благодарость', $lang ) ?></div>
                <div><? the_field( 'модалка_благодарость_текст', $lang ) ?></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sorry">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-order">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex align-items-center flex-column">
                <div class="title-main text-center"><? pll_e( 'Ошибка обратной связи' ) ?></div>
                <div><? pll_e( 'Попробуйте отправить позже' ) ?></div>
            </div>
        </div>
    </div>
</div>