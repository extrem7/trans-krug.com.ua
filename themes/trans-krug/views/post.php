<? $color = is_front_page() ? 'white' : '' ?>
<div class="col-lg-3 col-md-6 col-sm-6 col-12 <?= $color ? 'wow zoomIn' : '' ?>" data-wow-delay="0.5s">
    <article class="news-item">
        <a href="<? the_permalink() ?>" class="d-block">
            <div class="news-banner" style="background-image: url('<? the_post_thumbnail_url() ?>')"></div>
            <div class="news-header">
                <div class="news-date <?= $color ?>"><? the_date( 'd F Y' ) ?></div>
                <div class="title-second <?= $color ?>"><? the_title() ?></div>
            </div>
            <div class="news-anons <?= $color ?>"><? the_excerpt() ?></div>
        </a>
    </article>
</div>