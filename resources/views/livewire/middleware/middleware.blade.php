<?php

use Livewire\Volt\Component;
use App\Models\Qrcode;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


new class extends Component {

    use WithPagination;
    public $data = [];
    public $paginate;
    public $m;
    
    public function mount(Request $request,$paginate,$m)
    {
        $this->paginate = $paginate;
        $this->m = $m;
        
        
    }

    public function with(): array
    {
        
        return [
            // 'datas' => Qrcode::paginate($this->paginate)
            'datas' => DB::table($this->m)->paginate($this->paginate)

        ];
    }

}; ?>

<div>
    <ul>
        @foreach ($datas as $data)
            {{-- <li>{{$data}}</li> --}}
            <li>{{ json_encode($data) }}</li>

        @endforeach
        
    </ul>
    
 
    {{ $datas->links() }}
</div>
