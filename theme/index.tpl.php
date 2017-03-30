<!doctype html>
<html lang = "<?= $lang; ?>">
	<head>
		<meta charset="<?= $charset; ?>"/>

		<title><?= (isset($title) ? $title : $titleDefault) . $titleExtension; ?></title>

		<?php if(isset($favicon) && !empty($favicon)): ?>
			<link rel="shortcut icon" href="<?= $favicon; ?>"/>
		<?php endif; ?>

		<?php foreach($css as $val): ?>
			<link rel="stylesheet" type="text/css" href="<?= $val; ?>?v=<?= time(); ?>"/>
		<?php endforeach; ?>

		<script>
			var SERVER_PATH = "<?= SERVER_PATH ?>";

		</script>
		<?php foreach($js as $val): ?>
			<script type="text/javascript" src="<?= $val; ?>?v=<?= time(); ?>"></script>
		<?php endforeach; ?>

		<?php if(isset($googleAnalyticsID) && !empty($googleAnalyticsID)): ?>
			<script type="text/javascript">
				var _gaq=[['_setAccount','<?= $googleAnalyticsID; ?>'],['_trackPageview']];
				(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
				g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
				s.parentNode.insertBefore(g,s)}(document,'script'));
			</script>
		<?php endif; ?>
	</head>

	<body>
		<div class = "header-wrapper">
			<?php
				include($header);
			?>
		</div>

		<div class = "main-wrapper">

			<?php
				include($page);
			?>
		</div>

		<div class = "footer-wrapper">
			<?php
				include($footer);
			?>
		</div>
	</body>
</html>
