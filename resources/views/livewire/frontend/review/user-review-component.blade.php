<div>
    <style>
        .product-link{
            color: #203239;
        }
        .product-link:hover, .product-link:active{
            color: #141E27;
        }
        .comment-form-rating>span {
            font-size: 14px;
            line-height: 20px;
            display: block;
            float: left;
            margin-right: 7px;
            color: #666;
        }

        .comment-form-rating~p {
            margin-bottom: 0 !important;
        }

        .comment-form-rating p.stars {
            display: inline-block;
            margin-bottom: 0 !important;
        }

        .comment-form-rating .stars input[type=radio] {
            display: none;
        }

        .comment-form-rating .stars label {
            display: block;
            float: left;
            margin: 0;
            padding: 0 2px;
        }

        .comment-form-rating .stars label::before {
            content: "\f005";
            font-family: FontAwesome;
            font-size: 15px;
            /*color: #e6e6e6;*/
            color: #efce4a;
        }

        .comment-form-rating .stars input[type=radio]:checked~label::before {
            color: #e6e6e6;
        }

        .comment-form-rating .stars:hover label::before {
            color: #efce4a !important;
        }

        .comment-form-rating .stars label:hover~label::before {
            color: #e6e6e6 !important;
        }

        .comment-form-rating {
            margin-bottom: 15px;
        }
    </style>
    <div class="container">
        <div class="card my-2">
            <div class="card-header">
                <h5><b>Publish review for</b> <q style="font-weight: normal;">{{ $orderItem->product->name }}</q></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <img src="storage/{{ json_decode($orderItem->product->image)[0] }}" width="100" alt="">
                    </div>
                    <div class="col-md-8 my-auto">
                        <a href="{{ route('product.detail', ['slug' => $orderItem->product->slug]) }}" class="product-link">{{ $orderItem->product->name }}</a>
                    </div>
                </div>
                <hr>
                <form wire:submit.prevent="addReview">
                    <div class="mb-3">
                        <div class="comment-form-rating">
                            <span class="form-label">Your rating</span>
                            <p class="stars">
                                <label for="rated-1"></label>
                                <input type="radio" id="rated-1" name="rating" value="1" wire:model="rating">
                                <label for="rated-2"></label>
                                <input type="radio" id="rated-2" name="rating" value="2" wire:model="rating">
                                <label for="rated-3"></label>
                                <input type="radio" id="rated-3" name="rating" value="3" wire:model="rating">
                                <label for="rated-4"></label>
                                <input type="radio" id="rated-4" name="rating" value="4" wire:model="rating">
                                <label for="rated-5"></label>
                                <input type="radio" id="rated-5" name="rating" value="5" wire:model="rating">
                            </p>
                        </div>
                        @error('rating')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="from-label">Comment</label>
                        <textarea id="comment" class="form-control @error('comment') is-invalid @enderror" cols="30" rows="10" wire:model="comment"></textarea>
                        @error('comment')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Publish</button>
                </form>
            </div>
        </div>
    </div>
</div>
