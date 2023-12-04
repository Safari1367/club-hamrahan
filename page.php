<?php
/*
* File Name:        page.php
* Author:           Sohrab Yazdanparast <sohrab.yazdan@yahoo.com>
* License:          Check license URI for more information
* @Author-URI:      https://www.www.venus-itc.com.com
* @Version:         1.0.0
* @License-URI:     https://www.venus-itc.com/license
*/
get_header();
?>

<div class="content-page rtl-page">


	<div class="container-fluid">
		<?php
		get_template_part('templates/content/breadcrumb');
		?>
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<!-- <div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h2 class="card-title"><?= get_the_title(); ?></h4>
						</div>
					</div> -->
					<div class="card-body">
						<div class="row">

							<div class="col-md-12">
								<?php
								while (have_posts()) :
									the_post();
									the_content();
								endwhile; // End of the loop.
								?>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
</div>

<?php
get_footer();

?>