@php

$dari = (int)date("d", strtotime($periode->dari));
$hingga = (int)date("d", strtotime($periode->hingga));
$bulan = (int)date("m", strtotime($periode->dari));
$tahun = (int)date("Y", strtotime($periode->dari));
@endphp

<x-app-layout>
	<div class="space-y-6">
		<div class="overflow-x-auto border rounded-lg">
		  <table class="table w-full">
		    <thead>
		      <tr>
		        <th colspan="{{ $hingga + 1}}" >
		        	<h1 class="text-center">tanggal</h1>
		        </th>
		      </tr>
		    </thead>
		    <tbody>
		    	<tr>
		    		<th>Anggota</th>
		    		@for($d = $dari; $d <= $hingga; $d++)
				        <td class="border bg-base-300">
				        	<h1 class="text-center">
				        	{{ $d }}
				        	</h1>
				        </td>
			        @endfor
		    	</tr>
				@forelse($list_anggota as $anggota)
					<tr>
						<th>{{ $anggota->user->nama }}</th>
						
				        @for($d = $dari; $d <= $hingga; $d++)
					        <td class="border">
					        	@php
					        		$jadwal = null;


					        		foreach($anggota->jadwal as $j) {
					        			$tanggal = (int)date('d', strtotime($j->tanggal));

					        			if($tanggal == $d) {
					        				$jadwal = $j;
					        			}
					        		}
					        	@endphp

					        	@if($jadwal == null)
					        		<button x-data @click.prevent="$dispatch('open-modal', 'create-schedule-{{$anggota->id}}-{{$d}}')" class="btn btn-ghost">off</button>
					        		<x-modal name="create-schedule-{{$anggota->id}}-{{$d}}" focusable>
										<form action="{{ route('jadwal-anggota.store') }}" class="grid gap-4 p-6" method="post">
											@csrf

											<x-form-control>
												<x-label>nama</x-label>
												<x-text-input value="{{ $anggota->user->nama }}" readonly disabled/>
											</x-form-control>

											<x-form-control>
												<x-label>tanggal</x-label>
												<x-text-input value="{{ date('d, F Y', mktime(0, 0, 0, $bulan, $d, $tahun)) }}" readonly disabled/>
											</x-form-control>

											<input type="hidden" name="tanggal" value="{{ date('Y-m-d', mktime(0, 0, 0, $bulan, $d, $tahun)) }}">
											<input type="hidden" name="anggota_id" value={{ $anggota->id }}>
											<input type="hidden" name="periode_id" value={{ $periode->id }}>

											<x-form-control>
												<x-label>shift</x-label>
												<select required name="shift" class="select select-bordered">
													<option selected disabled>pilih shift</option>
													<option value="pagi">pagi</option>
													<option value="siang">siang</option>
													<option value="malam">malam</option>
												</select>
											</x-form-control>

											<div class="flex items-center justify-end gap-2">
												<button type="reset" class="btn btn-outline">reset</button>
												<button type="submit" class="btn">submit</button>
											</div>

										</form>
									</x-modal>
					        	@else
						        	@if($jadwal->shift == 'pagi')
						        		<button x-data @click.prevent="$dispatch('open-modal', 'update-schedule-{{$jadwal->id}}')" class="btn btn-primary">{{ $jadwal->shift }}</button>
						        	@elseif($jadwal->shift == 'siang')
						        		<button x-data @click.prevent="$dispatch('open-modal', 'update-schedule-{{$jadwal->id}}')" class="btn btn-secondary">{{ $jadwal->shift }}</button>
						        	@elseif($jadwal->shift == 'malam')
						        		<button x-data @click.prevent="$dispatch('open-modal', 'update-schedule-{{$jadwal->id}}')" class="btn btn-accent">{{ $jadwal->shift }}</button>
						        	@endif

						        	<x-modal name="update-schedule-{{$jadwal->id}}" focusable>
										<form action="{{ route('jadwal-anggota.update', ['jadwal_anggotum' => $jadwal]) }}" class="grid gap-4 p-6" method="post">
											@method('put')
											@csrf

											<x-form-control>
												<x-label>nama</x-label>
												<x-text-input value="{{ $anggota->user->nama }}" readonly disabled/>
											</x-form-control>

											<x-form-control>
												<x-label>tanggal</x-label>
												<x-text-input value="{{ date('d, F Y', mktime(0, 0, 0, $bulan, $d, $tahun)) }}" readonly disabled/>
											</x-form-control>

											<input type="hidden" name="tanggal" value="{{ date('Y-m-d', mktime(0, 0, 0, $bulan, $d, $tahun)) }}">
											<input type="hidden" name="anggota_id" value={{ $anggota->id }}>

											<input type="hidden" name="periode_id" value={{ $periode->id }}>

											<x-form-control>
												<x-label>shift</x-label>
												<select required name="shift" class="select select-bordered" >
													<option value="pagi" @if($jadwal->shift == 'pagi') selected @endif>pagi</option>
													<option value="siang" @if($jadwal->shift == 'siang') selected @endif>siang</option>
													<option value="malam" @if($jadwal->shift == 'malam') selected @endif>malam</option>
												</select>
											</x-form-control>

											<div class="flex items-center justify-end gap-2">
												<button type="reset" class="btn btn-outline">reset</button>
												<button type="submit" class="btn">submit</button>
											</div>

										</form>
									</x-modal>
					        	@endif
					        </td>
				        @endfor
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