<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /* Display a listing of the resources
     *
     * @return Response
     */
    public function index()
    {
        return view('todos.index');
    }

    /* Show the form for creating a new resource
     *
     * @return Response
     */
     public function create()
     {
         //
     }

    /* Store a newly created resource in storage
     *
     * @return Response
     */
     public function store()
     {
         //
     }

    /* Display the specific resource.
     *
     * @param init $id
     * @return Response
     */
     public function show($id)
     {
         return view('todos.show')->withId($id);
     }

    /* Show the form for editing the specific resource.
     *
     * @param init $id
     * @return Response
     */
     public function edit($id)
     {
         //
     }

    /* update the specific resource.
     *
     * @param init $id
     * @return Response
     */
     public function update($id)
     {
         //
     }

    /* remove the specific resource from storage.
     *
     * @param init $id
     * @return Response
     */
     public function destroy($id)
     {
         //
     }


}
