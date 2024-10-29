<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Exception;

class paper_stars extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'paper_stars';
    protected $fillable = [
        'student_id',
        'journal_name',
        'paper_title',
        'ranking_total',
        'publication_time',
        'materials',
        'created_at',
        'updated_at',
        'rejection_reason'
    ];

    public $timestamps = false;
    protected $primaryKey = 'student_id';
    protected $guarded = [];

    public function getJWTIdentifier()
    {
        //getKey() 方法用于获取模型的主键值
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['role => paper_stars'];
    }

    public function student(){
        return $this->belongsTo(students::class,'student_id','id');
    }

    public static function revise_status($student_id, $data)
    {
        try {
            // 使用 update() 方法来更新记录
            $affectedRows = paper_stars::where('student_id', $student_id)
                ->where('journal_name', $data['name'])
                ->update([
                    'status' => $data['status'],
                    'rejection_reason' => isset($data['reason']) ? $data['reason'] : null,
                ]);

            // 返回受影响的行数
            return $affectedRows;
        } catch (Exception $e) {
            return 'error: ' . $e->getMessage();
        }
    }

    public static function create($data)
    {
        try {
            $data = paper_stars::insert([
                'student_id'=>$data['student_id'],
                'journal_name' => $data['journal_name'],
                'paper_title' => $data['paper_title'],
                'publication_time' => $data['publication_time'],
                'materials' => $data['materials'],
                'ranking_total'=>$data['ranking_total'],
            ]);
            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    public static function revise($student_id, $data)
    {
        try {
            // 使用 update() 方法来更新记录
            $affectedRows = paper_stars::where('student_id', $student_id)
                ->where('journal_name',$data['old_journal_name'])
                ->update([
                    'journal_name' => $data['journal_name'],
                    'paper_title' => $data['paper_title'],
                    'publication_time' => $data['publication_time'],
                    'materials' => $data['materials'],
                    'ranking_total'=>$data['ranking_total'],
                ]);
            // 返回受影响的行数
            return $affectedRows;
        } catch (Exception $e) {
            return 'error: ' . $e->getMessage();
        }
    }

    public static function FindDate($id) // 学生查询
    {
        try {
            $data = paper_stars::where('student_id', $id)
                ->get([
                    'journal_name',
                    'paper_title',
                    'publication_time',
                    'materials',
                    'status',
                    'rejection_reason'
                ]);

            return $data->isEmpty() ? null : $data; // 如果没有数据，返回 null
        } catch (Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
    public static function shanchu($user)
    {
        try {
            $dd = paper_stars::where('student_id', $user)
                ->delete();
            return $dd;
        } catch (Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
    public static function shuliang($user)
    {
        try {
            $dd = paper_stars::where('student_id', $user)
                ->count();
            return $dd;
        } catch (Exception $e) {
            return 'error ' . $e->getMessage();
        }
    }
}



