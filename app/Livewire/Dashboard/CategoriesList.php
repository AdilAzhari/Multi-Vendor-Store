<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class CategoriesList extends Component
{
    public $categories, $name, $selectedId = null, $parentId = null;
    public $editMode = false;

    protected $rules = [
        'name' => 'required|unique:categories,name', // Adjust validation rules as needed
    ];

    public function mount()
    {
        $this->categories = Category::paginate(10);
    }

    public function render()
    {
        return view('livewire.dashboard.categories-list');
    }

    public function someMethod($data)
    {
        // Access and use the data here
        foreach ($data['data'] as $category) {
            // Process individual categories
        }
    }
    public function createCategory()
    {
        $this->validate();

        $category = Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'parent_id' => $this->parentId,
        ]);

        $this->resetInputFields();
        $this->categories = Category::paginate(10);
        $this->emit('categoryCreated', $category->id); // Emit event for potential UI updates (optional)

        session()->flash('success', 'Category added successfully!');
    }

    public function editCategory(Category $category)
    {
        $this->name = $category->name;
        $this->selectedId = $category->id;
        $this->parentId = $category->parent_id; // Consider handling parent edits if applicable
        $this->editMode = true;

        $this->rules = [
            'name' => 'required|unique:categories,name,' . $this->selectedId, // Adjust for unique validation
        ];
    }

    public function updateCategory()
    {
        $this->validate();

        $category = Category::findOrFail($this->selectedId);
        $category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        $this->resetInputFields();
        $this->categories = Category::paginate(10);
        $this->editMode = false;

        session()->flash('success', 'Category updated successfully!');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        $this->categories = Category::paginate(10);

        session()->flash('success', 'Category deleted successfully!');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->selectedId = null;
        $this->parentId = null; // Reset parent if applicable
        $this->editMode = false;
    }
}
