@extends('home.layouts.main')
@section('title', 'About Us')
@section('content')
<div class="relative z-10 overflow-hidden bg-primary pt-[120px] pb-[100px] md:pt-[130px] lg:pt-[160px]">
    <div class="container">
        <div class="-mx-4 flex flex-wrap items-center">
            <div class="w-full px-4">
                <div class="text-center">
                    <h1 class="mb-8 text-4xl font-semibold text-white">Forum</h1>
                    <p class="mx-auto mb-10 max-w-[600px] text-base text-[#e4e4e4] sm:text-lg sm:leading-relaxed md:text-xl md:leading-relaxed">
                        Ask and answer with thousands of people.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-10 flex flex-wrap items-center justify-center">
        <a href="{{ route('forum.create') }}" class="inline-flex items-center justify-center rounded-lg bg-white py-4 px-6 text-center text-base font-medium text-dark transition duration-300 ease-in-out hover:text-primary hover:shadow-lg sm:px-10">
            Start a new discussion
            <span class="pl-2">
                <svg width="20" height="8" viewBox="0 0 20 8" class="fill-current">
                    <path d="M19.2188 2.90632L17.0625 0.343819C16.875 0.125069 16.5312 0.0938193 16.2812 0.281319C16.0625 0.468819 16.0312 0.812569 16.2188 1.06257L18.25 3.46882H0.9375C0.625 3.46882 0.375 3.71882 0.375 4.03132C0.375 4.34382 0.625 4.59382 0.9375 4.59382H18.25L16.2188 7.00007C16.0312 7.21882 16.0625 7.56257 16.2812 7.78132C16.375 7.87507 16.5 7.90632 16.625 7.90632C16.7812 7.90632 16.9375 7.84382 17.0312 7.71882L19.1875 5.15632C19.75 4.46882 19.75 3.53132 19.2188 2.90632Z" />
                </svg>
            </span>
        </a>
    </div>
    <div>
        <span class="absolute top-0 left-0 z-[-1]">
            <svg width="495" height="470" viewBox="0 0 495 470" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="55" cy="442" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
                <circle cx="446" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
                <path d="M245.406 137.609L233.985 94.9852L276.609 106.406L245.406 137.609Z" stroke="white" stroke-opacity="0.08" stroke-width="12" />
            </svg>
        </span>
        <span class="absolute top-0 right-0 z-[-1]">
            <svg width="493" height="470" viewBox="0 0 493 470" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="462" cy="5" r="138" stroke="white" stroke-opacity="0.04" stroke-width="50" />
                <circle cx="49" cy="470" r="39" stroke="white" stroke-opacity="0.04" stroke-width="20" />
                <path d="M222.393 226.701L272.808 213.192L259.299 263.607L222.393 226.701Z" stroke="white" stroke-opacity="0.06" stroke-width="13" />
            </svg>
        </span>
    </div>
</div>
<!-- ====== Banner Section End -->

<!-- ====== Forum Section Start -->
@if (session('success'))
<div class=" bg-green-500 text-white p-3 rounded-lg mb-3">
    {{ session('success') }}
</div>
@endif
<section class="bg-[#f3f4fe] py-10 lg:py-[120px]">
    <div class="container">
        @foreach ($data as $item)
        <a href="{{ route('forum.show', $item->slug) }}">
            <div class="bg-white p-5 lg:p-[70px] rounded-lg shadow-lg p-10 mb-6"> <!-- Tambahkan class "mb-6" di sini -->
                <h4 class="text-3xl font-bold text-dark mb-6">{{ $item->title }}</h4>
                <div class="user-and-date flex items-center mb-6 text-body-color">
                    <span class="user text-gray-600"><i class="fas fa-user"></i> : {{ $item->user->name }}</span>
                    <span class="date ml-4 text-blue-500"><i class="fas fa-calendar-alt"></i> : {{ $item->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-base leading-relaxed text-body-color">
                    {!! strip_tags(Str::limit($item->content, 200)) !!}
                </p>
            </div>
        </a>
        @endforeach
</section>

<!-- ====== Forum Section End -->
@endsection
