<?php

namespace App\Livewire\Admin\Category;

use Livewire\WithPagination;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_id;

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }



    public function destroyCategory()
    {
        $category = Category::find($this->category_id);

        $path = 'uploads/category/' . $category->image;
        if (Storage::exists($path)) {
            Storage::delete($path);
        }
        $category->delete();
        session()->flash('message', 'Category deleted successfully');
        $this->dispatch('close-modal');

        
    }


    public function render()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
}
