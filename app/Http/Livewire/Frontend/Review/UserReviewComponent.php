<?php

namespace App\Http\Livewire\Frontend\Review;

use App\Models\Review;
use Livewire\Component;
use App\Models\OrderItem;

class UserReviewComponent extends Component
{
    public $order_item_id;
    public $rating;
    public $comment;

    public function mount($id){
        $this->order_item_id = $id;
        $this->rating = 5;
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'rating' => 'required|integer',
            'comment' => 'required'
        ]);
    }

    public function addReview(){
        $this->validate([
            'rating' => 'required|integer',
            'comment' => 'required'
        ]);

        $review = new Review();
        $review->rating = $this->rating;
        $review->comment = $this->comment;
        $review->order_item_id = $this->order_item_id;
        $review->save();

        $orderItem = OrderItem::find($this->order_item_id);
        $orderItem->rstatus = true;
        $orderItem->save();

        session()->flash('review_message', 'Review Published!');
        return redirect()->route('user.order', ['id' => $orderItem->order_id]);
    }

    public function render()
    {
        $orderItem = OrderItem::find($this->order_item_id);
        return view('livewire.frontend.review.user-review-component', ['page_title' => 'User Review', 'orderItem' => $orderItem])->layout('frontend.layouts.app', ['page_title' => 'User Review']);
    }
}
