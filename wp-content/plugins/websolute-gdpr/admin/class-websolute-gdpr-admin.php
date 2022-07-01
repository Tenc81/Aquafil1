<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.websolute.com
 * @since      1.0.0
 *
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Websolute_Gdpr
 * @subpackage Websolute_Gdpr/admin
 * @author     Alessandro Lambertini <alambertini@websolute.it>
 */
class Websolute_Gdpr_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	function informative_register() {  
	    $args = array(  
	        'label' => __('Informative Trattamento dati'),  
	        'singular_label' => __('Informativa'),   
	        'public' => false,
			    'public_queryable' => true,
			    'exclude_from_search' => true,  
	        'show_ui' => true,  
	        'capability_type' => 'post',  
	        'hierarchical' => false,  
	        'rewrite' => true,  
	        'supports' => array('title', 'editor', 'author', 'revisions')  
	       );  
	    register_post_type( 'informative' , $args );  
	}

	public function check_i_items($id) {
		global $wpdb;
		$output = array();
		$i = $wpdb->get_results( 
			"SELECT meta_value, post_id FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'ws-informative-rif-iubenda'"
		);
		if(count($i) > 0){
			foreach($i as $v){
				if($v->post_id != $id) array_push($output, $v->meta_value);
			}
		}
		return $output;

	}

	function render_ws_meta_box( $object, $box ) { 

		global $wpdb;

		wp_nonce_field( basename( __FILE__ ), 'ws_informative_nonce' ); 
		$refIubenda = get_option('informative_options');
		$refIubendaItems = explode(',',$refIubenda['informative_iubenda_policy_identifiers_list']);
		?>
		<p>
		    <label for="ws-informative-rif-iubenda"><?php _e( 'Rif. Iubenda', 'example' ); ?></label>
		    <br />
			<select id="ws-informative-rif-iubenda" name="ws-informative-rif-iubenda">
				<?php 
				$ver = $this->check_i_items($object->ID);
				foreach($refIubendaItems as $s) {
					if(!in_array($s, $ver)){
					echo '<option value="'.$s.'" '.(esc_attr( get_post_meta( $object->ID, 'ws-informative-rif-iubenda', true ) )==$s?'selected':'').' >'.$s.'</option>';
					}
				}
				?>
			</select>
		</p>
		<?php

		if ( is_plugin_active( 'formidable/formidable.php' ) ) { // è attivo formidable
			//$isfdb = true;
			//add_settings_error('informative_messages', 'informative_message', __('Rilevato Formidable', 'informative'), 'Aggiornato');
//echo $wpdb->prefix;
$ffForms = $wpdb->get_results( 
	"
	SELECT id, form_key 
	FROM ".$wpdb->prefix."frm_forms
	WHERE is_template = '0' AND default_template = '0' AND status = 'published'
	"
);
 ?>
	<p>
	    <label for="ws-informative-ff-forms"><?php _e( 'Aggancio a Form di Formidable', 'example' ); ?></label>
	    <br />
			<?php 
			$postmeta = maybe_unserialize( get_post_meta( $object->ID, 'ws-informative-ff-forms', true ) );
			foreach ( $ffForms as $ffForm ) {

	        if ( is_array( $postmeta ) && in_array( $ffForm->id, $postmeta ) ) {
	            $checked = 'checked="checked"';
	        } else {
	            $checked = null;
	        }

	        ?>
	        <p>
	            <input  type="checkbox" name="ws-informative-ff-forms[]" value="<?php echo $ffForm->id;?>" <?php echo $checked; ?> />
	            <?php echo $ffForm->form_key ?>
	        </p>

		<?php } ?>
	</p>
<?php

		}

		if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
			//$iscf7 = true;
            //add_settings_error('informative_messages', 'informative_message', __('Rilevato Contact Form 7', 'informative'), 'Aggiornato');


            $ffForms = $wpdb->get_results(
                "
	SELECT ID, post_name
	FROM ".$wpdb->prefix."posts
	WHERE post_type = 'wpcf7_contact_form' AND post_status = 'publish'
	"
            );
?>

<p>
    <label for="ws-informative-cf-forms">
        <?php _e( 'Aggancio a Form di CF7', 'example' ); ?>
    </label>
    <br />

    <?php
			$postmeta = maybe_unserialize( get_post_meta( $object->ID, 'ws-informative-cf-forms', true ) );
			foreach ( $ffForms as $ffForm ) {

                if ( is_array( $postmeta ) && in_array( $ffForm->ID, $postmeta ) ) {
                    $checked = 'checked="checked"';
                } else {
                    $checked = null;
                }

    ?>
    <p>
        <input type="checkbox" name="ws-informative-cf-forms[]" value="<?php echo $ffForm->ID;?>" <?php echo $checked; ?> />
        <?php echo $ffForm->post_name ?>
    </p>

    <?php } ?>
</p>
<?php




		}

	}

	function adding_custom_meta_boxes( $post ) {
	    add_meta_box(
	        'informative_gdpr',
	        __( 'Dettagli Informativa Trattamento' ),
	        array($this,'render_ws_meta_box'),
	        'informative',
	        'normal',
	        'default'
	    );

	}

