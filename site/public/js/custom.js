


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





/* Contact Data Send */

$(document).ready(function(){

    $("#contactSendConfirm").click(function(){
        let contactName = $("#contactName").val();
        let contactMessage = $("#contactMessage").val();
        let contactPhone = $("#contactMessage").val();
        let contactEmail = $("#contactEmail").val();
        if(contactName.length==0)
        {
            alert("Your Name Required");
        }
        else if(contactPhone.length==0)
        {
            alert("Your Contact NumberRequired");
        }
        else if(contactMessage.length==0)
        {
            alert("Message Required");
        }
        else if(!validateEmail(contactEmail))
        {
            alert("Invalid Email");
        }
        else{
            axios.post('/addContact',{
                name:contactName,
                email:contactEmail,
                message:contactMessage,
                phone:contactPhone
            })
            .then(function(response){
                if(response.data.status==200)
                {
                    alert("Send Success");
                }
                else{
                    toastr.error("Something went wrong");
                }
            }).catch(function(error){
                alert("something went wrong");
            })
        }
    });


});

function validateEmail(email)
{
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}




