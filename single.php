<?php
/**
 * Template Name: News
 */
get_header();
$q = get_queried_object(); 
$f = get_fields(get_the_ID());
$cat = get_the_category(get_the_ID());
$cids = [];
foreach($cat as $c){
    array_push($cids, $c->term_id); 
}
$video = get_field('video');
$rendervideo = [];

    if (is_array($video) && count($video)> 0) { 
        foreach($video as $code){
            array_push($rendervideo,'</div>
            </div><div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
            <div class="news-detail-content__text">
            <div class="video-embed">
            <div class="video-embed__iframe-container">
                <iframe class="video-embed__iframe" width="560" height="315" src="https://www.youtube.com/embed/'.$code['cod'].'"></iframe>
            </div>
            </div>
            <div class="col-sm-20 offset-sm-2 col-md-10 offset-md-7">
            <div class="news-detail-content__text">'); 
        }
    }

?>
<body>
	<script>
	window.STATIC = true;

	window.labels = {
		select: "Seleziona",
		error_required: "Il campo &#232; obbligatorio",
		error_email: "Email non valida",
		error_match: "I campi non corrispondono",
		select_file: "Seleziona un file (fino a 15mb)",
	};

	</script>
	<?php get_template_part( 'templates/partials/shared/svg'); ?>
	<div class="app" app-component>
		<div class="page page--location">

			<?php get_template_part( 'templates/partials/shared/header'); ?>

			<!--<div class="wrapper">-->
			<main class="main">
				<?php  get_template_part( 'templates/partials/shared/breadcrumb' ); //the breadcrumb ?>


                <div class="news-detail-hero">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3 col-lg-11">
                                <div class="news-detail-hero__content" appear>
                                    <div class="news-detail-hero__title-small"><?=get_the_title()?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <section class="news-detail-content">
                    <div class="news-detail-content__row" appear>
                        <div class="news-detail-content__thumbnail" style="background-image:url(<?=esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>)"></div>
                    </div>
                    <div class="row news-detail-content__row" appear>
                        <div class="col-sm-20 offset-sm-2 col-md-10 offset-md-7">
                            <div class="news-detail-content__text">
                                <?php
                                $placed = []; 
                                $content = get_the_content_with_formatting(); 
                                foreach($rendervideo as $k => $v){
                                    if (strstr($content, '[insertVideo_')) {
                                        $content = str_replace('[insertVideo_'.$k.']', $v, $content);
                                        $placed[$k] = true;
                                    } else {
                                        $placed[$k] = false;
                                    }
                                }
                                echo $content;

                                foreach ($rendervideo as $k => $v) {
                                    if(!$placed[$k]){
                                        echo $v;
                                    }
                                }
                                

                                ?>
                            </div>
                        </div>
                    </div>


                <?php 
                $carousel = get_field('photogallery');
                if (is_array($carousel) && count($carousel)> 0) { 
                    
                    ?>
                    <div class="content-slider" appear>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-20 offset-sm-2 col-md-18 offset-md-3">
                                    <!-- swiper -->
                                    <div class="swiper-container" swiper-content>
                                        <div class="swiper-wrapper">
                                            <?php foreach($carousel as $slide){ 
                                                ?>
                                                <div class="swiper-slide">
                                                    <div class="card--content">
                                                        <img src="<?=$slide['image']['url']?>" />
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="content-slider__controls">
                                            <div class="content-slider__index"><span class="page" [innerHTML]="slideIndex"></span> of <span [innerHTML]="slideTotal"></span></div>
                                            <div class="content-slider__nav">
                                                <!-- prev button -->
                                                <button type="button" class="btn--prev">
                                                    <svg class="circle"><use xlink:href="#circle-dotted"></use></svg>
                                                    <svg class="caret"><use xlink:href="#caret-left"></use></svg>
                                                </button>
                                                <!-- next button -->
                                                <button type="button" class="btn--next">
                                                    <svg class="circle"><use xlink:href="#circle-dotted"></use></svg>
                                                    <svg class="caret"><use xlink:href="#caret-right"></use></svg>
                                                </button>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php }  ?>                    
                    
                    <div class="row news-detail-content__row" appear>
                        <div class="col-sm-20 offset-sm-2 col-md-10 offset-md-7">
                            <div class="news-detail-content__text">
                                <div class="share">
                                    <p class="share__text">
                                        Condividi
                                    </p>    
                                    <a class="share__link" href="#"><svg class="facebook"><use xlink:href="#facebook"></use></svg></a>
                                    <a class="share__link" href="#"><svg class="twitter"><use xlink:href="#twitter"></use></svg></a>
                                    <a class="share__link" href="#"><svg class="linkedin"><use xlink:href="#linkedin"></use></svg></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>                


                <?php 
                set_query_var( 'cids', $cids );
                get_template_part( 'templates/partials/homepage/news', 'proposition' ); ?>
			</main>
				<?php get_template_part( 'templates/partials/shared/footer'); ?>
			<!--</div>-->
			<?php get_template_part( 'templates/partials/shared/modal', 'outlet' ); ?>
		</div>
	</div>
	<?php wp_footer(); ?>
	<script src="<?=DOCS_DIR; ?>js/vendors.min.js"></script>
	<script src="<?=DOCS_DIR; ?>js/main.js"></script>

</body>

</html>