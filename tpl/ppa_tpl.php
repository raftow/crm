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


                                                $(".ppa-acceptance").click(function() {
                                                    $("#crm_go").attr("disabled", $("#ppa").checked);
                                                });
                                        });
                                        </script>