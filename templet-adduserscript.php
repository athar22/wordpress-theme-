<?php
/**
 * Template Name: Add new user
 */
 get_header();
$wp_upload_dir = wp_upload_dir();


if ( ! function_exists( 'wpmu_delete_user' ) ) {
    require_once ABSPATH . '/wp-admin/includes/ms.php';
}

$base = dirname(__FILE__);
$path = false;
$path = dirname(dirname($base));

$csvFiles=list_files( $path.'/csv', 100 );
//if(isset($_POST['clubID'])){
    // echo $_POST['clubID'];
   // $ClubID= get_post_meta($_POST['clubID'],'RotaryClubID',true);
   // $BlogID= get_post_meta($_POST['clubID'],'BlogID',true);
//}
if(!empty($_POST['fileUrl'])){

    $data_new_users=array();
    $rowCounter=0;
    if($_POST['fileUrl']!=''){
        if (($handle = fopen($_POST['fileUrl'], 'r')) !== FALSE) { // Check the resource is valid
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Check opening the file is OK!
                array_push( $data_new_users,$data);
                $rowCounter++;
            }
			//int_r( $data_new_users);
            fclose($handle);
            $rowCounter;

        }
    }



    if( $_POST['Import']!="") {
        $mySingleMemberArray=array();
        $myNewArray=array();

        foreach($data_new_users as $data_new_user){
//            print_r($data_new_user);
//            echo "</br>";
//            echo "</br>";
//            echo "===============================================";
//            echo "===============================================";
//            echo "</br>";
//            echo "</br>";
             if($data_new_user[0]!= 'member_name' && $data_new_user[2]=="Principal Member"){


                  //print_r($userEmail);

                $user_login = sanitize_text_field(strtolower($data_new_user[5]));
				//$user_login = sanitize_text_field($data_new_user[19]);
                $user_email = sanitize_email($data_new_user[11]);
				//print_r($user_login);
				//print_r($user_email);
                $user = register_new_user( $user_login, $user_email );
				//int_r($user);
                if ( ! is_wp_error( $user ) ) {

                    $registerStatus="true";
                    $user_id=$user;
                    update_user_meta($user_id , 'custom_avatar',$data_new_user[14]);
                    wp_update_user([
                        'ID' => $user_id, // this is the ID of the user you want to update.
                        'first_name' => $data_new_user[5],

                    ]);



                 //import members

				    $my_post = array(
                        'post_title'    => $data_new_user[4].$data_new_user[5],
                        'post_content'  => $data_new_user[5],
                        'post_status'   => 'publish',
                        'post_type' => 'member',
                        'post_author'   => $my_current_user,
                    );
                    $global_post=wp_insert_post( $my_post );


				if ( $data_new_user[27]==1){
                    update_post_meta($global_post,'MemberType','corporate');
                    if($corpExist=="true"){
                       $CorporateUser2= rwmb_meta('CorporateUser2' ,$args , $global_post);
                        $CorporateUser3= rwmb_meta('CorporateUser3' ,$args , $global_post);
                        if(empty($CorporateUser2)){
                            update_post_meta($global_post,'CorporateUser2',$user_id);
                            update_post_meta($global_post,'CorporatePosition2',$data_new_user[22]);

                        }
                        if(empty($CorporateUser3)&&!empty($CorporateUser2)){
                            update_post_meta($global_post,'CorporateUser3',$user_id);
                            update_post_meta($global_post,'CorporatePosition3',$data_new_user[22]);
                        }

                    }
                    else{
                        update_post_meta($global_post,'MemberId',$data_new_user[0]);
                        update_post_meta($global_post,'COMP_ID',$data_new_user[1]);
                        update_post_meta($global_post,'MEM_MEM_ID',$data_new_user[3]);
                        update_post_meta($global_post,'TITLE',$data_new_user[4]);
                        update_post_meta($global_post,'BusinessPhone1',$data_new_user[6]);
                        update_post_meta($global_post,'BusinessPhone2',$data_new_user[7]);
                        update_post_meta($global_post,'BusinessFax1',$data_new_user[8]);
                        update_post_meta($global_post,'BusinessFax2',$data_new_user[9]);
                        update_post_meta($global_post,'Mobile',$data_new_user[10]);
                        update_post_meta($global_post,'ADDRESS',$data_new_user[12]);
                        update_post_meta( $global_post, 'AddingDate', $data_new_user[13] );
                        update_post_meta($global_post,'CorporateUser1',$user_id);
                        update_post_meta($global_post,'CorporatePosition1',$data_new_user[15]);
                        update_post_meta($global_post,'CorporateCompanyName',$data_new_user[16]);
                        update_post_meta($global_post,'CorporateCompanyBio',$data_new_user[17]);
                        update_post_meta($global_post,'CorporateCompanyAddress',$data_new_user[18]);
                        update_post_meta($global_post,'CorporateCompanyPhone1',$data_new_user[19]);
                        update_post_meta($global_post,'CorporateCompanyPhone2',$data_new_user[20]);
                        update_post_meta($global_post,'CorporateCompanyPhone3',$data_new_user[21]);
                        update_post_meta($global_post,'CorporateCompanyFax1',$data_new_user[22]);
                        update_post_meta($global_post,'CorporateCompanyFax2',$data_new_user[23]);
                        update_post_meta($global_post,'CorporateCompanyFax3',$data_new_user[24]);
                        update_post_meta($global_post,'CorporateCompanyWebsite',$data_new_user[25]);
                        update_post_meta($global_post,'CorporateMail',$data_new_user[26]);
                        update_post_meta($global_post,'membercategory',$data_new_user[28]);
                        update_post_meta($global_post,'memberActivities',$data_new_user[29]);
                        update_post_meta($global_post,'memberSubActivity',$data_new_user[30]);
                        update_post_meta($global_post,'memberofbusinesscouncil',$data_new_user[31]);
                        update_post_meta($global_post,'memberofcommittee',$data_new_user[32]);
                    }


                }
                 $myUserCounter++;
                }
		}


        }

        foreach($data_new_users as $data_new_user){

            if($data_new_user[0]!= 'member_name' && $data_new_user[2]=="Original Member"){
                $user_login = sanitize_text_field(strtolower($data_new_user[5]));
                //$user_login = sanitize_text_field($data_new_user[19]);
                $user_email = sanitize_email($data_new_user[11]);
                //print_r($user_login);
                //print_r($user_email);
                $user = register_new_user( $user_login, $user_email );
                //int_r($user);
                if ( ! is_wp_error( $user ) ) {

                    $registerStatus = "true";
                    $user_id = $user;
                    update_user_meta($user_id, 'custom_avatar', $data_new_user[14]);
                    wp_update_user([
                        'ID' => $user_id, // this is the ID of the user you want to update.
                        'first_name' => $data_new_user[5],

                    ]);


                    //import members

                    $my_post = array(
                        'post_title' => $data_new_user[4] . $data_new_user[5],
                        'post_content' => $data_new_user[5],
                        'post_status' => 'publish',
                        'post_type' => 'member',
                        'post_author' => $my_current_user,
                    );
                    $global_post = wp_insert_post($my_post);

                    if ($data_new_user[27] == 0) {
                        update_post_meta($global_post, 'MemberType', 'individual');
                        update_post_meta($global_post, 'MemberId', $data_new_user[0]);
                        update_post_meta($global_post, 'COMP_ID', $data_new_user[1]);
                        update_post_meta($global_post, 'MEM_MEM_ID', $data_new_user[3]);
                        update_post_meta($global_post, 'TITLE', $data_new_user[4]);
                        update_post_meta($global_post, 'BusinessPhone1', $data_new_user[6]);
                        update_post_meta($global_post, 'BusinessPhone2', $data_new_user[7]);
                        update_post_meta($global_post, 'BusinessFax1', $data_new_user[8]);
                        update_post_meta($global_post, 'BusinessFax2', $data_new_user[9]);
                        update_post_meta($global_post, 'Mobile', $data_new_user[10]);
                        update_post_meta($global_post, 'ADDRESS', $data_new_user[12]);
                        update_post_meta($global_post, 'AddingDate', $data_new_user[13]);
                        update_post_meta($global_post, 'IndividualUser', $user_id);
                        update_post_meta($global_post, 'IndividualPosition', $data_new_user[15]);
                        update_post_meta($global_post, 'IndividualCompanyName', $data_new_user[16]);
                        update_post_meta($global_post, 'IndividualCompanyBio', $data_new_user[17]);
                        update_post_meta($global_post, 'IndividualCompanyAddress', $data_new_user[18]);
                        update_post_meta($global_post, 'IndividualCompanyPhone1', $data_new_user[19]);
                        update_post_meta($global_post, 'IndividualCompanyPhone2', $data_new_user[20]);
                        update_post_meta($global_post, 'IndividualCompanyPhone3', $data_new_user[21]);
                        update_post_meta($global_post, 'IndividualCompanyFax1', $data_new_user[22]);
                        update_post_meta($global_post, 'IndividualCompanyFax2', $data_new_user[23]);
                        update_post_meta($global_post, 'IndividualCompanyFax3', $data_new_user[24]);
                        update_post_meta($global_post, 'IndividualCompanyWebsite', $data_new_user[25]);
                        update_post_meta($global_post, 'IndividualMail', $data_new_user[26]);
                        update_post_meta($global_post, 'membercategory', $data_new_user[28]);
                        update_post_meta($global_post, 'memberActivities', $data_new_user[29]);
                        update_post_meta($global_post, 'memberSubActivity', $data_new_user[30]);
                        update_post_meta($global_post, 'memberofbusinesscouncil', $data_new_user[31]);
                        update_post_meta($global_post, 'memberofcommittee', $data_new_user[32]);
						wp_update_term( 1, 'membercategory', array(
                      
					   'name' => $data_new_user[28],
                        
						'parent' => 0,
						
               ) );
						$terms = get_terms( 'membercategory', array(
                            'hide_empty' => false,
                                 ) );
			                foreach($terms as $term){
								if($data_new_user[28]== $term->name){
				         //echo $term->name;
				         $sector_id = $term->term_id;
								}
			          }
						wp_update_term( 1, 'membercategory', array(
                      
					   'name' => $data_new_user[29],
                        'parent' => $sector_id,
               ) );
                    }
                }
            }
        }


        foreach($data_new_users as $data_new_user){

            if($data_new_user[0]!= 'member_name' && $data_new_user[2]=="Affiliate Member"){
                $user_login = sanitize_text_field(strtolower($data_new_user[5]));
                //$user_login = sanitize_text_field($data_new_user[19]);
                $user_email = sanitize_email($data_new_user[11]);
                //print_r($user_login);
                //print_r($user_email);
                $user = register_new_user( $user_login, $user_email );
                //int_r($user);
                if ( ! is_wp_error( $user ) ) {

                    $registerStatus = "true";
                    $user_id = $user;
                    update_user_meta($user_id, 'custom_avatar', $data_new_user[14]);
                    wp_update_user([
                        'ID' => $user_id, // this is the ID of the user you want to update.
                        'first_name' => $data_new_user[5],

                    ]);


                    $args = array(
                        'post_type' => 'member',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => 'COMP_ID',
                                'value' => $data_new_user[1],
                                'compare' => '==',
                            ),

                        ),
                    );


                    query_posts($args);

                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            $global_post=get_the_ID();
                            $CorporateUser2=rwmb_meta('CorporateUser2' ,$args , get_the_ID());
                            $CorporateUser3=rwmb_meta('CorporateUser3' ,$args , get_the_ID());
                        endwhile;
                    else :
                    endif;

                    wp_reset_query();

                    if($CorporateUser2==""){
                        update_post_meta($global_post,'CorporateUser2',$user_id);
                        update_post_meta($global_post,'CorporatePosition2',$data_new_user[15]);
                    }
                    if($CorporateUser3==""&&$CorporateUser2!=""){
                        update_post_meta($global_post,'CorporateUser3',$user_id);
                        update_post_meta($global_post,'CorporatePosition3',$data_new_user[15]);
                    }

                }
            }
        }
    }


    wp_reset_query();

    //switch_to_blog($BlogID);
   

    

   //dd_existing_user_to_blog( array( 'user_id' => $newUserObject->ID, 'role' => 'subscriber'));
    //restore_current_blog();
}


