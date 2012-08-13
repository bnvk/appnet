<h2 class="content_title"><img src="<?= $modules_assets ?>appnet_32.png"> App.Net</h2>
<ul class="content_navigation">
	<?= navigation_list_btn('home/appnet', 'Recent') ?>
	<?= navigation_list_btn('home/appnet/custom', 'Custom') ?>
	<?php if ($logged_user_level_id <= 2) echo navigation_list_btn('home/appnet/manage', 'Manage', $this->uri->segment(4)) ?>
</ul>