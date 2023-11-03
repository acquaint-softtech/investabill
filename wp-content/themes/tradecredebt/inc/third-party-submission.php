<?php


add_action( 'gform_after_submission', 'post_to_third_party', 10, 2 );


function post_to_third_party( $entry, $form ) {
    
    $select_form = get_field('select_form', 'option');
    $select_form = $select_form ['value'];
	
    if($entry['form_id'] == $select_form):

    $endpoint_url = ENDPOINT_URL;
    $finance_value = '';
    $turn_over = '';
    $no_of_emp = '';

    // switch ($entry[33]) {
    //     case "Less than EUR 1m":
    //         $finance_value = '999999.00';
    //         break;
    //     case "EUR 1m – 5m":
    //         $finance_value = '5000000.00';
    //         break;
    //     case "EUR 5m – 10m":
    //         $finance_value = '9999999.00';
    //         break;
    //     case "EUR 10m+":
    //         $finance_value = '10000000.00';
    //         break;
    // }
    switch ($entry[46]) {
        case "10k":
            $finance_value = '10000.00';
            break;
        case "50k":
            $finance_value = '50000.00';
            break;
        case "100k":
            $finance_value = '100000.00';
            break;
        case "500K+":
            $finance_value = '500000.00';
            break;
    }

    switch ($entry[34]) {
        case "Less than EUR 0.5m":
            $turn_over = '500000.00';
            break;
        case "EUR 0.5m – 2.5m":
            $turn_over = '2500000.00';
            break;
        case "EUR 2.5m – 5.0m":
            $turn_over = '5000000.00';
            break;
        case "EUR 5.0m +":
            $turn_over = '6000000.00';
            break;
    }

    $txt = $entry[35];
    $txt1 = explode(" - ",$txt);
    $no_of_emp = preg_replace('/\D/', '', end($txt1));
	
    $lead_source_details = isset($entry[52]) ? $entry[52] : "";
    $sold_type = "Investor";
    
    $body = [
        "company" => $entry[30],
        "website" => $entry[31],
        "sold_type" => $sold_type,
        "lead_source_details" => $lead_source_details, 
        "lead_source" => LEAD_SOURCE_DETAIL,
        //"product_name" => $entry[32],
        "product_name" => '',
        "email"=> $entry[28],
        "phone" => $entry[29],
        "finance_value" => $finance_value,
        "first_name" => $entry[44],
        "last_name" => $entry[27],
        "turn_over" => $turn_over,
        "no_of_emp" => $no_of_emp,
        "registered_country_id" => $entry[55],

    ];
 
    
    $body = wp_json_encode( $body );


    $options = [
        'body'        => $body,
        'headers'     => [
            'Content-Type' => 'application/json',
            'API-KEY' => API_KEY,
            'API-SECRET' => API_SECRET,
        ],
    ];
    
    
	
    GFCommon::log_debug( 'gform_after_submission: body => ' . print_r( $body, true ) );
    $response = wp_remote_post( $endpoint_url, $options );
	GFCommon::log_debug( 'gform_after_submission: response => ' . print_r( $response, true ) );
    
    if ( is_wp_error( $response ) ) {
        gform_update_meta( $entry['id'], 53 , 'Not Synced' );
    } else {
        $responceData = json_decode(wp_remote_retrieve_body($response), true);
        $lead_id = $responceData['lead']['id'];
        if(!empty($lead_id)):
        gform_update_meta( $entry['id'], 53 , $lead_id );
        else:
        gform_update_meta( $entry['id'], 53 , 'Not Synced' );
        endif;
    }
    endif;

}