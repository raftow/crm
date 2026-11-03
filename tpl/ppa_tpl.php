                                        <p class="ppa-acceptance hide">
                                            <input type="checkbox" name="ppa" id="ppa" value="Y">
                                            <span>
                                                اطلعت وأوافق على سياسة الخصوصية
                                            </span>    
                                        </p>
                                        <script>  
                                        $(document).ready(function() {       
                                                /* $(".special-link.ppa.read>a").click(function() {
                                                        $(".ppa-acceptance.hide").removeClass("hide");
                                                });*/

                                                $(".ppa-acceptance.hide").removeClass("hide");


                                                $('#ppa').on('change', function() {
                                                    // تفعيل أو تعطيل الزر بناءً على حالة الـ Checkbox
                                                    if(this.checked) $('#crm_go').removeAttr("disabled");
                                                    else $('#crm_go').attr("disabled", true);
                                                });
                                                
                                        });
                                        </script>