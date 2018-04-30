<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Field data must be accepted.',
    'active_url'           => 'Field data is not a valid URL.',
    'after'                => 'Field data must be a date after :date.',
    'after_or_equal'       => 'Field data must be a date after or equal to :date.',
    'alpha'                => 'Field data may only contain letters.',
    'alpha_dash'           => 'Field data may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'Field data may only contain letters and numbers.',
    'array'                => 'Field data must be an array.',
    'before'               => 'Field data must be a date before :date.',
    'before_or_equal'      => 'Field data must be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'Field data must be between :min and :max.',
        'file'    => 'Field data must be between :min and :max kilobytes.',
        'string'  => 'Field data must be between :min and :max characters.',
        'array'   => 'Field data must have between :min and :max items.',
    ],
    'boolean'              => 'Field must be true or false.',
    'confirmed'            => 'Field data confirmation does not match.',
    'date'                 => 'Field data is not a valid date.',
    'date_format'          => 'Field data does not match the format :format.',
    'different'            => 'Field data and :other must be different.',
    'digits'               => 'Field data must be :digits digits.',
    'digits_between'       => 'Field data must be between :min and :max digits.',
    'dimensions'           => 'Field data has invalid image dimensions.',
    'distinct'             => 'Field data has a duplicate value.',
    'email'                => 'Field data must be a valid email address.',
    'exists'               => 'selected data is invalid.',
    'file'                 => 'Field data must be a file.',
    'filled'               => 'Field data must have a value.',
    'image'                => 'Field data must be an image.',
    'in'                   => 'selected data is invalid.',
    'in_array'             => 'Field data does not exist in :other.',
    'integer'              => 'Field data must be an integer.',
    'ip'                   => 'Field data must be a valid IP address.',
    'ipv4'                 => 'Field data must be a valid IPv4 address.',
    'ipv6'                 => 'Field data must be a valid IPv6 address.',
    'json'                 => 'Field data must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Field data may not be greater than :max.',
        'file'    => 'Field data may not be greater than :max kilobytes.',
        'string'  => 'Field data may not be greater than :max characters.',
        'array'   => 'Field data may not have more than :max items.',
    ],
    'mimes'                => 'Field data must be a file of type: :values.',
    'mimetypes'            => 'Field data must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Field data must be at least :min.',
        'file'    => 'Field data must be at least :min kilobytes.',
        'string'  => 'Field data must be at least :min characters.',
        'array'   => 'Field data must have at least :min items.',
    ],
    'not_in'               => 'selected :attribute is invalid.',
    'numeric'              => 'Field data must be a number.',
    'present'              => 'Field data must be present.',
    'regex'                => 'Field data format is invalid.',
    'required'             => 'Field data is required.',
    'required_if'          => 'Field data is required when :other is :value.',
    'required_unless'      => 'Field data is required unless :other is in :values.',
    'required_with'        => 'Field data is required when :values is present.',
    'required_with_all'    => 'Field data is required when :values is present.',
    'required_without'     => 'Field data is required when :values is not present.',
    'required_without_all' => 'Field data is required when none of :values are present.',
    'same'                 => 'Field data and :other must match.',
    'size'                 => [
        'numeric' => 'Field data must be :size.',
        'file'    => 'Field data must be :size kilobytes.',
        'string'  => 'Field data must be :size characters.',
        'array'   => 'Field data must contain :size items.',
    ],
    'string'               => 'Field data must be a string.',
    'timezone'             => 'Field data must be a valid zone.',
    'unique'               => 'Field data has already been taken.',
    'uploaded'             => 'Field data failed to upload.',
    'url'                  => 'Field data format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
