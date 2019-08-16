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
    public $nama_guru;
    public $id_siswa = null;
    public $id_roles;
    public $deskripsi;
    public $jenis;
    public $id_staff = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct($nama_guru,$id_siswa,$id_roles,$id_staff,$deskripsi,$jenis)
    {
        $this->nama_guru = $nama_guru;
        $this->id_siswa = $id_siswa;
        $this->id_roles = $id_roles;
        $this->deskripsi = $deskripsi;
        $this->id_staff = $id_staff;
        $this->jenis = $jenis;
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
            'nama_guru' => $this->nama_guru,
            'id_siswa' => $this->id_siswa,
            'id_roles' => $this->id_roles,
            'jenis' => $this->jenis,
            'deskripsi' => $this->deskripsi,
            'id_staff' => $this->id_staff
        ];
    }
}
