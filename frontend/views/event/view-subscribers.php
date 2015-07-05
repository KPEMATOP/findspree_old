<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 11.03.15
 * Time: 16:18
 */
?>

<div class="panel panel-default">
    <div class="panel-heading">Подписчики мероприятия</div>
    <div class="panel-body" id="subscriber-container"></div>
    <div id="subscriber-next-page" class="panel-footer" style="text-align: center; font-size: 28px; cursor: pointer; color: #c7c7c7;"><i class="md md-more-horiz"></i></div>
</div>

<script id="subscriber-event-item" data-remote="<?= Yii::$app->urlManager->createUrl(['event/event-subscribers', 'event_id' => $event->id ]); ?>" type="text/html">
	<a href="<%= user.link.home %>">
	<%=   Helper.html.avatar(user, 30, {
				"class": "img-circle",
				style: "width:'50px'; height:'50px';",
				"title": user.username,
				"alt": user.username
	})
	%>
    </a>
</script>