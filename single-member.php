<?php
get_header();
$currentMemberId=get_the_ID();
?>
<?php
$memberType= get_post_meta(get_the_ID(),'MemberType',true);
$memberType= get_post_meta(get_the_ID(),'MemberType',true);
if($memberType=="individual"){

    $user_id=rwmb_meta('IndividualUser' ,$args , get_the_ID());
    $user_image_ids = get_user_meta( $user_id, 'custom_avatar', false ); // Media fields are always multiple.
    $user_avatar=$user_image_ids[0];

    $userPosition=rwmb_meta('IndividualPosition' ,$args , get_the_ID());
	$Bio=rwmb_meta('IndividualCompanyBio' ,$args , get_the_ID());
    $CompanyName=rwmb_meta('IndividualCompanyName' ,$args , get_the_ID());
    $Linkedin=rwmb_meta('IndividualLinkedin' ,$args , get_the_ID());
    $Facebook = rwmb_meta('IndividualFacebook' ,$args , get_the_ID());
    $CompanyPhone=rwmb_meta('IndividualCompanyPhone1' ,$args , get_the_ID());
	$CompanyPhone2=rwmb_meta('IndividualCompanyPhone2' ,$args , get_the_ID());
	$CompanyPhone3=rwmb_meta('IndividualCompanyPhone3' ,$args , get_the_ID());
    $CompanyFax=rwmb_meta('IndividualCompanyFax1' ,$args , get_the_ID());
    $Mail=rwmb_meta('IndividualMail' ,$args , get_the_ID());
    $CompanyLogo=rwmb_meta('IndividualCompanyLogo' ,$args , get_the_ID());
	$member_title=rwmb_meta('TITLE' ,$args , get_the_ID());
	$BusinessPhone1=rwmb_meta('BusinessPhone1' ,$args , get_the_ID());
	$BusinessFax1=rwmb_meta('BusinessFax1' ,$args , get_the_ID());
	$Mobile=rwmb_meta('Mobile' ,$args , get_the_ID());
	
	
}
else{
    $user_id=rwmb_meta('CorporateUser1' ,$args , get_the_ID());
    $user_image_ids = get_user_meta( $user_id, 'custom_avatar', false ); // Media fields are always multiple.
    $user_avatar=$user_image_ids[0];

    $userPosition=rwmb_meta('CorporatePosition1' ,$args , get_the_ID());
	    $Bio=rwmb_meta('CorporateCompanyBio' ,$args , get_the_ID());

    $CompanyName=rwmb_meta('CorporateCompanyName' ,$args , get_the_ID());
    $Linkedin=rwmb_meta('CorporateLinkedin' ,$args , get_the_ID());
    $Facebook=rwmb_meta('CorporateFacebook' ,$args , get_the_ID());
    $CompanyPhone=rwmb_meta('CorporateCompanyPhon1' ,$args , get_the_ID());
    $CompanyFax=rwmb_meta('CorporateCompanyFax1' ,$args , get_the_ID());
    $Mail=rwmb_meta('CorporateMail' ,$args , get_the_ID());
    $CompanyLogo=rwmb_meta('CorporateCompanyLogo' ,$args , get_the_ID());
	$BusinessPhone1=rwmb_meta('BusinessPhone1' ,$args , get_the_ID());
	$BusinessFax1=rwmb_meta('BusinessFax1' ,$args , get_the_ID());
	$Mobile=rwmb_meta('Mobile' ,$args , get_the_ID());
	
	
}

?>
    <!-- Hero Header BEGIN -->
    <section class="heroHeader">
        <!-- Background -->
        <div class="backgroundImage" <?php if(get_the_post_thumbnail_url(get_the_ID())!=""){ echo "style='background-image:url(".get_the_post_thumbnail_url(get_the_ID()).")'";}?>></div>

        <!-- Content -->
        <div class="container">
            <!-- Header Row BEGIN -->
            <div class="row">
			
			 <!-- Search Form BEGIN -->
