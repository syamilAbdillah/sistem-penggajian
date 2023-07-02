<x-app-layout>
	<div class="space-y-6">
		<form method="get" class="grid gap-4">
			<x-form-control>
				<x-label>pilih jabatan</x-label>
				<select name="jabatan_id" class="select select-bordered">
					@forelse($list_jabatan as $j)
						<option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
					@empty
						<option>belum ada data</option>
					@endforelse
				</select>
			</x-form-control>
			<div class="flex justify-end">
				<button class="btn">apply</button>
			</div>
		</form>
		<a href="{{ route('potongan-gaji.create') }}" class="btn">tambah potongan gaji</a>
	</div>
</x-app-layout>
