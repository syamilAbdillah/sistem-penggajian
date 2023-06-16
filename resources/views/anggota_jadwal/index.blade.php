<x-anggota-layout>
	<div class="space-y-6">
		<form method="get" class="grid gap-4">
			<x-form-control>
				<x-label>pilih jadwal bulanan</x-label>
				<select name="bulan" class="select select-bordered" value="{{ $jadwal->bulan }}">
					@forelse($list_jadwal as $j)
						<option value="{{ $j->bulan }}">{{ date('F, Y', strtotime($j->bulan)) }}</option>
					@empty
						<option disabled>belum ada jadwal</option>
					@endforelse
				</select>
			</x-form-control>
			<div class="flex justify-end">
				<button type="submit" class="btn">apply</button>
			</div>
		</form>
		
		<div class="overflow-x-auto border rounded-lg">
			<table class="table w-full">
				<thead>
					<tr>
						<th>tanggal</th>
						<th>shift</th>
					</tr>
				</thead>
				<tbody>
					@forelse($list_jadwal_harian as $jh) 
						<tr>
							<td>{{ $jh->tanggal }}</td>
							<td>

								@if($jh->shift == 'pagi')
									<span class="badge badge-lg badge-primary">{{$jh->shift}}</span>
								@elseif($jh->shift == 'siang')
									<span class="badge badge-lg badge-secondary">{{$jh->shift}}</span>
								@elseif($jh->shift == 'malam')
									<span class="badge badge-lg badge-accent">{{$jh->shift}}</span>
								@else
									<span class="badge badge-lg badge-ghost">{{$jh->shift}}</span>
								@endif
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="2">
								<h1>belum ada jadwal</h1>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>


</x-anggota-layout>