function gdpr_status_box() {
 wp_add_dashboard_widget( 'gdpr_status_box_start', __('Websolute - Stato GDPR', 'informative'), array($this,'gdpr_status_box_callback') );
}

function gdpr_status_box_callback(){ ?>
	<h3>Verifica compliancy</h3>
	<ul>
		<li><strong>Account Iubenda</strong> - ## leggo impostazioni ##</li>
		<li><strong>Presenza Form</strong> - ## leggo presenza formidable / impostazioni ##</li>
		<li><strong>Presenza CSS per Iubenda</strong> - ## le classi sono state inserite ##</li>
		<li><strong>Controllo associazioni Informative/Form</strong> - ## associazioni tra form e informative ##
		<li><strong>Assegnazione Informative / Iubenda</strong> - ## stato assegnazioni</li>
	</ul>
<?php }


	/**
	 * top level menu
	 */
	function informative_options_page()
	{
	    // add top level menu page
	    add_menu_page(
	        'Settaggi GDPR',
    	    'Conf. GDPR',
	        'administrator',
	        'informative',
	        array($this,'informative_options_page_html')
	    );
	}

	/**
	 * top level menu:
	 * callback functions
	 */
	function informative_options_page_html()
	{
	    // check user capabilities

	    if (!current_user_can('manage_options')) {
	        return;
	    }

	    // check if the user have submitted the settings
	    // wordpress will add the "settings-updated" $_GET parameter to the url
	    if (isset($_GET['settings-updated'])) {
	        // add settings saved message with the class of "updated"
	        add_settings_error('informative_messages', 'informative_message', __('Opzioni Salvate', 'informative'), 'Aggiornato');
	    }
	 
	    // show error/update messages
	    settings_errors('informative_messages');
	    ?>
	    <div class="wrap">
	        <h1><?= esc_html(get_admin_page_title()); ?></h1>
	        <form action="options.php" method="post">
	            <?php
	            // output security fields for the registered setting "wporg"
	            settings_fields('informative');
	            // output setting sections and their fields
	            // (sections are registered for "wporg", each field is registered to a specific section)
	            do_settings_sections('informative');
	            // output save settings button
	            submit_button('Salva Impostazioni');
	            ?>
	        </form>
	    </div>
	    <?php
	}


