<x-anggota-layout>
	<div class="space-y-6">
		<a href="{{ route('jadwal-absensi.index') }}" class="btn">daftar jadwal per bulan</a>
		<div class="overflow-x-auto border rounded-lg">
			<table class="table w-full">
				<thead>
					<tr>
						<th>tanggal</th>
						<th>shift</th>
						<th>aksi</th>
					</tr>
				</thead>
				<tbody>
					@php
					$dari = (new DateTime($jadwal->dari))->format("d");
					$hingga = (new DateTime($jadwal->hingga))->format("d");
					$bulan = (new DateTime($jadwal->dari))->format("m");
					$thn = (new DateTime($jadwal->dari))->format("Y");
					@endphp

					@for($d = (int)$dari; $d <= (int)$hingga; $d++) 
						<tr>
							<th>{{ date("d F, Y", mktime(0,0,0,(int)$bulan, $d, (int)$thn)) }}</th>
							<td>
								@php 
								$jadwal_anggota = $list_jadwal_anggota->where("tanggal", "=", date("Y-m-d", mktime(0,0,0,(int)$bulan, $d, (int)$thn)))->first(); 
								@endphp
								@if($jadwal_anggota == null) 
									<button class="btn btn-ghost">off</button>
								@else
									@if($jadwal_anggota->shift == "pagi")
										<button class="btn btn-primary">{{ $jadwal_anggota->shift }}</button>
									@elseif($jadwal_anggota->shift == "siang")

										<button class="btn btn-secondary">{{ $jadwal_anggota->shift }}</button>
									@else
										<button class="btn btn-accent">{{ $jadwal_anggota->shift }}</button>
									@endif
								@endif
							</td>
							<td>
								<a href="{{ route('jadwal-absensi.show', ['jadwal_absensi' => $jadwal]) }}" class="btn btn-link">detil</a>
							</td>
							
						</tr>
					@endfor
				</tbody>
			</table>
		</div>
		
	</div>
</x-anggota-layout>