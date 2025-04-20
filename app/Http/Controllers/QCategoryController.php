<?php

namespace App\Http\Controllers;

use App\Models\QCategory;
use App\Http\Requests\StoreQCategoryRequest;
use App\Http\Requests\UpdateQCategoryRequest;
use Illuminate\Http\Request;

class QCategoryController extends Controller
{


    public function iindex($qCategoryId, Request $request)
    {
        $qCategory = QCategory::findOrFail($qCategoryId);

        $paginate = $request->has('paginate') ? $request->paginate : 1;
        $qrcodes =  $qCategory->qrcodes()->paginate($paginate) ;
        
        return view('livewire.qrcode.view_paginate', compact('qrcodes','paginate'));
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(QCategory $qCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QCategory $qCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQCategoryRequest $request, QCategory $qCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QCategory $qCategory)
    {
        //
    }
}
