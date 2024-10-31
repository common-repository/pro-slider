<?php
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );
 ?>
<?php
$cl = $values['slider__id'];
global $wpdb;
$retrieve_data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}proslider WHERE id = '".$cl."'", OBJECT );


foreach ($retrieve_data as $retrieved_data){

 ?>
 <?php
 $allinone = $retrieved_data->pro__images;
 $allurls = $retrieved_data->pro__url_toredirect;
 $myArray = explode(',', $allinone);
 $urlArray = explode(',', $allurls);
//  array_pop($myArray);
   }

if(!empty($retrieved_data)){

?>

<div class="slide hi-slide">
      <section class="hi-prev "></section>
			<section class="hi-next "></section>
      <ul>
 <?php
//  if (is_array($myArray) || is_object($myArray)){
  // print_r ($myArray);
         foreach ($myArray as $my => $vlu){
        
           echo "<li class='li__pro__slide'><a target='_blank' href='".esc_attr($vlu)."'><img src='".esc_attr($vlu)."'/></a></li>";
         
          }
        // }
      }
     ?>
</ul>
</div>
<script>
  jQuery(function() {
	  jQuery('.hi-slide').hide();
		jQuery('.slide').hiSlide();

	  setTimeout(function(){

		  jQuery('.hi-slide').show();
	  },1700);
  });
</script>
