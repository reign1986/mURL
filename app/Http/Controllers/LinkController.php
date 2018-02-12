<?php

namespace App\Http\Controllers;

use App\Http\Requests\Link\CreateRequest;
use App\Http\Requests\Link\UpdateRequest;
use App\Jobs\Link\MinifyUrl;
use App\Link;
use App\Stats;
use DB;
use Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::latest()->paginate(10);

        return view('link.index', compact('links'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $link = new Link();

        return view('link.create', compact('link'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $request->request->add(['murl' => $this->dispatchNow(new MinifyUrl())]);
        Link::create($request->all());

        return redirect()->route('link.index')->with('success', 'Link created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $link = Link::find($id);

        return view('link.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $link = Link::find($id);

        return view('link.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        Link::find($id)->update($request->all());

        return redirect()->route('link.index')
            ->with('success', 'Link updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Link::find($id)->delete();

        return redirect()->route('link.index')
            ->with('success', 'Link deleted successfully');
    }

    /**
     * Redirect to general URL.
     *
     * @param Link $link
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(Link $link)
    {
        $stats = new Stats(['country' => geoip()->getLocation(Request::ip())->country]);
        $link->stats()->save($stats);

        return redirect($link->url);
    }

    /**
     * Show the link stats.
     *
     * @param Link $link
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stats(Link $link)
    {
        $stats = DB::table('stats')
            ->select(DB::raw('count(*) as y, country as name'))
            ->where('link_id', $link->id)
            ->groupBy('country')
            ->get();

        return view('link.stats', compact('stats'));
    }
}
