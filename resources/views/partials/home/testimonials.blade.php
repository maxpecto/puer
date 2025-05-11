@if(isset($testimonials) && $testimonials->count() > 0)
<section id="testimonials" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold font-serif text-green-800 mb-4">
                {{ $settings['testimonials_title'] ?? __('What Our Customers Say') }}
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ $settings['testimonials_subtitle'] ?? __('Honest feedback from our valued tea lovers.') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-lg shadow-lg p-8 flex flex-col items-center text-center">
                    {{-- İsteğe bağlı olarak yorum yapanın bir avatarı/görseli eklenebilir --}}
                    {{-- <img src="{{ $testimonial->author_avatar ?? 'https://via.placeholder.com/100' }}" alt="{{ $testimonial->author_name }}" class="w-20 h-20 rounded-full mb-4 object-cover"> --}}
                    
                    <svg class="w-12 h-12 text-green-500 mb-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.083 7.417C4.083 5.53 5.537 4.083 7.417 4.083c1.125 0 2.142.55 2.75 1.375a.75.75 0 001.333-.75C10.833 3.608 9.25 2.583 7.417 2.583 4.667 2.583 2.583 4.667 2.583 7.417c0 1.4.542 2.666 1.417 3.633L2.667 15.5h3.5a.75.75 0 00.75-.75v-2.25a.75.75 0 00-.75-.75h-1.5c-.412 0-.62-.254-.458-.592C4.012 10.517 4.083 8.417 4.083 7.417zm9.167 0c0-1.887 1.454-3.334 3.333-3.334 1.125 0 2.142.55 2.75 1.375a.75.75 0 001.333-.75C19.958 3.608 18.375 2.583 16.542 2.583c-2.75 0-4.834 2.084-4.834 4.834 0 1.4.542 2.666 1.417 3.633L11.834 15.5h3.5a.75.75 0 00.75-.75v-2.25a.75.75 0 00-.75-.75h-1.5c-.413 0-.62-.254-.458-.592.313-.691.384-2.791.384-3.791z" clip-rule="evenodd"></path></svg>

                    <p class="text-gray-600 italic mb-6 leading-relaxed">
                        "{{ $testimonial->content }}"
                    </p>
                    <p class="font-semibold font-serif text-green-700 text-lg">- {{ $testimonial->author_name }}</p>
                    {{-- İsteğe bağlı olarak yazarın pozisyonu/şirketi eklenebilir --}}
                    {{-- <p class="text-sm text-gray-500">{{ $testimonial->author_position }}</p> --}}
                </div>
            @endforeach
        </div>
    </div>
</section>
@else
<!-- Görünür müşteri yorumu bulunamadı. Admin panelinden yorumları 'Görünür' olarak işaretleyin. -->
@endif 