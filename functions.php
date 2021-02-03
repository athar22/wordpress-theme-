<?php

require_once( ABSPATH . 'wp-admin/includes/file.php' );

add_filter( 'get_avatar' , 'my_custom_avatar' , 1 , 5 );
function my_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;
    if ( is_numeric( $id_or_email ) ) {
        $id = (int) $id_or_email;
        $user = get_user_by( 'id' , $id );
    } elseif ( is_object( $id_or_email ) ) {
        if ( ! empty( $id_or_email->user_id ) ) {
            $id = (int) $id_or_email->user_id;
            $user = get_user_by( 'id' , $id );
        }
    } else {
        $user = get_user_by( 'email', $id_or_email );
    }

    if ( $user && is_object( $user ) ) {
        $value = rwmb_meta( 'custom_avatar', array( 'object_type' => 'user' ), $user->data->ID );
       // echo $value;
        if ( $value ) {
            $avatar = "<img src='" . $value . "' class='avatar avatar-" . $size . " photo' alt='" . $alt . "' height='" . $size . "' width='" . $size . "' />";
        }
    }
    return $avatar;
}


/*--------------------------------------------------------------------------*/

add_theme_support( 'post-thumbnails' );
require_once('wp_bootstrap_pagination.php');


add_action("wp_ajax_firstlvlselect", "firstlvlselect");
add_action('wp_ajax_nopriv_firstlvlselect', 'firstlvlselect');

function firstlvlselect() {
    $firstlvlselect = $_POST['firstlvlselect'];

    $SelectedTerm=get_term_by('slug',$firstlvlselect,'membercategory');
    $SelectedTermChilderns=get_term_children( $SelectedTerm->term_id, 'membercategory' );

        ?>
        <option value="">All</option>

        <?php
                $SelectedTermChilderns = get_terms( 'membercategory', array( 'parent' => $SelectedTerm->term_id,'hide_empty' => false ) );


                    foreach($SelectedTermChilderns as $SelectedTermChildern){
                    ?>

                <option value="<?php echo $SelectedTermChildern->slug;?>"><?php echo $SelectedTermChildern->name; ?></option>

            <?php
                    }

        exit;



}
add_action("wp_ajax_seclvlselect", "seclvlselect");
add_action('wp_ajax_nopriv_seclvlselect', 'seclvlselect');

function seclvlselect() {
    $seclvlselect = $_POST['seclvlselect'];

    $SelectedTerm=get_term_by('slug',$seclvlselect,'membercategory');
    $SelectedTermChilderns=get_term_children( $SelectedTerm->term_id, 'membercategory' );

    ?>


    <?php
    $SelectedTermChilderns = get_terms( 'membercategory', array( 'parent' => $SelectedTerm->term_id,'hide_empty' => false ) );


    foreach($SelectedTermChilderns as $SelectedTermChildern){
        ?>

        <option value="<?php echo $SelectedTermChildern->slug;?>"><?php echo $SelectedTermChildern->name; ?></option>

    <?php
    }

    exit;



}

add_action("wp_ajax_cityselect", "cityselect");
add_action('wp_ajax_nopriv_cityselect', 'cityselect');

function cityselect() {
    $CitySelect = $_POST['cityselect'];

    $SelectedCityTerm=get_term_by('slug',$CitySelect,'memberlocation');


    ?>


    <?php
    $SelectedCityTermChilderns = get_terms( 'memberlocation', array( 'parent' => $SelectedCityTerm->term_id,'hide_empty' => false ) );

    foreach($SelectedCityTermChilderns as $SelectedCityTermChildern){
        ?>

        <option value="<?php echo $SelectedCityTermChildern->slug;?>"><?php echo $SelectedCityTermChildern->name; ?></option>

    <?php
    }

    exit;



}

function admin_default_page() {
    $url=home_url();
    return $url ;
}

add_filter('login_redirect', 'admin_default_page');
add_filter('show_admin_bar', '__return_false');



