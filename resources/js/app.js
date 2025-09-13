import "./libs/trix";
import './bootstrap';

// Dark mode toggle
document.addEventListener('DOMContentLoaded', function() {
	const themeToggle = document.getElementById('themeToggle');
	if (themeToggle) {
		themeToggle.addEventListener('click', function() {
			document.body.classList.toggle('dark-mode');
			// Ganti icon
			const icon = themeToggle.querySelector('.theme-icon');
			if (icon) {
				icon.classList.toggle('bi-sun');
				icon.classList.toggle('bi-moon');
			}
		});
	}
});
