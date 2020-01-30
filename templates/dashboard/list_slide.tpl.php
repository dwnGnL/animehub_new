<tr class="table-row-data">
    <td class="title-slider">
        <span class="title-data data-block"><a class="inner-title" href="/anime/<?=$helper::renderUrl($slider['id'],$slider['alias'])?>"><?=$slider['title']?></a></span>
        <input class="change-data-title change-data" type="text">
    </td>

    <td>
        <span class="img-src-data data-block"><?=$slider['img']?></span>
        <input class="change-data-img change-data" type="text">
    </td>

    <td>
        <span class="season-data data-block"><?=$slider['tv']?></span>
        <input class="change-data-season change-data" type="text">
    </td>

    <td>
        <div class="button-place default-buttons active">
            <span class="edit-table-data button-table-data">Edit</span>
            <span class="remove-table-data button-table-data" data-toggle="modal" data-target="#logoutModal"  id-slider="<?=$slider['id_slider']?>">Remove</span>
        </div>

        <div class="button-place edit-buttons">
            <span class="save-table-data button-table-data" id-slider="<?=$slider['id_slider']?>">Save</span>
            <span class="cancel-table-data button-table-data" >Cancel</span>
        </div>
    </td>
</tr>