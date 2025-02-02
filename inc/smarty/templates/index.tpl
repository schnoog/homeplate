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
            <div class="container px-4 px-lg-5">
                <!-- Featured Project Row-->
                <div class="row gx-0 mb-4 mb-lg-5 align-items-top">

                    <div class="col-xl-8 col-lg-7">

                    {$mcnt = count($badgecolos) -1}
                    {$bci = 0}
                    <button type="button" class="badge text-bg-dark" onclick="filterButtons('');">
                        <h4><span class="badge text-bg-dark">All</span></h4>
                    </button>                    
                    {foreach $fullhostdata.taglist as $tag}
                            <button type="button" class="badge text-bg-dark" onclick="filterButtons('{$tag}');">
                                <h4><span class="badge text-bg-dark">{$tag}</span></h4>
                            </button>
                    {/foreach}
                    <hr>
                    <button type="button" class="badge text-bg-dark" onclick="filterButtonsByClass('');">
                        <h4><span class="badge text-bg-dark">All</span></h4>
                    </button>                     
                    {foreach $fullhostdata.grouplist as $id=>$group}
                    {$tg = "text-bg-grp{$id}"}
                        <button type="button" class="badge {$tg}" onclick="filterButtonsByClass('{$group}');">
                            <h3><span class="badge {$tg}">{$group}</span></h3>
                        </button>
                    {/foreach}                    
                    <hr>




                    {foreach $fullhostdata.fullhosts as $host}
                        <button type="button" class="btn mbtn badge text-bg-info {$host.hostgroup}" alt="{$host.host_url}" 
                        title="Open {$host.host_url}" onclick='openNewTab("{$host.host_url}");' tags="{$host.tags}"  style="display: flex; align-items: right; text-align: left;">
                        <img src="assets/img/icons/{$basedata.iconset[$host.host_icon]}" height="60px" style="margin-right: 10px;">
                        <div>
                        <h5>{$host.host_name}</h5>
                            <div>
                            {foreach $host.tag as $tag}
                                

                                <span class="badge text-bg-dark">{$tag}</span>
                            {/foreach}

                            <span class="badge text-bg-secondary">{$host.hostgroup}</span>
                            </div>
                        </div>
                        </button>

                    {/foreach}





                                
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                                    {$online = '<i class="fa-regular fa-circle-check" style="color:green"></i>'}
                                    {$offline = '<i class="fa-regular fa-circle-xmark" style="color:red"></i>'}




                                    <div id="pinglist">
                                    <h4>Last update {$data.lastscan} second{if $data.lastscan > 1}s{/if} ago</h4>                                    
                                    <ul class="list-group">
                                    {foreach $data.hosts as $id=>$host}
                                        {if $host.host_active == 1 or $host.host_state == 1}
                                        {if $host.host_name == $host.host_ipv4}
                                            {$label = ""}
                                        {else}
                                            {$label = " ({$host.host_ipv4})" }
                                        {/if}



                                    <li class="list-group-item">{if $host.host_state == 1}{$online}{else}{$offline}{/if}{$host.host_name}{$label}</li>
                                        {/if}
                                    {/foreach}
                                    </ul>
                                    </div>
                            
                            <p class="text-black-50 mb-0">Grayscale is open source and MIT licensed. This means you can use it for any project - even commercial projects! Download it, customize it, and publish your website!</p>
                        </div>
                    </div>
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
