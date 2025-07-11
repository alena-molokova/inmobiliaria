<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Propiedad;

class NewPropertyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $propiedad;

    /**
     * Crear una nueva notificación.
     *
     * @param Propiedad $propiedad
     */
    public function __construct(Propiedad $propiedad)
    {
        $this->propiedad = $propiedad;
    }

    /**
     * Obtener los canales de entrega de la notificación.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Obtener la representación en correo de la notificación.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nueva Propiedad Disponible')
                    ->line('Se ha añadido una nueva propiedad disponible en el sistema.')
                    ->line('**Detalles de la Propiedad**')
                    ->line('Dirección: ' . $this->propiedad->address)
                    ->line('Ciudad: ' . $this->propiedad->city)
                    ->line('Tipo: ' . $this->propiedad->property_type)
                    ->line('Precio: $' . number_format($this->propiedad->price, 0, ',', '.'))
                    ->line('Descripción: ' . ($this->propiedad->description ?? 'N/A'))
                    ->action('Ver Propiedad', route('usuario.propiedades.show', $this->propiedad->property_id))
                    ->line('Gracias por usar nuestro sistema.');
    }
}