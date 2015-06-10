<?php namespace Modules\Contact\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Modules\Core\Contracts\Setting;
use Modules\Contact\Http\Requests\ContactRequest;


class ContactController extends Controller
{
    /**
     * @var Setting
     */
    private $setting;
    /**
     * @var AssetPipeline
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Handle the contact form submission.
     *
     * @return Response
     */
    public function send(Mailer $mailer, ContactRequest $request)
    {
        $mailer->send(config('asgard.contact.config.mail.views'), $request->all(), function ($message) {
            $message->to(
                $this->setting->get('contact::contact-to-email'),
                $this->setting->get('contact::contact-to-name')
            );
            $message->subject($this->setting->get('contact::contact-to-subject'));
        });

        return redirect($request->get('from'))->with('contact_form_message', trans('contact::contacts.sent_message'));
    }
}
