<?php
/**
 * Template Name: Add new user
 */

$wp_upload_dir = wp_upload_dir();


if ( ! function_exists( 'wpmu_delete_user' ) ) {
    require_once ABSPATH . '/wp-admin/includes/ms.php';
}

$base = dirname(__FILE__);
$path = false;
$path = dirname(dirname($base));

$csvFiles=list_files( $path.'/csv', 100 );
if(isset($_POST['clubID'])){
    // echo $_POST['clubID'];
    $ClubID= get_post_meta($_POST['clubID'],'RotaryClubID',true);
    $BlogID= get_post_meta($_POST['clubID'],'BlogID',true);
}
if(!empty($_POST['fileUrl'])){

    $data_new_users=array();
    $rowCounter=0;
    if($_POST['fileUrl']!=''){
        if (($handle = fopen($_POST['fileUrl'], 'r')) !== FALSE) { // Check the resource is valid
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Check opening the file is OK!
                array_push( $data_new_users,$data);
                $rowCounter++;
            }
            fclose($handle);
            $rowCounter;
        }
    }
    if($_POST['Replace']!="" || $_POST['Import']!="") {
        $args = array(
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'RotaryClubID',
                    'value' => $ClubID,
                ),
            )
        );
        $wp_user_query = new WP_User_Query($args);
        $authors = $wp_user_query->get_results();
        if (!empty($authors)) {
            foreach ($authors as $author) {
                wpmu_delete_user( $author->ID );
            }
        }
        wp_reset_query();
        switch_to_blog($BlogID);
        $args = array (
            'exclude' => 0,
        );
        $wp_user_query = new WP_User_Query($args);
        $clubAuthors = $wp_user_query->get_results();

        if (!empty($clubAuthors)) {

            wp_delete_user( $clubAuthors->ID, $reassign = null );

        }
        wp_reset_query();
        restore_current_blog();
        $myUserCounter=0;
        foreach($data_new_users as $data_new_user){




                $memberUsername=preg_split('/(?:"[^"]*"|)\K\s*(,\s*|$)/', $data_new_user[1]);
                $memberEmail=$data_new_user[9];
                $memberEmail=preg_split('/(?:"[^"]*"|)\K\s*(,\s*|$)/',$data_new_user[9]);



                $user_login = sanitize_text_field(strtolower($data_new_user[1].$data_new_user[2]));
                $user_email = sanitize_email($data_new_user[9]);
                $user = register_new_user( $user_login, $user_email );
                if ( ! is_wp_error( $user ) ) {

                    $registerStatus="true";
                    $user_id=$user;

                    update_user_meta($user_id,'MemberID',$data_new_user[0]);
                    update_user_meta($user_id,'first_name',$data_new_user[1]);
                    update_user_meta($user_id,'last_name',$data_new_user[2]);
                    update_user_meta($user_id,'MemberSince',$data_new_user[3]);

                    update_user_meta($user_id,'OriginalRotaryDate',$data_new_user[4]);

                    update_user_meta($user_id,'Address',$data_new_user[5]);
                    update_user_meta($user_id,'City',$data_new_user[6]);
                    update_user_meta($user_id,'PostalCode',$data_new_user[7]);
                    update_user_meta($user_id,'Phone',$data_new_user[8]);
                    if($data_new_user[10]=="Y"){
                        update_user_meta($user_id,'OnlineAccountwithMyRotary',1);
                    }
                    if($data_new_user[11]=="Y"){
                        update_user_meta($user_id,'AgeDataAvailable',1);
                    }
                    if($data_new_user[12]=="Y"){
                        update_user_meta($user_id,'SatelliteMember',1);
                    }

                    update_user_meta($user_id,'RotaryClubID',$ClubID);


                    switch_to_blog($BlogID);
                    add_existing_user_to_blog( array( 'user_id' => $user_id, 'role' => 'subscriber'));
                    restore_current_blog();

                }


            $myUserCounter++;
        }
    }


    wp_reset_query();

    switch_to_blog($BlogID);
    $args = array (
        'exclude' => 0,
    );
    $wp_user_query = new WP_User_Query($args);
    $clubAuthors = $wp_user_query->get_results();

    if (!empty($clubAuthors)) {

        wp_delete_user( $clubAuthors->ID, $reassign = null );

    }

    add_existing_user_to_blog( array( 'user_id' => $newUserObject->ID, 'role' => 'subscriber'));
    restore_current_blog();
}


?>
<?php get_template_part('content', 'DashboardHeader'); ?>



    <section id="body" class="body">
    <div class="masterHeader row m-0">
        <div class="title col-md-6 col-12">
            <p>Members</p>
        </div>
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
                    <label>Select Club</label>
                </div>
                <div class="col-md-10">
                    <select id="clubID" class="form-control" name="clubID" required>
                        <option value="">Select Club</option>
                        <?php
                        $args = array(
                            'post_type' => 'clubs',
                            'posts_per_page' => -1,
                        );
                        query_posts( $args );

                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                ?>
                                <option value="<?php echo get_the_ID();?>">
                                    <?php the_title();?>
                                </option>
                            <?php
                            endwhile;
                        else :
                        endif;

                        ?>
                    </select>
                </div>
            </div>
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
                        if(! is_wp_error( $user ) && !empty($_POST['fileUrl'])){?>
                            <span id="message--success" class="success">User data updated successfully</span>

                        <?php }
                        if(is_wp_error( $user )  && !empty($_POST['fileUrl'])){
                           ?>
                            <span id="message--error" class="error">User data updated failed</span>
                        <?php }
                    ?>
                </div>
            </div>

            <div class="row" style="margin-bottom: 15px; text-align: center">
                <div class="col-md-6">
                    <input id="import" type="submit" value="Import" name="Import" class="rwmb-button action--btn">
                </div>
                <div class="col-md-6">
                    <input id="replace" type="submit" value="Replace" name="Replace" class="rwmb-button action--btn">
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
get_template_part('content', 'DashboardFooter');