<?php

/** 
 * @package Kontactusplugin
 */
/*
Plugin Name: Kontact Us Plugin
Description: Kontact us plugin is a way to create a contact us form where users can send emails to you
Version:1.0.0
Author: Ayoub Mabrouk
Plugin URI: https://github.com/Ayoub-Mabrouk
Author URI: https://github.com/Ayoub-Mabrouk
License: GPLv2 or later
Text Domain: Kontact-us-plugin
*/

/*
 <one line to give the program's name and a brief idea of what it does.>
    Copyright (C) <year>  <name of author>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
if (!defined('ABSPATH')) {
    die;
}

function mycontact()
{

    global $wpdb;
    $form = $wpdb->get_row("SELECT * FROM wp_kontact_us_plug_fields WHERE id = 1;");

    $div = '<h3>Contact us</h3>';
    $div .='<form method="POST" action="">';
    if($form->fname){
        $div .= '<label>First Name:</label>';
        $div .= '<input type="text" name="firstname" placeholder="First name"><br>';
    }
    if($form->lname){
        $div .= '<label>Lirst Name:</label>';
        $div .= '<input type="text" name="lastname" placeholder="Last name"><br>';
    }
    if($form->email){
        $div .= '<label>Email:</label>';
        $div .= '<input type="text" name="email" placeholder="Email"><br>';
    }
    if($form->subject){
        $div .= '<label>Subject:</label>';
        $div .= '<input type="text" name="message_subject" placeholder="Subject"><br>';
    }
    if($form->message){
        $div .= '<label>Message:</label>';
        $div .= '<input type="text" name="message_content" placeholder="Message"><br>';
    }
    $div .= '<input type="submit" name="submit-form"><br>';
    $div .='</form>';
    return $div;
}
function activate()
{
}
function deactivate()
{
}
function unistall()
{
}
function create_values_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $tablename = 'kontact_us_plug';
    $sql = "CREATE TABLE $wpdb->base_prefix$tablename (
        id int AUTO_INCREMENT,
        firstname varchar(255) ,
        lastname varchar(255) ,
        email varchar(255) ,
        message_subject varchar(255),
        message_content varchar(255),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY key(id)
        ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    // dbDelta($sql);
    maybe_create_table($wpdb->base_prefix . $tablename, $sql);
}
function create_true_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $tablename = 'kontact_us_plug_fields';
    $sql = "CREATE TABLE $wpdb->base_prefix$tablename (
        id INT,
        fname BOOLEAN,
        lname BOOLEAN,
        email BOOLEAN,
        subject BOOLEAN,
        message BOOLEAN
        ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    maybe_create_table($wpdb->base_prefix . $tablename, $sql);
    $wpdb->insert(
        $wpdb->base_prefix . $tablename,
        array(
            'id'=>'1',
            'fname' => true,
            'lname' => true,
            'email' => true,
            'subject' => true,
            'message' => true
        )
    );
}
if (isset($_POST['submit-true'])) {
    update_true_table();
}
if (isset($_POST['submit-form'])) {
    insert_to_kontact();
}
function update_true_table(){
    $fname = filter_var($_POST['fname'], FILTER_VALIDATE_BOOLEAN);
    $lname = filter_var($_POST['lname'], FILTER_VALIDATE_BOOLEAN);
    $email =  filter_var($_POST['email'], FILTER_VALIDATE_BOOLEAN);
    $subject =  filter_var($_POST['subject'], FILTER_VALIDATE_BOOLEAN);
    $message =  filter_var($_POST['message'], FILTER_VALIDATE_BOOLEAN);

    global $wpdb;
    $wpdb->update(
        'wp_kontact_us_plug_fields',
        [
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ],
        ['id' => 1]
    );
}
function insert_to_kontact(){
    unset($_POST['submit-form']);
    global $wpdb;
    $wpdb->insert('wp_kontact_us_plug',$_POST);
}

function my_admin_menu()
{
    // add_management_page('Description', 'Description', 'manage_options',__FILE__,'kontact_admin_menu_main');
    add_menu_page('Kontact', 'Kontact', 'manage_options', 'Kontact_menu', 'kontact_admin_menu_main', 'dashicons-embed-generic', '110');
    add_submenu_page('Kontact_menu', 'Kontact Settings', 'Settings', 'manage_options', 'kontact_admin_menu_Settings', 'Kontact_settings_page');
}
function kontact_admin_menu_main()
{
    echo '<div class="wrap">
    <h1>Hello!</h1>
    <p>Kontact can manage contact form, plus you can customize the form inputs with simple markup.
    The form supports Database insertion, all submitted data will be inserted into a specific table created by kontact in your database.
    </p>
    <span>use this shortcode to integrate the form to your wordpress</span><h3>[kontactplug]</h3>
    <p><strong>Contributors & Developers</strong></p>
    <p>“Kontact” is open source software.</p>
    </div>';
}
function Kontact_settings_page()
{
    settings_header();
    echo show_inputs();
}
function checkdata()
{

    return "heeeeeeeeeeeeeeeeeeeeeeeey";
}

function settings_header()
{
    echo '<div class="wrap">
    <h1>Settings!</h1>
    <p>Set all your preferences here
    </p>
    </div>';
}
function show_inputs()
{
    global $wpdb;

    $form = $wpdb->get_row("SELECT * FROM wp_kontact_us_plug_fields WHERE id = 1;");

    $div = '<h3>Contact us</h3>';
    $div .= '<form method="post" action="">';
    $div .= '<label>First Name:</label>';
    if($form->fname){
        $div .= '<div><input type="radio" value="true" name="fname" checked required><span>YES</span><input type="radio" value="false" name="fname"><span>NO</span></div><br>';
    }
    else{
        $div .= '<div><input type="radio" value="true" name="fname"  required><span>YES</span><input type="radio" value="false" checked name="fname"><span>NO</span></div><br>';
    }
    if($form->lname){
        $div .= '<div><input type="radio" value="true" name="lname" checked required><span>YES</span><input type="radio" value="false" name="lname"><span>NO</span></div><br>';
    }
    else{
        $div .= '<div><input type="radio" value="true" name="lname"  required><span>YES</span><input type="radio" value="false" checked name="lname"><span>NO</span></div><br>';
    }
    if($form->email){
        $div .= '<div><input type="radio" value="true" name="email" checked required><span>YES</span><input type="radio" value="false" name="email"><span>NO</span></div><br>';
    }
    else{
        $div .= '<div><input type="radio" value="true" name="email"  required><span>YES</span><input type="radio" value="false" checked name="email"><span>NO</span></div><br>';
    }
    if($form->subject){
        $div .= '<div><input type="radio" value="true" name="subject" checked required><span>YES</span><input type="radio" value="false" name="subject"><span>NO</span></div><br>';
    }
    else{
        $div .= '<div><input type="radio" value="true" name="subject"  required><span>YES</span><input type="radio" value="false" checked name="subject"><span>NO</span></div><br>';
    }
    if($form->message){
        $div .= '<div><input type="radio" value="true" name="message" checked required><span>YES</span><input type="radio" value="false" name="message"><span>NO</span></div><br>';
    }
    else{
        $div .= '<div><input type="radio" value="true" name="message"  required><span>YES</span><input type="radio" value="false" checked name="message"><span>NO</span></div><br>';
    }
    
    
   
    $div .= '<input type="submit"  name="submit-true"><br>';
    $div .= '</form>';
    return $div;
}

//shortcode
add_shortcode('kontactplug', 'mycontact');
add_action('admin_menu', 'my_admin_menu');

// activation hook
register_activation_hook(__FILE__, 'create_true_table');
register_activation_hook(__FILE__, 'create_values_table');

//deactivation hook
register_deactivation_hook(__FILE__, 'deactivate');
