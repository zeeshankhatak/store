
    $('#filetype').change(function() {
      
    if($(this).val() == 'video')
    {
      $('#videotype').show();
      $('#imageChoose').hide();
      $('#zipChoose').hide();
      $('#pdfChoose').hide();
      $('#imageUpload').hide();
      $('#pdfUpload').hide();
      $('#imageURL').hide();
      $('#size').hide();
      $('#pdfURL').hide();
      $('#duration_video').show();
      $('#zipURL').hide();
      $('#zipUpload').hide();
      $('#subtitle').show();
      $('#previewUrl').show();
      $("#ch1").prop("checked", false);
      $("#ch2").prop("checked", false);
    }
    else if($(this).val() == 'image')
    { 
      $('#imageChoose').show();
      $('#videotype').hide();
      $('#zipChoose').hide();
      $('#pdfChoose').hide();
      $('#pdfUpload').hide();
      $('#videoUpload').hide();
      $('#zipUpload').hide();
      $('#videoURL').hide();
      $('#size').show();
      $('#duration_video').hide();
      $('#pdfURL').hide();
      $('#zipURL').hide();
      $('#subtitle').hide();
      $('#previewUrl').hide();
      $("#ch3").prop("checked", false);
      $("#ch4").prop("checked", false);
    }
    else if($(this).val() == 'zip')
    {
      $('#zipChoose').show();
      $('#videotype').hide();
      $('#videoUpload').hide();
      $('#videoURL').hide();
      $('#imageChoose').hide();
      $('#pdfChoose').hide();
      $('#imageUpload').hide();
      $('#size').show();
      $('#imageURL').hide();
      $('#pdfUpload').hide();
      $('#pdfURL').hide();
      $('#duration_video').hide();
      $('#subtitle').hide();
      $('#previewUrl').hide();
      $("#ch5").prop("checked", false);
      $("#ch6").prop("checked", false);
    }
    else if($(this).val() == 'pdf')
    {
      $('#pdfChoose').show();
      $('#videotype').hide();
      $('#videoUpload').hide();
      $('#videoURL').hide();
      $('#imageChoose').hide();
      $('#duration_video').hide();
      $('#zipChoose').hide();
      $('#imageUpload').hide();
      $('#size').show();
      $('#imageURL').hide();
      $('#zipUpload').hide();
      $('#zipURL').hide();
      $('#subtitle').hide();
      $('#previewUrl').hide();
      $("#ch7").prop("checked", false);
      $("#ch8").prop("checked", false);
    }
    else
    {
      $('#videotype').hide();
      $('#videoUpload').hide();
      $('#zipUpload').hide();
      $('#videoURL').hide();
      $('#zipURL').hide();
      $('#pdfUpload').hide();
      $('#pdfChoose').hide();  
      $('#pdfURL').hide();
      $('#imageChoose').hide();
      $('#zipChoose').hide();
      $('#subtitle').hide();
    }
  });

    $('#ch1').click(function(){
      $('#videoURL').show();
      $('#videoUpload').hide();
      $('#iframeURLBox').hide();
      $('#duration_video').show();
    });

    $('#ch2').click(function(){
      $('#videoURL').hide();
      $('#videoUpload').show();
      $('#iframeURLBox').hide();
      $('#duration_video').show();
    });

    $('#ch9').click(function(){
      $('#iframeURLBox').show();
      $('#videoURL').hide();
      $('#videoUpload').hide();
      $('#liveclassBox').hide();
      $('#duration_video').show();
    });

    $('#ch10').click(function(){
      $('#videoURL').show();
      $('#liveclassBox').show();
      $('#iframeURLBox').hide();
      $('#videoUpload').hide();
      $('#duration_video').show();
    });
      
    $('#ch22').click(function(){
      $('#videoURL').hide();
      $('#videoUpload').hide();
      $('#duration_video_video').show();
    });

    $('#ch3').click(function(){
      $('#imageURL').show();
      $('#imageUpload').hide();
    });

    $('#ch4').click(function(){
      $('#imageURL').hide();
      $('#imageUpload').show();
    });

    $('#ch5').click(function(){
      $('#zipURL').show();
      $('#zipUpload').hide();
    });

    $('#ch6').click(function(){
      $('#zipURL').hide();
      $('#zipUpload').show();
    });

    $('#ch7').click(function(){
      $('#pdfURL').show();
      $('#pdfUpload').hide();
    });

    $('#ch8').click(function(){
      $('#pdfURL').hide();
      $('#pdfUpload').show();
    });



 // dynamic subtitle add js 
    $(document).ready(function(){
      var i= 1;
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="sub_t[]"/></td><td><input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');  
      });

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $('form').on('submit', function(event){
        $('.loading-block').addClass('active');
      });
      $('#custom_url').hide();

      $('#TheCheckBox').on('switchChange.bootstrapSwitch', function (event, state) {

          if (state == true) {

             $('#ready_url').show();
            $('#custom_url').hide();

          } else if (state == false) {

            $('#ready_url').hide();
            $('#custom_url').show();

          };

      });

      $('.upload-image-main-block').hide();
      $('.subtitle_list').hide();
      $('#subtitle-file').hide();
      $('.movie_id').hide();
      $('input[name="subtitle"]').click(function(){
          if($(this).prop("checked") == true){
              $('.subtitle_list').fadeIn();
              $('#subtitle-file').fadeIn();
          }
          else if($(this).prop("checked") == false){
            $('.subtitle_list').fadeOut();
              $('#subtitle-file').fadeOut();
          }
      });
      $('.for-custom-image input').click(function(){
        if($(this).prop("checked") == true){
          $('.upload-image-main-block').fadeIn();
        }
        else if($(this).prop("checked") == false){
          $('.upload-image-main-block').fadeOut();
        }
      });
      $('input[name="series"]').click(function(){
          if($(this).prop("checked") == true){
              $('.movie_id').fadeIn();
          }
          else if($(this).prop("checked") == false){
            $('.movie_id').fadeOut();
          }
      });
    });