if(!function_exists('vivid_login_page'))
{
    function vivid_login_page()
    {
        $args = array(
            'echo'           => true,
            'remember'       => true,
            'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
            'form_id'        => 'loginform',
            'id_username'    => 'user_login',
            'id_password'    => 'user_pass',
            'id_remember'    => 'rememberme',
            'id_submit'      => 'wp-submit',
            'label_username' => __( 'Username or Email Address' ),
            'label_password' => __( 'Password' ),
            'label_remember' => __( 'Remember Me' ),
            'label_log_in'   => __( 'Log In' ),
            'value_username' => '',
            'value_remember' => false
        );
        wp_login_form($args);
    }
    add_shortcode('vivid-login-page', 'vivid_login_page');
}

add_action( 'admin_init', 'redirect_non_logged_users_to_specific_page' );

function redirect_non_logged_users_to_specific_page() {

    if ( !is_user_logged_in() ) {

        wp_redirect( home_url().'/login');
        exit;
    }
}

add_filter('login_redirect', 'my_login_redirect', 10, 3);
function my_login_redirect($redirect_to, $requested_redirect_to, $user) {
    if (is_wp_error($user)) {
        //Login failed, find out why...
        $error_types = array_keys($user->errors);
        //Error type seems to be empty if none of the fields are filled out
        $error_type = 'both_empty';
        //Otherwise just get the first error (as far as I know there
        //will only ever be one)
        if (is_array($error_types) && !empty($error_types)) {
            $error_type = $error_types[0];
        }
        wp_redirect( get_permalink( 115 ) . "?login=failed&reason=" . $error_type ); 
        exit;
    } else {
        //Login OK - redirect to another page?
        return home_url();
    }
}

function get_the_user_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
//check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
//to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return apply_filters( 'wpb_get_ip', $ip );
}

add_shortcode('show_ip', 'get_the_user_ip');

