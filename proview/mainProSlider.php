<?php
   defined('ABSPATH') || die("Okay! you can leave now.");
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4 pt-5 pr_col">
        <h3 class="pr__heading">Pro <span class="bx_slider"> Slider</span></h3>
        <h5 style="color:#fff; font-size:19px; margin-top:10%;">User Friendly design</h5> 
        <h5 style="color:#fff; font-size:19px;">Grow Your Bussiness</h5>
        <h5 style="color:#fff; font-size:19px;">Front End developement</h5>

        <h5 style="color:#fff; margin-top:10%;">Follow us</h5>
        <p class="pro__team__icon">
        <a href="https://www.facebook.com/pages/category/Software-Company/Dream-Reflection-Media-103845991299475/"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com/dream_r_media"><i class="fa fa-twitter"></i></a>
        <a href="https://www.instagram.com/dreamreflectionmedia/"><i class="fa fa-instagram"></i></a>
        <a href="https://www.youtube.com/watch?v=KjlV7ZcEDgU"><i class="fa fa-youtube"></i></a>
        
        </p>
         
        </div>

        <div class="col-sm-12 col-md-8 col-lg-8 mt-5">
            <h3 class="uploadme">Upload Your Files</h3>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                <form action="Javascript:void(0)" method="post" id="get_img_form">
               
                <div class="getting_slides">
                    <!-- selecting images here -->
                    <input type="text" name="pro__sliders_name" placeholder="Slider Name" id="collect_pro_slider_name" autocomplete="off" ><br><br>
                    <p style="color:#888888;">*Add Minimum 7 Images. And images in odd number is good.</p>
                    <input type="button" name="i_have_proslides" id="collect_pro_slides" class="pro_slides" required/>
                    <input type="hidden" id="hiddensl__pro_img" name="prs1" value=""/>
            </div>
           

        <div class="sb__btn_row">
                 <?php
                 global $wpdb;
                 $pro__slider__result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}proslider ", OBJECT );
                
                //  echo $pro__slider__result;
                  
                //  echo sizeof($pro__slider__result)
                    if(count($pro__slider__result)>2){

                      echo "<div style='display:flex; color:#888888; margin-top:5%;'><a href='". admin_url( 'admin.php?page=get-premium' )."' type='button' id='get__Premium'style='margin-right:10px;'>Get Premium </a> Slider Limit Is Over</div>";
                      
                    }
                    else{
                        echo "<button type='button' id='add__pro__slides' style='margin-top:5%;'>UPLOAD</button>";
                    }
                
                 ?>
                 
            </div>
           
                 <div id="see__pro__slides" class="row">
                    
            </div>
    </form>
    </div>
</div>
</div>
</div>
<div class="col-sm-12 col-md-4 col-lg-13 mt-4">
   <?php  echo "<a href='". admin_url( 'admin.php?page=get-premium' )."' type='button' id='go_to_sliders'style='margin-right:10px;'><i class='fa fa-arrow-left'></i> Go To Sliders </a>" ?>    
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="pro__slides_added__successfully">
            <h3 id="successcontent"></h3>
                <p id="ShortCodeOfSliderr"></p>

        </div> 
    </div>
</div>
<style>
    textarea#collect_pro_slider_url {
    width: 312px;
    padding: 0.5rem 1rem;
    font-weight: 600;
    color: #888888;
    border-color: #81d052;
    box-shadow: 0 0 0 1px #81d052;
    outline: 2px solid transparent;
}
textarea#collect_pro_slider_url::placeholder{
    font-weight: 600;
    color: #888888;
}
textarea#collect_pro_slider_url:focus{
    border-color: #1cc8cc;
    box-shadow: 0 0 0 1px #1cc8cc;
    outline: 2px solid transparent;
}
</style>
   
