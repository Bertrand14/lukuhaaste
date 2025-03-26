<div x-data="{ 
    addReview: false, 
    reviewContent: '', 
    reviewBookID: {{$book->id}}, 
    reviewUserID: {{ auth()->user()->id}}
    }">

    <!-- Add button -->
    <button @click="addReview = !addReview" class="add-review">
        <i class="fa fa-solid fa-pen-fancy"></i>
        <span x-text="addReview ? 'Cancel' : 'Add review'"></span>
    </button>


    <!-- Error / success messages -->
    @if ($errors->any())
    <div class="bg-red-500 text-white p-2 rounded-md">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="bg-green-500 text-white p-2 rounded-md">
        {{ session('success') }}
    </div>
    @endif


    <!-- Form (hidden by default) -->
    <div x-show="addReview" x-transition>
        <form action="{{ route('review.store') }}" method="POST" x-cloak>
            @csrf

            <input type="hidden" id="reviewUserID" name="reviewUserID" x-model="reviewUserID">
            <input type="hidden" id="reviewBookID" name="reviewBookID" x-model="reviewBookID">

            <div x-data="{ rating: 0 }" id="reviewNote" name="reviewNote" class="flex items-center">
                <label for="reviewNote">How much would you rate? (click again on the star to reset to 0)</label>

                <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                    <i @click="rating = rating === star ? 0 : star"
                        :class="{
                            'fa fa-solid fa-star filled': star <= rating, 
                            'fa fa-regular fa-star': star > rating
                        }"></i>
                </template>

                <span x-text="rating + '/5'" class="ml-2"></span>
                <input type="hidden" name="reviewNote" :value="rating">
            </div>

            <label for="reviewRecommend" class="mr-2">I recommend this book:</label>
            <input type="checkbox" id="reviewRecommend" name="reviewRecommend" value="1"><br />

            <label for="reviewContent">Your review:</label><br />
            <textarea
                id="reviewContent"
                name="reviewContent"
                placeholder="Write your review"
                class="w-full h-20 resize p-2 border rounded-md"
                required></textarea>

            <button type="submit">Submit</button>

        </form>

    </div>

</div>