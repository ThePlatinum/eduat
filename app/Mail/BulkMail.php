<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkMail extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $bulkmail;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($_bulkmail)
  {
    //
    $this->bulkmail = $_bulkmail;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject(config('app.name').' NewsLetter')->markdown('mail.bulk-mail');
  }
}
