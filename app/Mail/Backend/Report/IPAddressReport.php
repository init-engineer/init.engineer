<?php

namespace App\Mail\Backend\Report;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class IPAddressReport.
 */
class IPAddressReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    public $data;

    /**
     * IPAddressReport constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(config('mail.from.address'), config('mail.from.name'))
            ->view('frontend.mail.ip-address-report')
            ->text('frontend.mail.ip-address-report-text')
            ->subject(__('strings.emails.report.ip_address', ['ip_address' => $this->data['ip_address']]))
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.from.address'), config('mail.from.name'));
    }
}
