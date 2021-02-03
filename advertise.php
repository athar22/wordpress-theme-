<?php 
/* Template Name: to_advertise */
get_header();
$user_id=$_GET['user_id'];
$member_id=$_GET['member_id'];
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
				 
                <!-- Member Info BEGIN -->
                
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
                <div class="col-10 col-lg-8 row m-auto">
                    <h3 class="title">Search</h3>
                    <                    <form action="<?php echo get_post_type_archive_link('member')?>" method="get">
                        <div class="form-row">
                            <div class="col-12">
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