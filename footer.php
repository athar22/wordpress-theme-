<!-- Footer BEGIN -->
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
        <span aria-hidden="true">×</span>
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
										$membercategoryArray=array();
						  				$memberActivitiesArray=array();

										$args = array(
												'post_type' => 'member',
												'posts_per_page'=>-1,
											);
											query_posts( $args );
											if ( have_posts() ) :
												while ( have_posts() ) : the_post();
						  							$membercategory=rwmb_meta('membercategory' ,$args , get_the_ID());
                    								$memberActivities=rwmb_meta('memberActivities' ,$args , get_the_ID());
													if($membercategory!=""){
														array_push($membercategoryArray,$membercategory);
													}
						  							if($memberActivities!=""){
														array_push($memberActivitiesArray,$memberActivities);
													}
						  							
												endwhile;
											else :
											endif;
						 				$membercategoryArray = array_unique($membercategoryArray);
						   				$memberActivitiesArray = array_unique($memberActivitiesArray);
                                        sort($membercategoryArray);
						  				sort($memberActivitiesArray);

                                        foreach ($membercategoryArray as $membercategoryArrayVal) {
                                           
                                                ?>
                                                <option value="<?php echo $membercategoryArrayVal;?>"><?php echo $membercategoryArrayVal;?></option>
                                            <?php
                                            
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
										<?php 
										 foreach ($memberActivitiesArray as $memberActivitiesArrayVal) {
                                           
                                                ?>
                                                <option value="<?php echo $memberActivitiesArrayVal;?>"><?php echo $memberActivitiesArrayVal;?></option>
                                            <?php
                                            
                                        }
										?>
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
<footer <?php if(get_the_ID()==115){echo 'style="display:none;"';}?>>
    <div class="container pt-5 noPrint">
        <div class="row mt-5">
            <!-- Company Info BEGIN -->
            <div class="col-md-4 col-sm-12 mb-md-0 mb-5 text-center">
                <img
                    src="<?php bloginfo('template_directory') ;?>/assets/images/eba-logo.png"
                    width="230"
                    height="auto"
                    alt="EBA Members Directory"
                    title="EBA Members Directory"
                    loading="lazy"
                    />
                <div class="socialMedia">
                    <a href="https://www.facebook.com/EBA.Page/"><em class="fab fa-facebook-f"></em></a>
                    <a style="display:none;" href="#"><em class="fab fa-twitter"></em></a>
                    <a href="https://www.linkedin.com/groups/3790127/"><em class="fab fa-linkedin-in"></em></a>
                </div>
            </div>
            <!-- Company Info END -->

            <!-- Ad Section BEGIN -->
            <div class="col-md-8 col-sm-12 mb-md-0 mb-5 m-0 row">
                <?php
                $args = array(
                    'post_type' => 'ads',
                    'posts_per_page'=>4,
                    'orderby'        => 'rand',
                    'meta_query' => array(
                        array(
                            'key'     => 'DisplayOptionList',
                            'value'   => 'footer',
                            'compare' => 'IN',
                        ),
                    ),
                );
                query_posts( $args );
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        ?>
                        <!-- Ad Container Item -->
                       
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


            </div>
            <!-- Ad Section END -->

            <!-- Copyrights -->
            <div class="col-sm-12 text-center mt-5">
                <p>
                    © 2020 <strong>EBA Members Directory</strong>. All Rights
                    Persevered.
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer END -->

<!-- jQuery 3.5.1 -->
<script
    src="https://code.jquery.com/jquery-3.5.1.js"
    ></script>

<!-- Popper.js 1.16.1 -->
<script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"
    ></script>

<!-- Bootstrap 4.5.2 -->
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"
    ></script>
<script type="text/javascript">
   

</script>
<!-- EBA Scripts -->
<script src="<?php bloginfo('template_directory') ;?>/assets/js/functions.js" name="functions"></script>
<script>
  $(function () {
    $('.print-button').on('click', function() {  
      window.print();  
    });    
  });
</script>

<script> 
        function printDiv() { 
            var divContents = document.getElementById("printhis6").innerHTML; 
            var a = window.open('', '', 'height=1200, width=1200'); 
            a.document.write('<html>'); 
            a.document.write(divContents); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        } 
    </script>
<?php wp_footer();?>


</body>
</html>
