<?php

$cv_data = json_decode(json: file_get_contents(filename: '../../cv.json'),  associative: true);

function get_date(array $mini_json): string {
	return $mini_json['date'] ?? $mini_json['date from'] . ' - ' . ($mini_json['date until'] ?? '(on going)');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CV</title>
	<link rel="stylesheet" href="../css/styles.css">
	<link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
</head>
<body>
	<main class="cv" style="
		--primary-text-colour: <?= $cv_data['styles']['primary text colour'] ?? '#333' ?>;
		--secondary-text-colour: <?= $cv_data['styles']['secondary text colour'] ?? '#555' ?>;
		--primary-colour: <?= $cv_data['styles']['primary colour'] ?? '#ffd556' ?>;
		--background: <?= $cv_data['styles']['background'] ?? '#fff' ?>;
		--border-width: <?= $cv_data['styles']['border width'] ?? '3px' ?>;
	">
		<header class="name"><?= $cv_data['name'] ?></header>
		<div class="body">
			<div class="column" id="left-column">
				<article class="about-me">
					<h2 class="title">about me</h2>
					<?= $cv_data['about me'] ?>
				</article>
				<div class="section-2">
					<h2 class="title">experience</h2>
					<?php foreach ($cv_data['experiences'] as $experience): ?>
						<div class="experience">
							<h3 class="sub-title">
								<span><?= $experience['title'] ?></span>
								<span><?= get_date($experience) ?></span>
								<span><?= $experience['location'] ?></span>
							</h3>
							<p class="description"><?= $experience['description'] ?></p>
						</div>
					<?php endforeach; ?>
					<h2 class="title">education</h2>
					<?php foreach ($cv_data['education'] as $education): ?>
						<div class="education">
							<h3 class="sub-title">
								<span><?= $education['title'] ?></span>
								<span><?= get_date($education) ?></span>
								<span><?= $education['location'] ?></span>
							</h3>
							<p class="description"><?= $education['description'] ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="column" id="right-column">
				<div class="section-2">
					<div class="volunteering">
						<h2 class="title">Volunteering</h2>
						<?php foreach ($cv_data['volunteering'] as $volunteer): ?>
							<h3 class="sub-title">
								<span><?= $volunteer['title'] ?></span>
								<span><?= get_date($volunteer) ?></span>
							</h3>
							<p class="description"><?= $volunteer['description'] ?></p>
						<?php endforeach; ?>
					</div>
					<div class="contact">
						<h2 class="title">Contact</h2>
						<ul>
							<?php if (isset($cv_data['contact']['phone'])): ?>
								<a
								href="tel:<?= $cv_data['contact']['phone'] ?>">
									<img
									src="../assets/images/phone.svg"
									alt="Phone">
									<?= $cv_data['contact']['phone'] ?>
								</a>
							<?php endif ?>
							<?php if (isset($cv_data['contact']['email'])): ?>
								<a
								href="mailto:<?= $cv_data['contact']['email'] ?>">
									<img
									src="../assets/images/email.svg"
									alt="Email">
									<?= $cv_data['contact']['email'] ?>
								</a>
							<?php endif ?>
							<?php if (isset($cv_data['contact']['github'])): ?>
								<a
								target="_blank"
								href="<?= $cv_data['contact']['github href'] ?? "https://github.com/" . $cv_data['contact']['github'] ?>">
									<img
									src="../assets/images/github.svg"
									alt="GitHub">
									<?= $cv_data['contact']['github'] ?>
								</a>
							<?php endif ?>
							<?php if (isset($cv_data['contact']['linkedin'])): ?>
								<a
								target="_blank"
								href="<?= $cv_data['contact']['linkedin href'] ?? ''?>">
									<img
									src="../assets/images/linkedin.svg"
									alt="LinkedIn">
									<?= $cv_data['contact']['linkedin'] ?>
								</a>
							<?php endif ?>
						</ul>
					</div>
					<div class="passion">
						<h2 class="title">Passion</h2>
						<p><?= $cv_data['passion'] ?></p>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>
</html>