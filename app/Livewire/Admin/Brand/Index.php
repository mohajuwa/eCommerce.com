<?php

namespace App\Livewire\Admin\Brand;

use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $layout = 'layouts.admin'; // Set the layout for this Livewire component

    public $name, $slug, $status, $brand_id, $category_id; // Declare $brand_id property

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|integer',

            'status' => 'nullable|boolean',
        ];
    }


    public function resetInput()
    {
        $this->reset(['name', 'slug', 'status', 'brand_id', 'category_id']); // Reset $brand_id as well
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();

        Brand::create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'status' => $validatedData['status'] == true ? '1' : '0',
            'category_id' => $this->category_id,
        ]);

        session()->flash('message', 'Brand Added Successfully');
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;

        $brand = Brand::findOrFail($brand_id);

        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = (bool) $brand->status; // Ensure 'status' is cast to boolean
        $this->category_id = $brand->category_id;
    }


    public function updateBrand()
    {
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status ?? false, // Use null coalescing operator to set default value
            'category_id' => $this->category_id,

        ]);
        session()->flash('message', 'Brand updated successfully');
        $this->dispatch('close-modal');
        $this->resetInput();
    }
    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }
    public  function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand deleted successfully');
        $this->dispatch('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $categories = Category::where('status', '0')->get();
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
            ->extends('layouts.admin')
            ->section('content');
    }
}
