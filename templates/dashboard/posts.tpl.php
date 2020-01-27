<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Страница вывода всех постов</h1>

  <div class="search-table-block">
    <div class="search-block">
      <span>Search:</span>
      <input type="search" name="" id="search">
    </div>
  </div>

  <table cellspacing="0">
    <thead>
      <tr>
        <th class="title">Title</th>
        <th class="views">Views</th>
        <th class="reating">Rating</th>
        <th class="comments">Comments</th>
        <th class="date">Date</th>
        <th class="button-place-header">Edit/Delete</th>
      </tr>
    </thead>

    <tbody>
    <?php foreach ($posts['items'] as $post) :?>
        <?php require 'table.tpl.php'?>
    <?php endforeach; ?>
    </tbody>
  </table>

  <div class="table-pages-place">
    <div class="table-pages">
     <?=$posts['navigation']?>
    </div>
  </div>
</div>
<script src="<?=$uri?>/templates/dashboard/vendor/jquery/jquery.min.js"></script>
<script src="<?=$uri?>/templates/dashboard/js/postsD.js"></script>
