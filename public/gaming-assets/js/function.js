$('.coach-slider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  centerMode: true,
  variableWidth: true,
  infinite: true,
  focusOnSelect: true,
  cssEase: 'linear',
  touchMove: true,
  prevArrow:'<button class="slick-prev"> < </button>',
  nextArrow:'<button class="slick-next"> > </button>',

  //         responsive: [
  //             {
  //               breakpoint: 576,
  //               settings: {
  //                 centerMode: false,
  //                 variableWidth: false,
  //               }
  //             },
  //         ]
});


var imgs = $('.coach-slider img');
imgs.each(function(){
  var item = $(this).closest('.coach');
  item.css({
    'background-image': 'url(' + $(this).attr('src') + ')',
    'background-position': 'center',
    '-webkit-background-size': 'cover',
    'background-size': 'cover',
    'display': 'block'
  });
  $(this).hide();
});

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
  //... and fix the Previous/Next buttons:
  if (i == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (i == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
}

$(document).ready(function(){
  AOS.init();
   // $('.game-selection li').hover(function () {

   //      $(this).children('.drop-down').toggle();


   //  });



$('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');

  });


    $('input:radio[name="chooseCoach"]').change(
    function(){
        if ($(this).is(':checked') && $(this).val() == 'Coach') {
            $('.btn1').show();
            $('.btn2').hide();
        }
        else{
          $('.btn1, .btn2').show();
        }
    });


    $("input[name=package]").click(function() {
      $('.packageid').html($(this).val());

    });

   $("input[name=experience]").click(function() {
      $('.experienceid').html($(this).val());

    });

    $("input[name=duration]").click(function() {

        console.log('test');

      $('.durationid').html($(this).val());

    });

    $("input[name=rank]").click(function() {
      $('.rankid').html($(this).val());

    });



    $("input[name=coachingExp]").click(function() {
      $('.coachingExpid').html($(this).val());

      if ($("#ce1").prop("checked")) {
        $('.hours, .gamingExp').css('display', 'block')
      }else if ($("#ce2").prop("checked")) {
         $('.packageGamingExp').css('display', 'block')
         $('.hours, .gamingExp, .your-rank').css('display', 'none')
      }else {
        $('.hours, .gamingExp, .packageGamingExp, .your-rank').css('display', 'none')
      }

    });

    $("input[name=packageGaming]").click(function() {
       $('.packageGamingid').html($(this).val());
    })

    $("input[name=experience]").click(function() {
      $('.experienceid').html($(this).val());

      if ($("#e1").prop("checked")) {
        $('.your-rank').css('display', 'block')
      }else {
        $('.your-rank').css('display', 'none')
      }

    });


    $("input[name=experience]").click(function() {
     if ($("#ge1").prop("checked", true)) {

        $('.gamingrank').css('display', 'block')
      }else {
        $('.gamingrank').css('display', 'none')
      }
    });

});

