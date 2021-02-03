<?php


get_header();
$user_id=$_GET['user_id'];
$member_id=$_GET['member_id'];
?>
<?php
$memberType= get_post_meta($member_id,'MemberType',true);
if($memberType=="individual"){
    $IndividualDataValues=get_post_meta($member_id,'IndividualData',true);
    $user_id=$IndividualDataValues['IndividualUserInformation']['IndividualUser'];
    $user_image_ids = get_user_meta( $user_id, 'custom_avatar', false ); // Media fields are always multiple.
    foreach ( $user_image_ids as $user_image_id ) {
        $user_image = RWMB_Image_Field::file_info( $user_image_id, array( 'size' => 'thumbnail' ) );
        $user_avatar=$user_image['full_url'];
    }
    $userPosition=$IndividualDataValues['IndividualUserInformation']['IndividualPosition'];
    $CompanyName=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyName'];
    $CompanyBio=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyBio'];
    $CompanyAddress=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualCompanyAddress'];
    $CompanyPhone=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualCompanyPhone'];
    $CompanyFax=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualCompanyFax'];
    $CompanyWebsite=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualCompanyWebsite'];

    $CompanyLogo=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyLogo'];
    $Facebook=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualSocial']['IndividualFacebook'];
    $Linkedin=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualSocial']['IndividualLinkedin'];
    $Mail=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualSocial']['IndividualMail'];

}
else{
    $CorporateDataValues=get_post_meta($member_id,'CorporateData',true);
    $CorporateUserInformationValues=$CorporateDataValues['CorporateUserInformation'];
    foreach($CorporateUserInformationValues as $CorporateUserInformationValue){
        if($CorporateUserInformationValue['MainMember']==1){
            $user_id=$CorporateUserInformationValue['CorporateUser'];
            $userPosition=$CorporateUserInformationValue['CorporatePosition'];

        }
    }
    $user_image_ids = get_user_meta( $user_id, 'custom_avatar', false ); // Media fields are always multiple.
    foreach ( $user_image_ids as $user_image_id ) {
        $user_image = RWMB_Image_Field::file_info( $user_image_id, array( 'size' => 'thumbnail' ) );
        $user_avatar=$user_image['full_url'];
    }
    $CompanyName=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyName'];
    $CompanyBio=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyBio'];
    $CompanyAddress=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateCompanyAddress'];
    $CompanyPhone=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateCompanyPhone'];
    $CompanyFax=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateCompanyFax'];
    $CompanyWebsite=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateCompanyWebsite'];
    $CompanyLogo=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyLogo'];
    $Facebook=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateSocial']['CorporateFacebook'];
    $Linkedin=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateSocial']['CorporateLinkedin'];
    $Mail=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateSocial']['CorporateMail'];

}
?>

    <!-- Hero Header BEGIN -->
    <section class="heroHeader">
        <!-- Background -->
        <div class="backgroundImage"></div>

        <!-- Content -->
        <div class="container">
            <!-- Header Row BEGIN -->
            <div class="row">
                <!-- Member Info BEGIN -->
                <div class="col-md-9 col-sm-12">
                    <div class="memberInfo row m-0">
                        <div class="col-md-4 col-sm-12 mb-md-0 mb-3">
                            <?php
                            $user_image_ids = get_user_meta( $user_id, 'custom_avatar', false ); // Media fields are always multiple.
                            foreach ( $user_image_ids as $user_image_id ) {
                                $user_image = RWMB_Image_Field::file_info( $user_image_id, array( 'size' => 'thumbnail' ) );
                                $user_avatar=$user_image['full_url'];
                            }

                            ?>
                            <img
                                src="<?php echo $user_avatar;?>"
                                alt="Placeholder"
                                />
                        </div>
                        <div class="col-md-8 col-sm-12 mt-auto mb-md-0 mb-5">
                            <div class="infoContainer mb-3">
                                <a href="#">
                                    <?php $user_info = get_userdata($user_id);?>
                                    <div class="title"><?php echo $user_info->first_name." ".$user_info->last_name; ?></div>
                                </a>
                                <a href="#">
                                    <div class="jobTitle"><?php echo $userPosition;?></div>
                                </a>
                                <a href="#">
                                    <div class="companyName"><?php echo $CompanyName;?></div>
                                </a>
                                <p class="my-2 address">
                                    <strong>Address:</strong> <?php echo $CompanyAddress?>
                                </p>
                                <p class="my-2 phone"><strong>Phone:</strong> <?php echo $CompanyPhone?></p>
                                <p class="my-2 fax"><strong>Fax:</strong> <?php echo $CompanyFax?></p>
                                <div class="options row">
                                    <div class="col contactOptions">
                                        <a href="<?php echo $Linkedin;?>"><em class="fab fa-linkedin-in"></em></a>
                                        <a href="<?php echo $Facebook;?>"><em class="fab fa-facebook-f"></em></a>
                                        <a href="<?php echo $CompanyPhone;?>"><em class="fa fa-phone"></em></a>
                                        <a href="<?php echo $CompanyFax;?>"><em class="fa fa-print"></em></a>
                                        <a href="<?php echo $Mail;?>"><em class="fa fa-envelope"></em></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
