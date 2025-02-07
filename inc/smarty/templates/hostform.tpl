

<div class="container mt-5">
    <div class="col-md-6">
    <form method="post" action="hosts.php"><button type="submit" class="btn btn-danger">Back to host list</button></form><br>

    </div>
    <div class="col-md-6">
    </div>


<form method="post" class="row g-3">
    <div class="col-md-6">

        <input type='hidden' name='save' value='save'>
        {if $upd} 
            <input type="hidden" name="id" value="{$ehost.id}">
        {/if}
        <label for="host_name" class="form-label">Host Name</label>
        <input type="text" name="host_name" id="host_name" {if $upd} value="{$ehost.host_name}"{/if}  required />

    </div>

    <div class="col-md-6">
        <label for="GRPID" class="form-label">Group</label>
        {html_options id="GRPID" name="GRPID" options=$SET.groupsbyid selected=$ehost.GRPID}

    </div>
    <div class="col-md-6">
        <label for="localonly" class="form-label">Local Only</label>

    {html_options id="localonly" name="localonly" options=$SET.options.yesno selected=$ehost.localonly}
    
    </div>
    <div class="col-md-6">
        <label for="usedns" class="form-label">Use DNS</label>    
    
    {html_options id="usedns" name="usedns" options=$SET.options.yesno selected=$ehost.usedns}

    </div>
    <div class="col-md-6">
        <label for="host_ipv4" class="form-label">Host IPv4</label>


<input type="text" name="host_ipv4" id="host_ipv4" {if $upd} value="{$ehost.host_ipv4}"{/if}   />

    </div>
    <div class="col-md-6">
        <label for="host_ipv6" class="form-label">Host IPv6</label>


<input type="text" name="host_ipv6" id="host_ipv6" {if $upd} value="{$ehost.host_ipv6}"{/if}   />


    </div>
    <div class="col-md-6">
        <label for="host_hostname" class="form-label">Hostname</label>

<input type="text" name="host_hostname" id="host_hostname" {if $upd} value="{$ehost.host_hostname}"{/if}   />

    </div>
    <div class="col-md-6">
        <label for="host_url" class="form-label">Host URL</label>


<input type="text" name="host_url" id="host_url" {if $upd} value="{$ehost.host_url}"{/if}   />

    </div>
    <div class="col-md-6">
        <label for="host_checkurl" class="form-label">Check URL</label>


    {html_options id="host_checkurl" name="host_checkurl" options=$SET.options.yesno selected=$ehost.host_checkurl}

    </div>
    <div class="col-md-6">
        <label for="host_state" class="form-label">Host State</label>


    {html_options id="host_state" name="host_state" options=$SET.options.activeinactive selected=$ehost.host_state}

    </div>
    <div class="col-md-6">
        <label for="host_laststatechange" class="form-label">Last State Change</label>


<input type="text" name="host_laststatechange" id="host_laststatechange" {if $upd} value="{$ehost.host_laststatechange}"{/if}   />

    </div>
    <div class="col-md-6">
        <label for="host_icon" class="form-label">Host Icon</label>


    {html_options id="host_icon" name="host_icon" options=$SET.iconssbyid selected=$ehost.host_icon}

    </div>
    <div class="col-md-12">
        <label for="tags" class="form-label">Tags</label>
        {html_options id="tags" name="tags[]" class="js-tag-multiple" options=$SET.tagsbyid selected=$ehost.tagarray  multiple="multiple"}




    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
</div>


<script>
$(document).ready(function() {
    $('.js-tag-multiple').select2();
} ) ;

</script>
