jQuery(function() {
jQuery(document).ready(function(){
    jQuery('.imagen[src=""]').hide();
    jQuery('.imagen:not([src=""])').show();
});
// changing the input buttons value @meadi screen
 if (screen.width < 601) {
    jQuery('.pro_slides').val("+");
}
else if (screen.width > 601) {
    jQuery('.pro_slides').val("+");
}

var sliderImgArr = [];


// Getting images for slider from the media files
jQuery("#collect_pro_slides").on("click",function(){
      var images = wp.media({
      title: "Choose a file…",
      multiple: true
    }).open().on("select",function(e){
      var uploadedImages = images.state().get("selection");
      var selectedImages = uploadedImages.toJSON();      
      jQuery.each(selectedImages,function(index,image){
        var div = document.createElement('DIV');
        div.className ="col-sm-12 col-md-4 col-lg-4 imgwrap";
        var cross = document.createElement('I');
        cross.classList = 'fa fa-times removeicon';
        cross.setAttribute('data-lngth',image.url);
        var img = document.createElement('IMG');
        img.src = image.url;
        img.width = '200';
        div.append(img);
        div.append(cross);
        var breaktag = document.createElement('br');
        document.getElementById('see__pro__slides').append(div);
        sliderImgArr.push(image.url);
        }); 
        jQuery('input[name="prs1"]').val(sliderImgArr.toString());
    });
  });
  // selection jQuery ends


  jQuery('#get_img_form').delegate('.removeicon',"click",function(){
   var url1 = jQuery(this).data('lngth');
    var index = jQuery.inArray(url1,sliderImgArr);

    jQuery(this).parent().remove();
    
    sliderImgArr.splice(index,1);
   
    document.getElementById('hiddensl__pro_img').value = sliderImgArr.toString();
    
  });

});

// slider submit button function is here

jQuery("#add__pro__slides").on("click", function() {


var postdata = "action=pro_slider_data&param=save_plugin&" + jQuery("#get_img_form").serialize();
jQuery.post(ajax_object, postdata, function(response) {
var data = jQuery.parseJSON(response);
if (data.status == 1) {

document.getElementById('successcontent').innerHTML = "Successfully Submitted !!";
document.getElementById('ShortCodeOfSliderr').innerHTML = "Please Go To The My Sliders Page For Shortcode";
location.reload();

}
});
});

jQuery(".updatepro___slides").on("click",function(){

  var sure = confirm('Are you sure, you want to update this slider!');

  if(sure){
   
  var postdata = "action=edit__pro__slides&param=save_plugin&"+jQuery("#edit__my__pro__slider__id").serialize();
          jQuery.post(ajax_object,postdata,function(response){
              var data = jQuery.parseJSON(response);
              if(data.status==1){
                  // var mainid = data['id'];                    
                  // window.location.href ="?page=all-popups";
                  window.location.reload();
          }
          });
}
  });

// mainProSliderFront Page js

jQuery(function() {
jQuerynum = jQuery('.my-card').length;
jQueryeven = jQuerynum / 2;
jQueryodd = (jQuerynum + 1) / 2;

if (jQuerynum % 2 == 0) {
  jQuery('.my-card:nth-child(' + jQueryeven + ')').addClass('active');
  jQuery('.my-card:nth-child(' + jQueryeven + ')').prev().addClass('prev');
  jQuery('.my-card:nth-child(' + jQueryeven + ')').next().addClass('next');
} else {
  jQuery('.my-card:nth-child(' + jQueryodd + ')').addClass('active');
  jQuery('.my-card:nth-child(' + jQueryodd + ')').prev().addClass('prev');
  jQuery('.my-card:nth-child(' + jQueryodd + ')').next().addClass('next');
}

jQuery('.my-card').click(function() {
  jQueryslide = jQuery('.active').width();
  
  if (jQuery(this).hasClass('next')) {
    jQuery('.card-carousel').stop(false, true).animate({left: '-=' + jQueryslide});
  } else if (jQuery(this).hasClass('prev')) {
    jQuery('.card-carousel').stop(false, true).animate({left: '+=' + jQueryslide});
  }
  
  jQuery(this).removeClass('prev next');
  jQuery(this).siblings().removeClass('prev active next');
  
  jQuery(this).addClass('active');
  jQuery(this).prev().addClass('prev');
  jQuery(this).next().addClass('next');
});


// Keyboard nav
jQuery('html body').keydown(function(e) {
  if (e.keyCode == 37) { // left
    jQuery('.active').prev().trigger('click');
  }
  else if (e.keyCode == 39) { // right
    jQuery('.active').next().trigger('click');
  }
});
});
