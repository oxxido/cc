<?php namespace App\Services;

use App\Models\Admin;
use App\Models\Business;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Event;
use App\Events\UserEmailEvent;

class BusinessService
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validator(array $data)
    {
        return Validator::make($data, [
            'name'                 => 'required',
            'url'                  => 'required|url',
            'organization_type_id' => 'required',
            'business_type_id'     => 'required',
            'admin_id'             => 'required_if:new_admin,0',
            'admin_first_name'     => 'required_if:new_admin,1',
            'admin_last_name'      => 'required_if:new_admin,1',
            'admin_email'          => 'required_if:new_admin,1|email',
            'country_code'         => 'required',
            'city_id'              => 'required_if:new_city,0',
            'city_name'            => 'required_if:new_city,1',
            'state_name'           => 'required_if:new_city,1',
            'zip_code'             => 'required_if:new_city,1',
            'city_name'            => 'required_if:new_city,1',
            'address'              => 'required'
        ]);
    }

    public static function getCity(array $data)
    {
        $cities = LocationService::find($data);
        if($cities->count())
        {
            return $cities->first();
        } else {
            return LocationService::create($data);
        }
    }

    /**
     * Update user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return Business
     */
    public static function update($id, array $data)
    {
        $business = Business::find($id);
        foreach ($data as $key => $value) {
            $business->$key = $value;
        }
        $business->save();

        return $business;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return Business
     */
    public static function create(array $data)
    {
        $business         = Business::create($data);
        $business->config = self::defaultConfig("default", $business);
        $business->save();
        $product              = new Product();
        $product->business_id = $business->id;
        $product->save();
        return $business;
    }

    public static function defaultConfig($type, $business, $request = false)
    {
        $default = [
            'feedback'     => [
                'include_social_links' => true,
                'include_phone'        => false,
                'positive_threshold'   => 3,
                'page_title'           => '',
                'logo_url'             => asset('images/logo-example.png'),
                'logo_gallery'         => [],
                'banner_url'           => asset('images/landscape.jpg'),
                'banner_gallery'       => [],
                'stars_style'          => 'default',
                'positive_text'        => 'Thanks you for your feedback. It is very important to us to hear your feedback and it allow us to serve you better.

[REVIEW_LINKS]

Have a great day!

[OWNER_NAME]',
                'negative_text'        => 'Thanks you for your feedback

Whenever we see feedback that is not outstanding, we like to follow up to see what we could have done better.

We will contact you to address the situation in any way we can.
                ',
            ],
            'testimonial'  => [
                'include_feedback' => true,
                'include_likes'    => true
            ],
            'notification' => [
                'send_to_owner'  => true,
                'send_to_admin'  => true,
                'alert_positive' => true,
                'alert_negative' => true,
                'send_alerts'    => true,
                'send_reports'   => true,
                'frequency'      => Business::CONFIG_NOTIFICATIONS_FREQUENCY_DAILY
            ],
            'email'        => [
                'feedback_request_from'     => $business->owner->email,
                'feedback_request_subject'  => 'Thank you for visiting us. Would you leave us your feedback?',
                'feedback_request_body'     => 'Dear [CUSTOMER_FIRST_NAME],
Thank you for visiting us at [BUSINESS_NAME]. We appreciate your business and value you as a customer. To help us continue our high quality of service, we invite you to leave us your feedback.

[FEEDBACK_URL]

We look forward to seeing you again soon.

Sincerely,

[OWNER_NAME]
[BUSINESS_NAME]
[BUSINESS_URL]',
                'positive_feedback_subject' => 'Thank you for your feedback.',
                'positive_feedback_body'    => 'Thank you for your feedback - we appreciate having you as a customer and your feedback helps us serve you better.

Online reviews are becoming very important for our business. If you would leave us a review on one of these review sites it would really help us a lot:

[REVIEW_LINKS]

Thanks for your support, and have a great day!

[OWNER_NAME]',
                'negative_feedback_subject' => 'Thank you for your feedback.',
                'negative_feedback_body'    => 'Thank you for your feedback.

Whenever we see feedback that is not outstanding, we like to follow up to see what we could have done better.

We will contact you to address the situation in any way we can.

Once again, thank you for taking the time to let us know how you feel, and I hope we can address this for you.

Sincerely,

[OWNER_NAME]'
            ],
            'kiosk'        => []
        ];

        if ($type == "default") {
            return json_decode(json_encode($default));
        } elseif ($type == "all") {
            $config = new \stdClass;
            foreach ($default as $name => $value) {
                $config->$name = self::defaultConfigByType($name, $business, $request, $default);
            }

            return $config;
        } else {
            return self::defaultConfigByType($type, $business, $request, $default);
        }
    }

    private static function defaultConfigByType($type, Business $business, $request, $default)
    {
        $config = isset($business->config->$type) ? (object) $business->config->$type : new \stdClass();

        foreach ($default[$type] as $name => $value) {
            if ($request && $request->input($name)) {
                $config->$name = $request->input($name);
            } elseif ($request && $request->old($name) && $request->old($name) !== false) {
                $config->$name = $request->old($name);
            } elseif (isset($config->$name) && $config->$name !== "") {
                $config->$name = $config->$name;
            } else {
                if (is_array($config)) {
                    if (empty($config)) {
                        $config = new \stdClass();
                    } else {
                        $config = json_decode(json_encode($config));
                    }
                }
                $config->$name = $value;
            }
        }

        return $config;
    }

    public static function tagsReplace($options = [])
    {
        $parsed = str_replace("\r\n", "<br>", $options['text']);
        $parsed = str_replace("\n", "<br>", $parsed);

        $business  = $options['business'];
        $comment   = isset($options['comment']) ? $options['comment'] : null;
        $commenter = isset($options['commenter']) ? $options['commenter'] : null;
        $commenter = (!$commenter && $comment) ? $comment->commenter : null;

        $tags = [
            "BUSINESS_NAME"       => $business->name,
            "BUSINESS_PHONE"      => $business->phone,
            "BUSINESS_URL"        => $business->url,
            "OWNER_NAME"          => $business->owner->name,
            "YOUR_NAME"           => $business->owner->name,
            "OWNER_FIRST_NAME"    => $business->owner->first_name,
            "OWNER_LAST_NAME"     => $business->owner->last_name,
            "OWNER_EMAIL"         => $business->owner->email,
            "CUSTOMER_NAME"       => $commenter ? $commenter->name : "",
            "CUSTOMER_FIRST_NAME" => $commenter ? $commenter->first_name : "",
            "CUSTOMER_LAST_NAME"  => $commenter ? $commenter->last_name : "",
            "PROVIDE_FEEDBACK"    => $comment ? $comment->rating : "",
            "FEEDBACK_URL"        => $business->feedbackUrl()
        ];

        foreach ($tags as $tag => $value) {
            $parsed = str_replace("[" . $tag . "]", $value, $parsed);
        }

        if (isset($options["section"]) && $options["section"] == "header") {
            $parsed = strpos($parsed, "[REVIEW_LINKS]") ? substr($parsed, 0,
                strpos($parsed, "[REVIEW_LINKS]")) : $parsed;
        } elseif (isset($options["section"]) && $options["section"] == "footer") {
            $parsed = strpos($parsed, "[REVIEW_LINKS]") ? substr($parsed,
                (strpos($parsed, "[REVIEW_LINKS]") + strlen("[REVIEW_LINKS]"))) : "";
        } else {
            $parsed = str_replace("[REVIEW_LINKS]", "", $parsed);
        }

        return $parsed;
    }

    public static function getConfig($type, Request $request)
    {
        $business = new Business();

        $default_config = self::defaultConfig($type, $business);

        $config = new \stdClass();
        foreach ($default_config as $field => $value) {
            $config->$field = $request->input($field, false);
        }

        return $config;
    }
}
