<?php

namespace Modules\Auth\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Http\Request;

class Notifikasi implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $id_siswa;
    public $id_roles;
    public $deskripsi;
    public $id_staff;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($id_staff,$id_siswa,$id_roles,$deskripsi)
    {
        $this->id_staff = $id_staff;
        $this->id_siswa = $id_siswa;
        $this->id_roles = $id_roles;
        $this->deskripsi = $deskripsi;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new Channel('notifikasi');
    }
    public function broadcastWith()
    {
        return [
            'id_siswa' => $this->id_siswa,
            'id_roles' => $this->id_roles,
            'id_staff' => $this->id_staff,
            'deskripsi' => $this->deskripsi
        ];
    }
}
