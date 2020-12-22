<div class="center">
<h1>Новости</h1>

<?php
foreach ($data as $d) {
?>
    <div class="news_one">
        <div class="title">
            <span class="date"><?= $d['date'] ?></span>
            <span class="title"><a href="/view.php?id=<?= $d['id'] ?>"><?= $d['title'] ?></a></span>
        </div>
        <div class="announce">
            <?= $d['announce'] ?>
        </div>
    </div>
<?php
}
?>
    <div class="bottom">
        <h2>Страницы:</h2>
<?php for ($p = 1; $p <= $pages; ++$p) {
    if ($p != $page) { ?>
    <a href="/news.php<?php if ($p > 1) { ?>?page=<?=$p?><?php } ?>"><?php } ?>
    <div class="p <?php if ($p == $page)
        { ?>p_active<?php } ?>"><?=$p?>
    </div><?php if ($p != $page) { ?></a>
    <?php } ?>
<?php } ?>
    </div>
</div>
