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
                    <h1><?php the_title();?></h1>
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
    <!-- Hero Header END -->

<?php wp_reset_query();?>
    <!-- Body BEGIN -->
    <section class="body mt-5 mb-5">
    <!-- Content -->
    <div class="container">
    <div class="row">
    <!-- Contained BEGIN -->
    <div class="col-md-8 col-sm-12 mb-md-0 mb-sm-5">
        <!-- Single News Begin -->
       <?php the_post(); the_content();?>
        <!-- Single News END -->
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

<?php get_footer();?>