<?php

namespace App\Http\Livewire\Admin\Chat;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowChats extends Component
{

    public $senderId;
    public $searchTerm;

    public $senderName;
    public $senderRole;
    public $replyMessage;
    public $userMessages = [];

    protected $listeners = [
        'cancelDelete',
        'confirmDelete',

    ];

    public function render()
    {
        //$searchTerm = '%' . $this->searchTerm . '%';
        $search = '%' . $this->searchTerm . '%';

        $users = User::whereNotIn('id', [\auth()->id()])
            ->whereRoleIs(['admin', 'staff', 'agent', 'user'])
            ->where('name', 'like', $search)
            ->with('latestReply')
            ->withCount('unreadReplies')
            ->get();
        return view('livewire.admin.chat.show-chats', ['users' => $users]);
    }

    protected function getResponderDetails()
    {


        $sender = User::find($this->senderId);
        if ($sender) {
            $this->senderName = $sender->name;
            $this->senderRole = $sender->roles->first()->display_name;
        } else {
            $this->senderName = 'NO USER SELECTED';
            $this->senderRole = '';
        }
    }

    public function getUserChats()
    {
        $this->userMessages = Chat::where(function ($query) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $this->senderId);
        })
            ->orWhere(function ($query) {
                $query->where('receiver_id', Auth::id())->where('sender_id', $this->senderId);
            })
            ->get();

        $this->markUnreadChatsAsRead();
    }

    protected function markUnreadChatsAsRead()
    {
        Chat::whereNull('read_at')
            ->where('sender_id', $this->senderId)
            ->where('receiver_id', \auth()->id())
            ->update(['read_at' => now()]);
    }

    public function showChats($id)
    {
        $this->senderId = $id;
        $this->getResponderDetails();
        $this->getUserChats();


    }

    public function sendReply()
    {
        $this->validate(['replyMessage' => 'required']);

        Chat::create([
            'message' => $this->replyMessage,
            'sender_id' => auth()->id(),
            'receiver_id' => $this->senderId,
        ]);

        $this->getUserChats();

        $this->replyMessage = '';

    }

    public function triggerDelete()
    {
        $this->confirm('Clear this conversation with ' . $this->senderName . ' ?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => 'Nope',
            'onConfirmed' => 'confirmDelete',
            'onCancelled' => 'cancelDelete'
        ]);
    }

    public function confirmDelete()
    {

        $messagesToDelete = Chat::where(function ($query) {
            $query->where('sender_id', Auth::id())->where('receiver_id', $this->senderId);
        })
            ->orWhere(function ($query) {
                $query->where('receiver_id', Auth::id())->where('sender_id', $this->senderId);
            })
            ->delete();

        //$messagesToDelete->delete();

        $this->userMessages = [];


        $this->alert(
            'success',
            'Cleared.'
        );
    }

    public function cancelDelete()
    {
        $this->alert('info', 'Understood');
    }
}
