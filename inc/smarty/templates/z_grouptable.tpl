                <table border="1" id='grouptable'>
                <tr><th>id</th><th>Group</th></tr>
                {foreach $SET.groups as $ROW}
                    <tr>
                    <td>{$ROW.id}</td><td>{$ROW.hostgroup}</td>
                    </tr>
                {/foreach}

                </table>
