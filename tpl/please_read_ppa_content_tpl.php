                    <?php                         
                        $company = AfwSession::currentCompany();
                        $main_company_domain = AfwSession::config("main_company_domain", "$company.gov.sa");       
                        $url_ppa = AfwSession::config("url_ppa", "https://$main_company_domain/ar/Pages/PrivacyPolicy.aspx");       
                    ?>   
                        <div class="ppa">
                                <p class="special-link todo">
                                    قبل تسجيل الدخول فضلا نأمل منكم فتح الرابط أسفله ثم قراءة تفاصيل وبنود سياسة الخصوصية
                                </p>
                                <p class="special-link ppa read"><a target="_new" href="<?php echo $url_ppa;?>">الاطلاع على سياسة الخصوصية</a></p>
                        </div><br>