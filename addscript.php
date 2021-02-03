<?php
/**
 * Template Name: Add members script
 */

get_header();

 $wp_upload_dir = wp_upload_dir();
//print_r($wp_upload_dir);
$base = dirname(__FILE__);
print_r($base);
$path = false;
echo "</br>";
echo $path = dirname(dirname($base));


$csvFiles=list_files( $path.'/csv');
//print_r($csvFiles);

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

    <?php wp_reset_query();?>
    <!-- Body BEGIN -->
    <section class="body mt-5 mb-5">
        <!-- Content -->
        <div class="container">
            <div class="row">
                <!-- Contained BEGIN -->
                <div class="col-md-8 col-sm-12 mb-md-0 mb-sm-5">
                    <!-- Single News Begin -->
                      <div>


                          <form action="#" method="post" enctype="multipart/form-data">
                              <div class="row" style="margin-bottom: 15px;">
                                  <div class="col-md-2">
                                      <label>Select Club</label>
                                  </div>
                                  <div class="col-md-10">
                                      <select class="form-control" name="clubID" required>
                                          <option selected disabled>Select Club</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="row" style="margin-bottom: 15px;">
                                  <div class="col-md-2">
                                      <label>Select A CSV File</label>
                                  </div>
                                  <div class="col-md-10">
                                      <select class="form-control" name="fileUrl" required>
                                          <option>Please Select A CSV File</option>
                                          <?php
                                          foreach($csvFiles as $csvFile){
                                              $arr = explode('csv/', $csvFile);
                                              $important = $arr[1];
                                              ?>
                                              <option value="<?php echo $csvFile;?>"><?php echo $important; ?></option>
                                          <?php }
                                          ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="row" style="margin-bottom: 15px; text-align: center">
                                  <div class="col-md-12 form--action--message">
                                      <span id="message--success" class="success">User data updated successfully</span>
                                      <span id="message--error" class="error">User data updated failed</span>
                                  </div>
                              </div>

                              <div class="row" style="margin-bottom: 15px; text-align: center">
                                  <div class="col-md-6">
                                      <input id="import" type="submit" value="Import" name="Import" class="rwmb-button action--btn">
                                  </div>
                                  <div class="col-md-6">
                                      <input id="replace" type="submit" value="Replace" name="Replace" class="rwmb-button action--btn">
                                  </div>
                              </div>
                          </form>


                      </div>

                    <!-- Single News END -->
                </div>
                <!-- Contained END -->

            </div>
        </div>
    </section>
    <!-- Body END -->


<?php
get_footer();