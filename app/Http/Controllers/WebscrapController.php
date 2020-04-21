<?php

namespace App\Http\Controllers;

use App\webscrap;
use Illuminate\Http\Request;
use Goutte\Client;


class WebscrapController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
        $this->middleware('verified');
    }
    private $list_limit=10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $approve_save_datas =   webscrap::where("approve_save",true)->paginate($this->list_limit);
        return \view("webscrap.index",[  "page_title" => "webscrapper","datas"=>$approve_save_datas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return \view("webscrap.create",[  "page_title" => "webscrapper create"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $req_json= $request->all();
        $valid_data=$request->validate([
            "url"=>"url|required",
            "docquery"=>"min:1|max:255|required"
        ]);
        $client = new Client();


        $craw_data=[];
        $crawler = $client->request('GET', $valid_data["url"]);
        $craw_data=$crawler->filter($valid_data["docquery"])
        ->each(function ($node) use ($craw_data) {
          //  print $node->text()."\n";
            return $node->text() ;
        });
        $save_datas=[];
        foreach($craw_data as $cd){
            $tempsave=[
                "url"=>$valid_data["url"],
                "docquery"=>$valid_data["docquery"],
                "data"=>$cd,
                "approve_save"=>false,
            ];
            array_push($save_datas,$tempsave);
        }
        $issave=webscrap::insert($save_datas);
        if($issave) return \redirect("/webscrap/review");
        return abort(404);
    }

    public function review(){
        
        $approve_save_datas =   webscrap::where("approve_save",false)->paginate($this->list_limit);
        return view("webscrap.review",[ "page_title"=>"Review","reviews"=>$approve_save_datas]);
    }

    public function approve_review(Request $request){
        $valid_data = $request->validate([
            "id"=>"required|exists:webscraps,id"
        ]);
        $id = $valid_data["id"];
        $approve_save_data =   webscrap::where("id",$id)->first();
        $approve_save_data->approve_save=true;
        $issave = $approve_save_data->save();
        if( $issave ) return \redirect("/webscrap/review")->with(["message"=>" review approve"]);
        return abort(404);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\webscrap  $webscrap
     * @return \Illuminate\Http\Response
     */
    public function show(webscrap $webscrap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\webscrap  $webscrap
     * @return \Illuminate\Http\Response
     */
    public function edit(webscrap $webscrap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\webscrap  $webscrap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, webscrap $webscrap)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\webscrap  $webscrap
     * @return \Illuminate\Http\Response
     */
    public function destroy(webscrap $webscrap)
    {
        //
       // dump(\request()->path());return ;
        $isdelete = $webscrap->delete();
        if($isdelete)
            return \redirect("/webscrap")->with("message","message was deleted");
        else
            return \redirect("/webscrap")->with("messagefail","message was delete fail");
    }

    public function destroy_review(webscrap $webscrap)
    {
        //
        //dump(  $webscrap->data );return ;
        $isdelete = $webscrap->delete();
        if($isdelete)
            return \redirect("/webscrap/review")->with("message","message was deleted");
        else
            return \redirect("/webscrap/review")->with("messagefail","message was delete fail");
    }

    public function delete_all_review(){
        $isdelete = webscrap::where("approve_save",false)->delete();
        if($isdelete)
        return \redirect("/webscrap/review")->with("message"," all message was deleted");
    else
        return \redirect("/webscrap/review")->with("messagefail"," all message was delete fail");
    }
}
