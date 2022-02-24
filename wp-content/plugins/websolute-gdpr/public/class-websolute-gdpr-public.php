<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.websolute.com
 * @since      1.0.0
 *
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/public
 * @author     Alessandro Lambertini <alambertini@websolute.it>
 */
class Websolute_Gdpr_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->match = 'gdpr';
        $this->IubendaObject = null;

	}

	public function GUID()
	{
	    if (function_exists('com_create_guid') === true)
	    {
	        return trim(com_create_guid(), '{}');
	    }

	    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	public function informative_render() {
	    global $wp;
	    $plugindir = dirname( __FILE__ );
	        $templatefilename = 'single-informative.php';
	        if (file_exists(TEMPLATEPATH . '/' . $templatefilename)) {
	            $return_template = TEMPLATEPATH . '/' . $templatefilename;
	        } else {
	            $return_template = $plugindir . '\templates\\' . $templatefilename;
	        }
	        $this->do_theme_redirect($return_template);
	}


	public function getCssFromKey($k, $searchMasked = false){
		global $wpdb;
		$output = '';
		if($k != '') {
			//echo "SELECT field_options FROM ".$wpdb->prefix."frm_fields WHERE field_key = '".$k."'"; die();


				$i = $wpdb->get_row("SELECT field_options FROM ".$wpdb->prefix."frm_fields WHERE field_key = '".$k."'");
				$o = unserialize($i->field_options);
				if(trim($o['classes']) != ''){
					$is = explode(' ', $o['classes']);
					foreach($is as $single){
						if(!$searchMasked){
							if(strstr($single, $this->match)) return $single;
						}else{
							if(strstr($single, 'masked')) return true;
						}
					}
				}
		}
		return $output;
	}

	public function iubSubject($var){

		// $match = 'gdpr';



		$output = [];
		$output['email'] = null;
		$output['first_name'] = null;
		$output['last_name'] = null;
		foreach($var['item_values'] as $k => $v){
			$opt = $this->getCssFromKey($v['key']);

			if(trim($opt) != ''){
				$s = explode('__', $opt);
				$sd = explode('-', $s[0]);
				switch($sd[0]){
					case $this->match:
						switch($sd[1]){
							case 'sub':
								$output[$s[1]] = $v['value'];
                                break;
						}
                        break;
				}
			}
		}

		$output['id'] = $output['email'] != null ? md5($output['email']) : '';

        //print_r($output); die();

		return json_decode(json_encode($output));

	}


	public function iubSubjectCF7($form, $pData){

        preg_match_all("/\[([^\]]*)\]/", $form, $matches);
        $values = [];
		$output = [];
        foreach($matches[1] as $str){
            if(strstr($str,'class:gdpr')){
                $pts = explode(' ',$str);
                $values[$pts[1]] = str_replace('class:gdpr-','',$pts[2]);
            }
        }

        foreach($values as $k => $v){
            $s = explode('__', $v);
                switch($s[0]){
                    case 'sub':
                        $output[$s[1]] = $pData[$k];
                        break;
                }
        }

		$output['id'] = $output['email'] != null ? md5($output['email']) : '';
		return json_decode(json_encode($output));
	}

	private function valid_field($string) {
		$string = strtolower($string);
		return ($string !== "false" && $string !== "0" && $string !== "no" && $string != '');
	}

	public function iubPreferences($var, $type = 'ff', $form = null){

		$output = [];
        switch($type){
            case 'ff':
				//$e = FrmEntry::getOne($_POST["item_key"], true);
				//error_log(print_r($e, true));
                foreach($var as $k => $v){
                    $opt = $this->getCssFromKey($v['key']);
                    if(trim($opt) != ''){
                        $s = explode('__', $opt);
                        $sd = explode('-', $s[0]);
                        switch($sd[0]){
                            case $this->match:
                                switch($sd[1]){
                                    case 'pref':
										if(class_exists('SitePress')) {
											$s[1] = preg_replace('@_\w{2}$@', '_'.ICL_LANGUAGE_CODE, $s[1]);
										}
                                        switch($s[2]){
                                            case 'hideonfalse':
												if(is_array($v['value'])) {
													if ($this->valid_field($v['value'][0])) {
														$output[$s[1]] = true;
													}
												} else {
													if ($this->valid_field($v['value'])) {
														$output[$s[1]] = true;
													}
												}
                                                break;
                                            case 'sendonfalse':
                                                if(is_array($v['value'])) {
													if ($this->valid_field($v['value'][0])) {
														$output[$s[1]] = true;
													} else {
														$output[$s[1]] = false;
													}
												} else {
													if ($this->valid_field($v['value'])) {
														$output[$s[1]] = true;
													} else {
														$output[$s[1]] = false;
													}
												}
                                                break;
                                        }
                                        break;
                                }
                                break;
                        }
                    }
                }
                break;
            case 'cf':

                preg_match_all("/\[([^\]]*)\]/", $form, $matches);
                $values = [];
                foreach($matches[1] as $str){
                    //if(strstr($str,'class:gdpr')){
                        $pts = explode(' ',$str);
                        $values[$pts[1]] = str_replace('class:gdpr-','',$pts[2]);
                    //}
                }

                foreach($values as $k => $v){
                    $s = explode('__', $v);
                    switch($s[0]){
                        case 'pref':
                            switch($s[2]){
                                case 'hideonfalse':
                                    if ($var[$k] != '') {
                                        $output[$s[1]] = true;
                                    }
                                    break;
                                case 'sendonfalse':
                                    $output[$s[1]] = ($var[$k] != '' ? true : false);
                                    break;
                            }
                            break;
                    }
                }
                break;
        }

		return json_decode(json_encode($output));

	}

	public function makeProofs($p, $type = 'ff', $form = null) {
		$output = [];
		$serverProof = array(
			'HTTP_REFERER' => $_SERVER['HTTP_REFERER'],
			'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
			'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
			'LOGGED' => (is_user_logged_in() ? true : false)
		);
		$serverProof = json_encode($serverProof);
		$spt = new stdClass();
		$spt->content = $serverProof;
		array_push($output, $spt);
		$formProof = [];


        switch($type){
            case 'ff';
                foreach($p as $k => $v){
                    $isMasked = $this->getCssFromKey($v['key'], true);
                    if($isMasked) $v['value'] = str_replace($v['value'], 'xxxxxxxxxx', $v['value']);
                    if($k != '') $formProof[$k] = $v['value'];
                }
            break;
            case 'cf':
                preg_match_all("/\[([^\]]*)\]/", $form, $matches);
                foreach($matches[1] as $str){
                    $pts = explode(' ',$str);
                    if(count($pts) > 1){
                        if(array_key_exists ( $pts[1] , $p )){
                            if($pts[count($pts)-1] == 'masked'){
                                $formProof[$pts[1]] = 'xxxxxxxxxx';
                            }else{
                                $formProof[$pts[1]] = $p[$pts[1]];
                            }
                        }
                    }
                }
            break;
        }
        $formProof = json_encode($formProof);
		$fpt = new stdClass();
		$fpt->content = $formProof;
		array_push($output, $fpt);
		return $output;

	}

	public function getLegal($form_id, $type = 'ff'){
		global $wpdb;
		$output = [];


	$ffForms = $wpdb->get_results(
		"
		SELECT post_id, meta_value
		FROM ".$wpdb->prefix."postmeta
		WHERE meta_key = 'ws-informative-".$type."-forms'
		"
	);
	foreach($ffForms as $form){
		$ar = unserialize($form->meta_value);
		if(in_array($form_id, $ar)){ //	ws-informative-rif-iubenda
			$i = $wpdb->get_row("SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id = '".$form->post_id."' AND meta_key = 'ws-informative-rif-iubenda'");
			if($i->meta_value) {
				$ln = new stdClass();
				$ln->identifier =  $i->meta_value;
				$ln->timestamp =  "0001-01-01T00:00:00";
				array_push($output, $ln);
			}

		}
	}
    return $output;

	}



	public function toIubenda($key, $obj, $action = 'consent', $post = 1) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,            "http://consent.iubenda.com/".$action );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_POST,           $post );
		if ($post == 1) curl_setopt($ch, CURLOPT_POSTFIELDS,     $obj );
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json', 'ApiKey: '.$key));
		$result=curl_exec ($ch);
		return $result;

	}



    /**
     * Invia il consenso a Iubenda da un form CF7.
     *
     * @since    1.0.0
     */

	public function cf7ToIubenda() {

        global $wpdb;

        // get_contact_form
        $submission = WPCF7_Submission::get_instance(); 
        if ( $submission ) {

            $posted_data = $submission->get_posted_data(); 
			$contact_form = WPCF7_ContactForm::get_current();
			$contact_form_id = $contact_form -> id; //ID
			$contact_form_unit_tag = $contact_form -> unit_tag; //unit_tag			

            $f = $wpdb->get_row("SELECT post_content FROM ".$wpdb->prefix."posts WHERE ID = '".$contact_form_id."'");
            $form = $f->post_content;
            $iubendaObj = new stdClass();
            $iubendaObj->subject = new stdClass();
            $iubendaObj->id = strtolower($this->GUID());
            $iubendaObj->subject->id = md5(mktime().$contact_form_unit_tag);

            $iubendaObj->subject = $this->iubSubjectCF7($form, $posted_data);
            $iubendaObj->subject->verified = false;
            $iubendaObj->legal_notices = $this->getLegal($contact_form_id, 'cf');
            $iubendaObj->proofs = $this->makeProofs($posted_data, 'cf', $form);
            $iubendaObj->preferences = $this->iubPreferences($posted_data, 'cf', $form);
            $iubendaObj->timestamp = substr_replace(date('c'), substr(microtime(), 1, 8), 19, 0);


            $refIubenda = get_option('informative_options'); //informative_iubenda_toggle

            if($refIubenda['informative_iubenda_toggle'] == 'abilitato') {

                //chiamata iubenda
                $pk = $refIubenda['informative_iubenda_private_key'];
                $iPostCall = $this->toIubenda($pk, json_encode($iubendaObj));
                $iPostCall = json_decode($iPostCall);
                $iPostCall->email = $iubendaObj->subject->email;

                $wpdb->insert(
                    $wpdb->prefix . 'gdpr_iubenda_resp',
                    array(
                        'Id' 			=> $iPostCall->id,
                        'Subject_id' 	=> $iPostCall->subject_id,
                        'Subject_email' => $iPostCall->email,
                        'Timestamp' 	=> $iPostCall->timestamp,
                        'Consent_url' 	=> 'http://consent.iubenda.com/consent/'.$iPostCall->id,
                        'Subject_url' 	=> 'http://consent.iubenda.com/subjects/'.$iPostCall->subject_id
                    ),
                    array(
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s',
                        '%s'
                    )
                );

				$wpdb->insert(
					$wpdb->prefix . 'gdpr_consent',
					array(
						'Id' 			=> $iubendaObj->id,
						'Mail' 			=> $iubendaObj->subject->email,
						'Subject_id' 	=> $iubendaObj->subject->id,
						'Subject' 		=> json_encode($iubendaObj->subject),
						'Legal_notices' => json_encode($iubendaObj->legal_notices),
						'Context' 		=> json_encode($iubendaObj->proofs[0]),
						'Data' 			=> json_encode($iubendaObj->proofs[1]),
						'Preferences' 	=> json_encode($iubendaObj->preferences),
						'Timestamp' 	=> $iubendaObj->timestamp
					)
				);
            }

        }

	}

    public function woocommerceToIubenda() {
        global $wpdb;

        $data = $this->IubendaObject;
        $options = json_decode($data['gdprOpt']);
        //$ok = explode('_',$data['_order_key']);

		$iubendaObj = new stdClass();
		$iubendaObj->id = strtolower($this->GUID());
        $iubendaObj->timestamp = substr_replace(date('c'), substr(microtime(), 1, 8), 19, 0);

        $sbj = [];
        foreach($options->informative_iubenda_to_fieldsinprefs_list as $item){

            if(in_array($item, $options->informative_iubenda_to_hidefields_list)){
                $sbj[$item] = 'xxxxxxxxxxxxxxxx';
            }else{
                $sbj[$item] = $data['_billing_'.$item];
            }
        }
        $sbj['id'] = md5($data['_billing_email']);
        $iubendaObj->subject = new stdClass();
        $iubendaObj->subject = json_decode(json_encode($sbj));
        $iubendaObj->subject->verified = false;
        $prf = [];
        foreach($data as $k => $v){
            if(strstr($k, '_gdpr-pref')){
                $pr = explode('__', $k);
                if ( function_exists('icl_object_id') ) {
                    $pre = str_replace('lang', ICL_LANGUAGE_CODE, $pr[1]);
                    $prf[$pre] = 'true';
                }
            }
        }
        foreach($options->prefs_iubenda_to_woocommerce_list as $preferenza) {
            if(!$preferenza->obb_preferenza){
                if($preferenza->sendOnFalse){
                    if ( function_exists('icl_object_id') ) {
                        $pre = str_replace('lang', ICL_LANGUAGE_CODE, $preferenza->nome_preferenza);
                        $prf[$pre] = 'false';
                    }
                }
            }
        }
        $iubendaObj->preferences = new stdClass();
        $iubendaObj->preferences = json_decode(json_encode($prf));

        $legNot = [];
        foreach($options->informative_iubenda_to_woocommerce_list as $legalNotice) {
            $i = $wpdb->get_row("SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE post_id = '".$legalNotice."' AND meta_key = 'ws-informative-rif-iubenda'");
            if($i->meta_value) {
                $ln = new stdClass();
                $ln->identifier =  $i->meta_value;
                $ln->timestamp =  "0001-01-01T00:00:00";
                array_push($legNot, $ln);
            }
        }
        $iubendaObj->legal_notices = new stdClass();
        $iubendaObj->legal_notices = json_decode(json_encode($legNot));

		$proofs = [];
		$serverProof = array(
			'HTTP_REFERER' => $_SERVER['HTTP_REFERER'],
			'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
			'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
			'LOGGED' => (is_user_logged_in() ? true : false)
		);
		$serverProof = json_encode($serverProof);
		$spt = new stdClass();
		$spt->content = $serverProof;
		array_push($proofs, $spt);
		$formProof = [];

        foreach($data as $k => $v){
            if($k != 'gdprOpt'){
                if(in_array(str_replace('_billing_','',$k),$options->informative_iubenda_to_hidefields_list)){
                    $formProof[$k] = 'xxxxxxxxxxxxxxxx';
                }else{
                    $formProof[$k] = $v;
                }
            }
        }

        $formProof = json_encode($formProof);
		$fpt = new stdClass();
		$fpt->content = $formProof;
		array_push($proofs, $fpt);

        $iubendaObj->proofs = new stdClass();
        $iubendaObj->proofs = $proofs;


        //print_r($iubendaObj); die();

		//preparo l'invio dell'oggetto
		$refIubenda = get_option('informative_options'); //informative_iubenda_toggle

		if($refIubenda['informative_iubenda_toggle'] == 'abilitato') {

			//chiamata iubenda
			$pk = $refIubenda['informative_iubenda_private_key'];
			$iPostCall = $this->toIubenda($pk, json_encode($iubendaObj));
			$iPostCall = json_decode($iPostCall);
			$iPostCall->email = $iubendaObj->subject->email;

			$wpdb->insert(
				$wpdb->prefix . 'gdpr_iubenda_resp',
				array(
					'Id' 			=> $iPostCall->id,
					'Subject_id' 	=> $iPostCall->subject_id,
					'Subject_email' => $iPostCall->email,
					'Timestamp' 	=> $iPostCall->timestamp,
					'Consent_url' 	=> 'http://consent.iubenda.com/consent/'.$iPostCall->id,
					'Subject_url' 	=> 'http://consent.iubenda.com/subjects/'.$iPostCall->subject_id
				),
				array(
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s'
				)
			);

			$wpdb->insert(
				$wpdb->prefix . 'gdpr_consent',
				array(
					'Id' 			=> $iubendaObj->id,
					'Mail' 			=> $iubendaObj->subject->email,
					'Subject_id' 	=> $iubendaObj->subject->id,
					'Subject' 		=> json_encode($iubendaObj->subject),
					'Legal_notices' => json_encode($iubendaObj->legal_notices),
					'Context' 		=> json_encode($iubendaObj->proofs[0]),
					'Data' 			=> json_encode($iubendaObj->proofs[1]),
					'Preferences' 	=> json_encode($iubendaObj->preferences),
					'Timestamp' 	=> $iubendaObj->timestamp
				)
			);
		}



    }

    public function woocommerceGdprMeta($order_id, $posted = null ){

        global $wpdb;

        $options = get_option('informative_options');

        if(count($options['prefs_iubenda_to_woocommerce_list']) > 0){
            foreach($options['prefs_iubenda_to_woocommerce_list'] as $k => $pref){
                if( isset( $_POST['gdpr-pref__'.$pref['nome_preferenza'].($pref['sendOnFalse'] == 'true' ? '__sendonfalse' : '')] ) ) {
                    update_post_meta( $order_id, '_gdpr-pref__'.$pref['nome_preferenza'].($pref['sendOnFalse'] == 'true' ? '__sendonfalse' : ''),  $_POST['gdpr-pref__'.$pref['nome_preferenza'].($pref['sendOnFalse'] == 'true' ? '__sendonfalse' : '')] );
                }
            }
        }
        $object = [];
        $o = $wpdb->get_results(
        "
		SELECT *
		FROM ".$wpdb->prefix."postmeta
		WHERE post_id = ".$order_id."
		"
        );

        foreach($o as $k => $v){
            $object[$v->meta_key] = $v->meta_value;
        }

        //echo '<script>console.log('.serialize($object).')</script>';
        $object['gdprOpt'] = json_encode($options);

        //print_r($object); die();

        $this->IubendaObject = $object;
        $this->woocommerceToIubenda();
    }

	public function userToIubenda() {

		global $wpdb;



        //print_r($_POST); die();

        //echo json_encode($_POST); die();

		$iubendaObj = new stdClass();
        $iubendaObj->subject = new stdClass();

		$iubendaObj->id = strtolower($this->GUID());
		$iubendaObj->subject->id = $_POST['frm_submit_entry_'.$_POST['form_id']];
		$iubendaObj->subject = $this->iubSubject($_POST);
		$iubendaObj->subject->verified = false;
		$iubendaObj->legal_notices = $this->getLegal($_POST['form_id']);
		$iubendaObj->proofs = $this->makeProofs($_POST['item_values']);
		$iubendaObj->preferences = $this->iubPreferences($_POST['item_values']);
		$iubendaObj->timestamp = substr_replace(date('c'), substr(microtime(), 1, 8), 19, 0);

		//preparo l'invio dell'oggetto
		$refIubenda = get_option('informative_options'); //informative_iubenda_toggle

        //print_r($_POST); die('!');


		if($refIubenda['informative_iubenda_toggle'] == 'abilitato') {


			//chiamata iubenda
			$pk = $refIubenda['informative_iubenda_private_key'];
			$iPostCall = $this->toIubenda($pk, json_encode($iubendaObj));
			$iPostCall = json_decode($iPostCall);
			$iPostCall->email = $iubendaObj->subject->email;

			$wpdb->insert(
				$wpdb->prefix . 'gdpr_iubenda_resp',
				array(
					'Id' 			=> $iPostCall->id,
					'Subject_id' 	=> $iPostCall->subject_id,
					'Subject_email' => $iPostCall->email,
					'Timestamp' 	=> $iPostCall->timestamp,
					'Consent_url' 	=> 'http://consent.iubenda.com/consent/'.$iPostCall->id,
					'Subject_url' 	=> 'http://consent.iubenda.com/subjects/'.$iPostCall->subject_id
				),
				array(
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s'
				)
			);

			$wpdb->insert(
				$wpdb->prefix . 'gdpr_consent',
				array(
					'Id' 			=> $iubendaObj->id,
					'Mail' 			=> $iubendaObj->subject->email,
					'Subject_id' 	=> $iubendaObj->subject->id,
					'Subject' 		=> json_encode($iubendaObj->subject),
					'Legal_notices' => json_encode($iubendaObj->legal_notices),
					'Context' 		=> json_encode($iubendaObj->proofs[0]),
					'Data' 			=> json_encode($iubendaObj->proofs[1]),
					'Preferences' 	=> json_encode($iubendaObj->preferences),
					'Timestamp' 	=> $iubendaObj->timestamp
				)
			);
		}
	}





	/**
     * Invia il consenso a Iubenda da un form Formidable.
     *
     * @since    1.0.0
     */

	public function formidableToIubenda() {

		global $wpdb;

        $c = 0;
        $im=[];
        foreach($_POST['item_meta'] as $k => $v){
            if($c > 0) $im[$k] = $v;
            $c++;
        }
        $_POST['item_meta'] = $im;


	    foreach($_POST['item_meta'] as $k => $v){
			$i = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."frm_fields WHERE id = '".$k."'");
			$_POST['item_values'][$i->name]['value'] = $v;
			$_POST['item_values'][$i->name]['key'] = $i->field_key;
	    }
		$form = FrmForm::getOne($_POST['form_id']);
		$iubendaObj = new stdClass();
        $iubendaObj->subject = new stdClass();

		$iubendaObj->id = strtolower($this->GUID());
		$iubendaObj->subject->id = $_POST['frm_submit_entry_'.$_POST['form_id']];
		$iubendaObj->subject = $this->iubSubject($_POST);
		$iubendaObj->subject->verified = false;
		$iubendaObj->legal_notices = $this->getLegal($_POST['form_id']);
		$iubendaObj->proofs = $this->makeProofs($_POST['item_values']);
		$iubendaObj->preferences = $this->iubPreferences($_POST['item_values'], 'ff', $form);
		$iubendaObj->timestamp = substr_replace(date('c'), substr(microtime(), 1, 8), 19, 0);

		//preparo l'invio dell'oggetto
		$refIubenda = get_option('informative_options'); //informative_iubenda_toggle

		if($refIubenda['informative_iubenda_toggle'] == 'abilitato') {

			//chiamata iubenda
			$pk = $refIubenda['informative_iubenda_private_key'];
			$iPostCall = $this->toIubenda($pk, json_encode($iubendaObj));
			$iPostCall = json_decode($iPostCall);
			$iPostCall->email = $iubendaObj->subject->email;

			$wpdb->insert(
				$wpdb->prefix . 'gdpr_iubenda_resp',
				array(
					'Id' 			=> $iPostCall->id,
					'Subject_id' 	=> $iPostCall->subject_id,
					'Subject_email' => $iPostCall->email,
					'Timestamp' 	=> $iPostCall->timestamp,
					'Consent_url' 	=> 'http://consent.iubenda.com/consent/'.$iPostCall->id,
					'Subject_url' 	=> 'http://consent.iubenda.com/subjects/'.$iPostCall->subject_id
				),
				array(
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
					'%s'
				)
			);

			$wpdb->insert(
				$wpdb->prefix . 'gdpr_consent',
				array(
					'Id' 			=> $iubendaObj->id,
					'Mail' 			=> $iubendaObj->subject->email,
					'Subject_id' 	=> $iubendaObj->subject->id,
					'Subject' 		=> json_encode($iubendaObj->subject),
					'Legal_notices' => json_encode($iubendaObj->legal_notices),
					'Context' 		=> json_encode($iubendaObj->proofs[0]),
					'Data' 			=> json_encode($iubendaObj->proofs[1]),
					'Preferences' 	=> json_encode($iubendaObj->preferences),
					'Timestamp' 	=> $iubendaObj->timestamp
				)
			);
		}
	}



    public function gdprWooPreferences($checkout) {


        echo '<div id="my_custom_checkout_field">##lettura impostazioni gdpr associate a woocommerce per il numero di preferenze da mostrare ##<h2>' . __('My Field') . '</h2>';

        woocommerce_form_field( 'my_field_name', array(
            'type'          => 'text',
            'class'         => array('my-field-class form-row-wide'),
            'label'         => __('Fill in this field'),
            'placeholder'   => __('Enter something'),
            'required'      => true,
            ), $checkout->get_value( 'my_field_name' ));

        echo '</div>';


	}



    function woocommerceGdprOptions( $checkout ) {

        $options = get_option('informative_options');
        $data = json_encode($options);

        echo '<div id="user_link_hidden_checkout_field">
            <input type="hidden" class="input-hidden" name="gdpr-data" id="billing_vid" value="' . base64_encode($data) . '">
        </div>';

    }


    public function custom_override_checkout_fields( $fields ) {

        $options = get_option('informative_options');

        if(count($options['prefs_iubenda_to_woocommerce_list']) > 0){

            foreach($options['prefs_iubenda_to_woocommerce_list'] as $k => $pref){

                preg_match('/<'.ICL_LANGUAGE_CODE.'>(.*?)<\/'.ICL_LANGUAGE_CODE.'>/s', $pref['testo_preferenza'], $matches);
                $fields['billing']['gdpr-pref__'.$pref['nome_preferenza'].($pref['sendOnFalse'] == 'true' ? '__sendonfalse' : '')] = array(
               'label'     => $matches[1],
               'type' => 'checkbox',
               'required'  => ($pref['obb_preferenza'] == 'true' ? true : false),
               'class'     => array('form-row-wide'),
               'clear'     => true
                );

            }

        }
        return $fields;
    }


	public function do_theme_redirect($url) {
	    global $post, $wp_query;
	    if(!is_null($post) && $post->post_type == 'informative'){
		    if (have_posts()) {
		        include($url);
		    } else {
		        $wp_query->is_404 = true;
		    }
		}
	}


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Websolute_Gdpr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Websolute_Gdpr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/websolute-gdpr-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Websolute_Gdpr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Websolute_Gdpr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/websolute-gdpr-public.js', array( 'jquery' ), $this->version, false );

	}

}
