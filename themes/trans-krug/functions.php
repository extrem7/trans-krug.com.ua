<?

add_action('admin_notices', function () {
	if (!class_exists('Theme'))
		echo '<div class="error"><p>' . 'Внимание: для роботы сайта нужно включить плагин TransKrug' . '</p></div>';
});

// silence is golden.