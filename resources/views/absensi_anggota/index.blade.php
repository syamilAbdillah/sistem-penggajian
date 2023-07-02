<x-app-layout>
	<div class="space-y-6">
		<form method="get" class="grid gap-4">
			<x-form-control>
				<x-label>anggota</x-label>
				<select name="anggota_id" class="select select-bordered w-full">
					@foreach ($list_anggota as $a)
						<option 
							value="{{$a->id}}" 
							@if($anggota->id == $a->id) selected @endif
						>{{$a->user->nama}}</option>
					@endforeach
				</select>
			</x-form-control>
			<x-form-control>
				<x-label>periode</x-label>
				<select name="periode_id" class="select select-bordered w-full">
					@foreach ($list_periode as $p)
						@php
							$datetime = new DateTime($p->dari);
						@endphp
						<option 
							value="{{$p->id}}"
							@if($periode->id == $p->id) selected @endif
						>{{ $datetime->format('F') }}</option>
					@endforeach
				</select>
			</x-form-control>

			<div class="flex justify-end items-center">
				<button class="btn">apply</button>
			</div>
		</form>

		<div class="overflow-x-auto w-full">
			<table class="table w-full">
				<thead>
					<tr>
						<th>no</th>
						<th>tanggal</th>
						<th>shift</th>
						<th>keterangan</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($list_jadwal as $jadwal)
						<tr>
							<th>{{ $loop->iteration }}</th>
							@php 
								$timezone = new DateTimeZone('Asia/Jakarta');
								$datetime = new DateTime($jadwal->tanggal, $timezone); 
							@endphp
							<td>
								<span class="@if($datetime->format('D') == 'Sun') text-rose-500 @endif">
									{{ $datetime->format('D, d F Y') }}
								</span>
							</td>
							<td>{{ $jadwal->shift }}</td>
							<td>
								@if($jadwal->absensi == null && $datetime->getTimestamp() <= time())
									<span class="badge badge-lg badge-warning">tidak ada keterangan</span>
								@elseif($jadwal->absensi == null && $datetime->getTimestamp() > time())
									<span class="badge badge-lg badge-ghost">belum tersedia</span>
								@elseif($jadwal->absensi->keterangan == 'sakit' || $jadwal->absensi->keterangan == 'izin')
									<span class="badge badge-lg badge-warning">{{ $jadwal->absensi->keterangan }}</span>

								@else
									<span class="badge badge-lg">hadir</span>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		
	</div>
</x-app-layout>