<a href="<? the_permalink() ?>" class="card-video-gallery card-gallery col-md-6">
	<div class="card-video-banner mb-4">
		<div class="video-icon"><i class="fas fa-play-circle"></i></div>
		<div class="card-banner" style="background-image: url('<? the_post_thumbnail_url() ?>')"></div>
	</div>
	<div class="d-flex align-items-center justify-content-between">
		<div class="card-video-header">
			<div class="title-second"><? the_field( 'компания' ) ?></div>
			<div class="sub-title"><? the_field( 'объект' ) ?></div>
		</div>
	</div>
</a>