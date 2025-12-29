<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSmtpMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build(): SendSmtpMail
    {
        $this->data['content']['body'] = '';
        $subject                       = getArrayValue('subject', $this->data['content']);
        if (arrayCheck('template_title', $this->data['content'])) {
            $user                          = $this->data['content']['user'];
            $template                      = EmailTemplate($this->data['content']['template_title']);
            $tags                          = ['{name}', '{email}', '{site_name}', '{otp}', '{confirmation_link}', '{reset_link}', '{login_link}'];

            $confirmation_link             = getArrayValue('confirmation_link', $this->data['content']);
            $reset_link                    = getArrayValue('reset_link', $this->data['content']);
            $login_link                    = getArrayValue('login_link', $this->data['content']);

            $replaces                      = [$user->name, $user->email, setting('system_name'), getArrayValue('otp', $this->data['content']), '<a href="'.$confirmation_link.'">'.$confirmation_link.'</a>', '<a href="'.$reset_link.'">'.$reset_link.'</a>',
                '<a href="'.$login_link.'">'.$login_link.'</a>'];
            $subject                       = str_replace($tags, $replaces, $template->subject);
            $this->data['content']['body'] = str_replace($tags, $replaces, $template->body);
        }

        return $this->subject($subject)->view($this->data['view'], $this->data['content']);
    }
}
