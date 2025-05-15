<?php

namespace App\Livewire\Admin\Contents;

use App\Models\Content;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class ContentList extends Component
{
    use WithPagination;

    public $confirmingContentId = null;
    #[On('deleteConfirmed')]
    public function deleteConfirmed()
    {
        $content = Content::find($this->confirmingContentId);

        if ($content) {
            // Hapus image dari storage jika ada
            if ($content->image && Storage::disk('public')->exists($content->image)) {
                Storage::disk('public')->delete($content->image);
            }

            $content->delete();
            $this->dispatch('contentDeleted');
        }

        $this->confirmingContentId = null;
        $this->dispatch('closeDeleteModal');
        $this->dispatch('refreshContentList');

    }

    public function confirmDelete($id)
    {
        $this->confirmingContentId = $id;
        $this->dispatch('openDeleteModal');
    }


    #[On('refreshContentList')]
    public function render()
    {
        $contents = Content::with(['user', 'type', 'categories'])
        ->latest()
        ->paginate(10);
        return view('livewire.admin.contents.content-list', [
            'contents' => $contents,
        ]);
    }
}
