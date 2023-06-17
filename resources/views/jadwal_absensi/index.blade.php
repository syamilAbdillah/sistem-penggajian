<x-anggota-layout>
	<div class="space-y-6">
		
		<div class="overflow-x-auto border rounded-lg">
			<table class="table w-full">
				<thead>
					<tr>
						<th>no</th>
						<th>bulan</th>
						<th>tahun</th>
						<th>aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($list_jadwal as $jadwal) 
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ (new DateTime($jadwal->dari))->format('F') }}</td>
							<td>{{ (new DateTime($jadwal->dari))->format('Y') }}</td>
							<td>
								<a href="{{ route('jadwal-absensi.show', ['jadwal_absensi' => $jadwal]) }}" class="btn btn-link">detil</a>
							</td>
							
						</tr>
					@empty
						<tr>
							<td colspan="4">
								<h1 class="text-center" >belum ada jadwal</h1>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</x-anggota-layout>