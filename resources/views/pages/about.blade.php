@extends('layouts.app')

@section('title', isset($aboutPage) ? $aboutPage->title : __('Haqqımızda'))

@section('content')
<div class="container mx-auto px-4 pt-24 pb-12" style="color: var(--text-color);">
    @if(isset($aboutPage) && $aboutPage)
        <h1 class="text-4xl font-bold mb-6 text-center" style="color: var(--accent-color);">{{ $aboutPage->title }}</h1>
        <div class="prose prose-lg max-w-full mx-auto" style="color: var(--text-color);">
            {!! $aboutPage->content !!} {{-- RichEditor içeriği HTML olarak gösterilecek --}}
        </div>
    @else
        <h1 class="text-4xl font-bold mb-6 text-center" style="color: var(--accent-color);">{{ __('Haqqımızda') }}</h1>
        <p class="text-center" style="color: var(--text-color);">{{ __('Haqqımızda səhifəsinin məzmunu tezliklə əlavə olunacaq.') }}</p>
    @endif
</div>
@endsection 