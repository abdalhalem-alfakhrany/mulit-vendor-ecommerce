<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'in:done,rejected,accepted,pended'
        ];
    }
}
// Illuminate\Database\QueryException: SQLSTATE[23000]: Integrity constraint violation: 19 CHECK constraint failed: status (Connection: sqlite, SQL: update "orders" set "status" = accept, "updated_at" = 2023-07-13 19:34:40 where "id" = 1) in file /home/abdalhalem/DEV/mulit_vendor_e_commerce/vendor/laravel/framework/src/Illuminate/Database/Connection.php on line 795
