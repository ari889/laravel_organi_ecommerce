<?php

namespace App\Http\Livewire\Frontend\Blog;

use Livewire\Component;

class BlogComponent extends Component
{
    public function render()
    {
        return view('livewire.frontend.blog.blog-component', ['page_title' => 'Blog'])->layout('frontend.layouts.app', ['page_title' => 'Blog']);
    }
}