function informative_settings_init()
{
    // register a new setting for "wporg" page
    register_setting('informative', 'informative_options');

    // register a new section in the "wporg" page
    add_settings_section(
        'informative_section_developers',
        __('chiavi API Iubenda.', 'informative'),
        array($this,'informative_section_developers_cb'),
        'informative'
    );

    add_settings_field(
        'informative_iubenda_toggle', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Utilizzo IUBENDA per registrare preferenze e consensi: ', 'informative'),
        array($this,'informative_iubenda_toggle'),
        'informative',
        'informative_section_developers',
        [
            'label_for'         => 'informative_iubenda_toggle',
            'class'             => 'informative_row',
            'informative_custom_data' => 'custom',
        ]
    );

    add_settings_field(
        'informative_iubenda_private', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Chiave Privata (API via http): ', 'informative'),
        array($this,'informative_iubenda_private'),
        'informative',
        'informative_section_developers',
        [
            'label_for'         => 'informative_iubenda_private_key',
            'class'             => 'informative_row',
            'informative_custom_data' => 'custom',
        ]
    );

    add_settings_field(
        'informative_iubenda_policy_identifiers', // as of WP 4.6 this value is used only internally
        // use $args' label_for to populate the id inside the callback
        __('Identificativi delle informative (separati da virgola): ', 'informative'),
        array($this,'informative_iubenda_policy_identifiers'),
        'informative',
        'informative_section_developers',
        [
            'label_for'         => 'informative_iubenda_policy_identifiers_list',
            'class'             => 'informative_row',
            'informative_custom_data' => 'custom',
        ]
    );


    add_settings_field(
            'informative_iubenda_to_registration_users', // as of WP 4.6 this value is used only internally
            // use $args' label_for to populate the id inside the callback
            __('associazione informative alla registrazione di un nuovo utente:', 'informative'),
            array($this,'informative_iubenda_to_registration_users'),
            'informative',
            'informative_section_developers',
            [
                'label_for'         => 'informative_iubenda_to_registration_users_list',
                'class'             => 'informative_row',
            'informative_custom_data' => 'custom',
        ]
    );

    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {


        add_settings_field(
            'informative_iubenda_to_fieldsinprefs', // as of WP 4.6 this value is used only internally
            // use $args' label_for to populate the id inside the callback
            __('selezionare i campi da inviare nella preferenza a iubenda:', 'informative'),
            array($this,'informative_iubenda_to_fieldsinprefs'),
            'informative',
            'informative_section_developers',
            [
                'label_for'         => 'informative_iubenda_to_fieldsinprefs_list',
                'class'             => 'informative_row',
                'informative_custom_data' => 'custom',
            ]
        );


        add_settings_field(
                'informative_iubenda_to_hidefields', // as of WP 4.6 this value is used only internally
                // use $args' label_for to populate the id inside the callback
                __('selezionare i campi da oscurare verso iubenda:', 'informative'),
                array($this,'informative_iubenda_to_hidefields'),
                'informative',
                'informative_section_developers',
                [
                    'label_for'         => 'informative_iubenda_to_hidefields_list',
                    'class'             => 'informative_row',
            'informative_custom_data' => 'custom',
        ]
    );


        add_settings_field(
                'informative_iubenda_to_woocommerce', // as of WP 4.6 this value is used only internally
                // use $args' label_for to populate the id inside the callback
                __('associazione informative a woocommerce:', 'informative'),
                array($this,'informative_iubenda_to_woocommerce'),
                'informative',
                'informative_section_developers',
                [
                    'label_for'         => 'informative_iubenda_to_woocommerce_list',
                    'class'             => 'informative_row',
                    'informative_custom_data' => 'custom',
                ]
        );


        add_settings_field(
                'prefs_iubenda_to_woocommerce', // as of WP 4.6 this value is used only internally
                // use $args' label_for to populate the id inside the callback
                __('gestione GDPR prefs woocommerce:', 'informative').wc_help_tip(esc_html(__('quando è installato wpml includere il testo in tag con il language code corrispondente.', 'informative')), true),
                array($this,'prefs_iubenda_to_woocommerce'),
                'informative',
                'informative_section_developers',
                [
                    'label_for'         => 'prefs_iubenda_to_woocommerce_list',
                    'class'             => 'informative_row',
                    'informative_custom_data' => 'custom',
                ]
        );


    }

}


