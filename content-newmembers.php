<!-- Hero Header BEGIN -->
<section class="heroHeader">
<!-- Background -->
<div class="backgroundImage"></div>

<!-- Content -->
<div class="container">
<!-- Header Row BEGIN -->
<div class="row">
    <!-- Title BEGIN -->
    <div class="col-md-5 col-sm-12 mr-auto mb-sm-5">
        <h1 class="font-weight-light">
            <span class="font-weight-bold">EBA</span> Members
            <span class="font-weight-bold">Directory</span>
        </h1>
      
    </div>
    <!-- Title END -->
    <!-- Ad Container BEGIN -->
    <div class="col-md-3 col-sm-12 mb-sm-5">
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
                    $DisplayOptionList = rwmb_meta( 'DisplayOptionList' );
                    //print_r($DisplayOptionList);
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

<!-- Search Form BEGIN -->
	
<div class="searchForm mt-3 mb-3">
<form action="<?php echo get_post_type_archive_link('member');?>" method="get">
    <div class="form-row">
        <div class="col-lg-10 col-12 mb-3 mb-lg-0">
            <div class="form-group m-md-0 mb-sm-3">
                <label for="keywords">Keywords</label>
                <input
                    type="text"
                    name="names"
                    class="form-control"
                    id="keywords"
                    placeholder="Member Name "
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
	
<!-- Search Form END -->
<script>

</script>


<!-- New Members Section BEGIN -->
<div class="newMembers mt-5">
    <h2 class="title"><strong>New</strong> Members</h2>
    <div class="row membersContainer">
        <?php
        $args = array(
            'post_type' => 'member',
            'posts_per_page'=>4,
			'meta_query' => array(
            'arrange' => array(
                'key' => 'AddingDate',
                'compare' => 'EXISTS',
				'type'    => 'DATE'
            ),
            
        ),
    'orderby' => array(
            'arrange' => 'DESC',
            
        )
        );
        query_posts( $args );
        if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        ?>
        <!-- Member Item BEGIN -->
        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
            <div class="memberItem">
                <?php

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

                }

                ?>
                <!-- Avatar Image -->
                <div
                    class="avatarImage"
					<?php
						if(isset($user_avatar) === true && $user_avatar !== '') { 
					?>
					 
					style="background-image: url('<?php echo $user_avatar;?>')"
					 
					 <?php
						}
					?>
                    >
                   
                    </div>
                   
                <!-- Info -->
                <div class="infoContainer">
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
                   
					<div class=" contactOptions">
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
                </div>
            </div>
        </div>
        <!-- Member Item END -->

        <?php
        endwhile;
        else :
        endif;
        ?>
    </div>
</div>
<!-- New Members Section END -->
</div>
</section>
<!-- Hero Header END -->