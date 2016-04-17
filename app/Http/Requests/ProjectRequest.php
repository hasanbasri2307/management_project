<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case 'POST':
                return [
                    //
                    'p_name' => 'required',
                    'p_address' => 'required',
                    'client_id' => 'required',
                    'start_date' => 'required',
                    'pm_id' => 'required',
                    'status_project' => 'required'
                ];

                break;

            case 'PUT':
                return [
                    //
                    'p_name' => 'required',
                    'p_address' => 'required',
                    'client_id' => 'required',
                    'start_date' => 'required',
                    'pm_id' => 'required',
                    'status_project' => 'required'
                ];

                break;

            case 'PATCH':
                return [
                    //
                    'estimate_end_date' => 'required',
                    'end_date' => 'required',
                    'start_date' => 'required',
                    'status_project' => 'required'
                ];

                break;
        }
    }
}
