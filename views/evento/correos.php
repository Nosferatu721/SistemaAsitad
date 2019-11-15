<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>invitacion a eventos</title>
		<link rel="stylesheet" type="text/js" href="js/crud.js">
		<link rel="stylesheet" type="text/css" 	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	</head>
	<body>
		<div class="modal-body">
			<form action="<?= baseUrl; ?>user/corre " method="post" enctype="multipart/form-data">
				<div class="form-row">
					<div style="width: 100%; height: 20px;"></div>
					<div class="col-md-12">
						<label>Asunto</label>
						<input type="text" name="asunto" id="asunto" placeholder="Asunto" class="form-control form-control-sm" required="">
					</div>
					<div class="col-md-12">
						<label>Mensaje</label>
						<textarea name="mensaje" id="mensaje" placeholder="Mensaje" class="form-control form-control-sm"></textarea>
					</div>
					<br>
					<input type="file" name="archivo" id="archivo" class="card">
					<br>
				  	<input type="submit" value="enviar" class="btn btn-success">
			  	</div>
			 </form>
		</div>
	</body>
</html>