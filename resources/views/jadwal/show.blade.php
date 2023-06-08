<x-app-layout>
	<div class="space-y-6">
		<div class="overflow-x-auto border rounded-lg">
		  <table class="table w-full">
		    <thead>
		      <tr>
		        <th>anggota</th>
		        @for($d = 1; $d <= $total_day; $d++)
			        <th>
			        	<h1 class="text-center">
			        	{{$d}}
			        	</h1>
			        </th>
		        @endfor
		      </tr>
		    </thead>
		    <tbody>
				@forelse($jadwal_anggota as $ja)
					<tr>
						<th>{{ $ja->user->nama }}</th>

						@foreach($ja->jadwal_harian as $jh)
							<td class="border">
								@if($jh->shift == 'pagi')
									<button x-data @click.prevent="$dispatch('open-modal', 'create-schedule-{{$jh->id}}')" class="btn btn-primary">{{ $jh->shift }}</button>
								@elseif($jh->shift == 'siang')
									<button x-data @click.prevent="$dispatch('open-modal', 'create-schedule-{{$jh->id}}')" class="btn btn-secondary">{{ $jh->shift }}</button>
								@elseif($jh->shift == 'malam')
									<button x-data @click.prevent="$dispatch('open-modal', 'create-schedule-{{$jh->id}}')" class="btn btn-accent">{{ $jh->shift }}</button>
								@else
									<button x-data @click.prevent="$dispatch('open-modal', 'create-schedule-{{$jh->id}}')" class="btn btn-ghost">{{ $jh->shift }}</button>
								@endif

								<x-modal name="create-schedule-{{$jh->id}}" focusable>
									<form action="{{ route('jadwal-harian.update', ['jadwal_harian' => $jh]) }}" class="grid gap-4 p-6" method="post">
										@method('PATCH')
										@csrf

										<x-form-control>
											<x-label>nama</x-label>
											<x-text-input value="{{ $ja->user->nama }}" readonly disabled/>
										</x-form-control>

										<x-form-control>
											<x-label>tanggal</x-label>
											@if($jh->tanggal > 9)
												<x-text-input type="date" value="{{ $jadwal->bulan }}-{{$jh->tanggal}}" readonly disabled/>
											@else
												<x-text-input type="date" value="{{ $jadwal->bulan }}-0{{$jh->tanggal}}" readonly disabled/>
											@endif
										</x-form-control>

										<x-form-control>
											<x-label>shift</x-label>
											<select name="shift" class="select select-bordered" selected="{{$jh->shift}}">
												<option @if($jh->shift == 'off') selected @endif value="off">off</option>
												<option @if($jh->shift == 'pagi') selected @endif value="pagi">pagi</option>
												<option @if($jh->shift == 'siang') selected @endif value="siang">siang</option>
												<option @if($jh->shift == 'malam') selected @endif value="malam">malam</option>
											</select>
										</x-form-control>

										<div class="flex items-center justify-end gap-2">
											<button type="reset" class="btn btn-outline">reset</button>
											<button type="submit" class="btn">submit</button>
										</div>

									</form>
								</x-modal>
							</td>
						@endforeach
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