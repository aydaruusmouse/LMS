<?php

namespace App\Http\Controllers\Admin\Email;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailConfigureRequest;
use App\Repositories\EmailTemplateRepository;
use App\Repositories\SettingRepository;
use App\Traits\SendMailTrait;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class EmailController extends Controller
{
    use SendMailTrait;

    protected $settings;

    protected $emailTemplate;

    public function __construct(SettingRepository $settings, EmailTemplateRepository $emailTemplate)
    {
        $this->settings      = $settings;
        $this->emailTemplate = $emailTemplate;
    }

    public function serverConfiguration()
    {
        $mail_driver = setting('mail_driver');
        $data        = [
            'mail_driver' => $mail_driver,
        ];

        return view('backend.admin.email-setup.server-configuration', $data);
    }

    public function emailTemplate(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'email_templates' => $this->emailTemplate->authentication(),
            ];

            return view('backend.admin.email-setup.email-template', $data);
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function serverConfigurationUpdate(EmailConfigureRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            Toastr::error(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        $driver = $request->mail_server;
        if ($this->settings->update($request)) {

            if ($driver == 'smtp' || $driver == 'sendgrid' || $driver == 'mailgun' || $driver == 'sendinBlue' || $driver == 'zohoSMTP') {
                $mail_host            = setting('smtp_server_address');
                $mail_username        = setting('smtp_user_name');
                $mail_port            = setting('smtp_mail_port');
                $mail_address         = setting('mail_from_address');
                $name                 = setting('smtp_mail_from_name');
                $mail_password        = setting('smtp_password');
                $mail_encryption_type = setting('smtp_encryption_type');
            } elseif ($request->mail_server == 'sendmail') {
                $sendmail_path = setting('sendmail_path');
            }

            if ($request->mail_server == 'sendmail') {
                envWrite('MAIL_MAILER', 'sendmail');
                envWrite('MAIL_HOST', '');
                envWrite('MAIL_PORT', '');
                envWrite('MAIL_USERNAME', '');
                envWrite('MAIL_PASSWORD', '');
                envWrite('MAIL_ENCRYPTION', '');
                envWrite('MAIL_FROM_ADDRESS', '');
                envWrite('MAIL_FROM_NAME', '');
                envWrite('SENDMAIL_PATH', $sendmail_path);
            } else {
                envWrite('MAIL_MAILER', 'smtp');
                envWrite('MAIL_HOST', $request->smtp_server_address);
                envWrite('MAIL_PORT', $request->smtp_mail_port);
                envWrite('MAIL_USERNAME', $request->smtp_user_name);
                envWrite('MAIL_PASSWORD', $request->smtp_password);
                envWrite('MAIL_ENCRYPTION', $request->smtp_encryption_type);
                envWrite('MAIL_FROM_ADDRESS', $request->mail_from_address);
                envWrite('MAIL_FROM_NAME', $request->smtp_mail_from_name);
            }

            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('view:clear');

            Toastr::success(__('Setting Updated Successfully'));

            return redirect()->back();
        } else {
            Toastr::error(__('Something went wrong, please try again.'));

            return back();
        }
    }

    public function sendTestMail(Request $request)
    {
        $request->validate([
            'send_to' => 'required|email',
        ]);
        $send_to = $request->send_to;

        try {
            $data['content'] = __('Email is working Perfectly!! This is just a test email');
            $data['subject'] = __('Test Email');
            $this->sendmail($send_to, 'emails.auth.email-template', $data);
            Toastr::success(__('successfully_email_send'));

            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error($e->getMessage());

            return redirect()->back();
        }
    }

    public function templateBody(Request $request)
    {
        $templateBody = $this->emailTemplate->get($request->id);

        return response()->json($templateBody);
    }

    public function emailTemplateUpdate(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'subject' => 'required',
            'body'    => 'required',
        ]);
        try {
            $this->emailTemplate->update($request->all());
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('message_sent_successfully'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
