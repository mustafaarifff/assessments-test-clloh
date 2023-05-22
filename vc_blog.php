<?php

// VC ELEMENT LISTING BLOG NEW
vc_map( array(
	"name"        => __( "Listing Blog New", "whello" ),
	"description" => __( "Display listing blog new", "whello" ),
	"base"        => "listing-blog-new",
	"category"    => __( "Whello Element", "whello" ),
	"icon"        => "icon-wpb-row",
	"params"      => array(
		array(
			"type"          => "dropdown",
			"heading"       => __( "Select Listing", "whello" ),
			"param_name"    => "select_listing",
			"admin_label"   => true,
			"save_always"   => true,
			"value"         => array(
								__( 'Show All', 'whello' )		=> '-',
								__( 'Posts', 'whello' )			=> 'posts',
								__( 'Categories', 'whello' )	=> 'category',
							),
		),
		array(
			"type"          => "textfield",
			"holder"        => "div",
			"class"         => "vc-hidden-field",
			"param_name"    => "taxonomy",
			"save_always"   => true,
			"value"         => 'category',
			"dependency"	=> Array( "element" => "select_listing", "value" => "category" )
		),
		array(
			"type"          => "dropdown_alt",
			"heading"       => __( "Choose Category", "whello" ),
			"admin_label"   => true,
			"param_name"    => "terms",
			"save_always"   => true,
			"value"         => array(),
			"class"         => "pv_type_terms_category",
			"dependency"	=> Array( "element" => "select_listing", "value" => "category" )
		),
		array(
			"type"          => "dropdown_multi",
			"heading"       => __( "Choose Posts", "whello" ),
			"param_name"    => "posts",
			"admin_label"   => true,
			"save_always"   => true,
			"value"         => array(),
			"class"         => "pv_type_post",
			"dependency"	=> Array( "element" => "select_listing", "value" => "posts" )
		),
		array(
			"type"          => "textfield",
			"heading"       => __( "Posts per page", "whello" ),
			"param_name"    => "posts_per_page",
			"save_always"   => true,
			"value"         => "",
			"dependency"	=> Array( "element" => "select_listing", "value" => array( "-", "category" ) )
		),
		array(
			"type"          => "dropdown",
			"heading"       => __( "Order", "whello" ),
			"param_name"    => "order",
			"save_always"   => true,
			"value"         => array(
								__( 'DESC', 'whello' )	=> 'DESC',
								__( 'ASC', 'whello' )	=> 'ASC',
							),
		),
		array(
			"type"          => "dropdown",
			"heading"       => __( "Orderby", "whello" ),
			"param_name"    => "orderby",
			"save_always"   => true,
			"value"         => array(
								__( 'Date', 'whello' )				=> 'date',
								__( 'Last Modified', 'whello' )		=> 'modified',
								__( 'Title', 'whello' )				=> 'title',
								__( 'Random', 'whello' )			=> 'rand',
								__( 'Popular', 'whello' )			=> 'popular',
								__( 'ID', 'whello' )				=> 'ID',
								__( 'Follow Selected', 'whello' )	=> 'none'
							),
		),
		array(
			"type"          => "dropdown",
			"heading"       => __( "Pagination", "whello" ),
			"param_name"    => "pagination",
			"save_always"   => true,
			"value"         => array(
								__( 'No', 'whello' )	=> 'no',
								__( 'Yes', 'whello' )	=> 'yes',
							),
		),
		array(
			"type"          => "textfield",
			"heading"       => __( "Extra class name", "whello" ),
			"param_name"    => "extra_class",
			"save_always"   => true,
			"value"         => "",
		),
	)
) );