<?php wp_reset_query();?>
    <!-- Hero Header END -->

    <!-- Body BEGIN -->
    <section class="body mt-5 mb-5">
    <!-- Content -->
    <div class="container">
    <div class="row">
    <!-- Contained BEGIN -->
    <div class="col-md-8 col-sm-12 mb-md-0 mb-sm-5">
        <!-- News BEGIN -->
        <div class="news">
            <div class="mainTitle mb-3">
                <h2 class="title"><strong>Member</strong> News</h2>
            </div>
            <!-- News List BEGIN -->
            <div class="memberNewsList row m-0">
            <?php
            $args = array(
                'post_type' => 'news',
                'posts_per_page'=>6,
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
            );
            query_posts( $args );
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    ?>
                <!-- News Item with image BEGIN -->
                <div class="col-12 mb-2">
                    <div class="newsItem">
                        <!-- News Image -->
                        <div class="newsImageContainer">
                            <div
                                class="newsImage"
                                style="background-image: url(<?php echo get_the_post_thumbnail_url();?>)"
                                ></div>
                        </div>
                        <!-- Data -->
                        <div class="dataContainer">
                            <div class="date"><?php echo rwmb_meta( 'newsDate', $args, get_the_ID() );?></div>
                            <div class="title"><?php echo $user_info->first_name." ".$user_info->last_name; ?></div>
                            <p>
                                <?php the_title();?>
                            </p>
                            <div class="row m-0">
                                <a href="<?php echo get_the_permalink().'/?member_id='.$member_id.'&user_id='.$user_id;?>" type="button" class="btn mr-2"
                                    >+ Read More</a
                                    >
                            </div>
                        </div>
                    </div>
                </div>
                <!-- News Item with image END -->

                <?php
                endwhile;
            else :
            endif;
            ?>
            </div>
            <!-- News List END -->
        </div>
        <!-- News END -->
        <?php
        if ( function_exists('wp_bootstrap_pagination') )
            wp_bootstrap_pagination();
        ?>

    </div>
    <!-- Contained END -->

    <!-- Sidebar BEGIN -->
    <aside class="sidebarMain col-md-4 col-sm-12 mt-md-0 mt-5">




        <!-- Member of Committee BEGIN -->
        <div class="memberCommittee">
            <p class="title"><strong>Member</strong> of Committee</p>
            <ul>
                <?php
                $committeeTerms=wp_get_post_terms($member_id,'memberofcommittee');

                foreach ($committeeTerms as $committeeTerm) {
                    ?>
                    <li>
                        <p><?php echo $committeeTerm->name;?></p>
                    </li>
                <?php

                }

                ?>
            </ul>
        </div>
        <!-- Member of Committee END -->

        <!-- Member of Business Council BEGIN -->
        <div class="memberBusinessCouncil">
            <p class="title"><strong>Member</strong> of Business Council</p>
            <ul>
                <?php
                $councilTerms=wp_get_post_terms($member_id,'memberofbusinesscouncil');

                foreach ($councilTerms as $councilTerm) {
                    ?>
                    <li>
                        <p><?php echo $councilTerm->name;?></p>
                    </li>
                <?php

                }

                ?>
            </ul>
        </div>
        <!-- Member of Business Council END -->

        <!-- Ad Container BEGIN -->
       
                <?php
                $args = array(
                    'post_type' => 'ads',
                    'posts_per_page'=>3,
                    'orderby'        => 'rand',
                    'meta_query' => array(
                        array(
                            'key'     => 'DisplayOptionList',
                            'value'   => 'rightSidebar',
                            'compare' => 'IN',
                        ),
                    ),
                );
                query_posts( $args );
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        ?>
		 <div class="adContainer">
            <div class="m-auto">
                        <img src="<?php echo get_the_post_thumbnail_url();?>">
				</div>
        </div>
                    <?php
                    endwhile;
                else :
                endif;
                ?>
            
        <!-- Ad Container END -->
    </aside>
    <!-- Sidebar END-->
    </div>
    </div>
    </section>
    <!-- Body END -->


<?php
get_footer();
