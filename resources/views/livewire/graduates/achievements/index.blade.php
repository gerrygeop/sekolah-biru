<div class="py-12 bg-gray-50">
	<div class="container mx-auto px-4">
		<!-- Page Header -->
		<div class="text-center mb-12">
			<h1 class="text-4xl font-bold text-gray-900 mb-4">Prestasi Siswa</h1>
			<p class="text-lg text-gray-600 max-w-2xl mx-auto">
				Kebanggaan dan pencapaian siswa-siswi kami
			</p>
		</div>

		<!-- Category Filter -->
		@if ($categories->isNotEmpty())
			<div class="flex flex-wrap gap-2 justify-center mb-8">
				<button wire:click="setCategory(null)"
					class="px-6 py-2 rounded-lg font-medium transition {{ $selectedCategory === null ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-primary-200' }} cursor-pointer">
					Semua
				</button>
				@foreach ($categories as $category)
					<button wire:click="setCategory('{{ $category }}')"
						class="px-6 py-2 rounded-lg font-medium transition {{ $selectedCategory === $category ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-primary-200' }} cursor-pointer capitalize">
						{{ $category }}
					</button>
				@endforeach
			</div>
		@endif

		@if ($achievements->isNotEmpty())
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
				@foreach ($achievements as $achievement)
					<a href="{{ route('graduates.achievements.show', $achievement->slug) }}"
						class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
						@if ($achievement->image_path)
							<div class="aspect-video bg-gray-200 overflow-hidden">
								<img src="{{ Storage::url($achievement->image_path) }}" alt="{{ $achievement->title }}"
									class="w-full h-full object-cover">
							</div>
						@else
							<div class="aspect-video bg-gradient-to-br from-secondary-400 to-secondary-600 flex items-center justify-center">
								<svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
								</svg>
							</div>
						@endif

						<div class="p-5">
							<div class="flex items-center gap-2 mb-3">
								<span class="px-2 py-1 bg-secondary-100 text-secondary-700 text-xs font-medium rounded">
									{{ $achievement->category }}
								</span>
								<span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">
									{{ $achievement->achievement_rank }}
								</span>
								<span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">
									{{ $achievement->level }}
								</span>
							</div>
							<h3 class="font-semibold text-gray-900 mb-2">
								{{ $achievement->title }}
							</h3>
							<p class="text-sm text-gray-600 mb-2">
								{{ $achievement->student_name }}
							</p>
							<p class="text-xs text-gray-500">
								{{ $achievement->achievement_date->format('d M Y') }}
							</p>
						</div>
					</a>
				@endforeach
			</div>

			<!-- Pagination -->
			<div class="mt-8">
				{{ $achievements->links() }}
			</div>
		@else
			<div class="text-center py-12">
				<svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
				</svg>
				<p class="text-gray-500">Belum ada data prestasi</p>
			</div>
		@endif
	</div>
</div>
