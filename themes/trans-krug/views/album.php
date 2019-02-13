<a href="<? the_permalink() ?>"
   class="card-photo-gallery card-gallery col-12 col-sm-6 col-md-4 col-lg-3">
	<div class="card-photo-banner mb-2">
		<div class="card-photo-counter"><?= count( get_field( 'галерея' ) ) ?></div>
		<div class="card-banner"
		     style="background-image: url('<? the_post_thumbnail_url() ?>')"></div>
	</div>
	<div class="d-flex align-items-center justify-content-between">
		<div class="card-photo-header">
			<div class="title-second"><? the_field( 'компания' ) ?></div>
			<div class="sub-title"><? the_field( 'объект' ) ?></div>
		</div>
		<i class="fas fa-angle-right"></i>
	</div>
</a>