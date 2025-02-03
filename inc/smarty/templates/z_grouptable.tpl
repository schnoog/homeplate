                {$debugme}                
                <table border="1" id='grouptable'>
                <tr><th>id</th><th>Group</th><th></th><th>
                
                <button type="button" class="btn btn-success p-3" onclick="addTableItem('groups','grouptable');">Add new</button>     

                </th></tr>
                {foreach $SET.groups as $ROW}
                    <tr>
                    <td>{$ROW.id}</td><td>{$ROW.hostgroup}</td>
                    <td>
                        <button type="button" class="btn btn-secondary p-3" onclick="updateTableItem('groups','grouptable','{$ROW.id}','{$ROW.hostgroup}');">Edit</button> 
                    </td><td>
                    {if in_array($ROW.id,$SET.unused.groups)}
                        <button type="button" class="btn btn-danger p-3" onclick="deleteTableItem('groups','grouptable','{$ROW.id}');">Delete</button>                     
    
                    {/if}
                    </td>

                    </tr>
                {/foreach}

                </table>
