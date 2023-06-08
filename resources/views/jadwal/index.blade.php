<x-app-layout>
	<div class="space-y-6">
		<a href="{{ route('jadwal.create') }}" class="btn">tambah jadwal bulanan</a>

		<div class="overflow-x-auto border rounded-lg">
		  <table class="table w-full">
		    <thead>
		      <tr>
		      	<th>no.</th>
		        <th>bulan</th>
		        <th>aksi</th>
		      </tr>
		    </thead>
		    <tbody>
				@forelse($list_jadwal as $jadwal)
					<tr>
						<th>{{ $loop->iteration }}</th>
						<td>{{ $jadwal->bulan }}</td>
						<td>
							<div class="flex gap-2 items-center">
								<a href="{{ route('jadwal.show', ['jadwal' => $jadwal]) }}" class="btn btn-primary">atur jadwal</a>
								<a href="#" class="btn btn-error">hapus</a>

							</div>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="3">
							<h1 class="text-xl text-center text-base-300">belum ada data</h1>
						</td>
					</tr>
				@endforelse
		    </tbody>
		  </table>
		</div>
	</div>
</x-app-layout>