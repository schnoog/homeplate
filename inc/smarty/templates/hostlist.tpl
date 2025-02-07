
<table id="myDataTable" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
<th>
<form method='post'><input type='hidden' name='new' value='1'>
<button type="submit"><i class="fa-solid fa-square-plus"></i></button>
</form>

</th>
<th>Host_name</th>
<th>hostgroup</th>
<th>localonly</th>
<th>usedns</th>
<th>host_ipv4</th>
<th>host_ipv6</th>
<th>host_hostname</th>
<th>host_url</th>
<th>url check</th>
<th>host state</th>
<th>host lc</th>
<th>host icon</th>
<th>tags</th>


</thead>
<tbody>
{foreach $CFG.fullhostdata.fullhosts as $host}
<tr>
<td>
<form method='post'><input type='hidden' name='edit' value='1'><input type='hidden' name='id' value='{$host.id}'>
    <button type="submit"><i class="fas fa-edit"></i></button>
</form>

<form method='post'><input type='hidden' name='delete' value='1'><input type='hidden' name='id' value='{$host.id}'>
    <button type="submit" class="delbtn"><i class="fa-solid fa-trash"></i></button>
</form>


</td>
<td>
{$host.host_name}

</td>

<td>
{$host.hostgroup} 
</td>
<td>
{$host.localonly} 
</td>
<td>
{$host.usedns} 
</td>
<td>
{$host.host_ipv4} 
</td>
<td>
{$host.host_ipv6} 
</td>
<td>
{$host.host_hostname} 
</td>
<td>
{$host.host_url} 
</td>
<td>
{$host.host_checkurl} 
</td>
<td>
{$host.host_state} 
</td>
<td>
{$host.host_laststatechange} 
</td>
<td>
<img src="assets/img/icons/{$basedata.iconset[$host.host_icon]}" height="60px" style="margin-right: 10px;">
</td>
<td>
{$host.tags} 
</td>

</tr>

{/foreach}
</tbody>
</table>


<script>
{literal}
    
    // Select all delete buttons
    const delButtons = document.querySelectorAll('.delbtn');

    delButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Ask for confirmation before proceeding with the form submission
            var confirmation = confirm("Are you sure you want to delete this record?");
            if (!confirmation) {
                // Prevent form submission if user cancels
                event.preventDefault();
            }
        });
    });


{/literal}


</script>