function informative_iubenda_toggle ($args)
{
    $options = get_option('informative_options');

	if(isset($options[$args['label_for']]) && $options[$args['label_for']] == 'abilitato'){
		$chk = true;
	} else {
		$chk = false;
	}

?>
    <input type="checkbox" id="<?= esc_attr($args['label_for']); ?>" data-custom="<?= esc_attr($args['informative_custom_data']); ?>"
            name="informative_options[<?= esc_attr($args['label_for']); ?>]" value="abilitato" <?=($chk ? 'checked' : '')?> />
    <?php
}


function informative_iubenda_private ($args)
{
    $options = get_option('informative_options');
    ?>
    <input  style="width:90%" type="text" id="<?= esc_attr($args['label_for']); ?>"
    		placeholder="chiave privata iubenda" 
            data-custom="<?= esc_attr($args['informative_custom_data']); ?>"
            name="informative_options[<?= esc_attr($args['label_for']); ?>]"
            value="<?=(isset($options[$args['label_for']]) ? $options[$args['label_for']] : '') ?>"
    />
    <?php
}

function informative_iubenda_policy_identifiers ($args)
{
    $options = get_option('informative_options');
    ?>
    <input style="width:90%" type="text" id="<?= esc_attr($args['label_for']); ?>"
    		placeholder="identificativi delle policy separati da virgola" 
            data-custom="<?= esc_attr($args['informative_custom_data']); ?>"
            name="informative_options[<?= esc_attr($args['label_for']); ?>]"
            value="<?=(isset($options[$args['label_for']]) ? $options[$args['label_for']] : 'privacy_policy,cookie_policy,terms') ?>"
    />
    <?php
}

function informative_iubenda_to_fieldsinprefs ($args)
{
    $options = get_option('informative_options');
    $ffInForms = array('first_name', 'last_name', 'email', 'payment_method', 'company', 'address_1', 'address_2', 'city','state','postcode');
    $postmeta = maybe_unserialize( $options[esc_attr($args['label_for'])] );
    foreach ( $ffInForms as $ffInForm ) {
        if ( is_array( $postmeta ) && in_array( $ffInForm, $postmeta ) ) {
            $checked = 'checked="checked"';
        } else {
            $checked = null;
        }
    ?>
<input type="checkbox" data-custom="<?= esc_attr($args['informative_custom_data']); ?>" name="informative_options[<?= esc_attr($args['label_for']); ?>][]" value="<?php echo $ffInForm;?>" <?php echo $checked; ?> />
<?php echo $ffInForm.'<br>';
    }
}


function informative_iubenda_to_hidefields ($args)
{
    $options = get_option('informative_options');
    $ffInForms = array('first_name', 'last_name', 'email');
    $postmeta = isset($options[esc_attr($args['label_for'])]) ? maybe_unserialize( $options[esc_attr($args['label_for'])] ) : array();
    foreach ( $ffInForms as $ffInForm ) {
        if ( is_array( $postmeta ) && in_array( $ffInForm, $postmeta ) ) {
            $checked = 'checked="checked"';
        } else {
            $checked = null;
        }
?>
        <input type="checkbox" data-custom="<?= esc_attr($args['informative_custom_data']); ?>" name="informative_options[<?= esc_attr($args['label_for']); ?>][]" value="<?php echo $ffInForm;?>" <?php echo $checked; ?> />
<?php 
        echo $ffInForm.'<br>';
    }
}


function informative_iubenda_to_registration_users ($args)
{
	global $wpdb;
	$options = get_option('informative_options');

	$ffInForms = $wpdb->get_results(
			"
		SELECT ID, post_title
		FROM ".$wpdb->prefix."posts
		WHERE post_type = 'informative' AND post_status = 'publish'
		"
	);
	if(!empty($ffInForms)) :
		$postmeta = maybe_unserialize( $options[esc_attr($args['label_for'])] );

		foreach ( $ffInForms as $ffInForm ) {

			if ( is_array( $postmeta ) && in_array( $ffInForm->ID, $postmeta ) ) {
				$checked = 'checked="checked"';
			} else {
				$checked = null;
			}
?>
	<input type="checkbox"  data-custom="<?= esc_attr($args['informative_custom_data']); ?>" name="informative_options[<?= esc_attr($args['label_for']); ?>][]" value="<?php echo $ffInForm->ID;?>" <?php echo $checked; ?> />
	<?php echo $ffInForm->post_title.'<br>';
		}
	else : echo 'ancora non ci sono informative da associare, clicca <a href="'.get_option("siteurl").'/wp-admin/post-new.php?post_type=informative">qui</a> per crearne una.';
	endif;
}


