<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Contrato;

class ContractStatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $contrato;

    /**
     * Crear una nueva notificación.
     *
     * @param Contrato $contrato
     */
    public function __construct(Contrato $contrato)
    {
        $this->contrato = $contrato;
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
                    ->subject('Cambio en el Estado de tu Contrato')
                    ->line('El estado de tu contrato ha cambiado.')
                    ->line('**Detalles del Contrato**')
                    ->line('ID del Contrato: ' . $this->contrato->contract_id)
                    ->line('Propiedad: ' . ($this->contrato->propiedad->address ?? 'N/A') . ', ' . ($this->contrato->propiedad->city ?? 'N/A'))
                    ->line('Tipo: ' . $this->contrato->contract_type)
                    ->line('Monto: $' . number_format($this->contrato->amount, 0, ',', '.'))
                    ->line('Nuevo Estado: ' . $this->contrato->status)
                    ->line('Fecha de Inicio: ' . $this->contrato->start_date)
                    ->line('Fecha de Fin: ' . $this->contrato->end_date)
                    ->action('Ver Contratos', route('usuario.contratos'))
                    ->line('Gracias por usar nuestro sistema.');
    }
}