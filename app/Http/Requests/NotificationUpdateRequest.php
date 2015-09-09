<?php namespace App\Http\Requests;

use App\Models\Business;

class NotificationUpdateRequest extends Request
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
        $frequencies = implode(',', Business::configNotificationsFrequencies(true));

        return [
            'frequency' => "in:{$frequencies}",
        ];
    }

    public function attributes()
    {
        return [
            'send_to_owner'     => trans('business.fields.notifications.send_to_owner'),
            'send_to_admin'     => trans('business.fields.notifications.send_to_admin'),
            'alert_positive'    => trans('business.fields.notifications.alert_positive'),
            'alert_negative'    => trans('business.fields.notifications.alert_negative'),
            'alert_both'        => trans('business.fields.notifications.alert_both'),
            'alert_none'        => trans('business.fields.notifications.alert_none'),
            'send_alerts'       => trans('business.fields.notifications.send_alerts'),
            'send_reports'      => trans('business.fields.notifications.send_reports'),
            'frequency'         => trans('business.fields.notifications.frequency'),
        ];
    }
}