?>



    <!-- Hero Header BEGIN -->
    <section class="heroHeader">
        <!-- Background -->
        <div
            class="backgroundImage"
            style="background-image: url(<?php echo get_the_post_thumbnail_url();?>)"
            ></div>

        <!-- Content -->
        <div class="container">
            <!-- Header Row BEGIN -->
            <div class="row">
                <!-- Member Info BEGIN -->
                <div class="col-md-9 col-sm-12">
                    <h1>Add Members</h1>
                </div>
                <!-- Member Info END -->

                <!-- Member Info BEGIN -->

                <!-- Member Info END -->

                <!-- Ad Container BEGIN -->
                <div class="col-md-3 col-sm-12 mb-sm-5 ml-auto">
                    <div class="adContainer">
                        <div class="m-auto">
                            <?php
                            $args = array(
                                'post_type' => 'ads',
                                'posts_per_page'=>1,
                                'orderby'        => 'rand',
                                'meta_query' => array(
                                    array(
                                        'key'     => 'DisplayOptionList',
                                        'value'   => 'header',
                                        'compare' => 'IN',
                                    ),
                                ),
                            );
                            query_posts( $args );
                            if ( have_posts() ) :
                                while ( have_posts() ) : the_post();
                                    ?>
                                    <img src="<?php echo get_the_post_thumbnail_url();?>">
                                <?php
                                endwhile;
                            else :
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Ad Container END -->
            </div>
            <!-- Header Row END -->
        </div>
    </section>
    <!-- Search Modal -->

