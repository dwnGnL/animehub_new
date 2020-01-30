<tr>
    <td><a href="<?=$uri.'/'.$post['type'].'/'.$helper::renderUrl($post['id'], $post['alias'])?>" ><?=$post['title'].' - '.$post['tv']?></a></td>
    <td><?=$post['views']?></td>
    <td><?=$post['postLike']?></td>
    <td><?=$post['comment']?></td>
    <td><?=$helper::getWatch($post['date'])?></td>
    <td>
        <div class="button-place default-buttons active">
            <span class="edit-table-data button-table-data"><a href="<?=$uri.'dashboard/post/edit/'.$post['type'].'/'.$post['id']?>" >Edit</a></span>
            <span class="remove-table-data button-table-data" data-toggle="modal" data-target="#logoutModal" id-post="<?=$post['id']?>">Remove</span>
        </div>

        <div class="button-place edit-buttons">
            <span class="save-table-data button-table-data">Save</span>
            <span class="cancel-table-data button-table-data">Cancel</span>
        </div>
    </td>
</tr>
<?php if ($i == 0): ?>
<script src="<?=$uri?>/templates/dashboard/js/postsD.js?<?=filemtime('templates/dashboard/js/postsD.js')?>"></script>
<?php endif;?>