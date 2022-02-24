<?php
namespace Roots\WStheme\Wpml;

/*---------------------------------------------------
WPML - Translate strings
--------------------------------------------------*/
function lang($stringToTranslate, $echo) {
    if ($echo) {
        return _e($stringToTranslate, 'WStheme');
    } else {
        return __($stringToTranslate, 'WStheme');
    }
}


/*---------------------------------------------------
Language Selector
--------------------------------------------------*/
function language_selector(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        foreach($languages as $l){
            if(!$l['active']){
                echo '<a href="'.$l['url'].'">' . $l['translated_name'] . '</a>';
            }
        }
    }
}


function getUserIP() {
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
	    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	    $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif(filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } elseif(in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1' ))) {
        $ip = '127.0.0.1';
	} else {
        $ip = $remote;
    }

    return $ip;
}


/*--------------------------------------------------
IP redirection
--------------------------------------------------*/
function ipRedir() {

    global $sitepress;
    global $pagesID;


    if ($pagesID->hostUrl == $pagesID->productionUrl) {
        $ip = getUserIP();
    }
    if($ip == '127.0.0.1') return;

	if($_SERVER['REDIRECT_URL'] == '') {
        $url = 'http://geoip.websolute.it/ip2location/get_info.aspx?ipaddress=' . $ip;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $sessionResult = simplexml_load_string($result);
        $nazione = $sessionResult->CountryCode;
        if($nazione == 'SM') $nazione = 'IT';
        if(trim($nazione) == '-') $nazione = 'IT';

        $redir = ($nazione!='IT'?"en":"it");

        if($_SERVER['REQUEST_URI'] != '/wp-login.php') {

            if(!strstr($_SERVER['REQUEST_URI'],'wp-admin')) {

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: /".$redir."/");
	            exit();
            }
	    }
    }
}

//add_action( 'init',  __NAMESPACE__ . '\\ipRedir', 5); //togli il commento per attivare il redirect

function not_found_redirect($redirect_url, $requested_url) {
    if(in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1' )) && strpos($redirect_url, $_SERVER['SERVER_PORT']) === false) {
        return $requested_url;
    }
    return $redirect_url;
}
add_filter('redirect_canonical', __NAMESPACE__ . '\\not_found_redirect', 10, 2);


/*--------------------------------------------------
Translating String through ACF and WPML
--------------------------------------------------*/

//function translateString($var){
//    if( have_rows('translation_string', 'option') ){
//        while( have_rows('translation_string', 'option') ):
//            the_row();
//            $varToTrans = get_sub_field('var');
//            if ($varToTrans == $var) {
//                $stringToTrans = get_sub_field('label');
//                if (!($stringToTrans)){
//                    //al momento WPML non permette di accedere alla variabile dell'altra lingua, da sistemare.
//                    if (ICL_LANGUAGE_CODE=='it'){
//                        echo 'da tradurre';
//                    } else {
//                        echo 'translate';
//                    }
//                } else {
//                    echo $stringToTrans;
//                }
//            }
//        endwhile;
//    }
//}


/*--------------------------------------------------
Get Translating String through ACF and WPML
--------------------------------------------------*/

//function getTranslateString($var){
//    if( have_rows('translation_string', 'option') ){
//        while( have_rows('translation_string', 'option') ):
//            the_row();
//            $varToTrans = get_sub_field('var');
//            if ($varToTrans == $var) {
//                $stringToTrans = get_sub_field('label');
//                return $stringToTrans;
//            }
//        endwhile;
//    }
//}
?>
