<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Mail;

class ContactController extends SiteController
{
    public function __construct(MenuRepository $m_rep)
    {
        parent::__construct($m_rep);

        $this->template = 'contacts';
        $this->bar = 'left';
    }

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'
            ]);

            $data = $request->all();
            $result = Mail::send(config('settings.theme') . '.email', ['data' => $data], function ($message) use ($data) {
                $message->from($data['email'], $data['name']);
                $message->to(env('MAIL_ADMIN'), 'Mr. Admin')->subject('Question');
            });
//			if ($result) {
            return redirect()->route('contacts')->with('status', trans('custom.email_is_send'));
//			}
        }


        $this->title = 'Контакты';
        $this->keywords = 'Контакты_ключи';
        $this->meta_desc = 'Контакты_описание';

        $content_view = view(config('settings.theme') . '.contacts_content')
            ->render();
        $this->vars = array_add($this->vars, 'content_view', $content_view);

        $this->contentLeftBar = view(config('settings.theme') . '.contactsBar')
            ->render();

        return $this->renderOutput();
    }
}
