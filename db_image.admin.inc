<?php

function field_example_module_admin_settings() {
    global $base_path;    
    //Manage REMUS data...
    //SWID
    $swid = variable_get('remus_swid', "{9949510E-70C2-4654-A1CD-8277D2C50245}");    
    $form['remus_swid'] = array(
        '#type' => 'textfield',
        '#title' => t('SWID'),
        '#maxlength' => 40,        
        '#default_value' =>  $swid,
        '#description' => t('Set REMUS upload SWID.'),
    );
    //PROJECT NAME
    $project = variable_get('remus_project', "calendar");    
    $form['remus_project'] = array(
        '#type' => 'textfield',
        '#title' => t('Project'),
        '#maxlength' => 80,
        '#default_value' =>  $project,
        '#description' => t('Set REMUS upload project.'),
    );
    //SHOW REMUS ID INPUT
    $form['remus_show_input'] = array(
        '#type' => 'select',
        '#title' => t('Show REMUS input'),
        '#options' => array(
            0 => t('No'),
            1 => t('Yes'),
        ),
        '#default_value' =>  variable_get('remus_show_input', 0),
        '#description' => t('Set this to <em>Yes</em> if you would like to show REMUS id.'),
    );    

    $form['#submit'][] = 'field_example_module_admin_form_submit';
    return system_settings_form($form);
}

function field_example_module_admin_settings_validate($form, &$form_state) {
    //if (!valid_url($form_state['values']['url'], TRUE))
    //  form_set_error('remus_url', 'URL is not valid');
}

function field_example_module_admin_form_submit($form, $form_state) {
    variable_set('remus_swid', $form_state['values']['remus_swid']);
    variable_set('remus_show_input', $form_state['values']['remus_show_input']);
    variable_set('remus_project', $form_state['values']['remus_project']);
}
