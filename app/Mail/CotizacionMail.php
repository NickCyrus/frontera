<?php

namespace App\Mail;

use App\Models\quotesModel;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotizacionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $cotizacion;
    public $pdf;
    public $to;
    public $subject;
    public $msg;
    public $attach;

    public function __construct( quotesModel $cotizacion , $r , $attr )
    {
        $this->cotizacion = $cotizacion;
        $this->subject    = $r->subject ?? 'Sin asunto';
        $this->msg        = $r->msg ?? '';
        $this->attach     = $attr ?? null;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('emails.cotizacion')->attach($this->attach);
    }
}
