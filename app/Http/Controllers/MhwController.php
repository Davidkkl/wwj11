<?php

namespace App\Http\Controllers;



use   Illuminate\Routing\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\paper_stars;
use Illuminate\Support\Facades\Storage;


class MhwController extends Controller//发表论文
{


    public function Mhwpapershanxun(Request $request)
    {
        $data['student_id'] = $request['student_id'];
        $ss = paper_stars::FindDate($data);

        if (is_error($ss)) {
            return json_fail('查询失败,请输入正确的ID！', null, 100);
        } elseif (empty($ss)) {
            return json_fail('未找到对应的学生ID，请检查输入！', null, 404);
        } else {
            return json_success('查询成功', $ss, 200);
        }
    }

    public function Mhwshanchu(Request $request)
    {
        $data['student_id'] = $request['student_id'];

        // 检查数量
        $quantity = paper_stars::shuliang($data);
        if ($quantity > 0) {
            // 如果有记录，尝试删除
            $deleteResult = paper_stars::shanchu($data);
            if (!is_error($deleteResult)) {
                return json_success('删除成功！', null, 200);
            } else {
                return json_fail('删除失败，请重试！', null, 100);
            }
        } else {
            // 无信息
            return json_fail('删除失败！请输入正确的ID！', null, 100);
        }
    }
}


