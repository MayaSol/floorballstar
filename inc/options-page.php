<?php

/* Add custom options pages */

add_action('admin_menu', 'floorball_add_options_page');

function floorball_add_options_page() {

  add_submenu_page('options-general.php','Options', 'Options Menu', 'manage_options', 'options_fields', 'floorball_options_page');

  add_action( 'admin_init', 'floorball_setup_fields' );

};

function floorball_options_page() {?>
        <div class="wrap">
        <h2>Дополнительные настройки</h2>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'options_fields' );
                do_settings_sections( 'options_fields' );
                submit_button();
            ?>
        </form>
    </div> <?php
}

/*
* Add sections for options page
*/

add_action( 'admin_init', 'floorball_setup_sections');

function floorball_setup_sections() {
    add_settings_section( 'contacts_section', 'Контакты', 'floorball_section_callback', 'options_fields' );
}

function floorball_section_callback( $arguments ) {
    switch( $arguments['id'] ){
        case 'contacts_section':
            break;
    }
}

function floorball_setup_fields() {

  /*Fields descriptions*/
  $fields = array(
      array(
          'uid' => 'phone_01_title',
          'label' => 'Подпись номера телефона 1',
          'section' => 'contacts_section',
          'type' => 'text',
          'options' => false,
          'placeholder' => '',
          'helper' => '',
          'supplemental' => '',
          'default' => ''
      ),
      array(
          'uid' => 'phone_01_number',
          'label' => 'Номер телефона 1',
          'section' => 'contacts_section',
          'type' => 'text',
          'options' => false,
          'placeholder' => '(012) 345-67-89',
          'helper' => '',
          'supplemental' => '',
          'default' => ''
      ),
      array(
          'uid' => 'phone_02_title',
          'label' => 'Подпись номера телефона 2',
          'section' => 'contacts_section',
          'type' => 'text',
          'options' => false,
          'placeholder' => '',
          'helper' => '',
          'supplemental' => '',
          'default' => ''
      ),
      array(
          'uid' => 'phone_02_number',
          'label' => 'Номер телефона 2',
          'section' => 'contacts_section',
          'type' => 'text',
          'options' => false,
          'placeholder' => '(012) 345-67-89',
          'helper' => '',
          'supplemental' => '',
          'default' => ''
      ),
      array(
          'uid' => 'address',
          'label' => 'Адрес',
          'section' => 'contacts_section',
          'type' => 'text',
          'options' => false,
          'placeholder' => '',
          'helper' => '',
          'supplemental' => '',
          'default' => ''
      ),
      array(
          'uid' => 'email',
          'label' => 'E-mail',
          'section' => 'contacts_section',
          'type' => 'text',
          'options' => false,
          'placeholder' => '',
          'helper' => '',
          'supplemental' => '',
          'default' => ''
      )
  );

  foreach ($fields as $field) {
    register_setting( 'options_fields', $field['uid']);
    add_settings_field( $field['uid'], $field['label'], 'field_callback', 'options_fields', $field['section'], $field );
  }
}

/* Add fields for sections for options page */

function field_callback( $arguments ) {

  $value = get_option( $arguments['uid'] );

  if( ! $value ) {
      $value = $arguments['default'];
  }

  switch ($arguments['type']) {
    case 'text':
    case 'password':
    case 'number':
      printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
      break;
  }
}
