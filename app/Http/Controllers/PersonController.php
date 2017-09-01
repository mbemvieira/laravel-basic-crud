<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Person;
use App\Email;
use App\Telephone;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view_person')) {
            abort(403);
        }

        $user = auth()->user();
        $people = Person::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('person.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'cpf' => 'required|digits_between:4,11|unique:people',
            'course' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
        ]);

        $person = new Person;

        $person->user_id = Auth::id();
        $person->name = $request->has('name') ? $request->input('name') : '';
        $person->cpf = $request->has('cpf') ? $request->input('cpf') : '00000000000';
        $person->course = $request->has('course') ? $request->input('course') : '';
        $person->institution = $request->has('institution') ? $request->input('institution') : '';

        $person->save();

        for ($i = 0; $i < count($request->input('emails')); $i++) {
            $email = new Email;

            $email->email = $request->has('emails.'. $i .'.email') ?
                $request->input('emails.'. $i .'.email') : '';
            $email->person()->associate($person);
            $email->save();
        }

        for ($i = 0; $i < count($request->input('phones')); $i++) {
            $telephone = new Telephone;

            $telephone->phone = $request->has('phones.'. $i .'.phone') ?
                $request->input('phones.'. $i .'.phone') : '';

            $telephone->person()->associate($person);
            $telephone->save();
        }

        $request->session()->flash('alert-success', 'Pessoa adicionada com sucesso!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        if (Gate::denies('update_person')) {
            abort(403);
        }

        // $this->authorize('view', $person);

        return view('person.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'cpf' => 'required|digits_between:4,11|unique:people,cpf,'. $person->cpf .',cpf',
            'course' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
        ]);

        $person->name = $request->has('name') ? $request->input('name') : '';
        $person->cpf = $request->has('cpf') ? $request->input('cpf') : '00000000000';
        $person->course = $request->has('course') ? $request->input('course') : '';
        $person->institution = $request->has('institution') ? $request->input('institution') : '';

        $person->save();

        for ($i = 0; $i < count($request->input('emails')); $i++) {
            $person->emails()->delete();
            $email = new Email;

            $email->email = $request->has('emails.'. $i .'.email') ?
                $request->input('emails.'. $i .'.email') : '';

            $email->person()->associate($person);
            $email->save();
        }

        for ($i = 0; $i < count($request->input('phones')); $i++) {
            $person->phones()->delete();
            $telephone = new Telephone;

            $telephone->phone = $request->has('phones.'. $i .'.phone') ?
                $request->input('phones.'. $i .'.phone') : '';

            $telephone->person()->associate($person);
            $telephone->save();
        }

        $request->session()->flash('alert-success', 'Pessoa editada com sucesso!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->emails()->delete();
        $person->phones()->delete();
        $person->delete();
        return back();
    }
}
