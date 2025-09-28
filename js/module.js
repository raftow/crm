$(document).ready(function() {       
    $("#confidentialbtn").click(function() {
        if($(this).hasClass('confidential'))
        {
            $("div.confidential").addClass('non-confidential');
            $("div.confidential").removeClass('confidential');
            $(this).addClass('non-confidential');
            $(this).removeClass('confidential');
            console.log("now become non-confidential");
        }
        else
        {
            $("div.non-confidential").addClass('confidential');
            $("div.non-confidential").removeClass('non-confidential');
            $(this).addClass('confidential');
            $(this).removeClass('non-confidential');
            console.log("should be confidential");
        }    
    
});
});