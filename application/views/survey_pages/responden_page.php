<div class="container">
	<div class="row">
		<div class="col-md-8 col-sm-12 mx-auto">
			<?= $this->session->flashdata('message'); ?>
			<?php
			if (!$this->session->csrf_token) {
				$this->session->csrf_token = generate_token(50);
			}
			?>
			<?= form_open_multipart('responden/process') ?>
			<div class="card">
				<div class="card-header">
					Informasi Umum
				</div>
				<div class="card-body">
					<div class="my-3 mx-4">
						<div class="form-group">
							<label for="no_survey">Nomor Survey</label>
							<input type="hidden" name="token" value="<?= $this->session->csrf_token ?>">
							<input type="text" class="form-control" name="no_survey" id="no_survey" value="<?= $survey ?>" readonly>
						</div>
						<div class="form-group">
							<label for="tanggal_survey">Tanggal Survey</label>
							<input type="date" class="form-control" name="tanggal_survey" id="tanggal_survey" value="<?= date('Y-m-d') ?>" required>
						</div>
						<div class="form-group">
							<label for="jam_survey">Jam Survey</label>
							<input type="time" name="jam_survey" id="jam_survey" class="form-control" value="<?= date('H:i') ?>" required>
						</div>

						<div class="form-group">
							<label for="kecamatan">Kecamatan</label>
							<select name="kecamatan" id="kecamatan" class="form-control" required>
								<option value="">--Pilih Kecamatan--</option>
								<option value="<?= $userdata->district_id ?>"><?= $userdata->district_name ?></option>
							</select>
						</div>

						<div class="form-group">
							<label for="kelurahan">Kelurahan</label>
							<select name="kelurahan" id="kelurahan" class="form-control" required>
								<option value="">--Pilih Kelurahan--</option>
							</select>
						</div>
						<div class="form-group">
							<label for="username">Nama Pewawancara/Enumerator</label>
							<input type="hidden" name="user_id" id="user_id" value="<?= $userdata->user_id ?>">
							<input type="text" name="username" id="username" class="form-control" value="<?= $userdata->name ?>" readonly>
						</div>
						<div class="form-group">
							<label for="username">Puskesmas</label>
							<input type="hidden" name="puskesmas_id" id="puskesmas_id" value="<?= $userdata->puskesmas_id ?>">
							<input type="text" name="puskesmas" id="puskesmas" class="form-control" value="<?= $userdata->puskesmas_name ?>" readonly>
						</div>
						<div class="form-group">
							<label for="supervisor">Nama Supervisor</label>
							<select name="supervisor" id="supervisor" class="form-control" required>
								<option value="">--Pilih Supervisor--</option>
								<?php
								foreach ($supervisor as $s) {
									echo '<option value="' . $s->id . '">' . $s->supervisor_name . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="koordinator">Koordinator Kecamatan</label>
							<select name="koordinator" id="koordinator" class="form-control" required>
								<option value="">--Pilih Koordinator--</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="card my-5">
				<div class="card-header">
					A. Informasi Responden
				</div>
				<div class="card-body">
					<div class="my-3 mx-4">
						<div class="form-group">
							<label for="nkk">NKK</label>
							<input type="number" class="form-control" name="nkk" id="nkk" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="nik">NIK Kepala Rumah Tangga</label>
							<input type="number" class="form-control" name="nik" id="nik" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="nama_kepala">Nama Kepala Rumah Tangga</label>
							<input type="text" class="form-control" name="nama_kepala" id="nama_kepala" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="jumlah_keluarga">Jumlah Keluarga Dalam Rumah</label>
							<input type="number" class="form-control" name="jumlah_keluarga" id="jumlah_keluarga" required>
						</div>
						<div class="form-group">
							<label for="jumlah_jiwa">Jumlah Jiwa dalam Rumah</label>
							<select name="jumlah_jiwa" id="jumlah_jiwa" class="form-control" required>
								<option value="">--Pilih--</option>
								<option value="1 Orang">1 Orang</option>
								<option value="2 Orang">2 Orang</option>
								<option value="3 Orang">3 Orang</option>
								<option value="4 Orang">4 Orang</option>
								<option value="5 Orang">5 Orang</option>
								<option value="< 5 Orang">
									< 5 Orang</option>
							</select>
						</div>
						<div class="form-group">
							<label for="responden">Nama Responden</label>
							<input type="text" class="form-control" name="responden" id="responden" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="hubungan">Hubungan Responden dengan Kepala Keluarga</label>
							<div class="custom-control custom-radio">
								<input type="radio" id="istri" name="hubungan" class="custom-control-input" value="1" required>
								<label class="custom-control-label" for="istri">Istri</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="anakPr" name="hubungan" class="custom-control-input" value="2">
								<label class="custom-control-label" for="anakPr">Anak perempuan yang sudah menikah</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="kepala" name="hubungan" class="custom-control-input" value="3">
								<label class="custom-control-label" for="kepala">Kepala keluarga</label>
							</div>
						</div>

						<div class="form-group">
							<label for="alamat">Alamat</label>
							<input type="text" class="form-control" name="alamat" id="alamat" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="rt">RT</label>
							<input type="number" class="form-control" name="rt" id="rt" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="rw">RW</label>
							<input type="number" class="form-control" name="rw" id="rw" autocomplete="off" required>
						</div>
						<div class="form-group">
							<label for="no_rmh">No Rumah</label>
							<input type="text" class="form-control" name="no_rmh" id="no_rmh" autocomplete="off" placeholder="Tulis dengan Blok jika ada ex. B-12" required>
						</div>

					</div>
				</div>
			</div>
			<div class="card my-5">
				<div class="card-header">

				</div>
				<div class="card-body">
					<div class="form-group">
						<label for="foto_responden">Foto Bersama Responden</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="image" id="image" required>
								<label class="custom-file-label" for="image">Choose file</label>
							</div>
						</div>
						<!-- <div class="row mt-3">
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label for="latitude">Latitude</label>
										<input type="text" class="form-control" name="latitude" id="latitude" value="" readonly>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label for="longitude">Longitude</label>
										<input type="text" class="form-control" name="longitude" id="longitude" value="" readonly>
									</div>
								</div>
							</div>
							<button type="button" class="btn btn-primary m-0">
								Aktifkan Lokasi
							</button> -->
					</div>
				</div>
			</div>
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_alert">
				Submit
			</button>

			<!-- Central Modal -->
			<div class="modal fade" id="modal_alert" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title w-100 text-center"><b>PERHATIAN</b></h4>
						</div>
						<div class="modal-body">
							<p class="text-center">Pastikan semua data sudah sesuai sebelum di simpan agar tidak terjadi kesalahan perhitungan pada laporan</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Batal</button>
							<button type="submit" onclick="this.form.submit(); this.disabled=true;" name="submit" class="btn btn-primary btn-sm">Simpan</button>
						</div>
					</div>
				</div>
			</div>
			<?= form_close() ?>
			<div class="modal fade" id="modal_warning" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title w-100 text-center"><b>PERHATIAN</b></h4>
						</div>
						<div class="modal-body">
							<p class="text-center">Dimohon Untuk Tekan Tombol Simpan Sekali Saja, Karena Akan Menyebabkan Data Yang Masuk Menjadi Double!</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#kecamatan').change(function() {
			var id = $('#kecamatan').val();
			if (id != '') {
				$.ajax({
					url: "<?= base_url('responden/fetch_village'); ?>",
					method: "POST",
					data: {
						id: id
					},
					success: function(data) {
						$('#kelurahan').html(data);
					}
				});
			}
		});

		$('#kecamatan').change(function() {
			var id = $('#kecamatan').val();
			if (id != '') {
				$.ajax({
					url: "<?= base_url('responden/fetch_koordinator'); ?>",
					method: "POST",
					data: {
						id: id
					},
					success: function(data) {
						$('#koordinator').html(data);
					},

				});
			}
		});

		$('#modal_warning').modal('show')
	});
</script>
