<div id='user_list'>
	<table>
		<?php foreach($users as $user): ?>
		<tr>
			<td><?=$user['first_name']?> <?=$user['last_name']?></td>
			<td>
				<?php if (isset($connections[$user['user_id']])): ?>
				<a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
				<?php else: ?>
				<a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>