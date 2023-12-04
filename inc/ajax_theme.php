<?php


function podcast_info()
{
    if (
        isset($_POST['userId']) && isset($_POST['postId']) && isset($_POST['podcastName']) && isset($_POST['allEpisode'])
        && isset($_POST['episodeId']) && isset($_POST['listenStatus']) && isset($_POST['listenTime']) && isset($_POST['podcastTime'])
    ) {


        $userId = floatval($_POST['userId']);
        $postId = floatval($_POST['postId']);
        $podcastName = $_POST['podcastName'];
        $allEpisode = floatval($_POST['allEpisode']);
        $episodeId = $_POST['episodeId'];
        $listenStatus = floatval($_POST['listenStatus']);
        $listenTime = $_POST['listenTime'];
        $podcastTime = $_POST['podcastTime'];

        //sanitize fields
        $sanitized_userId = sanitize_text_field($userId);
        $sanitized_postId = sanitize_text_field($postId);
        $sanitized_podcastName = sanitize_text_field($podcastName);
        $sanitized_allEpisode = sanitize_text_field($allEpisode);
        $sanitized_episodeId = sanitize_text_field($episodeId);
        $sanitized_listenStatus = sanitize_text_field($listenStatus);
        $sanitized_listenTime = sanitize_text_field($listenTime);
        $sanitized_podcastTime = sanitize_text_field($podcastTime);


        //  check array
        if (
            $sanitized_userId && $sanitized_postId && $sanitized_podcastName && $sanitized_allEpisode &&
            $sanitized_episodeId && $sanitized_listenStatus && $sanitized_listenTime && $sanitized_podcastTime
        ) {

            global $wpdb;
            $query = $wpdb->prepare(
                "SELECT count(*) FROM {$wpdb->prefix}users_podcasts
                                         WHERE user_id = %d AND episode_id = %s",
                $sanitized_userId,
                $sanitized_episodeId
            );

            $result = $wpdb->get_var($query);


            if ($result == 0) {

                $table_name = $wpdb->prefix . 'users_podcasts';
                $data = array(
                    'user_id' => $sanitized_userId,
                    'podcast_id' => $sanitized_postId,
                    'podcast_name' => $sanitized_podcastName,
                    'all_episode' => $sanitized_allEpisode,
                    'episode_id' => $sanitized_episodeId,
                    'listen_status' => $sanitized_listenStatus,
                    'listen_time' => $sanitized_listenTime,
                    'podcast_time' => $sanitized_podcastTime,
                    'listen_date' => current_time('mysql', 1),
                );

                $wpdb->insert($table_name, $data);
            } else {
                return "this item exist";
            }





            wp_send_json([
                'success' => true,
                'message' => 'اطلاهات با موفقیت ارسال شد. '
            ]);
        } else {
            // Error: One of the fields is empty

            wp_send_json([
                'success' => false,
                'message' => 'has error',

            ]);
        }
    } else {
        // Error: Data is not sent
        wp_send_json([
            'success' => false,
            'message' => 'has error',

        ]);
    }
}

add_action('wp_ajax_podcast_info', 'podcast_info');
add_action('wp_ajax_nopriv_podcast_info', 'podcast_info');




function post_type_like_dislike()
{
    if (isset($_POST["data"])) {
        $formData = $_POST["data"];

        if (
            isset($formData['user_id']) &&
            isset($formData['post_type_id']) &&
            isset($formData['form_entry_id']) &&
            isset($formData['action'])
        ) {
            $userId = floatval($formData['user_id']);
            $postId = floatval($formData['post_type_id']);
            $FormEntryId = floatval($formData['form_entry_id']);

            $action = $formData['action'];

         
        }

        //sanitize fields
        $sanitized_action = sanitize_text_field($action);

        //  check array
        if ($userId && $postId  && $sanitized_action) {

            global $wpdb;

            $formEntry = '';
            $result = '';
            if ($FormEntryId == 0) {
                $formEntry = NULL;
                $query = $wpdb->prepare(
                    "SELECT count(*) FROM {$wpdb->prefix}like_dislike_post_type
                                             WHERE user_id = %d AND post_type_id = %s",
                    $userId,
                    $postId
                );
    
                $result = $wpdb->get_var($query);

            } else {

                $formEntry = $FormEntryId;
                $query = $wpdb->prepare(
                    "SELECT count(*) FROM {$wpdb->prefix}like_dislike_post_type
                                             WHERE user_id = %d AND entry_form_id = %s",
                    $userId,
                    $formEntry
                );
            }

          

            if ($result) {

                if ($sanitized_action === 'like') {

                    if ($result->like_post == 0) {
                        $table_name = $wpdb->prefix . 'like_dislike_post_type';
                        $data = array(
                            'like_post' => 1,
                            'dislike' => 0,
                        );

                        $where = array(
                            'user_id' => $userId,
                            'post_type_id' => $postId,
                            'entry_form_id' =>  $formEntry
                        );

                        $wpdb->update($table_name, $data, $where);
                    }
                }
                if ($sanitized_action === 'dislike') {
                    if ($result->dislike == 0) {
                        $table_name = $wpdb->prefix . 'like_dislike_post_type';
                        $data = array(
                            'like_post' => 0,
                            'dislike' => 1,
                        );

                        $where = array(
                            'user_id' => $userId,
                            'post_type_id' => $postId,
                            'entry_form_id' => $formEntry,
                        );

                        $wpdb->update($table_name, $data, $where);
                    }
                }
            } else {
                if ($sanitized_action === 'like') {

                    global $wpdb;
                    $table_name = $wpdb->prefix . 'like_dislike_post_type';
                    $data = array(
                        'user_id' => $userId,
                        'post_type_id' => $postId,
                        'entry_form_id' => $formEntry,
                        'like_post' => 1,
                        'dislike' => 0,
                    );

                    $wpdb->insert($table_name, $data);
                }
                if ($sanitized_action === 'dislike') {
                    global $wpdb;
                    $table_name = $wpdb->prefix . 'like_dislike_post_type';
                    $data = array(
                        'user_id' => $userId,
                        'post_type_id' => $postId,
                        'entry_form_id' => $formEntry,
                        'like_post' => 0,
                        'dislike' => 1,
                    );

                    $wpdb->insert($table_name, $data);
                }
            }

            // send count like and dislike 

            $queryLikeDislike = $wpdb->prepare(
                "SELECT SUM(like_post) AS total_likes, SUM(dislike) AS total_dislikes
                 FROM {$wpdb->prefix}like_dislike_post_type
                 WHERE post_type_id = %d",
                $postId
            );
            $resultLikeDislike = $wpdb->get_row($queryLikeDislike);


            wp_send_json([
                'success' => true,
                'message' => 'اطلاعات با موفقیت ارسال شد. ',
                'like_count' => intval($resultLikeDislike->total_likes),
                'dislike_count' => intval($resultLikeDislike->total_dislikes),
                'form_entry_id ' => $formEntry

            ]);
        } else {
            // Error: One of the fields is empty

            wp_send_json([
                'success' => false,
                'message' => 'has error fields is empty',
                'data' =>  $formData['form_entry_id']

            ]);
        }
    } else {
        // Error: Data is not sent
        wp_send_json([
            'success' => false,
            'message' => 'has error Data is not sent',

        ]);
    }
}

add_action('wp_ajax_post_type_like_dislike', 'post_type_like_dislike');
add_action('wp_ajax_nopriv_post_type_like_dislike', 'post_type_like_dislike');
