

<div class="container mt-5">
    <div class="col-md-6">
    <form method="post" action="localnet.php"><button type="submit" class="btn btn-danger">Back to host list</button></form><br>

    </div>
    <div class="col-md-6">
    </div>

    {$upd = true}
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
        {html_options id="GRPID" name="GRPID" options=$SET.lgroupsbyid selected=$ehost.GRPID}

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


<input type="text" name="host_ipv4" id="host_ipv4" {if $upd} value="{$ehost.host_ipv4}"{/if}  disabled  />

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
        <label for="host_active" class="form-label">Check URL</label>


    {html_options id="host_active" name="host_active" options=$SET.options.yesno selected=$ehost.host_active}

    </div>
    <div class="col-md-6">
        <label for="host_state" class="form-label">Host State</label>


    {html_options id="host_state" name="host_state" options=$SET.options.activeinactive selected=$ehost.host_state}

    </div>


    <div class="col-md-6">
        <label for="host_alarmdeath" class="form-label">Host Alarming</label>


    {html_options id="host_alarmdeath" name="host_alarmdeath" options=$SET.options.activeinactive selected=$ehost.host_alarmdeath}

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






$(document).ready(function() {
   function formatOption(option) {
        if (!option.id) {
            return option.text;
        }
        var imageUrl = 'assets/img/icons/' + option.text ;
        var optionWithImage = $(
            '<span><img src="' + imageUrl + '" class="img-flag" height="20px" style="margin-right: 10px;" /> ' + option.text + '</span>'
        );
        return optionWithImage;
    }

    $('#host_icon').select2({
        templateResult: formatOption,
        templateSelection: formatOption,
        minimumResultsForSearch: Infinity
    });
});





</script>
