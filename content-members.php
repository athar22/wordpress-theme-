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
<?php wp_reset_query()?>
<div class="EBAMembers row">
<!-- Header BEGIN -->
<div class="header row m-0">
    <h2 class="title col-6"><strong>EBA</strong> Members</h2>
    <!-- Sup Options BEGIN-->
    <div class="options col-6 m-0 row justify-content-end">
        <!-- Sort By -->
        <div class="dropdown" style="display:none;">
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
<!-- Header END -->
    <?php
    $adsArray=[];
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
<!-- Members List BEGIN-->
    <?php wp_reset_query()?>
<div class="row m-0 membersContainer">
    <?php
	 $listStyle="display:flex; min-height:unset;";
    $adsIndex=0;
    $adsCounter=0;
    $args = array(
        'post_type' => 'member',
        'posts_per_page'=>24,
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    );
    query_posts( $args );
    if ( have_posts() ) :
    while ( have_posts() ) : the_post();

    ?>
    <!-- Member Item BEGIN -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 <?php if($_GET['style']=='list'){echo 'col-lg-12 col-md-12';}?>">
            <div class="memberItem <?php if($_GET['style']=='list'){echo 'row m-0';}?>" style="<?php if($_GET['style']=='list'){echo $listStyle;}?>">
            <!-- Avatar Image -->
            <?php
            $memberType= get_post_meta(get_the_ID(),'MemberType',true);
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
                    <div class="col contactOptions" style="<?php if($_GET['style']=='list'){echo 'margin-left:auto;';}?>">
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
    else :
    endif;
    ?>

</div>
<!-- Members List END-->
    
	<div style="width:100%; text-align:center; ">
        <h5><a style="border-radius: 10px;
    background-color: #0a3d80;
    color: white;
    padding: 8px 25px;" href="<?php echo get_post_type_archive_link('member');?>" >VIEW ALL MEMBERS</a></h5>
    </div>
</div>

</div>
</section>
<!-- Body END -->