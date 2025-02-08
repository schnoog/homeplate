<input type="text" name="myInput" id="myInput" class="form-control" onkeydown="CheckEnter(event);">

<button type="button" class="btn btn-success" onclick="FilterTable();">Search</button>
<button type="button" class="btn btn-danger" id="sreset" name="sreset" onclick="UnFilterTable();">Unfilter</button><br />
<table id="myDataTable" class="table table-striped table-bordered" style="width:100%">
<thead>
<tr>
<th></th>
<th>Host_name</th>
<th>hostgroup</th>
<th>localonly</th>
<th>usedns</th>
<th>host_ipv4</th>
<th>host_ipv6</th>
<th>host_hostname</th>
<th>host_active</th>
<th>host state</th>
<th>host lc</th>
<th>host alarm</th>



</thead>
<tbody>
{foreach $CFG.data.hostlist as $host}
<tr>

<td>

<form method='post'><input type='hidden' name='edit' value='1'><input type='hidden' name='id' value='{$host.id}'>
    <button type="submit"><i class="fas fa-edit"></i></button>
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
{$host.host_active} 
</td>
<td>
{$host.host_state} 
</td>
<td>
{$host.host_laststatechange} 
</td>
<td>

{$host.host_alarmdeath}
</td>


</tr>

{/foreach}
</tbody>
</table>


<script>
{literal}

function CheckEnter(event) {
  if (event.key === "Enter") {
    FilterTable();
  }
}



function FilterTable() {
  // Declare variables
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myDataTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows (excluding the header if necessary)
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td");
    let rowMatch = false;

    // Loop through all <td> elements in the row
    for (j = 0; j < td.length; j++) {
      txtValue = td[j].textContent || td[j].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        rowMatch = true;
        break; // No need to check further if a match is found
      }
    }

    // Show or hide the row based on the search match
    tr[i].style.display = rowMatch ? "" : "none";
  }
}

function UnFilterTable() {
  // Declare variables
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myDataTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows (excluding the header if necessary)
  for (i = 0; i < tr.length; i++) {
    tr[i].style.display = "";
  }
}


{/literal}


</script>