<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Content;
use App\Models\Department;
use App\Models\User;

class Dashboard extends Component
{




    #[Title('Dashboard Admin')]
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'departments' => Department::count(),
            'categories' => Category::count(),
            'contents' => Content::count(),
            'publishedContents' => Content::where('status', 'published')->count(),
            'unpublishedContents' => Content::where('status', 'unpublished')->count(),
            'users' => User::count(),
        ]);
    }
}