function informative_iubenda_to_woocommerce ($args)
{
    global $wpdb;
    $options = get_option('informative_options');

    $ffInForms = $wpdb->get_results(
        "
	        SELECT ID, post_title
	        FROM ".$wpdb->prefix."posts
	        WHERE post_type = 'informative' AND post_status = 'publish'
	        "
    );

    $postmeta = maybe_unserialize( $options[esc_attr($args['label_for'])] );

    foreach ( $ffInForms as $ffInForm ) {

        if ( is_array( $postmeta ) && in_array( $ffInForm->ID, $postmeta ) ) {
            $checked = 'checked="checked"';
        } else {
            $checked = null;
        }
?>
<input type="checkbox" data-custom="<?= esc_attr($args['informative_custom_data']); ?>" name="informative_options[<?= esc_attr($args['label_for']); ?>][]" value="<?php echo $ffInForm->ID;?>" <?php echo $checked; ?> />
<?php echo $ffInForm->post_title.'<br>';
    }

}

function prefs_iubenda_to_woocommerce ($args)
{

    $options = get_option('informative_options');
    $i = count($options['prefs_iubenda_to_woocommerce_list']) + 1;
    //echo '<pre>'; print_r($options['prefs_iubenda_to_woocommerce_list']); echo '</pre>';
?>

<script>
    jQuery(function () {
        var scntDiv = jQuery('#p_scents');
        var i = <?php echo $i; ?>

        jQuery('#addScnt').on('click', function () {
            jQuery('<p><label for="nome_preferenza">Nome preferenza: <input style="width:100%" type="text" id="nome_preferenza" name="informative_options[<?= esc_attr($args['label_for']); ?>][' + i + '][<?= esc_attr('nome_preferenza'); ?>]" value="" placeholder="Nome Preferenza ' + i + '" />' +
                '</label><br><label for="obb_preferenza">Selezione Obbligatoria: <select id="obb_preferenza" style="width:100%" name="informative_options[<?= esc_attr($args['label_for']); ?>][' + i + '][<?= esc_attr('obb_preferenza'); ?>]">' +
                '<option value="true">Si</option><option value="false">No</option></select></label><br><label for="sendOnFalse">Invia quando falso: <select id="sendOnFalse" style="width:100%" name="informative_options[<?= esc_attr($args['label_for']); ?>][' + i + '][<?= esc_attr('sendOnFalse'); ?>]">' +
                '<option value="true">Si</option><option value="false">No</option></select></label><br><label for="testo_preferenza">Testo preferenza: '+
                '<textarea id="testo_preferenza" style="width:100%" rows="5"  name="informative_options[<?= esc_attr($args['label_for']); ?>][' + i + '][<?= esc_attr('testo_preferenza'); ?>]">Testo Preferenza</textarea></label>' +
                '<a href="#" class="remPref">Remove</a></p>').appendTo(scntDiv);
            i++;
            return false;
        });

        jQuery('body').on('click', '.remPref', function () {
            if (i > 1) {
                jQuery(this).parents('p').remove();
                i--;
            }
            return false;
        });
    });
</script>

<div id="p_scents">
    <?php
    if(count($options['prefs_iubenda_to_woocommerce_list']) > 0){
        foreach($options['prefs_iubenda_to_woocommerce_list'] as $k => $pref){
            echo '<p><label for="nome_preferenza">Nome preferenza: <input style="width:100%" value="'.$pref['nome_preferenza'].'" type="text" id="nome_preferenza" name="informative_options['.esc_attr($args['label_for']).'][' . $k . ']['.esc_attr('nome_preferenza').']" value="" placeholder="Nome Preferenza ' . $k . '" />' .
            '</label><br><label for="obb_preferenza">Selezione Obbligatoria:  <select style="width:100%" id="obb_preferenza" name=informative_options['.esc_attr($args['label_for']).'][' . $k . ']['.esc_attr('obb_preferenza').']">' .
            '<option value="true" '. ($pref['obb_preferenza'] == 'true' ? 'selected' : '') .' >Si</option><option value="false" '. ($pref['obb_preferenza'] == 'false' ? 'selected' : '') .'>No</option></select></label><br>
<label for="sendOnFalse">Invia quando falso: <select id="sendOnFalse" style="width:100%" name="informative_options['.esc_attr($args['label_for']).'][' . $k . ']['.esc_attr('sendOnFalse') .']">'.
            '<option value="true" '. ($pref['sendOnFalse'] == 'true' ? 'selected' : '') .'>Si</option><option '. ($pref['sendOnFalse'] == 'false' ? 'selected' : '') .' value="false">No</option></select></label><br>
<label for="testo_preferenza">Testo preferenza: '.
            '<textarea style="width:100%" rows="5" id="testo_preferenza" name="informative_options['.esc_attr($args['label_for']).'][' . $k . ']['.esc_attr('testo_preferenza').']">'.$pref['testo_preferenza'].'</textarea></label>' .
            '<a href="#" class="remPref">Remove</a></p>';
        }
    }
    ?>
</div>
<a href="javascript:;" id="addScnt">Aggiungi una preferenza</a>

<?php

}


