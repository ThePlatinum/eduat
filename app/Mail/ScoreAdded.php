<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScoreAdded extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $score;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($_score)
  {
    //
    $this->score = $_score;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject('New Assessment Score')->markdown('mail.score-added');
  }
}
