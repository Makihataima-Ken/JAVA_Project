<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'university',
        'major',
        'type',
        'description',
        'deadline',
        'status',
        'file_path',
    ];

    /**
     * create an overview of order
     * @param $orders
     * @return JsonResponse
     */
    public function createOrderOverview():array
    {

        $orders_overview[]=[

            'id'=>$this->id,
            'type'=>$this->type,
            'status'=>$this->status,
            'creation_date'=>$this->created_at,
        ];
        
        return $orders_overview;
    }
}
