<? global $lang ?>
<section class="blue-gradient box-feedback decor-top-line-inside">
    <div class="container">
        <div class="title-main text-center white wow slideInDown"
             data-wow-delay="0.5s"><? pll_e( 'Заявка на изготовление продукции' ) ?></div>
        <div class="sub-title white text-center"><? the_field( 'отправьте_заявку', $lang ) ?></div>
        <div class="text-center mt-3">
            <button class="button btn-bordered-white wow flipInX" data-wow-delay="2s" data-toggle="modal"
                    data-target="#order"><? pll_e( 'Отправить заказ' ) ?></button>
        </div>
    </div>
</section>