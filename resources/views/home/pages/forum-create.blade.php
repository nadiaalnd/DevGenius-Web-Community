@extends('home.layouts.main')
@section('title', 'About Us')
@section('content')
<div class="relative z-10 overflow-hidden bg-primary pt-[120px] pb-[100px] md:pt-[130px] lg:pt-[160px]">
    <div class="container">
        <div class="-mx-4 flex flex-wrap items-center">
            <div class="w-full px-4">
                <div class="text-center">
                    <h1 class="text-4xl font-semibold text-white">What is your question?</h1>
                </div>
            </div>
        </div>
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
<section class="bg-[#f3f4fe] py-10 lg:py-[120px]">
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="bg-red text-white p-3 rounded-lg mb-3">
            {{ $error }}
        </div>
        @endforeach
        @endif
        <div class="bg-white p-5 lg:p-[70px] rounded-lg shadow-lg p-10 mb-6">
            <form action="{{ route('forum.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="title" class="block text-base font-semibold text-body-color">Title</label>
                    <input type="text" id="title" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label for="content" class="block text-base font-semibold text-body-color">Content</label>
                    <textarea id="content" name="content" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" rows="6"></textarea>
                </div>
                <button type="submit" class="bg-primary text-white py-2 px-4 rounded-lg shadow-md hover:bg-primary-dark transition duration-300 ease-in-out">Submit</button>
            </form>
        </div>
    </div>
</section>
<!-- ====== Forum Section End -->
@endsection

@push('scripts')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endpush
