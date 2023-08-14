<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategory extends Component
{
    use WithPagination;

    public function deleteCategory(Category $category): void
    {
        $this->authorize('manage', $category);

        $name = $category->name;

        $category->delete();

        session()->flash('status', 'Category ' . $name . ' Deleted!');
    }

    #[Layout('layouts.dashboard')]
    public function render()
    {
        return view('livewire.categories.list-category', [
            'categories' => Category::orderBy('name')->paginate(6),
        ]);
    }
}
