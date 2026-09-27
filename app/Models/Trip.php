<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'title',
        'destination',
        'description',
        'start_date',
        'end_date',
        'price',
        'max_capacity',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'price' => 'decimal:2',
            'max_capacity' => 'integer',
        ];
    }
}
