$(document).ready(function() {       
    $(".confidential-button").click(function() {
        idbtn = $(this).attr('id');
        console.log("idbtn="+idbtn);
        arr_data = idbtn.split("-");
        console.log("arr_data="+arr_data);
        idreq = arr_data[1];
        
        if($(this).hasClass('confidential'))
        {
            // $("div.confidential").addClass('non-confidential');
            // $("div.confidential").removeClass('confidential');
            $("#div-request-body-"+idreq).addClass('non-confidential');
            $("#div-request-body-"+idreq).removeClass("confidential");  

            $(this).addClass('non-confidential');
            $(this).removeClass('confidential');
            console.log("div-request-body-"+idreq+" now become non-confidential");
        }
        else
        {
            // $("div.non-confidential").removeClass('non-confidential');
            // $("div.non-confidential").addClass('confidential');
            $("#div-request-body-"+idreq).removeClass('non-confidential');
            $("#div-request-body-"+idreq).addClass("confidential");  

            $(this).addClass('confidential');
            $(this).removeClass('non-confidential');
            console.log("div-request-body-"+idreq+" should be now confidential");
        }    
    
});
});