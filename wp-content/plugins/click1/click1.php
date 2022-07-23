<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_filter( 'woocommerce_states', 'awrr_states_russia' );
function awrr_states_russia( $states ) {
	$states['UZ'] = array(
		"ТАШКЕНТ"                                 => " Ташкент",
		"ТАШКЕНТСКАЯ ОБЛАСТЬ"                        => " Ташкентская обл",
		"НАМАНГАН"                                 => " Наманган",
		"САМАРКАНД"                                => " Самарканд",
		"БУХАРА"                                  => " Бухара",
		"АНДИЖАН"                            => " Андижан",
		"ФЕРГАНА"                              => " Фергана",
		"ХИВА"                               => " Хива",
		"СУРХАНДАРЬЯ"                                => " Сурхандарья",
		"КАШКАДАРЬЯ"                               => " кашкадарья",
		"КАРАКАЛПАКИСТАН"                             => " Каракалпакистан",
	);
	
	return $states;
}
