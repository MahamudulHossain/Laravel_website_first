// Owl Carousel Start..................

$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});

// Owl Carousel End..................


$('#contactMsgBtn').click(function(){
    var name = $('#name').val();
    var mobile = $('#mobile').val();  
    var email = $('#email').val(); 
    var msg = $('#msg').val(); 
    contactDataSent(name,mobile,email,msg);
    document.getElementById('conFrm').reset();

});

function contactDataSent(name,mobile,email,msg){
    if(name.length == 0){
        $('#contactMsgBtn').html('আপনার নাম লিখুন');
        setTimeout(function(){ 
         $('#contactMsgBtn').html('পাঠিয়ে দিন');  }, 3000);
    }
    else if(mobile.length == 0){
        $('#contactMsgBtn').html('আপনার মোবাইল নং লিখুন');
        setTimeout(function(){ 
         $('#contactMsgBtn').html('পাঠিয়ে দিন');  }, 3000);
    }
    else if(email.length == 0){
        $('#contactMsgBtn').html('আপনার ইমেইল লিখুন');
        setTimeout(function(){ 
         $('#contactMsgBtn').html('পাঠিয়ে দিন');  }, 3000);
    }
    else if(msg.length == 0){
        $('#contactMsgBtn').html('আপনার মেসেজ লিখুন');
        setTimeout(function(){ 
         $('#contactMsgBtn').html('পাঠিয়ে দিন');  }, 3000);
    } 
    else{
        $('#contactMsgBtn').html('প্রেরিত হচ্ছে...... ');
        setTimeout(function(){ 
                    $('#contactMsgBtn').html('পাঠিয়ে দিন');  }, 3000);
        axios.post('/contactSend',{
            name : name,
            mobile : mobile,
            email : email,
            msg : msg

        })
        .then(function(response){
            if(response.data == 1){
                $('#contactMsgBtn').html('বার্তা প্রেরিত হয়েছে');
                setTimeout(function(){ 
                    $('#contactMsgBtn').html('পাঠিয়ে দিন');  }, 3000);
            }else{
                $('#contactMsgBtn').html('আবার চেষ্টা করুন');
                setTimeout(function(){ 
                    $('#contactMsgBtn').html('পাঠিয়ে দিন');  }, 3000);
            }
        })
        .catch(function(response){
            $('#contactMsgBtn').html('আবার চেষ্টা করুন');
            setTimeout(function(){ 
                 $('#contactMsgBtn').html('পাঠিয়ে দিন');  }, 3000);
        })
    }

}