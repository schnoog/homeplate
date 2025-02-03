                {$debugme}
                <table border="1" id="tagtable">
                <tr><th>id</th><th>Tag</th><th></th><th>
                
                <button type="button" class="btn btn-success p-3" onclick="addTableItem('tags','tagtable');">Add new</button>                 
                
                </th></tr>
                {foreach $SET.tags as $ROW}
                    <tr>
                    <td>{$ROW.id}</td><td>{$ROW.tag}</td>
                    <td>
                        <button type="button" class="btn btn-secondary p-3" onclick="updateTableItem('tags','tagtable','{$ROW.id}','{$ROW.tag}');">Edit</button> 

                    </td><td>
                {if in_array($ROW.id,$SET.unused.tags)}
                    <button type="button" class="btn btn-danger p-3" onclick="deleteTableItem('tags','tagtable','{$ROW.id}');">Delete</button>                     

                {/if}


                    </td>                    
                    </tr>
                {/foreach}

                </table>  
