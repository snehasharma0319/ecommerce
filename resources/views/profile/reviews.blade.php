@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Your Reviews</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">A list of all your product reviews.</p>
            </div>
            <a href="{{ route('profile.show') }}" class="text-indigo-600 hover:text-indigo-900">Back to Profile</a>
        </div>
        <div class="border-t border-gray-200">
            @forelse($reviews as $review)
                <div class="bg-white px-4 py-6 sm:px-6 border-b border-gray-200 last:border-b-0">
                    <div class="flex items-start">
                        @if($review->product->image_url)
                            <img src="{{ $review->product->image_url }}" alt="{{ $review->product->name }}" class="h-20 w-20 object-cover rounded">
                        @endif
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="text-lg font-medium text-gray-900">
                                    <a href="{{ route('shop.show', $review->product) }}" class="hover:text-indigo-600">
                                        {{ $review->product->name }}
                                    </a>
                                </h4>
                                <p class="text-sm text-gray-500">{{ $review->created_at->format('F j, Y') }}</p>
                            </div>
                            <div class="flex items-center mt-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                                @if($review->is_verified_purchase)
                                    <span class="ml-2 text-xs text-green-600">Verified Purchase</span>
                                @endif
                            </div>
                            @if($review->comment)
                                <p class="mt-2 text-gray-600">{{ $review->comment }}</p>
                            @endif
                            <div class="mt-4 flex space-x-4">
                                <button onclick="editReview({{ $review->id }})" class="text-sm text-indigo-600 hover:text-indigo-900">Edit</button>
                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white px-4 py-5 sm:px-6">
                    <p class="text-sm text-gray-500">You haven't written any reviews yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    @if($reviews->hasPages())
        <div class="mt-6">
            {{ $reviews->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
function editReview(reviewId) {
    // Implement review editing functionality
    // This could open a modal or navigate to an edit page
}
</script>
@endpush
@endsection 