$(document).ready(function() {
    getStudent();
    getAllStudent();
    // Making 2 variable month and day
    var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
    var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

    // make single object
    var newDate = new Date();
    // make current time
    newDate.setDate(newDate.getDate());
    // setting date and time
    $('#date').html(dayNames[newDate.getDay()] + ", " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

    setInterval( function() {
        // Create a newDate() object and extract the hours of the current time on the visitor's
        $("#hours").html(moment().format('hh'));
        $("#min").html(moment().format('mm'));
        $("#ampm").html(moment().format('a'));
        getStudent();
        getAllStudent();
    }, 1000);    
    
    $("form#form-student").on('submit', function(e){
        var formData = new FormData($(this)[0]);

        $.ajax({
            type: "POST",
            url: "data/student-handler.php",
            data: formData,
            cache: false,
            async: false,
            processData: false,
            contentType: false,
            success: function(data){
                console.log(data)
                if(data==1){
                    getStudent();
                    getAllStudent();
                    toastSuccess("","Please get your number");
                }else if(data==2){
                    getAllStudent();
                    toastSuccess("","Your Done !!!");
                }else{
                    toastErr("Error","Invalid student");
                }
            }
        })
        e.preventDefault();
    });
    
});

function getAllStudent(){
    
    $.ajax({
        type: "POST",
        url: "data/student-handler.php",
        data: "studentAll=true",
        cache: false,
        success: function(data) {
            var json = $.parseJSON(data);
            if(data!="null"){
                var list = $(".list-content").empty();
                $(json).each(function(i,val){
                    list.append('<li>'+
                                     '<div class="list-container">'+val.img+
                                         '<span>'+val.studnum+'</span>'+
                                         '<span>Start: <strong>'+val.str+'</strong> | End: <strong>'+val.end+'</strong></span>'+
                                     '</div>'+
                                 '</li>')
                 });
            }else{
                
            }
            
        }
    })
}

function getStudent() {
    $.ajax({
        type: "POST",
        url: "data/student-handler.php",
        data: "student=true",
        cache: false,
        success: function(data) {
            if(data=="null"){
                $(".intro-content h3").empty();
            }else{
                var json = $.parseJSON(data);
            
                $(json).each(function(i,val){
                    
                    $(".intro-content h3").html('<span id="fullname">'+val.studnum+'</span>'+
                    '<span>Start Time: <span id="str">'+val.str+'</span></span>');
                    $(".profile").html(val.img);
                   // $("#num").html('#'+val.num);
                });
            }
           
        }
    })
}

function toastSuccess(head,txt) {
	$.toast({
		stack: true,
	    heading: head,
	    text: txt,
	    icon: 'success',
	    showHideTransition: 'slide',
	    bgColor: '#000',
	    hideAfter: 5000,
	    loaderBg: '#f1f1f1',
	    position: 'bottom-left'
	})

}

function toastErr(head,txt) {
	$.toast({
		stack: true,
	    heading: head,
	    text: txt,
	    showHideTransition: 'slide',
	    icon: 'error',
	    hideAfter: 10000,
	    loaderBg: '#f1f1f1',
	    position: 'bottom-left'
	})

}