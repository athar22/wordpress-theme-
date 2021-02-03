<?php


get_header();
$user_id=$_GET['user_id'];
$member_id=$_GET['member_id'];
if(empty($_GET['style'])){
    $_GET['style']="grid";
}

?>
    <!-- Hero Header BEGIN -->
    <section class="heroHeader" style="    padding-bottom: 0px;">
        <!-- Background -->
        <div class="backgroundImage"></div>

        <!-- Content -->
        <div class="container">
            <!-- Header Row BEGIN -->
            <div class="row">

            </div>
            <!-- Header Row END -->
        </div>
		<!-- Search Form BEGIN -->
<div class="container">
<div class="searchForm  col-lg-12 col-12 mb-3 mb-lg-0">
<form action="<?php echo get_post_type_archive_link('member');?>" method="get">
    <div class="form-row">
        <div class="col-lg-10 col-12 mb-3 mb-lg-0">
            <div class="form-group m-md-0 mb-sm-3">
                <label for="keywords">keywords</label>
                <input
                    type="text"
                    name="names"
                    class="form-control"
                    id="keywords"
                    placeholder="Member Name 
"
                    />
            </div>
        </div>
        <div class="col-lg-2 col-sm-12">
            <div class="form-group m-0 submitContainer">
                <button type="submit" class="btn btn-primary submit">
                    <em class="fal fa-search"></em>
                    Search
                </button>
            </div>
        </div>
        <div class="col-sm-12">
            <!-- Button trigger modal -->
            <button
                type="button"
                class="btn"
                data-toggle="modal"
                data-target="#exampleModal"
                >
                + Advanced Search
            </button>
        </div>
    </div>
</form>

<!-- Search Modal -->

</div>
        
		</div>	
<!-- Search Form END -->

    </section>
    <!-- Hero Header END -->
    
    <!-- Body BEGIN -->
    <section class="body mt-5 mb-5" >
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
                                'value'   => 'home',
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


            <!-- Members List END-->

        </div>

        </div>
    </section>

