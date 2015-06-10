<?php namespace Modules\Contact\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Http\Requests\CreateContactRequest;
use Modules\Contact\Http\Requests\UpdateContactRequest;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ContactController extends AdminBaseController
{
    /**
     * @var ContactRepository
     */
    private $contact;

    public function __construct(ContactRepository $contact)
    {
        parent::__construct();

        $this->contact = $contact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $contacts = $this->contact->all();

        return view('contact::admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('contact::admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateContactRequest $request
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        $this->contact->create($request->all());

        Flash::success(trans('contact::contacts.messages.contact created'));

        return redirect()->route('admin.contact.contact.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function edit(Contact $contact)
    {
        return view('contact::admin.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Contact $contact
     * @param  UpdateContactRequest $request
     * @return Response
     */
    public function update(Contact $contact, UpdateContactRequest $request)
    {
        $this->contact->update($contact, $request->all());

        Flash::success(trans('contact::contacts.messages.contact updated'));

        return redirect()->route('admin.contact.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function destroy(Contact $contact)
    {
        $this->contact->destroy($contact);

        Flash::success(trans('contact::contacts.messages.contact deleted'));

        return redirect()->route('admin.contact.contact.index');
    }
}
