<?php

namespace App\Domain\Product\Actions;

use Illuminate\Http\Request;

class SaveFiltersInSessionAction
{
    public static function execute(Request $request)
    {
//        dd($request->all());
        $filters = $request->get('filter');
        $sorts = $request->get('sort');

        session(['filter' => $filters, 'sort' => $sorts]);
    }
}
