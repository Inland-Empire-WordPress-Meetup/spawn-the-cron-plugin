<?php

/**
 * Plugin Name:     Spawn The Cron
 * Plugin URI:      https://inlandempirewp.com
 * Description:     A Plugin For Learning WP Cron
 * Author:          Inland Empire WP
 * Author URI:      https://inlandempirewp.com
 * Text Domain:     spawn-the-cron
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Spawn_The_Cron
 */


// Scheduled Action Hook
function cron_spawn(){
	error_log('The Cron was spawned!', 3, "debug_log.txt");
}
add_action('cron_spawn', 'cron_spawn');

// Custom Cron Recurrences
function spawn_the_cron_job_recurrence($schedules)
{
	$schedules['every_two_min'] = array(
		'display' => __('Every Two Minutes', 'textdomain'),
		'interval' => 120,
	);
	return $schedules;
}
add_filter('cron_schedules', 'spawn_the_cron_job_recurrence');

// Schedule Cron Job Event
function spawn_the_cron_job() {
	if (!wp_next_scheduled('cron_spawn')) {
		wp_schedule_event(current_time('timestamp'), 'every_two_min', 'cron_spawn');
	}
}
add_action('wp', 'spawn_the_cron_job');

// wp_unschedule_event(wp_next_scheduled('cron_spawn'), 'cron_spawn');