<?php wp_reset_query()?>
    <!-- Body BEGIN -->
    <section class="body mt-5 mb-5">
    <!-- Content -->
    <div class="container">

    <div class="EBAMembers row">
    <!-- Header BEGIN -->
    <?php
    $adsArray=[];
    $adsIndex=0;
    $adsCounter=0;
    $args = array(
        'post_type' => 'ads',
        'posts_per_page'=>-1,
        'orderby'        => 'rand',
        'meta_query' => array(
            array(
                'key'     => 'DisplayOptionList',
                'value'   => 'home',
                'compare' => 'IN',
            ),
        ),
    );
    query_posts( $args );
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            array_push($adsArray,get_the_ID());
        endwhile;
    else :
    endif;
    ?>
       <?php echo  wp_reset_query();?>
       <?php

        $listStyle="display:flex; min-height:unset;";
        if(isset($_GET['keyword'])||isset($_GET['sector'])||isset($_GET['activity'] )||isset($_GET['names'])||isset($_GET['companies'])) {
            //$keyword = $_GET['keyword'];
            $sector = $_GET['sector'];
            $activity = $_GET['activity'];
            $member_names = $_GET['names'];
			$company_name = $_GET['companies'];
            $ArrayIds = [];
            $queryArray = [];
            $userIds = [];
            $uniqueQueryArray = array();
            $searchelements = 0;
			
			//search name 
			 if (!empty($member_names)) {
        $args = array("post_type" => "member", "s" => $member_names);
         $query = get_posts( $args );
        // print_r($query);
		foreach($query as $post ){
			//array_push($ArrayIds, get_the_ID());
		//echo	$post->post_title;
		//echo	$post->ID;
		 array_push($ArrayIds, get_the_ID());
			
		}
           $searchelements++;      
                  
            }			
			//end search name
			//start company search
			if (!empty($company_name)) {

                $args = array(
                    'post_type' => 'member',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => 'IndividualCompanyName',
                            'value' => $company_name,
                            'compare' => 'LIKE',
                        ),
                        array(
                            'key' => 'CorporateCompanyName',
                            'value' => $company_name,
                            'compare' => 'LIKE',
                        ),

                    ),
                );


                query_posts($args);

                if (have_posts()) :
                    while (have_posts()) : the_post();
                        array_push($ArrayIds, get_the_ID());
                    endwhile;
                else :
                endif;
                
                    wp_reset_query();
                if (empty($ArrayIds)) {
                    
                    //wp_reset_query();
                    $args = array(
                        'post_type' => 'member',
                        'posts_per_page' => -1,
                        's' => $company_name,
                        
                    );
                    query_posts($args);
                   
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            array_push($ArrayIds, get_the_ID());
                        endwhile;
                    else :
                    endif;   wp_reset_query();
                }
                $searchelements++;
            }
			//end company search
            if (!empty($keyword)) {

                $args = array(
                    'post_type' => 'member',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        'relation' => 'OR',
                        array(
                            'key' => 'IndividualCompanyName',
                            'value' => $keyword,
                            'compare' => 'LIKE',
                        ),
                        array(
                            'key' => 'CorporateCompanyName',
                            'value' => $keyword,
                            'compare' => 'LIKE',
                        ),

                    ),
                );


                query_posts($args);

                if (have_posts()) :
                    while (have_posts()) : the_post();
                        array_push($ArrayIds, get_the_ID());
                    endwhile;
                else :
                endif;
                
                    wp_reset_query();
                if (empty($ArrayIds)) {
                    
                    //wp_reset_query();
                    $args = array(
                        'post_type' => 'member',
                        'posts_per_page' => -1,
                        's' => $keyword,
                        
                    );
                    query_posts($args);
                   
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            array_push($ArrayIds, get_the_ID());
                        endwhile;
                    else :
                    endif;   wp_reset_query();
                }
                $searchelements++;
            }
            if (!empty($sector)) {
				
         
		 $args =( array(
    'post_type' => 'member',
   'tax_query' => array(
	'relation' => 'OR',
        array (
            'taxonomy' => 'membercategory',
            'field' => 'slug',
            //'terms' => 'information-technology',
			'terms' => $sector,
			 'compare' => 'LIKE',
			 
        )
    ),
) 
);
			
                query_posts($args);
				//print_r(query_posts($args));
                if (have_posts()) :
                    while ( have_posts()) : the_post();
                        array_push($ArrayIds, get_the_ID());
                    endwhile;
                else :
                endif;
                $searchelements++;   wp_reset_query();
            }
            if (!empty($activity)) {

                $args =( array(
    'post_type' => 'member',
   'tax_query' => array(
	'relation' => 'OR',
        array (
            'taxonomy' => 'membercategory',
            'field' => 'slug',
            //'terms' => 'information-technology',
			'terms' => $activity,
			 'compare' => 'LIKE',
			 
        )
    ),
) 
);
                query_posts($args);
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        array_push($ArrayIds, get_the_ID());
                    endwhile;
                else :
                endif;
                $searchelements++;   wp_reset_query();
            }
           

            if ($searchelements != 1) {
                for ($i = 0; $i < count($ArrayIds); $i++) {
                    for ($j = $i + 1; $j < count($ArrayIds); $j++) {
                        if ($ArrayIds[$i] == $ArrayIds[$j]) {
                            array_push($queryArray, $ArrayIds[$j]);
                        }
                    }

                }
            } else {
                $queryArray = $ArrayIds;
            }

                $uniqueQueryArray = array_unique($queryArray);


            if (!empty($uniqueQueryArray)) {
                $newargs = array(
                    'post_type' => 'member',
                    'posts_per_page' => 24,
					'orderby' => 'title',
                     'order'   => 'ASC',
                    'post__in' => $uniqueQueryArray,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                );
                $searchq=query_posts($newargs);

            }
        }
        else{
            $args = array(
                'post_type' => 'member',
                'posts_per_page'=>24,
				'orderby' => 'title',
                'order'   => 'ASC',
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
            );
            $searchq=query_posts( $args );
        }
        if ( !empty($searchq) || $searchq!="" ) {
        ?>
    <div class="header row m-0">
        
            <?php 
			
            if(isset($_GET['keyword'])||isset($_GET['sector'])||isset($_GET['activity'])) {
				$uniqueQueryArraycounter=0;
				foreach ($uniqueQueryArray as $uniqueQueryArrayID){
					$uniqueQueryArraycounter++;
				}
            ?>
            <h3>Search Results For | "
            <?php 
             echo$_GET['keyword']." "; echo $_GET['sector']." "; echo $_GET['activity']." ";
            ?> " | <?php echo $uniqueQueryArraycounter; ?> Results found
            </h3>
            <?php }?>
        
        <!-- Sup Options BEGIN-->
        <div class="options col-12 m-0 row justify-content-end">
            <!-- Sort By -->
            <div class="dropdown" ">
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
                    <a class="dropdown-item" href="<?php echo get_post_type_archive_link('member').'/?sort=col-9 align-self-end'?>">Name Ascending</a>
                    <a class="dropdown-item" href="<?php echo get_post_type_archive_link('member').'/?sort=namedescending'?>">Name Descending</a>
                   <!-- <a class="dropdown-item" href="<?php echo get_post_type_archive_link('member').'/?sort=sectorascending'?>">Sector Ascending</a>
                    <a class="dropdown-item" href="<?php echo get_post_type_archive_link('member').'/?sort=sectordescending'?>">Sector Descending</a>-->

                </div>
            </div>
            <?php
            global $wp;
            $clink= home_url( $wp->request )
            ?>
            <!-- Grid Style -->
            <a href="javascript:;" class="grid btn <?php if($_GET['style']=='grid'){echo 'active';}?>">
                        <em class="fal fa-grip-horizontal"></em>
                    </a>

            <a href="javascript:;" class="list btn <?php if($_GET['style']=='list'){echo 'active';}?>">
                        <em class="fal fa-bars"></em>
                    </a>
        </div>
        <!-- Sup Options END-->
    </div>
    <?php }?>
    <!-- Header END -->
    
    <!-- Members List BEGIN-->
    <div class="row m-0 membersContainer">

         



        <?php
        if ( !empty($searchq) || $searchq!="" ) {
           //if ($_GET['arraang']== 'Ascending' ){
			  // $args = array( 'post_type' => 'member',
			   //'orderby'=>'title',
			   //'order'=>'ASC');
              //$loop = new WP_Query( $args );
            // while ( $loop->have_posts() ) : $loop->the_post();
		  // }
		  wp_reset_query();
		   if($_GET['sort']== 'namedescending')
		   {
			   $args = array(
    'post_type' => 'member',
    'orderby'   => 'title menu_order',
    'order'     => 'DESC',
	//'number_posts' => 100
	'post__in' => $uniqueQueryArray,
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
	
);

                //$loop = new WP_Query( $args );
              // while ( $loop->have_posts() ) : $loop->the_post(); 
		   }
         $query = new WP_Query( $args );
		 //print_r($query);
		    while ( $query->have_posts() ) : $query->the_post(); 
        //while ( have_posts() ) : the_post();
        ?>
        <!-- Member Item BEGIN -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 <?php if($_GET['style']=='list'){echo 'col-lg-12 col-md-12';}?>">
            <div class="memberItem <?php if($_GET['style']=='list'){echo 'row m-0';}?>" style="<?php if($_GET['style']=='list'){echo $listStyle;}?>">
                <!-- Avatar Image -->
                <?php
                $user_avatar="";
                $memberType= get_post_meta(get_the_ID(),'MemberType',true);
                if($memberType=="individual"){

                    $user_id=rwmb_meta('IndividualUser' ,$args , get_the_ID());
                    $user_image_ids = get_user_meta( $user_id, 'custom_avatar', false ); // Media fields are always multiple.
                    $user_avatar=$user_image_ids[0];
                    $userPosition=rwmb_meta('IndividualPosition' ,$args , get_the_ID());
                    $CompanyName=rwmb_meta('IndividualCompanyName' ,$args , get_the_ID());
                    $Linkedin=rwmb_meta('linkedin' ,$args , get_the_ID());
                    $Facebook=rwmb_meta('Facebook' ,$args , get_the_ID());
                    $CompanyPhone=rwmb_meta('IndividualCompanyPhone' ,$args , get_the_ID());
                    $CompanyFax=rwmb_meta('IndividualCompanyFax' ,$args , get_the_ID());
                    $Mail=rwmb_meta('IndividualMail' ,$args , get_the_ID());
                    $membercategory=rwmb_meta('membercategory' ,$args , get_the_ID());

                }
                else{
                    $user_id=rwmb_meta('CorporateUser1' ,$args , get_the_ID());
                    $user_image_ids = get_user_meta( $user_id, 'custom_avatar', false ); // Media fields are always multiple.
                    $user_avatar=$user_image_ids[0];
                    $userPosition=rwmb_meta('CorporatePosition1' ,$args , get_the_ID());
                    $CompanyName=rwmb_meta('CorporateCompanyName' ,$args , get_the_ID());
                    $Linkedin=rwmb_meta('CorporateLinkedin' ,$args , get_the_ID());
                    $Facebook=rwmb_meta('CorporateFacebook' ,$args , get_the_ID());
                    $CompanyPhone=rwmb_meta('CorporateCompanyPhone' ,$args , get_the_ID());
                    $CompanyFax=rwmb_meta('CorporateCompanyFax' ,$args , get_the_ID());
                    $Mail=rwmb_meta('CorporateMail' ,$args , get_the_ID());
                    $membercategory=rwmb_meta('membercategory' ,$args , get_the_ID());

                }
                ?>
                <div class="avatarImageContainer <?php if($_GET['style']=='list'){echo 'col-12 col-sm-3 p-0';}?>">
                    <a href="<?php echo get_permalink();?>">
                        <div
                        class="avatarImage"
                            style="<?php if($_GET['style']=='list'){echo 'height:100%;';}?> 
								   
								   <?php
						if(isset($user_avatar) === true && $user_avatar !== '') { 
						?>

						background-image: url('<?php echo $user_avatar;?>')

						 <?php
							}
						?>

						";
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
                <a  type="button" class="btn"><?php echo $membercategory;?></a>
                <?php
                if($memberType!="individual"){
                    ?>
                    <a  type="button" class="btn corporate">Corporate</a>
                <?php }?>
            </div>
            <!-- Info -->
            <div class="infoContainer <?php if($_GET['style']=='list'){echo 'col-12 col-sm-9 p-4';}?>">
                <a href="<?php echo get_permalink();?>">
                    <?php $user_info = get_userdata($user_id);?>
                    <div class="title">
                    <?php 
						$title_unexplode = get_the_title();
						$title_explode = explode('.', $title_unexplode );
						$title_a = $title_explode[0];
						$title_b = $title_explode[1];
						echo $title_a;
						echo ". ";
						echo $title_b;
					?>
                    </div>
                </a>
                <a href="<?php echo get_permalink();?>">
                    <div class="jobTitle"><?php echo $userPosition?></div>
                </a>
                <a href="<?php echo get_permalink();?>">
                    <div class="companyName"><?php echo $CompanyName;?></div>
                </a>
                <div class="options row">
                    <div class="<?php if($_GET['style']=='grid'){echo 'col';}?> contactOptions" style="<?php if($_GET['style']=='list'){echo 'margin-left:auto;';}?>">
                        <?php if(!empty($Linkedin)){?>
                                        <a href="<?php echo $Linkedin;?>" target="_blank" ><em class="fab fa-linkedin-in"></em></a>
											<?php }; ?>
										<?php if(!empty($Facebook)){?>
                                        <a href="<?php echo $Facebook;?>" target="_blank"><em class="fab fa-facebook-f"></em></a>
										<?php }; ?>
										<?php if(!empty($CompanyPhone)){?>
                                        <a href="tel:<?php echo $CompanyPhone;?>"><em class="fa fa-phone"></em></a>
										<?php }; ?>
										<?php if(!empty($CompanyFax)){?>
                                        <a href=" <?php echo $CompanyFax;?>"><em class="fa fa-print"></em></a>
										<?php }; ?>
										<?php if(!empty($Mail)){?>
                                        <a href="mailto: <?php echo $Mail;?>"><em class="fa fa-envelope"></em></a>
										<?php }; ?>
                    </div>
                    <a href="<?php echo get_permalink();?>" type="button" class="btn" style="<?php if($_GET['style']=='list'){echo 'margin:0;';}?>">More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Member Item END -->
    <?php

    if(($adsCounter%6)==5){

        if(isset($adsArray[$adsIndex])){
            ?>
            <div class="col-md-12">
                <div class="adContainer mt-5 mb-5">
                    <div class="m-auto">
                        <img src="<?php echo get_the_post_thumbnail_url($adsArray[$adsIndex]);?>">
                    </div>
                </div>
            </div>
        <?php
        }
        $adsIndex++;
    }
    $adsCounter++;
    endwhile;
    }else {
        ?>
        <div style="text-align:center;width: 100%;">
            <h3>Sorry No Match Found!</h3>
        </div>
        <?php 

    }
   
    ?>


    </div>
    <!-- Members List END-->

    </div>

    </section>
<?php
if ( !empty($searchq) || $searchq!="" ) {
           
if ( function_exists('wp_bootstrap_pagination') )
    wp_bootstrap_pagination();
}
?>

    <!-- Body END -->


<?php
get_footer();