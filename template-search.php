<?php
/**
 * Template Name: Search
 */

get_header();
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
                    <h1>Search</h1>
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

    <!-- Body BEGIN -->
    <section class="body mt-5 mb-5">
    <!-- Content -->
    <div class="container">
    <!-- Ad Container BEGIN -->
    <div class="adContainer mt-5 mb-5">
        <div class="m-auto">
            <?php
            $args = array(
                'post_type' => 'ads',
                'posts_per_page'=>1,
                'orderby'        => 'rand',
                'meta_query' => array(
                    array(
                        'key'     => 'DisplayOptionList',
                        'value'   => 'innerPages',
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
    <!-- Ad Container END -->
    <?php wp_reset_query()?>
    <div class="EBAMembers row">
    <!-- Header BEGIN -->
    <div class="header row m-0">
        <h2 class="title col-6"><strong>EBA</strong> Members</h2>
        <!-- Sup Options BEGIN-->
        <div class="options col-6 m-0 row justify-content-end">
            <!-- Sort By -->
            <div class="dropdown" style="display: none;">
                <button
                    class="btn dropdown-toggle"
                    type="button"
                    id="sortBy"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    Sort by
                    <em class="fal fa-sort-shapes-down"></em>
                </button>
                <div class="dropdown-menu" aria-labelledby="sortBy">
                    <a class="dropdown-item" href="#">Sort by 1</a>
                    <a class="dropdown-item" href="#">Sort by 2</a>
                    <a class="dropdown-item" href="#">Sort by 3</a>
                </div>
            </div>
            <!-- Grid Style -->
            <!--                         <a class="grid btn active">
                                        <em class="fal fa-grip-horizontal"></em>
                                    </a>
                                     List Style
                                    <a class="list btn">
                                        <em class="fal fa-bars"></em>
                                    </a> -->
        </div>
        <!-- Sup Options END-->
    </div>
    <!-- Header END -->

    <!-- Members List BEGIN-->
    <div class="row m-0 membersContainer">
    <?php
    $keyword=$_GET['keyword'];
    $sector=$_GET['sector'];
    $activity=$_GET['activity'];
    $sub=$_GET['sub'];
    $city=$_GET['city'];
    $area=$_GET['area'];
    $committee=$_GET['committee'];
    $council=$_GET['council'];
    $ArrayIds=[];
    $queryArray=[];
    $userIds=[];
    $uniqueQueryArray=array();
    $searchelements=0;
    if(!empty($keyword)){

        $args = array(
            'post_type' => 'member',
            'posts_per_page'=>-1,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key'     => 'IndividualData',
                    'value'   => $keyword,
                    'compare' => 'LIKE',
                ),
                array(
                    'key'     => 'CorporateData',
                    'value'   => $keyword,
                    'compare' => 'Like',
                ),

            ),
        );


        query_posts( $args );

        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                array_push($ArrayIds,get_the_ID());
            endwhile;
        else :
        endif;

        if(empty($ArrayIds)){
            wp_reset_query();
            $args = array(
                'post_type' => 'member',
                'posts_per_page'=>-1,
                's'=>$keyword,
            );
            query_posts( $args );
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    array_push($ArrayIds,get_the_ID());
                endwhile;
            else :
            endif;
        }
        $searchelements++;
    }
    if(!empty($sector)){

        $args = array(
            'post_type' => 'member',
            'posts_per_page'=>-1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'membercategory',
                    'field'    => 'slug',
                    'terms'    => $sector,
                ),
            ),
        );
        query_posts( $args );
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                array_push($ArrayIds,get_the_ID());
            endwhile;
        else :
        endif;
        $searchelements++;
    }
    if(!empty($activity)){

        $args = array(
            'post_type' => 'member',
            'posts_per_page'=>-1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'membercategory',
                    'field'    => 'slug',
                    'terms'    => $activity,
                ),
            ),
        );
        query_posts( $args );
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                array_push($ArrayIds,get_the_ID());
            endwhile;
        else :
        endif;
        $searchelements++;
    }
    if(!empty($sub)){

        $args = array(
            'post_type' => 'member',
            'posts_per_page'=>-1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'membercategory',
                    'field'    => 'slug',
                    'terms'    => $sub,
                ),
            ),
        );
        query_posts( $args );
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                array_push($ArrayIds,get_the_ID());
            endwhile;
        else :
        endif;
        $searchelements++;
    }
    if(!empty($city)){

        $args = array(
            'post_type' => 'member',
            'posts_per_page'=>-1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'memberlocation',
                    'field'    => 'slug',
                    'terms'    => $city,
                ),
            ),
        );
        query_posts( $args );
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                array_push($ArrayIds,get_the_ID());
            endwhile;
        else :
        endif;
        $searchelements++;
    }
    if(!empty($area)){

        $args = array(
            'post_type' => 'member',
            'posts_per_page'=>-1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'memberlocation',
                    'field'    => 'slug',
                    'terms'    => $area,
                ),
            ),
        );
        query_posts( $args );
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                array_push($ArrayIds,get_the_ID());
            endwhile;
        else :
        endif;
        $searchelements++;
    }
    if(!empty($committee)){

        $args = array(
            'post_type' => 'member',
            'posts_per_page'=>-1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'memberofcommittee',
                    'field'    => 'slug',
                    'terms'    => $committee,
                ),
            ),
        );
        query_posts( $args );
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                array_push($ArrayIds,get_the_ID());
            endwhile;
        else :
        endif;
        $searchelements++;
    }
    if(!empty($council)){

        $args = array(
            'post_type' => 'member',
            'posts_per_page'=>-1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'memberofbusinesscouncil',
                    'field'    => 'slug',
                    'terms'    => $council,
                ),
            ),
        );
        query_posts( $args );
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                array_push($ArrayIds,get_the_ID());
            endwhile;
        else :
        endif;
        $searchelements++;
    }

    if($searchelements!=1){
        for($i = 0; $i < count($ArrayIds); $i++) {
            for($j = $i + 1; $j < count($ArrayIds); $j++) {
                if($ArrayIds[$i] == $ArrayIds[$j]){
                    array_push($queryArray,$ArrayIds[$j] );
                }
            }

        }
    }
    else{
        $queryArray=$ArrayIds;
    }

    $uniqueQueryArray= array_unique($queryArray);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if(!empty($uniqueQueryArray)){
    $newargs = array(
        'post_type' => 'member',
        'posts_per_page'=>9,
        'post__in' => $uniqueQueryArray,
         'paged' => $paged 
    );
    query_posts( $newargs );
    if ( have_posts() ) :
    while ( have_posts() ) : the_post();
    ?>
    <!-- Member Item BEGIN -->
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="memberItem">
            <!-- Avatar Image -->
            <?php
            $memberType= get_post_meta(get_the_ID(),'MemberType',true);
            if($memberType=="individual"){
                $IndividualDataValues=get_post_meta(get_the_ID(),'IndividualData',true);
                $user_id=$IndividualDataValues['IndividualUserInformation']['IndividualUser'];
                $user_image_ids = get_user_meta( $user_id, 'custom_avatar', false ); // Media fields are always multiple.
                foreach ( $user_image_ids as $user_image_id ) {
                    $user_image = RWMB_Image_Field::file_info( $user_image_id, array( 'size' => 'thumbnail' ) );
                    $user_avatar=$user_image['full_url'];
                }
                $userPosition=$IndividualDataValues['IndividualUserInformation']['IndividualPosition'];
                $CompanyName=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyName'];
                $Facebook=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualSocial']['IndividualFacebook'];
                $Linkedin=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualSocial']['IndividualLinkedin'];
                $Mail=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualSocial']['IndividualMail'];
                $CompanyPhone=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualCompanyPhone'];
                $CompanyFax=$IndividualDataValues['IndividualCompanyInformation']['IndividualCompanyContact']['IndividualCompanyFax'];


            }
            else{
                $CorporateDataValues=get_post_meta(get_the_ID(),'CorporateData',true);
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
                $Facebook=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateSocial']['CorporateFacebook'];
                $Linkedin=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateSocial']['CorporateLinkedin'];
                $Mail=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateSocial']['CorporateMail'];
                $CompanyPhone=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateCompanyPhone'];
                $CompanyFax=$CorporateDataValues['CorporateCompanyInformation']['CorporateCompanyContact']['CorporateCompanyFax'];

            }
            ?>
            <div class="avatarImageContainer">
                <a href="<?php echo get_permalink();?>">
                    <div
                        class="avatarImage"
                        style="background-image: url('<?php echo $user_image["full_url"];?>')";
                    ></div>
            </a>
            <?php
            $categoryTerms=wp_get_post_terms(get_the_ID(),'membercategory');
            foreach ($categoryTerms as $categoryTerm) {
                if ($categoryTerm->parent == 0){ //check for parent terms only
                    $categoryTermName=$categoryTerm->name;
                    $categoryTermSlug=$categoryTerm->slug;
                }
            }
            ?>
            <a href="<?php echo get_page_link(80).'/?sector='.$categoryTermSlug;?>" type="button" class="btn"><?php echo $categoryTermName;?></a>
        </div>
        <!-- Info -->
        <div class="infoContainer">
            <a href="<?php echo get_permalink();?>">
                <?php $user_info = get_userdata($user_id);?>
                <div class="title"><?php echo $user_info->first_name." ".$user_info->last_name; ?></div>
            </a>
            <a href="<?php echo get_permalink();?>">
                <div class="jobTitle"><?php echo $userPosition?></div>
            </a>
            <a href="<?php echo get_permalink();?>">
                <div class="companyName"><?php echo $CompanyName;?></div>
            </a>
            <div class="options row">
                <div class="col contactOptions">
                    <a href="<?php echo $Linkedin;?>"><em class="fab fa-linkedin-in"></em></a>
                    <a href="<?php echo $Facebook;?>"><em class="fab fa-facebook-f"></em></a>
                    <a href="<?php echo $CompanyPhone;?>"><em class="fa fa-phone"></em></a>
                    <a href="<?php echo $CompanyFax;?>"><em class="fa fa-print"></em></a>
                    <a href="<?php echo $Mail;?>"><em class="fa fa-envelope"></em></a>
                </div>
                <a href="<?php echo get_permalink();?>" type="button" class="btn">More</a>
            </div>
        </div>
    </div>
    </div>

    <!-- Member Item END -->
    <?php
    endwhile;
    else :
    endif;
    }
    else{
        ?>
        <div ><h2 >Sorry No Match Found!</h2></div>
    <?php }
    ?>
    </div>
    <!-- Members List END-->
    </div>

    </div>
    </section>
<?php

?>


    <!-- Body END -->
<?php
get_footer();
