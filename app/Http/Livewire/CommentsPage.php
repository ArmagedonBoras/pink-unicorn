<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentsPage extends Component
{
    use WithPagination;

    public Comment $comment;
    protected $rules = [
        'comment.title' => 'required|max:255',
        'comment.body' => 'required',
        'comment.expire_at' => 'required|date',
        'comment.pinned' => 'boolean',
    ];
    protected $queryString = [
        'expire_from' => ['except' => ""],
        'page' => ['except' => 1],

    ];
    protected $paginationTheme = 'bootstrap';
    public $expire_from;

    public function mount()
    {
        abort_if(Auth::check() === false, 403);
        $this->queryString['expire_from']['except'] = Carbon::today()->format('Y-m-d');
        $this->expire_from = $this->expire_from ?? Carbon::today()->format('Y-m-d');
        $this->comment = new Comment(['type' => 'info']);
        $this->rules['comment.expire_at'] = 'required|date|after:'.Carbon::today()->format('Y-m-d');

        $this->comment->pinned = false;
        $this->comment->expire_at = Carbon::today()->addMonth()->format('Y-m-d');
    }

    public function save()
    {
        $this->validate();
        $this->comment->save();
        $this->comment = new Comment(['type' => 'info']);
        $this->comment->pinned = false;
        $this->comment->expire_at = Carbon::today()->addMonth()->format('Y-m-d');
    }

    public function extend()
    {
        $this->expire_from = Carbon::createFromFormat('Y-m-d', $this->expire_from)->subMonths(3)->format('Y-m-d');
    }

    public function delete($id)
    {
        $item = Comment::find($id);
        if (Gate::allows('delete', $item)) {
            $item->delete();
        }
    }

    public function edit($id)
    {
        $item = Comment::find($id);
        if (Gate::allows('update', $item)) {
            $this->comment = $item;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $data = [
            'comments' => Comment::where('expire_at', '>=', $this->expire_from)->with('author')->latest()->paginate(10),
        ];

        /**
         * @var $view ViewFactory
         */
        $view = view('livewire.comments-page', $data);
        return $view->layout('layouts.app', ['title' => 'Information']);
    }
}
