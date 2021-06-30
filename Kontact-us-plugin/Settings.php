<?php
echo '<div class="wrap">
<h1>Settings!</h1>
<h3>Chose which fields to show to the users
</h3>
</div>';

global $wpdb;
$form = $wpdb->get_row("SELECT * FROM wp_kontact_us_plug_fields WHERE id = 1;");

$div = '<form method="post" action="">';

if ($form->fname) {
    $div .= '<label>First Name:</label>';
    $div .= '<div><input type="radio" value="true" name="fname" checked required><span>YES</span><input type="radio" value="false" name="fname"><span>NO</span></div><br>';
} else {
    $div .= '<label>First Name:</label>';
    $div .= '<div><input type="radio" value="true" name="fname"  required><span>YES</span><input type="radio" value="false" checked name="fname"><span>NO</span></div><br>';
}
if ($form->lname) {
    $div .= '<label>Last Name:</label>';
    $div .= '<div><input type="radio" value="true" name="lname" checked required><span>YES</span><input type="radio" value="false" name="lname"><span>NO</span></div><br>';
} else {
    $div .= '<label>Last Name:</label>';
    $div .= '<div><input type="radio" value="true" name="lname"  required><span>YES</span><input type="radio" value="false" checked name="lname"><span>NO</span></div><br>';
}
if ($form->email) {
    $div .= '<label>Email:</label>';
    $div .= '<div><input type="radio" value="true" name="email" checked required><span>YES</span><input type="radio" value="false" name="email"><span>NO</span></div><br>';
} else {
    $div .= '<label>Email:</label>';
    $div .= '<div><input type="radio" value="true" name="email"  required><span>YES</span><input type="radio" value="false" checked name="email"><span>NO</span></div><br>';
}
if ($form->subject) {
    $div .= '<label>Subject:</label>';
    $div .= '<div><input type="radio" value="true" name="subject" checked required><span>YES</span><input type="radio" value="false" name="subject"><span>NO</span></div><br>';
} else {
    $div .= '<label>Subject:</label>';
    $div .= '<div><input type="radio" value="true" name="subject"  required><span>YES</span><input type="radio" value="false" checked name="subject"><span>NO</span></div><br>';
}
if ($form->message) {
    $div .= '<label>Message:</label>';
    $div .= '<div><input type="radio" value="true" name="message" checked required><span>YES</span><input type="radio" value="false" name="message"><span>NO</span></div><br>';
} else {
    $div .= '<label>Message:</label>';
    $div .= '<div><input type="radio" value="true" name="message"  required><span>YES</span><input type="radio" value="false" checked name="message"><span>NO</span></div><br>';
}

$div .= '<input type="submit"  name="submit-true"><br>';
$div .= '</form>';
return $div;
