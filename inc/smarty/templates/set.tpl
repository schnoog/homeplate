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

        <center><h3>Settings</h3>
        </center>
        <div class="row align-top">
            <div class="col-sm-4 align-top">
            <center>
            {include file='z_grouptable.tpl'} 

            </center>
            </div>
            <div class="col-sm-4 align-top">
            <center>
            {include file='z_tagtable.tpl'} 
         
            </center>
            </div>
            <div class="col-sm-4 align-top">
            <center>
            {include file='z_icontable.tpl'} 

            </center>
            </div>

        </div>

    

        </section>



        <!-- Contact-->

        <section class="contact-section bg-yellow">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">

                <div class="col-sm-4 align-top">

                <form id="fileupload_form" class="form-horizontal">
                        
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Select File</label>
                    <div class="col-sm-6">
                    <input type="file" id="myfile" class="form-control"/>
                    </div>
                    </div>
                                
                    <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6 m-t-15">
                    <input type="button" onclick="saveFile();" value="Upload" class="btn btn-success btn-lg btn-block"> 
                    </div>
                    </div>
                            
                </form>

                </div>
                    <div class="col-sm-8 align-top">

                    <h3>Unassigned icons</h3>
                        <table border='1'>
 


                        <tr style="height: 80px;">
                        
                        {foreach $SET.newimages as $IMG }
                            <td style="height: 80px;"> 
                            <button type="button" class="btn btn-success p-3" onclick="assignIcon('{$IMG}');" >Assign</button> 
                            <img src="assets/img/icons/{$IMG}" height='90%'><br>
                            {$IMG}
                            </td>
                        {/foreach}
                        </tr>
                        </table>
                    </div>
                </div>
            </div>        
        </section>



{include file='foot.tpl'}        
