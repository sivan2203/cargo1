<?php foreach ($menu as $item): ?>
<li <? if ($_SERVER['REQUEST_URI'] == '/page/' . $item['slug']) echo 'class="active"'; ?>><a href="/page/<?=$item['slug'];?>"><?=$item['title'];?> <span class="sr-only">(current)</span></a></li>
<?php endforeach; ?>