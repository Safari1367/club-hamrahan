<?php
$postId = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
$podcastName = get_the_title($postId);
$choosePodcast = get_field('choose_podcast_type', $postId);
$singlePodcast = get_field('add_single_podcast', $postId);
$singlePodcastTitle = get_field('single_podcast_title', $postId);
$playListPodcasts = get_field('podcast_play_list', $postId);


// get all episode this podcast 
$episodeNames = [];

if ($singlePodcast || (is_array($playListPodcasts) && count($playListPodcasts) > 0)) {
   if ($choosePodcast == "single") {
      $episodeNames[] = [
         'name' => $singlePodcastTitle,
         'epizod_id' => $postId . '_episod_1',
      ];
   } elseif ($choosePodcast == "multiple") {
      $num = 1;
      foreach ($playListPodcasts as $episode) {
         if ($episode['podcast_file'] && $episode['podcast_name']) {
            $episodeNames[] = [
               'name' => $episode['podcast_name'],
               'epizod_id' => $postId . '_episod_' . $num,
            ];
            $num++;
         }
      }
   }
}

global $wpdb;

$user_id = get_current_user_id();
$table_users = $wpdb->base_prefix . 'users';
$table_users_podcasts = $wpdb->base_prefix . 'users_podcasts';

$query = $wpdb->prepare("SELECT * FROM $table_users_podcasts WHERE podcast_id = %d", $postId);
$user_podcast_data = $wpdb->get_results($query, OBJECT);



$users = get_users(array(
   'role'    => 'subscriber',
   'fields'  => 'all'
));




$users_data_with_episodes = [];

foreach ($user_podcast_data as $podcast) {
   $user_id = $podcast->user_id;

   if (!isset($users_data_with_episodes[$user_id])) {
      $users_data_with_episodes[$user_id] = [
         'user_id' => $user_id,
         'user_episodes' => [],
      ];
   }

   $users_data_with_episodes[$user_id]['user_episodes'][] = $podcast->episode_id;
}





/*
Template Name: Monitor Podcast single
*/
get_header();

?>
<div class="content-page rtl-page podcast-monitor-single">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">مانیتور کاربرانی که به اپیزودهای پادکست " <?= $podcastName ?> " گوش کرده اند </h4>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive">
                  <table id="datatable" class="table data-table table-striped table-bordered">
                     <thead>
                        <tr>
                           <?php

                           foreach ($users_data_with_episodes as $user) :
                              $first_name = get_user_meta($user['user_id'], 'first_name', true);
                              $last_name = get_user_meta($user['user_id'], 'last_name', true); ?>

                              <th><?= ($first_name && $last_name) ? $first_name . " " . $last_name : 'یوزر بی نام'; ?></th>
                           <?php endforeach; ?>
                        </tr>
                     </thead>
                     <tbody>
                     <tr>
                           <?php foreach ($users_data_with_episodes as $user) :
                              echo  ' <td>' . $podcastName . '</td>';
                           endforeach ?>
                        </tr>

                        <?php foreach ($episodeNames as $item) {   ?>

                           <tr>
                              <?php
                              $seeEpizode = false;
                              foreach ($users_data_with_episodes as $user) :

                              
                                foreach($user['user_episodes'] as $epizodResult){
                         if($item['epizod_id'] == $epizodResult){
                             $seeEpizode = true;

                                 break;
                         }
                                }?>

                                 <td><?= $item['name'] ?> <input type="checkbox" disabled="" <?= ($seeEpizode) ? 'checked' : '' ?>></td>

                              <?php
                              endforeach; ?>
                           </tr>
                        <?php } ?>


                     
                     </tbody>
                     <tfoot>
                        <tr>
                           <?php foreach ($users_data_with_episodes as $user) :
                              $first_name = get_user_meta($user['user_id'], 'first_name', true);
                              $last_name = get_user_meta($user['user_id'], 'last_name', true); ?>


                              <th><?= ($first_name && $last_name) ? $first_name . " " . $last_name : 'یوزر بدون نام' ?></th>
                           <?php endforeach; ?>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>


   </div>
</div>





<?php get_footer(); ?>