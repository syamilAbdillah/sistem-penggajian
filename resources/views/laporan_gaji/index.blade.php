<x-app-layout>
	<form method="post" class="grid gap-4">
		@csrf

		<x-form-control>
			<x-label>pilih bulan</x-label>
			<select name="periode_id" id="" class="select select-bordered">
				@forelse($list_periode as $p)
					<option value="{{ $p->id }}">{{ date('F, Y', strtotime($p->dari)) }}</option>
				@empty
					<option>belum ada data</option>
				@endforelse
			</select>
		</x-form-control>

		<div class="flex justify-end">
			<button class="btn">download laporan</button>
		</div>
	</form>
</x-app-layout>