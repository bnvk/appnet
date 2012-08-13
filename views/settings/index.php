<form name="settings_update" id="settings_update" method="post" action="<?= base_url() ?>api/settings/modify" enctype="multipart/form-data">
<div class="content_wrap_inner">

	<div class="content_inner_top_right">
		<h3>App</h3>
		<p><?= form_dropdown('enabled', config_item('enable_disable'), $settings['appnet']['enabled']) ?></p>
		<p><a href="<?= base_url() ?>api/<?= $this_module ?>/uninstall" id="app_uninstall" class="button_delete">Uninstall</a></p>
	</div>
	
	<h3>Application Setup</h3>

	<p>App.net requires <a href="https://alpha.app.net/developer/apps/" target="_blank">registering your application</a>, when prompted enter the following values:</p>
	<table>
	<tr>
		<td><strong>Application Name</strong>:</td>
		<td><?= config_item('site_title') ?></td>
	</tr>
	<tr>
		<td><strong>Website</strong>:</td>
		<td><?= base_url() ?></td>
	</tr>
	<tr>	
		<td><strong>OAuth redirect_uri</strong>:</td>
		<td><?= base_url() ?>connections/appnet/add</td>
	</tr>
	</table>
	<p>You will then be provided with the following:</p>
	<p><input type="text" name="client_id" value="<?= $settings['appnet']['client_id'] ?>"> Client ID </p> 
	<p><input type="text" name="client_secret" value="<?= $settings['appnet']['client_secret'] ?>"> Client Secret</p>

	<input type="hidden" name="module" value="<?= $this_module ?>">

	<p><input type="submit" name="save" value="Save" /></p>

</div>
</form>

<?= $shared_ajax ?>