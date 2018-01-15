<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CurriculoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $titulo = 'Avaliação de candidato';
    private $mensagem = 'Segue em Anexo';
    private $curricoloPDF;
    private $de;
    public function __construct($titulo, $mensagem, $curricoloPDF, $de )
    {
        $this->titulo = $titulo;
        $this->mensagem = $mensagem;
        $this->curricoloPDF = $curricoloPDF;
        $this->de = $de;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'testesuperpao@gmail.com';
        $name = $this->de;
        $subject = $this->titulo;

        return $this->view('mail.sendcurriculo',['mensagem'=> $this->mensagem])
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->attachData($this->curricoloPDF, 'Curriculo.pdf');;
    }
}
