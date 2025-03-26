<h2>Reviews</h2>

<!-- Add a review -->
@if (auth()->user() && auth()->user()->isMember() && !$reviews->contains(fn($review) => $review->user->username === auth()->user()->username))

<x-add-review :user="auth()->user()" :book="$book" />
@endif


<!-- Display existing reviews -->
@if (isset($reviews) && !$reviews->isEmpty())
<div class="flex flex-col">
    @foreach ($reviews as $review)

    <!-- Display the user's review on top -->
    <div class="review"
        @if(auth()->user() && $review->user->username === auth()->user()->username)
        style="order: -1;"
        @endif>

        <!-- Edit/delete user's review -->
        @if(auth()->user() && $review->user->username === auth()->user()->username)
        <div class="flex justify-between">
            <x-edit-review :user="auth()->user()" :book="$book" :review="$review" />
            <x-delete-review :user="auth()->user()" :book="$book" :review="$review" />
        </div>
        @endif


        <div x-data='{ review: @json($review) }' class="header">
            <span class="author" x-text="review.user ? review.user.username : 'Deleted user'"></span>
            <p class="date"> {{$review->date}}</p>
            <div class="note">
                @for ($i = 0; $i < $review->note; $i++)
                    <i class="fa fa-star fill"></i>
                    @endfor
                    @for ($i = $review->note; $i < 5; $i++)
                        <i class="fa fa-star empty"></i>
                        @endfor
            </div>

            @if ($review->recommend == 1)
            <div class="recommend flex flex-col items-center">
                <div>
                    <i class="fa fa-solid fa-thumbs-up"></i>
                </div>
                <p> Suositteltu</p>
            </div>
            @endif
        </div>

        <div class="content">
            <p class="content"> {{$review->content}} </p>
        </div>

    </div>
    @endforeach
</div>

@else
<p>Ei ole vielä arvosteluja.</p>
@endif