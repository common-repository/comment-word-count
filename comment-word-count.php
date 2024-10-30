<?php
/*
Plugin Name: Comment Word Count
Plugin URI: https://wordpress.org/plugins/comment-word-count/
Description: Outputs the total number of words in all comments.
Version: 2.0
Author: Nick Momrik
Author URI: http://nickmomrik.com/
*/

function mdv_comment_word_count() {
    global $wpdb;

	$words = $wpdb->get_results("SELECT comment_content FROM $wpdb->comments WHERE comment_approved = '1'");
	if ( $words ) {
		$oldcount = 0;
		foreach ( $words as $word ) {
			$comment = strip_tags( $word->comment_content );
			$comment = explode( ' ', $comment );
			$count = count( $comment );
			$totalcount = $count + $oldcount;
			$oldcount = $totalcount;
		}
	} else {
		$totalcount = 0;
	}

	echo number_format( $totalcount );
}