function informative_section_developers_cb($args)
{
    ?>
    <p id="<?= esc_attr($args['id']); ?>"><?= esc_html__('Inserisci i dati recuperati dalla dashboard Iubenda', 'informative'); ?></p>
    <?php
}

/* Save the meta box's post metadata. */
function save_informative( $post_id, $post ) {

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['ws_informative_nonce'] ) || !wp_verify_nonce( $_POST['ws_informative_nonce'], basename( __FILE__ ) ) )
        return $post_id;

      /* Get the post type object. */
      $post_type = get_post_type_object( $post->post_type );

      /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

// print_r($_POST); die();

    foreach($_POST as $k => $v){

        if($k != 'ws_informative_nonce'){

        	if(!$_POST['ws-informative-ff-forms']){
        		delete_post_meta( $post_id, 'ws-informative-ff-forms' );
        	}

        	if(!$_POST['ws-informative-cf-forms']){
        		delete_post_meta( $post_id, 'ws-informative-cf-forms' );
        	}

            switch ($k) {

            	case 'ws-informative-ff-forms':
				        update_post_meta( $post_id, $k, $_POST[$k] );
            	break;

            	case 'ws-informative-cf-forms':
                    update_post_meta( $post_id, $k, $_POST[$k] );
                    break;

                case 'ws-informative-rif-iubenda':

                      $new_meta_value = ( isset( $_POST[$k] ) ? $_POST[$k] : '' );
                      $meta_key = $k;


                      /* Get the meta value of the custom field key. */
                      $meta_value = get_post_meta( $post_id, $meta_key, true );


                      /* If a new meta value was added and there was no previous value, add it. */
                      if ( $new_meta_value && '' == $meta_value )
                        add_post_meta( $post_id, $meta_key, $new_meta_value, true );

                      /* If the new meta value does not match the old value, update it. */
                      elseif ( $new_meta_value && $new_meta_value != $meta_value )
                        update_post_meta( $post_id, $meta_key, $new_meta_value );

                      /* If there is no new meta value but an old value exists, delete it. */
                      elseif ( '' == $new_meta_value && $meta_value )
                        delete_post_meta( $post_id, $meta_key, $meta_value );

                break;

            }

        }

    }
}



	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/websolute-gdpr-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            wp_enqueue_script('tooltip', WP_CONTENT_URL . '/plugins/woocommerce/assets/js/jquery-tiptip/jquery.tipTip.min.js', array('jquery'), null, false);
		}
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/websolute-gdpr-admin.js', array( 'jquery' ), $this->version, false );

	}

}
