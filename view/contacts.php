<?php $title = "Liste étudiant"; ?>
<?php ob_start(); ?>
<section class="py-5 mt-5">
	<div class="container py-5">
		<div class="row mb-5">
			<div class="col-md-8 col-xl-6 text-center mx-auto">
				<h2 class="fw-bold">Envoyer un message</h2>
			</div>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="col">
				<div class="d-flex align-items-center">


					<form data-aos='fade-right'   action="index.php?action=transferMessage" class="col p-3 m-5 p-xl-4 rounded shadow" method="post">
						<?php if (isset($_GET['error'])): ?>
							<div class="alert alert-danger" role="alert">
								<?= $_GET['error'] ?>
							</div>
						<?php endif ?>
						<?php if (isset($_GET['sucess'])): ?>
							<div class="alert alert-success" role="alert">
								<?= $_GET['sucess'] ?>
							</div>
						<?php endif ?>
						<div class="mb-3"><label class="form-label" for="destinataire">Destinataires</label><input
									class="form-control" type="text" id="destinataire" name="destinataire"

										value="<?=$selectedUser ?? ($_GET['selectedUser'] ?? '') ?>">
						</div>
						<div class="mb-3"><label class="form-label" for="object">Object</label>
							<input class="form-control" type="text" id="object" name="object"></div>
						<div class="mb-3"><label class="form-label" for="message">Message</label><textarea
									class="form-control" id="message"
									name="message" rows="6"></textarea>
						</div>
						<div>
							<button class="btn btn-primary shadow d-block w-100" type="submit">Envoyer</button>
						</div>
					</form>

				</div>

			</div>
			<div class='col d-none d-md-block d-flex align-items-center' style='text-align: center;'>
				<img data-aos='fade-left' data-aos-once='true'
				     src="<?= IMG_URL . 'message.svg' ?>"
				     style='width: 90%;height: 90%;padding: 37px;' alt=''>
			</div>
		</div>
	</div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('templates/base.php'); ?>
