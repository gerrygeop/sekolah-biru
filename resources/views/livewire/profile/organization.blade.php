<div class="py-12 bg-gray-50">
	<div class="container mx-auto px-4">
		<!-- Page Header -->
		<div class="text-center mb-12">
			<h1 class="text-4xl font-bold text-gray-900 mb-4">Struktur Organisasi</h1>
			<p class="text-lg text-gray-600 max-w-2xl mx-auto">
				Kepemimpinan dan manajemen sekolah kami
			</p>
		</div>

		@if ($organization->isNotEmpty())
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
				@foreach ($organization as $position)
					<div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
						@if ($position->photo_path)
							<div class="aspect-square bg-gray-200 overflow-hidden">
								<img src="{{ Storage::url($position->photo_path) }}" alt="{{ $position->name }}"
									class="w-full h-full object-cover">
							</div>
						@else
							<div class="aspect-square bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
								<svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
								</svg>
							</div>
						@endif

						<div class="p-6 text-center">
							<h3 class="font-bold text-lg text-gray-900 mb-1">{{ $position->name }}</h3>
							<p class="text-primary-600 font-medium mb-2">{{ $position->position }}</p>
							@if ($position->nip)
								<p class="text-sm text-gray-500">NIP: {{ $position->nip }}</p>
							@endif
						</div>
					</div>
				@endforeach
			</div>
		@else
			<div class="text-center py-12">
				<svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
				</svg>
				<p class="text-gray-500">Belum ada data struktur organisasi</p>
			</div>
		@endif
	</div>
</div>
