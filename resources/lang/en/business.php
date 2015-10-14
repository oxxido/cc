<?php

return [
    'fields' => [
        'notifications' => [
            'send_to_owner'     => 'Account Owner',
            'send_to_admin'     => 'Business Manager',
            'alert_positive'    => 'Positive feedback',
            'alert_negative'    => 'Negative feedback',
            'alert_both'        => 'Both Positive and Negative',
            'alert_none'        => 'Neither',
            'send_alerts'       => 'Send new online review alerts',
            'send_reports'      => 'Send performance report',
            'frequency'         => 'Performance reports frequency',
            'frequency_hourly'  => 'Hourly',
            'frequency_daily'   => 'Daily',
            'frequency_weekly'  => 'Weekly',
            'frequency_monthly' => 'Monthly'
        ]
    ],
    'config' => [
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
        ],
        'email'        => [
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
    ],
    'feedback_link' => '<table class="row callout">
                          <tbody><tr>
                            <td class="wrapper last">
                              <table class="twelve columns">
                                <tbody><tr>
                                  <td class="panel">
                                    <p class="link"><a target="_blank" href=":feedback_url">Click here and write a review!</a></p>
                                  </td>
                                  <td class="expander"></td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                        </tbody></table>'
];
