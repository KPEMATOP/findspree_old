<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 12.03.2015
 * Time: 22:01
 */
\frontend\assets\LiveMap::register($this);
$this->title='Карта событий';
?>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body" id="live-map"></div>
        </div>
    </div>
</div>

<script id="tpl-event-line" type="text/html">
		<?= $this->renderFile('@app/views/tpl/event-line.php'); ?>
</script>