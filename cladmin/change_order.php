<?php
require_once "../includes/main.inc.php";
$cat_id			= $_GET['cat_id'];
$type			= $_GET['type'];
$order			= $_GET['order'];
$id				= $_GET['id'];
$start			= $_GET['start'];
$parent			= $_GET['parent'];	
$pagesize		= $_GET['pagesize'];	

if ($type=='category'){	
	change_display_orders($cat_id,$order,$id,$type,$parent);
	$header_link="category_list.php?start=$start&cat_parent_id=$_GET[parent]";
}
if ($type=='state'){	
	change_display_orders($cat_id,$order,$id,$type,$parent);
	$header_link="land.php?file=manage_states&start=$start";
}

if ($type=='alert'){	
	change_display_orders($cat_id,$order,$id,$type);
	$header_link="alert_ques_list.php";
}

if ($type=='faq'){	
	change_display_orders($cat_id,$order,$id,$type);
	$header_link="faqs_list.php";
}

if ($type=='video'){	
	change_display_orders($cat_id,$order,$id,$type,$parent);
	$header_link="videos_list.php?start=$start&v_cat_id=$parent";
}


if ($type=='city'){	
	change_display_orders($cat_id,$order,$id,$type,$parent);	
	$header_link="land.php?file=manage_city&start=$start&city_state_id=$parent";
}

if ($type=='artist'){	
	change_display_orders($cat_id,$order,$id,$type,$parent);
	$header_link="artist_list.php?start=$start";
}

if ($type=='genere'){	
	change_display_orders($cat_id,$order,$id,$type,$parent);
	$header_link="music_type_list.php?start=$start";
}

if ($type=='testimonial'){	
	change_display_orders($cat_id,$order,$id,$type);
	$header_link="testimonial_list.php";
}

if ($type=='file'){	
	change_display_orders($cat_id,$order,$id,$type,$parent);
	$header_link="view_files.php?start=$start&af_a_id=$parent";
}

if($type=='chart'){	
	change_display_orders($cat_id,$order,$id,$type,$parent);
	$header_link="chart_list.php?start=$start&ch_type=$parent&pagesize=$pagesize";
}

header("location: $header_link");
exit;

?>