@extends('home.layouts.main')
@section('title', 'Forum Detail')

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
</div>
<div class="container py-10 lg:py-[120px]">

    <div class=" bg-white p-5 lg:p-[70px] rounded-lg shadow-lg p-10 mb-10">
        <h2 class="text-3xl font-bold text-dark mb-6">{{ $forum->title }}</h2>
        <div class="user-and-date flex items-center mb-6 text-body-color">
            <span class="user text-gray-600"><i class="fas fa-user"></i> : {{ $forum->user->name }}</span>
            <span class="date ml-4 text-blue-500"><i class="fas fa-calendar-alt"></i> : {{ $forum->created_at->diffForHumans() }}</span>
        </div>
        <p class="text-base leading-relaxed text-body-color">{!! $forum->content !!}</p>
    </div>

    <h3 class="text-2xl font-bold text-dark mb-4 mt-4">Balasan</h3>
    @if($forum->forumThreads->count() > 0)
    @foreach($forum->forumThreads as $reply)
    <div class="bg-white p-5 lg:p-[70px] rounded-lg shadow-lg p-10 mb-6">
        <div class="bg-gray-100 p-4 rounded-lg mb-4">
            <div class="user-and-date flex items-center mb-6 text-body-color">
                <span class="user text-gray-600"><i class="fas fa-user"></i> : {{ $reply->user->name }}</span>
                <span class="date ml-4 text-blue-500"><i class="fas fa-calendar-alt"></i> : {{ $reply->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-base leading-relaxed">{!! $reply->content !!}</p>
        </div>
    </div>
    @endforeach
    @else
    <div class="bg-white p-5 lg:p-[70px] rounded-lg shadow-lg p-10 mb-6">
        <div class="bg-gray-100 p-4 rounded-lg mb-4">
            <p class="text-base leading-relaxed">Belum ada balasan</p>
        </div>
    </div>
    @endif
</div>
<section class="py-10 lg:py-[120px]">
    <div class="container">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="bg-red text-white p-3 rounded-lg mb-3">
            {{ $error }}
        </div>
        @endforeach
        @endif
        <div class="bg-white p-5 lg:p-[70px] rounded-lg shadow-lg p-10 mb-6">
            <p class="text-3xl font-bold text-dark mb-6">Balas Forum</p>

            <form action="{{ route('forum.reply', $forum->slug) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="content" class="block text-base font-semibold text-body-color">Balasan</label>
                    <textarea id="content" name="content" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" rows="6"></textarea>
                </div>
                <button type="submit" class="bg-primary text-white py-2 px-4 rounded-lg shadow-md hover:bg-primary-dark transition duration-300 ease-in-out">Submit</button>
            </form>
        </div>
    </div>
</section>
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
