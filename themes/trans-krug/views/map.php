<? global $lang; ?>
<section class="map-section base-section <?=  get_page_template_slug() == 'pages/guarantee.php' ? 'blue-gradient decor-top-line-inside' : 'decor-both-line' ?>">
    <div class="container">
        <div class="title-main text-center wow slideInDown"><? pll_e( 'Карта расположения наших клиентов' ) ?></div>
        <div class="map">
            <div class="box-form blue-line">
                <div class="scrollbar-inner">
					<? while ( have_rows( 'клиент', 'map' ) ):the_row();
						$name = $lang == 'ru' ? get_sub_field( 'название' ) : get_sub_field( 'название_украинское' );
						?>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="client-<? the_row_index() ?>" <? checked( get_sub_field( 'по_умолчанию' ) ) ?>
                                       data-client="<?= get_row_index() - 1 ?>">
                                <label class="custom-control-label"
                                       for="client-<? the_row_index() ?>"><?= $name ?></label>
                            </div>
                        </div>
					<? endwhile; ?>
                </div>
            </div>
            <div id="map"></div>
        </div>
    </div>
</section>