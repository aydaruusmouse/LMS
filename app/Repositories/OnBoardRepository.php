<?php

namespace App\Repositories;

use App\Models\OnBoard;
use App\Traits\ImageTrait;

class OnBoardRepository
{
    use ImageTrait;

    public function all()
    {
        return OnBoard::orderBydesc('id')->paginate(setting('paginate'));
    }

    public function get($id)
    {
        return OnBoard::findOrfail($id);
    }

    public function store($request)
    {
        if (isset($request['is_skipable']) == 'on') {
            $request['is_skipable'] = 1;
        } else {
            $request['is_skipable'] = 0;
        }
        if (arrayCheck('image', $request)) {
            $request['onboard_media_id'] = $request['image'];
            $request['image']            = $this->getImageWithRecommendedSize($request['image'], '305', '150');
        }

        return OnBoard::create($request);
    }

    public function update($request, $id)
    {
        if (isset($request['is_skipable']) == 'on') {
            $request['is_skipable'] = 1;
        } else {
            $request['is_skipable'] = 0;
        }
        if (arrayCheck('image', $request)) {
            $request['onboard_media_id'] = $request['image'];
            $request['image']            = $this->getImageWithRecommendedSize($request['image'], '305', '150');
        }

        return OnBoard::find($id)->update($request);
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return OnBoard::find($id)->update($request);
    }

    public function destroy($id): int
    {
        return OnBoard::destroy($id);
    }

    public function activeBoards($data)
    {
        return OnBoard::active()->when(arrayCheck('lang', $data), function ($query) {
            /*  $query->join('on_board_languages','on_boards.id','on_board_languages.on_board_id')
                ->selectRaw('on_boards.*,on_board_languages.title as board_title,on_board_languages.description as board_description');*/
        })->get();
    }
}
