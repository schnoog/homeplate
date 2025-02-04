                {$debugme}
                <table border="1" id="icontable">
                <tr><th>id</th><th>Icon</th><th>Pic</th><th></th><th>
                
                
                <button type="button" class="btn btn-success p-3" onclick="addTableItem('icons','icontable');" disabled>Add new</button>                   
                
                </th></tr>
                {foreach $SET.icons as $ROW}
                    <tr>
                    <td>{$ROW.id}</td><td>{$ROW.icon}</td>
                    <td>
                    
                    <img src="assets/img/icons/{$ROW.icon}" height="20px" style="margin-right: 10px;">                    
                    </td>
                    <td>
                        <button type="button" class="btn btn-secondary p-3" onclick="updateTableItem('icons','icontable','{$ROW.id}','{$ROW.icon}');">Edit</button> 
                    </td><td>
                    {if in_array($ROW.id,$SET.unused.icons)}
                        <button type="button" class="btn btn-danger p-3" onclick="deleteTableItem('icons','icontable','{$ROW.id}');">Delete</button>                     
    
                    {/if}
                    </td>

                    </tr>
                {/foreach}

                </table>
