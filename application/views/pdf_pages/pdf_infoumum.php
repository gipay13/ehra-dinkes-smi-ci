<html>

<?php
// echo '<pre>';
// print_r($answer);
// echo '</pre>'
?>

<head>
	<title></title>
	<style type="text/css">
		body {
			font-size: 10pt;
			font-family: "helvetica", Courier, monospace;
		}

		.line-title {
			border: 0;
			border-style: inset;
			border-top: 2px solid #000;
		}

		.table {
			width: 100%;
			margin-bottom: 1rem;
			color: #212529;
			background-color: transparent;
		}

		.table th,
		.table td {
			padding: 0.75rem;
			vertical-align: top;
			border-top: 1px solid #dee2e6;
		}

		.table thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #dee2e6;
		}

		.table tbody+tbody {
			border-top: 2px solid #dee2e6;
		}



		.table-striped tbody tr:nth-of-type(odd) {
			background-color: rgba(0, 0, 0, 0.05);
		}
	</style>
</head>

<body>
	<table width="100%">
		<tr>
			<td width="20%"><img style="width: 50px; align-items: center;" src="<?= base_url('assets/dist/img/baktihusada.png') ?>"></td>
			<td width="60%" style="text-align: center;">DRAFT PERSENTASE HASIL PENILAIAN RISIKO KESEHATAN LINGKUNGAN 2020/2024<br>Environmental Health Risk Assessment (EHRA)</td>
			<td width="20%"><img style="width: 150px" src="<?= base_url('assets/dist/img/ppsp.jpg') ?>"></td>
		</tr>
	</table>
	<br>
	<hr class="line-title">
	<table width="100%">
		<tr>
			<td style="padding-top: 60px;"></td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<th colspan="2" rowspan="3"><?= $title ?></th>
			<th colspan="<?= $district->num_rows() * 2 ?>">% Kecamatan</th>
			<tr>
				<?php foreach ($district->result() as $r) { ?>
					<th colspan="2"><?= $r->district_name ?></th>
				<?php } ?>
			</tr>
			<tr>
				<?php foreach ($district->result() as $r) { ?>
					<th>n</th>
					<th>%</th>
				<?php } ?>
			</tr>
		</tr>
		
		<?php foreach ($question as $q) { ?>
			<tr>
				<td rowspan="<?= $this->CI->answer($q->id)->num_rows() + 1 ?>"><?= $q->question_name ?></td>
				<?php $answer = $this->CI->answer($q->id)->result() ?>
				<?php foreach ($answer as $a) { ?>
					<tr>
						<td><?= $a->answer_name ?></td>
						<td>0</td>
						<td>0%</td>
						<td>0</td>
						<td>0%</td>
						<td>0</td>
						<td>0%</td>
						<td>0</td>
						<td>0%</td>
						<td>0</td>
						<td>0%</td>
						<td>0</td>
						<td>0%</td>
						<td><?= round($a->result) ?></td>
						<td><?= round($a->persentase) ?>%</td>
					</tr>
				<?php } ?>
				</tr>
	<?php } ?>
	</table>
</body>

</html>