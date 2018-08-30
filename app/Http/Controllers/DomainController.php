<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain;
use Auth;
use Validator;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $domains = Auth::user()->domains;
            if (view()->exists('domain-list')) {
                return view('domain-list', compact('domains'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (view()->exists('domain-add')) {
            return view('domain-add');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get only domain name and add user id in array
        if (Auth::check()) {
            $inputs = $request->except(['_token', 'method']);
            $inputs['user_id'] = Auth::id();
        }
        // Validate
        $validate = Validator::make($inputs, [
            'name' => ['required','min:5','max:255','unique:domains','regex:/.*[a-zA-Z\d-]+\.(com|ru|am)$/']
        ]);
        // If there is an error message after the validation, redirect back
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        // add new domain
        $new_domain = new Domain();
        $new_domain->fill($inputs);
        if ($new_domain->save()) {
            return redirect()->route('domain.index')->with('status', 'The domain was successfully added !!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_domain = Domain::find($id);
        if (view()->exists('domain-edit')) {
            return view('domain-edit', compact('edit_domain'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get only domain name and add user id in array
        $inputs = $request->except(['_token', '_method']);
        // Validate
        $validate = Validator::make($inputs, [
            'name' => ['required','min:5','max:255','unique:domains','regex:/.*[a-zA-Z\d-]+\.(com|ru|am)$/']
        ]);
        // If there is an error message after the validation, redirect back
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        // Update domain name
        $update_domain = Domain::find($id);
        $update_domain->name = $inputs['name'];
        if ($update_domain->update()) {
            return redirect()->route('domain.index')->with('status', 'Domain successfully updated !!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_partner = Domain::findOrFail($id);
        if ($delete_partner->delete()) {
            return redirect()->back()->with('status', 'Domain successfully sent to trash !!!');
        }
    }


    /**
     * Get only soft deleted domains
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOnlyTrashed()
    {
        $domains = Domain::onlyTrashed()->where('user_id', '=', Auth::id())->get();
        if (view()->exists('domain-trash')) {
            return view('domain-trash', compact('domains'));
        }
    }


    /**
     * Restore domain from trash
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreInTrash($id)
    {
        $domain = Domain::withTrashed()->findOrFail($id);
        if ($domain->restore()) {
            return redirect()->back()->with('status', 'Domain successfully restore !!!');
        }
    }


    /**
     * Final delete domain from trash
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteInTrash($id)
    {
        $domain = Domain::withTrashed()->findOrFail($id);
        if ($domain->forceDelete()) {
            return redirect()->back()->with('status', 'Domain successfully final delete !!!');
        }
    }


    /**
     * Dynamic validate update form input
     *
     * @param Request $request
     * @return int
     */
    public function dynamicCheckUpdateForm(Request $request)
    {
        if ($request->ajax()) {
            $domains = Domain::where('name', '=', $request->search)->get();
            return count($domains);
        }
    }
}
