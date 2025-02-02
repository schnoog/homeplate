                <table border="1" id="tagtable">
                <tr><th>id</th><th>Tag</th></tr>
                {foreach $SET.tags as $ROW}
                    <tr>
                    <td>{$ROW.id}</td><td>{$ROW.tag}</td>
                    </tr>
                {/foreach}

                </table>  