add_filter( 'rwmb_meta_boxes', 'your_prefix_register_meta_boxes' );
function your_prefix_register_meta_boxes( $meta_boxes ) {
    $prefix = '';
    $meta_boxes[] = [
        'title'      => esc_html__( 'new member setting', 'text-domain' ),
        'id'         => 'new-member-setting',
        'post_types' => ['member'],
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => [
            [
                'id'      => $prefix . 'MemberType',
                'name'    => esc_html__( 'Select Advanced', 'text-domain' ),
                'type'    => 'select_advanced',
                'options' => [
                    'individual' => esc_html__( 'individual', 'text-domain' ),
                    'corporate'  => esc_html__( 'corporate', 'text-domain' ),
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyName',
                'type'    => 'text',
                'name'    => esc_html__( 'company name', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'         => $prefix . 'IndividualCompanyLogo',
                'type'       => 'text',
                'name'       => esc_html__( 'company logo', 'text-domain' ),
                'visible'    => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyBio',
                'type'    => 'textarea',
                'name'    => esc_html__( 'company bio', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyAddress',
                'type'    => 'text',
                'name'    => esc_html__( 'Company Address', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyPhone1',
                'type'    => 'text',
                'name'    => esc_html__( 'Company Phone 1', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyPhone2',
                'type'    => 'text',
                'name'    => esc_html__( 'Company Phone 2', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyPhone3',
                'type'    => 'text',
                'name'    => esc_html__( 'Company Phone 3', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyFax1',
                'type'    => 'text',
                'name'    => esc_html__( 'Company Fax 1', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyFax2',
                'type'    => 'text',
                'name'    => esc_html__( 'Company Fax2', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyFax3',
                'type'    => 'text',
                'name'    => esc_html__( 'Company Fax3', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualCompanyWebsite',
                'type'    => 'text',
                'name'    => esc_html__( 'Company Website', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualFacebook',
                'type'    => 'text',
                'name'    => esc_html__( 'Facebook', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualLinkedin',
                'type'    => 'text',
                'name'    => esc_html__( 'linkedin', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualMail',
                'type'    => 'text',
                'name'    => esc_html__( 'member mail', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'         => $prefix . 'IndividualUser',
                'type'       => 'user',
                'name'       => esc_html__( 'User', 'text-domain' ),
                'field_type' => 'select_advanced',
                'visible'    => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'IndividualPosition',
                'type'    => 'text',
                'name'    => esc_html__( 'Position', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'individual']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyName',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Company Name', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'         => $prefix . 'CorporateCompanyLogo',
                'type'       => 'text',
                'name'       => esc_html__( 'Corporate Company Logo', 'text-domain' ),
                'visible'    => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyBio',
                'type'    => 'textarea',
                'name'    => esc_html__( 'Corporate Company Bio', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyAddress',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Company Address', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyPhon1',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Company Phone 1', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyPhon2',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Company Phone 2', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyPhon3',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Company Phone 3', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyFax1',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Company Fax 1', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyFax2',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Company Fax 2', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyFax3',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Company Fax 3', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateCompanyWebsite',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Company Website', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateFacebook',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Facebook', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateLinkedin',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Linkedin', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporateMail',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Mail', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'         => $prefix . 'CorporateUser1',
                'type'       => 'user',
                'name'       => esc_html__( 'Corporate frist user', 'text-domain' ),
                'field_type' => 'select_advanced',
                'visible'    => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporatePosition1',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Position', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'MainMember',
                'name'    => esc_html__( 'Main Member', 'text-domain' ),
                'type'    => 'checkbox',
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'         => $prefix . 'CorporateUser2',
                'type'       => 'user',
                'name'       => esc_html__( 'Corporate second user', 'text-domain' ),
                'field_type' => 'select_advanced',
                'visible'    => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporatePosition2',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Position (second)', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'MainMember2',
                'name'    => esc_html__( 'Main Member (second)', 'text-domain' ),
                'type'    => 'checkbox',
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'         => $prefix . 'CorporateUser3',
                'type'       => 'user',
                'name'       => esc_html__( 'Corporate thhird user', 'text-domain' ),
                'field_type' => 'select_advanced',
                'visible'    => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'CorporatePosition3',
                'type'    => 'text',
                'name'    => esc_html__( 'Corporate Position (third)', 'text-domain' ),
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'      => $prefix . 'MainMember3',
                'name'    => esc_html__( 'Main Member (third)', 'text-domain' ),
                'type'    => 'checkbox',
                'visible' => [
                    'when'     => [['MemberType', '=', 'corporate']],
                    'relation' => 'and',
                ],
            ],
            [
                'id'   => $prefix . 'TITLE',
                'type' => 'text',
                'name' => esc_html__( 'TITLE ', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'BusinessPhone1',
                'type' => 'text',
                'name' => esc_html__( 'Business Phone 1', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'BusinessPhone2',
                'type' => 'text',
                'name' => esc_html__( 'Business Phone 2', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'BusinessFax1',
                'type' => 'text',
                'name' => esc_html__( 'Business Fax 1', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'BusinessFax2',
                'type' => 'text',
                'name' => esc_html__( 'Business Fax 2', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'Mobile',
                'type' => 'text',
                'name' => esc_html__( 'Mobile', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'ADDRESS',
                'type' => 'text',
                'name' => esc_html__( 'ADDRESS', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'MemberId',
                'type' => 'text',
                'name' => esc_html__( 'Member Id', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'COMP_ID',
                'type' => 'text',
                'name' => esc_html__( 'Company ID ', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'MEM_MEM_ID',
                'type' => 'text',
                'name' => esc_html__( 'MEM_MEM_ID ', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'memberofbusinesscouncil',
                'type' => 'text',
                'name' => esc_html__( 'member of business council', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'memberofcommittee',
                'type' => 'text',
                'name' => esc_html__( 'member of committee', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'memberlocation',
                'type' => 'text',
                'name' => esc_html__( 'member location', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'membercategory',
                'type' => 'text',
                'name' => esc_html__( 'member category', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'memberActivities',
                'type' => 'text',
                'name' => esc_html__( 'Member Activities', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'memberSubActivity ',
                'type' => 'text',
                'name' => esc_html__( 'Member SubActivity ', 'text-domain' ),
            ],
            [
                'id'   => $prefix . 'AddingDate',
                'type' => 'date',
                'name' => esc_html__( 'Date', 'text-domain' ),
            ],
        ],
    ];
    return $meta_boxes;
}


