<?php
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );
?>
<style>
   .proslider_img_on__edit_mode[src=""] {
  display:none;
}
img[src=''] > i{
   display:none;
}
.hide{display:none !important;}
</style>


<div class="container">
    <div class="row">
    <div id="all_data_backup">
      <table class="table">
         <tr class="pro___slider___heading">
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Shortcode</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
         </tr>
         <?php
            global $wpdb;
            $pro__slider__result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}proslider ", OBJECT );


               foreach ( $pro__slider__result as $key22=>$value22 ) {

                   $id = $pro__slider__result[$key22]->id;
                   $pro__sl_images = $pro__slider__result[$key22]->pro__images;
                   $slider_name__is = $pro__slider__result[$key22]->pro__name;
                   ?>
         <tr>
            <?php
           if($key22<2){


            ?>
            <td scope="row"><?php echo esc_attr($id); ?></td>
            <td id="slider__names"><?php echo esc_attr($slider_name__is); ?></td>
            <td style="cursor: pointer;"><input id="copyshotcode<?php echo esc_attr($id); ?>"  onclick="Clicktocopy(this)" class="<?php echo esc_attr($id); ?>" type="text" value="[proslider-code slider__id='<?php echo esc_attr($id); ?>']" style="cursor: pointer; width:90%; "></td>
            <td id="edit__pro__data<?php echo esc_attr($id); ?>"><a href="#<?php echo esc_attr($id); ?>"  class="edit__slides" onclick="edit_my__slides()"><i class="fa fa-edit"></i></a></td>

            <td id="deletedata"><a class="delete_pro__slides" id="<?php echo esc_attr($id); ?>"><i class="fa fa-trash"></i></a></td>



         </tr>
         <?php
         }

      }

            ?>
   </div>
   </table>
</div>
</div>


                                    <!-- Edit mode is on -->


    <div class="row">
       <div class="col-md-12 col-sm-12 col-lg-12" id="edit__pro__slides_data">
          <form action="javascript:void(0)" method="post" id="edit__my__pro__slider__id">
             <h3 class="mt-4 mb-5" style="text-align:center;">Edit The Pro Slider</h3>
               <?php
                global $wpdb;
                $pro_result_for_edit = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}proslider WHERE id = '".$id."'" , OBJECT );

                foreach ( $pro_result_for_edit as $pro__key=>$pro__value ) {

                  $id = $pro_result_for_edit[$pro__key]->id;

                  $pro__sl_images = $pro_result_for_edit[$pro__key]->pro__images;
                  $pro__slides_arr = explode(',', $pro__sl_images);

                 ?>
               <script>
                        sliderString = "<?php echo esc_attr($pro__sl_images) ?>";
                        pro__sl_images = sliderString.split(",");
              </script>
              <div class="row">
                 <div class="row" id="cxdd">
                    <div class="col-sm-12 col-md-3 col-lg-3 mt-2 pro_slider_edit_mode_column">
                    <input type="button" name="edit_me_i_have_proslides" id="edit_collect_pro_slides" class="pro_slides" value="+" required/>
                    <input type="hidden" id="edit_hiddensl__pro_img" name="prs2" value="<?php  echo esc_attr($pro__sl_images); ?>"/>
                    </div>

                   <div class="nextandupdate">
                     <input type="hidden" name="id" value="<?php echo esc_attr($id) ?>">
                     <?php wp_nonce_field('edit__pro__slides', 'rdm-nonce'); ?>
                     <button type="button" class="updatepro___slides">Update</button>
                  </div>
                 </div>
              <?php
                   for($i=0; $i < sizeof($pro__slides_arr); $i++) {

                     if(!empty($pro__value)){
               ?>


                  <div class="col-sm-12 col-md-3 col-lg-3 mt-2 pro_slider_edit_mode_column">
                     <img class="proslider_img_on__edit_mode" src="<?php echo esc_attr($pro__slides_arr[$i]); ?>" width="200" height="200" style="object-fit: cover;"><i class="fa fa-times removeicon" data-lngth="<?php echo esc_attr($pro__slides_arr[$i]); ?>"aria-hidden="true"></i>
                  </div>
            <?php
            }
            }
            ?>

              </div>

                 <?php
                 }

               ?>
          </form>

       </div>

    </div>
</div>

<script>
   var pro__slide__arrr = [];

// Getting images for slider from the media files
jQuery("#edit_collect_pro_slides").on("click",function(){
      var images = wp.media({
      title: "Choose a file…",
      multiple: true
    }).open().on("select",function(e){
      var uploadedImages = images.state().get("selection");
      var selectedImages = uploadedImages.toJSON();
      jQuery.each(selectedImages,function(index,image){
        var div = document.createElement('DIV');
        div.className ="col-sm-12 col-md-3 col-lg-3 mt-2 pro_slider_edit_mode_column";
        var cross = document.createElement('I');
        cross.classList = 'fa fa-times removeicon';
        cross.setAttribute('data-lngth',image.url);
        var img = document.createElement('IMG');
        img.src = image.url;
        img.className="proslider_img_on__edit_mode";
        img.width = '200';
        img.height = '200';
        div.append(img);
        div.append(cross);
        pro__slide__arrr.push(image.url);
        document.getElementById('cxdd').append(div);
        jQuery('input[name="prs2"]').val(pro__slide__arrr.toString());
    });
  });

  jQuery('#edit__my__pro__slider__id').delegate('.removeicon',"click",function(){

var sure = confirm('Are you sure, you want to delete this Item!');
if(sure){
   var url1 = jQuery(this).data('lngth');
   var index = jQuery.inArray(url1,pro__slide__arrr);

 jQuery(this).parent().remove();
 pro__slide__arrr.splice(index,1);
 document.getElementById('edit_hiddensl__pro_img').value = pro__slide__arrr.toString();
}
});

});

      jQuery('.removeicon').click(function(e) {
      var sure = confirm('Are you sure, you want to delete this Item!');
      var aan = jQuery('#edit_hiddensl__pro_img').val();
      pro__slide__arrr = aan.split(",");
      var crtelen = (pro__slide__arrr.length)-1;
      pro__slide__arrr.splice(crtelen,1);
      if(sure){
      var url2 =jQuery('.removeicon').data('lngth');

      var index = jQuery.inArray(url2,pro__slide__arrr);

      jQuery(this).parent().remove();
      pro__slide__arrr.splice(index,1);
      document.getElementById('edit_hiddensl__pro_img').value = pro__slide__arrr.toString();
      }
      });

document.getElementById("edit__pro__slides_data").style.display="none";

function edit_my__slides(){
document.getElementById("edit__pro__slides_data").style.display="block";
document.getElementById("all_data_backup").style.display="none";

}

function Clicktocopy(ele) {
         var crteid = 'copyshotcode'+ele.className;
         console.log(crteid);
         var copyText = document.getElementById(crteid);
         copyText.select();
         copyText.setSelectionRange(0, 99999);
         document.execCommand("copy");
}

jQuery(".delete_pro__slides").on("click",function(){

    var sure = confirm('Are you sure, you want to delete this Item!');


    if(sure){
    var postdata = "action=delete_pro_slider_by_id&param=save_plugin&id="+this.id;
    jQuery.post(ajax_object,postdata,function(response){

    var data = jQuery.parseJSON(response);
    if(data.status==1){
    window.location.reload();check
    }
    });
    }

    });
</script>
