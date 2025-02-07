{include file='head.tpl'}      

        <!-- Masthead-->
        <!--
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">Grayscale</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">A free, responsive, one page Bootstrap theme created by Start Bootstrap.</h2>
                        <a class="btn btn-primary" href="#about">Get Started</a>
                    </div>
                </div>
            </div>
        </header>
       -->

       <!-- Projects-->
        <section class="projects-section bg-light" id="projects">
            <div class="container-fluid">
                <!-- Featured Project Row-->
                <div class="row gx-0 mb-4 mb-lg-5 align-items-top">

                    <div class="col-xl-12 col-lg-12">

                    {if $CFG.hostlist.edit}
                        {include file='hostform.tpl'}                         
                    
                    {else}

                        {include file='hostlist.tpl'}  

                    {/if}
                                
                    </div>
                    <!--
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">



                        </div>
                    </div>-->
                </div>
            </div>
        </section>



        <!-- Contact-->
        {if $CFG.session.loggedin}
        <section class="contact-section bg-yellow">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">

                        <h1>DUMP</h1>
                        {$dump}      
                        </hr>          


                </div>
            </div>        
        </section>
        {/if}


{include file='foot.tpl'}        
