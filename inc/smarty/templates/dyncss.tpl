



<style>


{foreach $SET.iconsbyid as $id => $image}
    select#host_icon option[value="{$id}"]   { background-image:url(assets/img/icons/{$image});   }
{/foreach}
</style>