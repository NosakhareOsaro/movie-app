<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class TagIndex extends Component
{
    public $showTagModal = false, $tagName, $tagId;

    public $search = '', $sort = 'asc', $perPage = 5;

    public function showCreateModal()
    {
        $this->showTagModal = true;
        
    }

    public function createTag()
    {
        try{ Tag::create([ 'tag_name'=> $this->tagName, 'slug'=> Str::slug($this->tagName) ]);
                $this->reset();
                $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'success', 'message'=>"Tag created successfully!" ]);
        } catch(\Exception $e){
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'error', 'message'=>"Operation failed!"]); 
        }
    }

    public function showEditModal($tagId)
    {
        $this->reset(['tagName']);
        $this->tagId = $tagId;
        $tag = Tag::find($tagId);
        $this->tagName = $tag->tag_name;
        $this->showTagModal = true;
    }
    
    public function updateTag()
    {
        try{

        }catch(\Exception $e){ 
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'error', 'message'=>"Operation failed!"]); 
        }
        try{
                Tag::findOrFail($this->tagId)->update([
                'tag_name' => $this->tagName,
                'slug'     => Str::slug($this->tagName)
            ]);
            $this->reset();
            $this->showTagModal = false;
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'success', 'message'=>"Tag updated successfully!"]);

        }catch(\Exception $e){ 
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'error', 'message'=>"Operation failed!"]); 
        }
        
        
    }

    public function deleteTag($tagId)
    {
        try{
            Tag::findOrFail($tagId)->delete();
            $this->reset();
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'success', 'message'=>"Tag deleted successfully!" ]);
        }catch(\Exception $e){ 
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'error', 'message'=>"Operation failed!"]); 
        }
    }

    public function closeTagModal()
    {
        $this->showTagModal = false;
    }

    public function resetFilters()
    {
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.tag-index', 
                        ['tags' => Tag::query()->where('tag_name', 'LIKE', "%{$this->search}%")
                        ->orderBy('tag_name', $this->sort)
                        ->paginate($this->perPage)]);
    }
}
