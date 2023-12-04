<?php
/*
Template Name: file overview
*/
get_header();

$fileCategories = get_categories(array(
	'taxonomy' => 'file_cat',
	'orderby' => 'term_id',
	'order' => 'ASC',
));
?>


<div class="content-page rtl-page file-overview">


	<div class="container-fluid">
		<?php
		get_template_part('templates/content/breadcrumb');
		?>

		<?php
		get_template_part('templates/content/content')
		?>

		<?php foreach ($fileCategories as $cat) : ?>
			<div class="row">
				<div class="col-sm-12">


					<div class="iq-header-title border-b pb-4">
						<h2 class="card-title mb-0"> <?= $cat->name ?></h2>
					</div>

					<?php

					$fileArgs = array(
						'post_type' => 'file',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'file_cat',
								'field' => 'id',
								'terms' => $cat->term_id,
							),
						),
					);

					$fileQuery = new WP_Query($fileArgs);


					?>

					<div class="row p-4">
						<?php if ($fileQuery->have_posts()) :
							while ($fileQuery->have_posts()) : $fileQuery->the_post();  ?>

								<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-2 pr-0 file-box">
									<div class="card card-block card-stretch card-height blog pricing-details">
										<div class="card-body border text-center rounded">
											<div class="pricing-header">
												<?php $thumbnail_id = get_post_thumbnail_id(get_the_ID()); ?>
												<?= wp_get_attachment_image($thumbnail_id, 'full', false, []); ?>
											</div>
											<h5 class="mb-2 truncate-text-1"><?= esc_html(get_the_title(get_the_ID())) ?></h5>
											<div class="truncate-text-2 pb-2 ">
												<?= the_excerpt(get_the_ID()); ?>
											</div>
											<a href="<?= esc_url(get_permalink(get_the_ID()))  ?>" class="btn btn-primary mt-2">ادامه مطلب</a>
										</div>
									</div>
								</div>
						<?php
							endwhile;
							wp_reset_postdata();
						else :
							echo 'هیچ فایلی یافت نشد.';
						endif;
						?>
					</div>



				</div>
			</div>
		<?php endforeach; ?>




	</div>
</div>

<?php
get_footer();

?>