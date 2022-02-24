<?php 
$p = get_post(get_the_ID());
$i = get_post_meta( get_the_ID(), 'ws-informative-rif-iubenda', true );
get_header();
print_r($p);
get_footer();