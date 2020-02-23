<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class Undangan extends Notification
{

    public $data = [];
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->line('The introduction to the notification.')
            ->action('Notification Action', $this->data['link'])
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'judul' => $this->data['judul'],
            'pesan' => $this->data['pesan'],
            'tempat' => $this->data['tempat'],
            'gambar' => $this->data['gambar'],
            'jam mulai' => $this->data['jam_mulai'],
            'jam_akhir' => $this->data['jam_akhir'],
            'tanggal' => $this->data['tanggal'],
            'tipe' => $this->data['tipe'],
            'link' => $this->data['link'],
            'nama_pengirim' => $this->data['nama_pengirim'], //
            'models_pengirim' => $this->data['models_pengirim'],
            'id_pengirim' => $this->data['id_pengirim'], //
            'nama_penerima' => $this->data['nama_penerima'],
            'models_penerima' => $this->data['models_penerima'],
            'id_penerima' => $this->data['id_penerima'],
            "models" => [],
            "models_id" => [],
            "read_at" => [],
            "untuk" => $this->data["untuk"], //pilihan guru, ortu, semua
            "rombel_id" => $this->data["rombel_id"],
            "sekolah_id" => $this->data["sekolah_id"]
        ];
    }
}