<!-- Hero Header END -->

<?php wp_reset_query();?>
<!-- Body BEGIN -->

<!-- Body END -->


    <section id="body" class="body">
    <div class="masterHeader row m-0">

    </div>
    <div class="container">
    <!-- Members BEGIN -->
    <div class="row newContainer">
    <style>
    .addNewMembers--container {
        padding: 50px;
        margin: 50px 0;
    }

    .addNewMembers--container .loader--animation {
        position: absolute;
        display: flex;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: transparent;
        backdrop-filter: blur(10px);
        z-index: 0;
        opacity: 0;
        -webkit-transition: 0.35s;
        transition: 0.35s;
    }

    .addNewMembers--container .loader--animation.active {
        z-index: 1;
        opacity: 1;
        -webkit-transition: 0.35s;
        transition: 0.35s;
    }

    .addNewMembers--container span {
        padding: 5px 10px;
        margin-top: 20px;
        display: block;
        font-size: 22px;
        font-weight: 500;
        text-transform: uppercase;
    }

    /* Spinier animation */
    .addNewMembers--container .b {
        -webkit-animation: spin 7s linear infinite;
        animation: spin 7s linear infinite;
        -webkit-transform-style: preserve-3d;
        transform-style: preserve-3d;
    }

    .addNewMembers--container .b,
    .addNewMembers--container .c {
        height: 100px;
        width: 100px;
        margin: auto;
    }

    .addNewMembers--container .c {
        border: 1px solid #f06;
        border-radius: 99em;
        position: absolute;
    }

    .addNewMembers--container .c:nth-child(1) {
        border-color: #f06;
        -webkit-animation: spin 7.2s linear 0.04s infinite;
        animation: spin 7.2s linear 0.04s infinite;
        opacity: 0.006;
    }

    .addNewMembers--container .c:nth-child(2) {
        border-color: #ff0048;
        -webkit-animation: spin 7.2s linear 0.08s infinite;
        animation: spin 7.2s linear 0.08s infinite;
        opacity: 0.012;
    }

    .addNewMembers--container .c:nth-child(3) {
        border-color: #ff002b;
        -webkit-animation: spin 7.2s linear 0.12s infinite;
        animation: spin 7.2s linear 0.12s infinite;
        opacity: 0.018;
    }

    .addNewMembers--container .c:nth-child(4) {
        border-color: #ff000d;
        -webkit-animation: spin 7.2s linear 0.16s infinite;
        animation: spin 7.2s linear 0.16s infinite;
        opacity: 0.024;
    }

    .addNewMembers--container .c:nth-child(5) {
        border-color: #ff1100;
        -webkit-animation: spin 7.2s linear 0.2s infinite;
        animation: spin 7.2s linear 0.2s infinite;
        opacity: 0.03;
    }

    .addNewMembers--container .c:nth-child(6) {
        border-color: #ff2f00;
        -webkit-animation: spin 7.2s linear 0.24s infinite;
        animation: spin 7.2s linear 0.24s infinite;
        opacity: 0.036;
    }

    .addNewMembers--container .c:nth-child(7) {
        border-color: #ff4d00;
        -webkit-animation: spin 7.2s linear 0.28s infinite;
        animation: spin 7.2s linear 0.28s infinite;
        opacity: 0.042;
    }

    .addNewMembers--container .c:nth-child(8) {
        border-color: #ff6a00;
        -webkit-animation: spin 7.2s linear 0.32s infinite;
        animation: spin 7.2s linear 0.32s infinite;
        opacity: 0.048;
    }

    .addNewMembers--container .c:nth-child(9) {
        border-color: #ff8800;
        -webkit-animation: spin 7.2s linear 0.36s infinite;
        animation: spin 7.2s linear 0.36s infinite;
        opacity: 0.054;
    }

    .addNewMembers--container .c:nth-child(10) {
        border-color: #ffa600;
        -webkit-animation: spin 7.2s linear 0.4s infinite;
        animation: spin 7.2s linear 0.4s infinite;
        opacity: 0.06;
    }

    .addNewMembers--container .c:nth-child(11) {
        border-color: #ffc400;
        -webkit-animation: spin 7.2s linear 0.44s infinite;
        animation: spin 7.2s linear 0.44s infinite;
        opacity: 0.066;
    }

    .addNewMembers--container .c:nth-child(12) {
        border-color: #ffe100;
        -webkit-animation: spin 7.2s linear 0.48s infinite;
        animation: spin 7.2s linear 0.48s infinite;
        opacity: 0.072;
    }

    .addNewMembers--container .c:nth-child(13) {
        border-color: yellow;
        -webkit-animation: spin 7.2s linear 0.52s infinite;
        animation: spin 7.2s linear 0.52s infinite;
        opacity: 0.078;
    }

    .addNewMembers--container .c:nth-child(14) {
        border-color: #e1ff00;
        -webkit-animation: spin 7.2s linear 0.56s infinite;
        animation: spin 7.2s linear 0.56s infinite;
        opacity: 0.084;
    }

    .addNewMembers--container .c:nth-child(15) {
        border-color: #c4ff00;
        -webkit-animation: spin 7.2s linear 0.6s infinite;
        animation: spin 7.2s linear 0.6s infinite;
        opacity: 0.09;
    }

    .addNewMembers--container .c:nth-child(16) {
        border-color: #a6ff00;
        -webkit-animation: spin 7.2s linear 0.64s infinite;
        animation: spin 7.2s linear 0.64s infinite;
        opacity: 0.096;
    }

    .addNewMembers--container .c:nth-child(17) {
        border-color: #88ff00;
        -webkit-animation: spin 7.2s linear 0.68s infinite;
        animation: spin 7.2s linear 0.68s infinite;
        opacity: 0.102;
    }

    .addNewMembers--container .c:nth-child(18) {
        border-color: #6aff00;
        -webkit-animation: spin 7.2s linear 0.72s infinite;
        animation: spin 7.2s linear 0.72s infinite;
        opacity: 0.108;
    }

    .addNewMembers--container .c:nth-child(19) {
        border-color: #4dff00;
        -webkit-animation: spin 7.2s linear 0.76s infinite;
        animation: spin 7.2s linear 0.76s infinite;
        opacity: 0.114;
    }

    .addNewMembers--container .c:nth-child(20) {
        border-color: #2fff00;
        -webkit-animation: spin 7.2s linear 0.8s infinite;
        animation: spin 7.2s linear 0.8s infinite;
        opacity: 0.12;
    }

    .addNewMembers--container .c:nth-child(21) {
        border-color: #11ff00;
        -webkit-animation: spin 7.2s linear 0.84s infinite;
        animation: spin 7.2s linear 0.84s infinite;
        opacity: 0.126;
    }

    .addNewMembers--container .c:nth-child(22) {
        border-color: #00ff0d;
        -webkit-animation: spin 7.2s linear 0.88s infinite;
        animation: spin 7.2s linear 0.88s infinite;
        opacity: 0.132;
    }

    .addNewMembers--container .c:nth-child(23) {
        border-color: #00ff2b;
        -webkit-animation: spin 7.2s linear 0.92s infinite;
        animation: spin 7.2s linear 0.92s infinite;
        opacity: 0.138;
    }

    .addNewMembers--container .c:nth-child(24) {
        border-color: #00ff48;
        -webkit-animation: spin 7.2s linear 0.96s infinite;
        animation: spin 7.2s linear 0.96s infinite;
        opacity: 0.144;
    }

    .addNewMembers--container .c:nth-child(25) {
        border-color: #00ff66;
        -webkit-animation: spin 7.2s linear 1s infinite;
        animation: spin 7.2s linear 1s infinite;
        opacity: 0.15;
    }

    .addNewMembers--container .c:nth-child(26) {
        border-color: #00ff84;
        -webkit-animation: spin 7.2s linear 1.04s infinite;
        animation: spin 7.2s linear 1.04s infinite;
        opacity: 0.156;
    }

    .addNewMembers--container .c:nth-child(27) {
        border-color: #00ffa2;
        -webkit-animation: spin 7.2s linear 1.08s infinite;
        animation: spin 7.2s linear 1.08s infinite;
        opacity: 0.162;
    }

    .addNewMembers--container .c:nth-child(28) {
        border-color: #00ffbf;
        -webkit-animation: spin 7.2s linear 1.12s infinite;
        animation: spin 7.2s linear 1.12s infinite;
        opacity: 0.168;
    }

    .addNewMembers--container .c:nth-child(29) {
        border-color: #00ffdd;
        -webkit-animation: spin 7.2s linear 1.16s infinite;
        animation: spin 7.2s linear 1.16s infinite;
        opacity: 0.174;
    }

    .addNewMembers--container .c:nth-child(30) {
        border-color: #00fffb;
        -webkit-animation: spin 7.2s linear 1.2s infinite;
        animation: spin 7.2s linear 1.2s infinite;
        opacity: 0.18;
    }

    .addNewMembers--container .c:nth-child(31) {
        border-color: #00e6ff;
        -webkit-animation: spin 7.2s linear 1.24s infinite;
        animation: spin 7.2s linear 1.24s infinite;
        opacity: 0.186;
    }

    .addNewMembers--container .c:nth-child(32) {
        border-color: #00c8ff;
        -webkit-animation: spin 7.2s linear 1.28s infinite;
        animation: spin 7.2s linear 1.28s infinite;
        opacity: 0.192;
    }

    .addNewMembers--container .c:nth-child(33) {
        border-color: #00aaff;
        -webkit-animation: spin 7.2s linear 1.32s infinite;
        animation: spin 7.2s linear 1.32s infinite;
        opacity: 0.198;
    }

    .addNewMembers--container .c:nth-child(34) {
        border-color: #008cff;
        -webkit-animation: spin 7.2s linear 1.36s infinite;
        animation: spin 7.2s linear 1.36s infinite;
        opacity: 0.204;
    }

    .addNewMembers--container .c:nth-child(35) {
        border-color: #006fff;
        -webkit-animation: spin 7.2s linear 1.4s infinite;
        animation: spin 7.2s linear 1.4s infinite;
        opacity: 0.21;
    }

    .addNewMembers--container .c:nth-child(36) {
        border-color: #0051ff;
        -webkit-animation: spin 7.2s linear 1.44s infinite;
        animation: spin 7.2s linear 1.44s infinite;
        opacity: 0.216;
    }

    .addNewMembers--container .c:nth-child(37) {
        border-color: #0033ff;
        -webkit-animation: spin 7.2s linear 1.48s infinite;
        animation: spin 7.2s linear 1.48s infinite;
        opacity: 0.222;
    }

    .addNewMembers--container .c:nth-child(38) {
        border-color: #0015ff;
        -webkit-animation: spin 7.2s linear 1.52s infinite;
        animation: spin 7.2s linear 1.52s infinite;
        opacity: 0.228;
    }

    .addNewMembers--container .c:nth-child(39) {
        border-color: #0900ff;
        -webkit-animation: spin 7.2s linear 1.56s infinite;
        animation: spin 7.2s linear 1.56s infinite;
        opacity: 0.234;
    }

    .addNewMembers--container .c:nth-child(40) {
        border-color: #2600ff;
        -webkit-animation: spin 7.2s linear 1.6s infinite;
        animation: spin 7.2s linear 1.6s infinite;
        opacity: 0.24;
    }

    .addNewMembers--container .c:nth-child(41) {
        border-color: #4400ff;
        -webkit-animation: spin 7.2s linear 1.64s infinite;
        animation: spin 7.2s linear 1.64s infinite;
        opacity: 0.246;
    }

    .addNewMembers--container .c:nth-child(42) {
        border-color: #6200ff;
        -webkit-animation: spin 7.2s linear 1.68s infinite;
        animation: spin 7.2s linear 1.68s infinite;
        opacity: 0.252;
    }

    .addNewMembers--container .c:nth-child(43) {
        border-color: #8000ff;
        -webkit-animation: spin 7.2s linear 1.72s infinite;
        animation: spin 7.2s linear 1.72s infinite;
        opacity: 0.258;
    }

    .addNewMembers--container .c:nth-child(44) {
        border-color: #9d00ff;
        -webkit-animation: spin 7.2s linear 1.76s infinite;
        animation: spin 7.2s linear 1.76s infinite;
        opacity: 0.264;
    }

    .addNewMembers--container .c:nth-child(45) {
        border-color: #bb00ff;
        -webkit-animation: spin 7.2s linear 1.8s infinite;
        animation: spin 7.2s linear 1.8s infinite;
        opacity: 0.27;
    }

    @-webkit-keyframes spin {
        from {
            -webkit-transform: rotateY(360deg) rotateX(-360deg) rotateZ(360deg);
            transform: rotateY(360deg) rotateX(-360deg) rotateZ(360deg);
        }
    }

    @keyframes spin {
        from {
            -webkit-transform: rotateY(360deg) rotateX(-360deg) rotateZ(360deg);
            transform: rotateY(360deg) rotateX(-360deg) rotateZ(360deg);
        }
    }
    </style>
    <div class="col addNewMembers--container" data-id="newMembers">
        <div id="loader--animation" class="loader--animation">
            <div class="m-auto">
                <div class="b">
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                    <div class="c"></div>
                </div>
                <span>Processing</span>
            </div>
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
            
            <div class="row" style="margin-bottom: 15px;">
                <div class="col-md-2">
                    <label>Select A CSV File</label>
                </div>
                <div class="col-md-10">
                    <select id="fileUrl" class="form-control" name="fileUrl" required>
                        <option value="">Please Select A CSV File</option>
                        <?php
                        foreach($csvFiles as $csvFile){
                            $arr = explode('csv/', $csvFile);
                            $important = $arr[1];
                            ?>
                            <option value="<?php echo $csvFile;?>"><?php echo $important; ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row" style="margin-bottom: 15px; text-align: center">
                <div class="col-md-12 form--action--message">
                    <?php
                        if(!empty($_POST['fileUrl'])){?>
                            <span id="message--success" class="success">User data updated successfully</span>

                        <?php }
                           ?>

                </div>
            </div>

            <div class="row" style="margin-bottom: 15px; text-align: center">
                <div class="col-md-6">
                    <input id="import" type="submit" value="Import" name="Import" style="color: #ffffff" class="btn btn-primary  nav-link">
                </div>
               
            </div>
        </form>
        <script>
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && !is_wp_error( $user )){
                ?>

            var element = document.getElementById("message--error");
            element.classList.add("active");

            <?php
            }else if($_SERVER['REQUEST_METHOD'] == 'POST' && is_wp_error( $user )){
                ?>

            var element = document.getElementById("message--success");
            element.classList.add("active");

            <?php }
            ?>
        </script>
        <div>
        </div>
    </div>
    <script>
        document.getElementById("import").addEventListener("click", activeFunctionForSpinner);
        document.getElementById("replace").addEventListener("click", activeFunctionForSpinner);

        function activeFunctionForSpinner() {
            var clubID = document.getElementById("clubID"),
                fileUrl = document.getElementById("fileUrl");

            if (clubID.selectedIndex != 0 && fileUrl.selectedIndex != 0) {
                var element = document.getElementById("loader--animation");
                element.classList.add("active");
            }
        }
    </script>
    </section>
<?php
get_footer();
get_template_part('content', 'DashboardFooter');