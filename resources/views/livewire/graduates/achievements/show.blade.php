<div class="py-12 bg-gray-50">
	<div class="container mx-auto px-4">
		<div class="max-w-4xl mx-auto">
			<!-- Breadcrumb -->
			<nav class="mb-6">
				<ol class="flex items-center space-x-2 text-sm text-gray-600">
					<li><a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a></li>
					<li>/</li>
					<li><a href="{{ route('graduates.achievements') }}" class="hover:text-primary-600">Prestasi</a>
					</li>
					<li>/</li>
					<li class="text-gray-900">{{ $achievement->title }}</li>
				</ol>
			</nav>

			<!-- Achievement Detail -->
			<article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
				@if ($achievement->image_path)
					<div class="aspect-video bg-gray-200">
						<img src="{{ Storage::url($achievement->image_path) }}" alt="{{ $achievement->title }}"
							class="w-full h-full object-cover">
					</div>
				@endif

				<div class="p-8 md:p-12">
					<!-- Badges -->
					<div class="flex flex-wrap items-center gap-2 mb-6 capitalize">
						<span class="px-3 py-1 bg-secondary-100 text-secondary-700 text-sm font-medium rounded">
							{{ $achievement->category }}
						</span>
						<span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded">
							{{ $achievement->achievement_rank }}
						</span>
						<span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded">
							{{ $achievement->level }}
						</span>
					</div>

					<!-- Title -->
					<h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $achievement->title }}</h1>

					<!-- Meta Information -->
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 p-6 bg-gray-50 rounded-xl">
						<div>
							<div class="text-sm text-gray-600 mb-1">Nama Siswa</div>
							<div class="font-semibold text-gray-900">{{ $achievement->student_name }}</div>
						</div>
						<div>
							<div class="text-sm text-gray-600 mb-1">Tanggal Pencapaian</div>
							<div class="font-semibold text-gray-900">
								{{ $achievement->achievement_date->format('d F Y') }}</div>
						</div>
						@if ($achievement->organizer)
							<div>
								<div class="text-sm text-gray-600 mb-1">Penyelenggara</div>
								<div class="font-semibold text-gray-900">{{ $achievement->organizer }}</div>
							</div>
						@endif
						@if ($achievement->location)
							<div>
								<div class="text-sm text-gray-600 mb-1">Lokasi</div>
								<div class="font-semibold text-gray-900">{{ $achievement->location }}</div>
							</div>
						@endif
					</div>

					<!-- Description -->
					@if ($achievement->description)
						<div class="prose prose-lg max-w-none">
							<h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h2>
							<p class="text-gray-700 leading-relaxed">{{ $achievement->description }}</p>
						</div>
					@endif
				</div>
			</article>

			<!-- Related Achievements -->
			@if ($relatedAchievements->isNotEmpty())
				<div class="mt-12">
					<h2 class="text-2xl font-bold text-gray-900 mb-6">Prestasi Terkait</h2>
					<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
						@foreach ($relatedAchievements as $related)
							<a href="{{ route('graduates.achievements.show', $related->slug) }}"
								class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
								@if ($related->image_path)
									<div class="aspect-video bg-gray-200 overflow-hidden">
										<img src="{{ Storage::url($related->image_path) }}" alt="{{ $related->title }}"
											class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
									</div>
								@endif
								<div class="p-4">
									<div class="flex items-center gap-2 mb-2 capitalize">
										<span class="px-2 py-1 bg-secondary-100 text-secondary-700 text-xs font-medium rounded">
											{{ $related->category }}
										</span>
										<span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">
											{{ $related->achievement_rank }}
										</span>
										<span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">
											{{ $related->level }}
										</span>
									</div>
									<h3 class="font-semibold text-gray-900 line-clamp-2 group-hover:text-primary-600 transition">
										{{ $related->title }}
									</h3>
									<p class="text-sm text-gray-600 mt-1">{{ $related->student_name }}</p>
								</div>
							</a>
						@endforeach
					</div>
				</div>
			@endif

			<!-- Back Button -->
			<div class="mt-8">
				<a href="{{ route('graduates.achievements') }}"
					class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
					<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
					</svg>
					Kembali ke Daftar Prestasi
				</a>
			</div>
		</div>
	</div>
</div>
