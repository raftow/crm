<script> 
        // alert('test 123');
        $(document).ready(function() {       
                $("#customer_cpt").on("input", function() {
                        $(".login_error").remove();
                        
                });

                $('#customer_mobile').on('change', function() {
                        if(!isCorrectMobileNumber($('#customer_mobile').val()))
                        {
                                $('#customer_mobile-error').removeClass('d-none').text('رقم الجوال غير صحيح، استخدم الصيغة : 0512345678');
                        }
                        else
                        {
                                $('#customer_mobile-error').addClass('d-none');
                                console.log($('#customer_mobile').val()+' is good saudi mobile number');
                        }                                                                        
                });

                $('#customer_idn').on('change', function() {
                        // alert('test 456');
                        if(validateSaudiID($('#customer_idn').val()) < 0)
                        {
                                $('#customer_idn-error').removeClass('d-none').text('رقم الهوية غير صحيح');
                        }
                        else
                        {
                                $('#customer_idn-error').addClass('d-none');
                                console.log($('#customer_idn').val()+' is good saudi ID');
                        }                                                                        
                });

                $('#first_name_ar').on('change', function() {
                        if(!isCorrectName($('#first_name_ar').val()))
                        {
                                $('#first_name_ar-error').removeClass('d-none').text('هذا الاسم غير صحيح. يجب أن يكون الاسم حروفا عربية أو انجليزية فقط');
                        }
                        else
                        {
                                $('#first_name_ar-error').addClass('d-none');
                                console.log($('#first_name_ar').val()+' is good Name');
                        }                                                                        
                });

                

                $('#last_name_ar').on('change', function() {
                        if(!isCorrectName($('#last_name_ar').val()))
                        {
                                $('#last_name_ar-error').removeClass('d-none').text('هذا الاسم غير صحيح. يجب أن يكون الاسم حروفا عربية أو انجليزية فقط');
                        }
                        else
                        {
                                $('#last_name_ar-error').addClass('d-none');
                                console.log($('#last_name_ar').val()+' is good Name');
                        }                                                                        
                });

                $('#customer_email').on('change', function() {
                        if(!isCorrectEmail($('#customer_email').val()))
                        {
                                $('#customer_email-error').removeClass('d-none').text('البريد الالكتروني غير صحيح');
                        }
                        else
                        {
                                $('#customer_email-error').addClass('d-none');
                                console.log($('#customer_email').val()+' is good email format');
                        }                                                                        
                });



                
        });
</script>