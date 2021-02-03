<?php
/**
 * Template Name: Login
 */

get_header();
?>
<?php 
	if($_GET['login']!==""){
		?>
		<input id="myhiddeninput" type="hidden" value="<?php echo $_GET['login'];?>">
	<?php }
	
?>
    <section class="heroHeader loginHeroDiv" style="height: 100%; ">
    <div class="container" style="height: 100%; max-width: 1300px;">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="row" style="margin-top:-200px">
					<?php 
						$imgs=rwmb_meta( 'images', $args, 115 );
						$cCounter=0;
						$imageArrayIDs=array();
						foreach($imgs as $img){
							$cCounter++;
							array_push($imageArrayIDs,$img['ID']);
						}
						$cCounter=0;
					
						foreach($imageArrayIDs as $imageArrayID){
							
							 if( $cCounter %2 == 0  ) :
							?>
							 <div class="col-md-12" style=" margin-bottom: 15px ">
								<div style="text-align:center;">
									
									<img  style="width:80% " src="<?php echo wp_get_attachment_url( $imageArrayIDs[$cCounter]);?>" >
								</div>
							</div>
						<?php
							$cCounter++;
							endif; }
					?>
                   
                   

                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="login-form-div">
                    <div style="text-align: center; padding-bottom: 26px; ">
                        <img src="<?php bloginfo('template_directory') ;?>/assets/images/eba-logo.png" style="width: 200px;">
                    </div>
                    <div style="color:red; border:2px solid red; padding: 6px ; text-align:center; margin-bottom: 20px;<?php if($_GET['login']!='failed'){echo 'display:none;';}?>">
                        <h4 style="<?php if($_GET['login']!='failed'){echo 'display:none;';}?>">The Username or password not correct</h4>
                    </div>
                    <?php do_shortcode('[vivid-login-page]')?>
                </div>
            </div>
			 <div class="col-md-4 col-sm-12">
                <div class="row" style="margin-top:-200px">
					<?php 
						$imgs=rwmb_meta( 'images', $args, 115 );
						
						foreach($imageArrayIDs as $imageArrayID){
							$img_id =$img['ID'];
							
							if( $cCounter %2 != 0  ) :
							?>
							 <div class="col-md-12" style=" margin-bottom: 15px ">
								<div style="text-align:center;">
									<img  style="width:80% " src="<?php echo wp_get_attachment_url( $imageArrayIDs[$cCounter]);?>" >
								</div>
							</div>
							
						<?php 
							$cCounter++;
							endif; }
					?>
                   
                   

                </div>
            </div>
        </div>
    </div>
</section>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    $( "#user_login" ).addClass( "form-control" );
    $( "#user_pass" ).addClass( "form-control" );
    $( "#wp-submit" ).addClass( "btn btn-primary" );
    $("#header-main").css('display' , 'none');
    $("html").css('height' , '100%');
    $("body").css('height' , '100%');
     if( $('#myhiddeninput').val() =="failed") {
         
    }
</script>
<?php
get_footer();
