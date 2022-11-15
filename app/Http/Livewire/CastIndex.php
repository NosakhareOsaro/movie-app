<?php

namespace App\Http\Livewire;

use App\Models\Cast;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class CastIndex extends Component
{
    use WithPagination;

    public $castTMDBId;
    public $castName;
    public $castPosterPath;
    public $castId;
    
    public $search = '';
    public $sort = 'asc';
    public $perPage = 5;

    public $showCastModal = false;

    public $deleteCastModal =false;

    protected $rules = [
        'castName' => 'required',
        'castPosterPath' => 'required'
    ];

    public function mount(){

    }

    public function generateCast()
    {
        $newCast = Http::get('https://api.themoviedb.org/3/person/'. $this->castTMDBId .'?api_key=8a11aac3fb4ef5f1f9607ee7e0329793&language=en-US
                        ')->json();

        $cast = Cast::where('tmdb_id', $newCast['id'])->first();
        if (!$cast) {
           
            try{ Cast::create([
                    'tmdb_id' => $newCast['id'],
                    'name'    => $newCast['name'],
                    'slug'    => Str::slug($newCast['name']),
                    'poster_path' => $newCast['profile_path']]);
                    $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'success', 'message'=>"Cast created!"]); 
            }catch(\Exception $e){ 
                $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'error', 'message'=>"Operation failed!"]); 
            }
        } else {
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'error', 'message'=>"Cast already"]); 
        }
    }

    public function showEditModal($id)
    {
        $this->castId = $id;
        $this->loadCast();
        $this->showCastModal = true;
    }

    public function loadCast()
    {
        $cast = Cast::findOrFail($this->castId);
        $this->castName = $cast->name;
        $this->castPosterPath = $cast->poster_path;
    }

    public function updateCast()
    {
            $this->validate();
            $cast = Cast::findOrFail($this->castId);
            
        try{ $cast->update([
                'name' => $this->castName,
                'poster_path' => $this->castPosterPath
            ]);
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'success', 'message'=>"Cast updated"]); 
            $this->reset();

        }catch(\Exception $e){ 
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'error', 'message'=>"Operation failed!"]); 
        }
        
    }

    public function closeCastModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function showDeleteModal($id)
    {
        $this->castId = $id;
        $this->loadCast();
        $this->deleteCastModal = true;
    }
    public function deleteCast($id)
    {
        try{
            Cast::findOrFail($id)->delete();
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'success', 'message'=>"Cast deleted!"]); 
            $this->reset();
        }catch(\Exception $e){ 
            $this->dispatchBrowserEvent('sweetAlert',[ 'type'=>'error', 'message'=>"Operation failed!"]); 
        }
        
    }

    public function resetFilters()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.cast-index',
        [ 'casts' => Cast::query()->where('name', 'LIKE', "%{$this->search}%")
            ->orderBy('name', $this->sort)
            ->paginate($this->perPage)]);
         //
    }
}