<div class="searchForm  col-lg-12 col-12 mb-3 mb-lg-0 noPrint">
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
<div
    class="modal fancy"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
    >
    <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
        >
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-12 col-lg-8 row m-auto">
                    <h3 class="title">Search</h3>
                                        <form action="<?php echo get_post_type_archive_link('member')?>" method="get">

                        <div class="form-row">
                           <!-- <div class="col-12">
                                <div class="form-group">
                                    <label for="keywords">Keywords</label>
                                    <input
                                        type="text"
                                        name="keyword"
                                        class="form-control"
                                        id="keywords"
                                        placeholder="Member Name , Member Company Name"
                                        />
                                </div>
                            </div>-->
							<div class="col-12">
                                <div class="form-group">
                                    <label for="names">Member Name</label>
                                    <input
                                        type="text"
                                        name="names"
                                        class="form-control"
                                        id="names"
                                        placeholder="Member Name "
                                        />
                                </div>
                            </div>
							 <div class="col-12">
                                <div class="form-group">
                                    <label for="companies">Company Name</label>
                                    <input
                                        type="text"
                                        name="companies"
                                        class="form-control"
                                        id="companies"
                                        placeholder="  Company Name"
                                        />
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"
                                        >Sector</label
                                        >
                                    <select
                                        name="sector"
                                        class="form-control firstlvlselect"
                                        id="firstlvlselect"
                                        >
                                        <option selected disabled>Select Sector</option>
                                        <?php
                                        $categoryTerms=get_terms('membercategory');

                                        foreach ($categoryTerms as $categoryTerm) {
                                            if ($categoryTerm->parent == 0){ //check for parent terms only
                                                ?>
                                                <option value="<?php echo $categoryTerm->slug;?>"><?php echo $categoryTerm->name;?></option>
                                            <?php
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"
                                        >Activity</label
                                        >
                                    <select
                                        name="activity"
                                        class="form-control Seclvlselect"
                                        id="seclvlselect"
                                        >
                                        <option value="">Select Activity</option>

                                    </select>
                                </div>
                            </div>




                            <div class="col">
                                <div class="form-group submitContainer">
                                    <button
                                        type="submit"
                                        class="btn btn-primary submit"
                                        >
                                        <em class="fal fa-search"></em>
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Search Form END -->
		
				
				
                <!-- Member Info BEGIN -->
                <div class="col-md-9 col-sm-12">
                    <div class="memberInfo row m-0" >
						
                        <div class="col-md-4 col-sm-12 mb-md-0 mb-3">


                            <img
								 <?php
									if(isset($user_avatar) === true && $user_avatar !== '') { 
								?>
                               	src="<?php echo $user_avatar;?>"
								<?php
									} else {
									?>
                               	src="<?php bloginfo('template_directory'); ?>/assets/images/avatar-placeholder.png"	
								<?php
									}
								?>
                                alt="Placeholder"
                                />

                        </div>
                        <div class="col-md-8 col-sm-12 mt-auto mb-md-0 mb-5">
                            <div class="infoContainer mb-3">
                                <a href="#">
                                    <?php $user_info = get_userdata($user_id);?>
                                    <div class="title"><?php echo $member_title." ". $user_info->first_name." ".$user_info->last_name; ?></div>
                                </a>
								<?php if(!empty($CompanyPhone)) :?>
                                <a href="#">
                                    <div class="jobTitle"><?php echo $userPosition?></div>
                                </a>
								<?php endif;?>
								<?php if(!empty($CompanyName)) :?>
                                <a href="#">
                                    <div class="companyName"><?php echo $CompanyName;?></div>
                                </a>
								<?php endif;?>
								 <?php if(!empty($CompanyAddress)) :?>
                                <p class="my-2 address">
                                    <strong>Address:</strong> <?php echo $CompanyAddress?>
                                </p>
								<?php endif;?>
								
								<?php if(!empty($BusinessFax1)) :?>
                                <p class="my-2 fax"><strong>Fax:</strong> <?php echo $BusinessFax1?></p>
								<?php endif;?>
								<?php if(!empty($Mobile)) :?>
                                <p class="my-2 fax"><strong>Mobile:</strong> <?php echo $Mobile?></p>
								<?php endif;?>
								<?php if(!empty($BusinessPhone1)) :?>
                                <p class="my-2 fax"><strong>BusinessPhone:</strong> <?php echo $BusinessPhone1?></p>
								<?php endif;?>
								
                                <div class="options row">
                                    <div class="col contactOptions">
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
										<button class="print-button noPrint">Print this page</button>
                                          
                                    </div>
                                </div>
                            </div>
                        </div>
						
                    </div>
					<div class="memberInfo row m-0 bio">
					<div class="col-9 align-self-end ">
						<?php if(!empty($CompanyName)) :?>
                        <p class="companyName "><?php echo $CompanyName;?></p>
						
						<?php endif ;?>
                        <?php
						$membercategory=rwmb_meta('membercategory' ,$args , get_the_ID());
                    	$memberActivities=rwmb_meta('memberActivities' ,$args , get_the_ID());
						$memberSubActivity=rwmb_meta('memberSubActivity' ,$args , get_the_ID());
						
                        
                        ?>
                        <p class="field"><?php if($membercategory!=""){echo $membercategory;}?></p>
						<p class="field"><?php if($memberActivities!=""){echo $memberActivities;}?></p>
						<p class="field"><?php if($memberSubActivity!=""){echo $memberSubActivity;}?></p>
						</div>
                    </div>
                </div>
                <!-- Member Info END -->
    
                <!-- Ad Container BEGIN -->
                <div class="col-md-3 col-sm-12 mb-sm-5 ml-auto"  >
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
    <section class="body mt-5 mb-5 "  >
    <!-- Content -->
    <div class="container">
    <div class="row">
    <!-- Contained BEGIN -->
    <div class="col-md-8 col-sm-12 mb-md-0 mb-sm-5 "  >
        <!-- Profile Info Begin -->
        <div class="profileData">
			<!-- Bio BEGIN -->
            <div class="bio">
			<!-- start sector-->
			
			<div class="companyInfo pb-3 row m-0">
                    <div class="col-3 p-0">
                   <?php 
				   $terms = rwmb_meta( 'sector_member' );
				   //print_r($terms);
              if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
              foreach ( $terms as $term ) {
                 echo '<p>', $term->name, '</p>';
				 
             }
              }
                 $terms = get_terms( 'membercategory', array(
               'hide_empty' => false,
               ) );
			   foreach($terms as $term){
				  echo $term->name;
				  echo $term->term_id;
				  
			   }
				  
				   ?>
                    </div>
                    
                </div>
			<!-- end sector-->
                <div class="mainTitle">
                    <h2 class="title"><strong>Company Bio </strong></h2>
					
                </div>
                <div class="companyInfo pb-3 row m-0">
                    <div class="col-3 p-0">
 <?php if(!empty($CompanyLogo)) :?>
                        <img
                            src="<?php echo  $CompanyLogo ; ?>"
                            alt="Logo Placeholder"
                            />
						<?php endif ;?>
                    </div>
                    
                </div>
                <p>
                    <?php echo $Bio?>
                </p>
            </div>
            <!-- Bio END -->
            <!-- Sub Activities BEGIN -->
			 <?php
                    $categoryTerms=wp_get_post_terms(get_the_ID(),'membercategory');
					print_r($categoryTerms);
				if(!empty($categoryTerms)) :?>	
            <div class="subactivities">
                <div class="mainTitle mb-3">
                    <h2 class="title notprint"><strong>Sub Activities</strong></h2>
                    <?php
                    $categoryTerms=wp_get_post_terms(get_the_ID(),'membercategory');
                    
                            ?>
                            
                            <?php
                      
                    ?>
                </div>
            </div>
			<?php endif;?>
            <!-- Sub Activities END -->

           

            <!-- Contact Info BEGIN -->
			
            <div class="contactInfo">
			<?php	if(!empty($categoryTerms)) :?>	
                <div class="mainTitle">
                    <h2 class="title"><strong>Contact Info </strong></h2>
                </div>
           <?php endif;?>
					
                <div class="contactList">
					
					<?php	if(!empty($CompanyAddress)) :?>	
                    <div class="item">
                        <p><strong>Address</strong></p>
                        <a href="#"
                            ><?php echo $CompanyAddress?></a
                            >
                    </div>
					<?php endif;?>
					<?php	if(!empty($CompanyPhone)) :?>	
                    <div class="item">
                        <p><strong>Phone</strong></p>
                        <a href="#"><?php echo $CompanyPhone?></a>
                    </div>
					<?php endif;?>
					<?php	if(!empty($CompanyFax)) :?>	
                    <div class="item">
                        <p><strong>Fax</strong></p>
                        <a href="#"><?php echo $CompanyFax?></a>
                    </div>
					<?php endif;?>
					<?php	if(!empty($CompanyWebsite)) :?>	
                    <div class="item">
                        <p><strong>Website</strong></p>
                        <a href="<?php echo $CompanyWebsite;?>" target="_blank"><?php echo $CompanyWebsite;?></a>
                    </div>
					<?php endif;?>
					<?php	if(!empty($Mail)) :?>	
                    <div class="item">
                        <p><strong>Email</strong></p>
                        <a href="mailto: <?php echo $Mail;?>"><?php echo $Mail;?></a>
                    </div>
					
					<?php endif;?>
                </div>
            </div>
            <!-- Contact Info END -->
        </div>
        <!-- Profile Info END -->
    </div>
    <!-- Contained END -->
		
		 
    <!-- Sidebar BEGIN -->
    <aside class="sidebarMain col-md-4 col-sm-12 mt-md-0 mt-5 ">


    <?php if($memberType=="corporate"){
        ?>

    <!-- Company Members BEGIN -->
    <div class="companyMembers">
		<?php 
	if ( !empty($CorporateUserInformationValues)){
            foreach($CorporateUserInformationValues as $CorporateUserInformationValue){
                if($CorporateUserInformationValue['CorporateUser']!=$user_id){
				$corperatemoreusers	='true';
				}
			}
	}
	if( $corperatemoreusers == 'true' ){
		?>
        <p class="title">
			
            <strong>Members belonging to the company</strong>
        </p>
		<?php
	}
		?>
        <!-- Members List -->
        <div class="membersContainer">
            <?php
            $user_id2=rwmb_meta('CorporateUser2' ,$args , get_the_ID());
            $user_id3=rwmb_meta('CorporateUser3' ,$args , get_the_ID());
	        if ( !empty($user_id2)||!empty($user_id3)){
            for($i=2 ; $i<4; $i++){

                    if($i==2){
                         $moreUser_id=$user_id2;
                    }
                if($i==3){
                     $moreUser_id=$user_id3;
                }

                    $user_image_ids = get_user_meta( $moreUser_id, 'custom_avatar', false ); // Media fields are always multiple.
                $user_avatar=$user_image_ids[0];

                $moreUserPosition=rwmb_meta('CorporatePosition'.$i ,$args , get_the_ID());


                ?>
                    <!-- Member BEGIN -->
                    <div class="memberItem row" style="background-image: none">
                        <!-- Avatar Image -->
                        <div class="col-sm-4 p-0">
                            <div class="avatarImageContainer">
                                <a href="<?php echo get_permalink();?>">
                                    <div
                                        class="avatarImage"
                                        
                                        >
										<img src="<?php echo $user_avatar;?>"  >
									</div>
                                </a>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="col-sm-8">
                            <div class="infoContainer">
                                <a href="<?php echo get_permalink();?>">
                                    <?php $user_info = get_userdata($moreUser_id);?>
                                    <div class="title"><?php echo $user_info->first_name." ".$user_info->last_name; ?></div>
                                </a>
                                <a href="<?php echo get_permalink();?>">
                                    <div class="jobTitle"><?php echo $moreUserPosition?></div>
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
										<?php if(function_exists('wp_print')) { print_link(); } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Member END -->
                <?php

             }
            }
            ?>


        </div>
		<?php //} ?> 
    </div>
    <!-- Company Members END -->
    <?php  }?>
    <!-- Recent News BEGIN -->
		
    
    <!-- Recent News END -->

    <!-- Member of Committee BEGIN -->
    <div class="memberCommittee hidden">
		<?php
		$committeeTerms=wp_get_post_terms($currentMemberId,'memberofcommittee');

        $memberofbusinesscouncil=rwmb_meta('memberofbusinesscouncil' ,$args , get_the_ID());
        $memberofcommittee=rwmb_meta('memberofcommittee' ,$args , get_the_ID());
        $memberlocation=rwmb_meta('memberlocation' ,$args , get_the_ID());
        $membercategory=rwmb_meta('membercategory' ,$args , get_the_ID());

        if(!empty( $memberofcommittee)):?>
        <p class="title"><strong>Member of Committee </strong></p>
        <ul>

            <li>
                <p><?php echo $memberofcommittee;?></p>
            </li>
            <?php

            endif

            ?>
        </ul>
    </div>
    <!-- Member of Committee END -->

    <!-- Member of Business Council BEGIN -->
    <div class="memberBusinessCouncil hidden">
		<?php
				if(!empty($memberofbusinesscouncil)):?>
        <p class="title"><strong>Member of Business Council </strong></p>
        <ul>
            <?php

                ?>
            <li>
                <p><?php echo $memberofbusinesscouncil;?></p>
            </li>
            <?php


endif;

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
		<div class="adContainer noPrint">
        <div class="m-auto noPrint">
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