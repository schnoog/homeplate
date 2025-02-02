                <table border="1" id="icontable">
                <tr><th>id</th><th>Icon</th><th>Pic</th></tr>
                {foreach $SET.icons as $ROW}
                    <tr>
                    <td>{$ROW.id}</td><td>{$ROW.icon}</td>
                    <td>
                    
                    <img src="assets/img/icons/{$ROW.icon}" height="20px" style="margin-right: 10px;">                    
                    </td>
                    </tr>
                {/foreach}

                </table>
