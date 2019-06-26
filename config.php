#!/usr/bin/env php
<?php

$config_dir = '/opt/factorio/config/';

function get_config( $dir, $name ) {

  $f = $dir . $name;
  if ( !file_exists( $f )) { return null; }
  return json_decode( file_get_contents( $f ), true );

}

function set_config( $dir, $name, $value ) {

  $f = $dir . $name;
  echo 'Writing ' . $f . '...' . PHP_EOL;
  $j = json_encode( $value, JSON_PRETTY_PRINT );
  return file_put_contents( $f, $j );
}

# ---

$f = 'server-settings.json';
$j = get_config( $config_dir, $f );

$j['name'] = 'The [color=green]Example[/color] Weekly Factory';

$j['description'] = '[item=oil-refinery] [color=green]Example[/color] Community Factorio Server [color=red]Weekly Reset[/color]';

$j['tags'] = [
  '[color=green]Example Server[/color]',
  '[color=red]Achievements Enabled[/color]',
  '[color=yellow]Resets Weekly on Tuesday, 7:00am US/Eastern[/color]',
  'Direct - [color=blue]factorio-weekly.example.com[/color]',
  'Discord - [color=blue]https://discord.gg/xxxxxxx[/color]',
  '[color=white]Vanilla[/color]',
  '[color=purple]Weekly Script by Caaaaarrrrlll[/color]',
];

$j['username'] = 'Caaaaarrrrlll';
$j['password'] = 'xxxxxxxxxxxxxxxx';
$j['token'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

$j['game_password'] = '';

$j['autosave_interval'] = 30;

//set_config( $config_dir, $f, $j );

# ---

$f = 'map-gen-settings.json';
$j = get_config( $config_dir, $f );

$j['starting_area'] = mt_rand( 1, 3 );

$j['autoplace_controls']['coal']['frequency'] = mt_rand( 1, 6 );
$j['autoplace_controls']['coal']['size'] = mt_rand( 3, 6 );
$j['autoplace_controls']['coal']['richness'] = mt_rand( 3, 6 );

$j['autoplace_controls']['stone']['frequency'] = mt_rand( 1, 6 );
$j['autoplace_controls']['stone']['size'] = mt_rand( 3, 6 );
$j['autoplace_controls']['stone']['richness'] = mt_rand( 3, 6 );

$j['autoplace_controls']['copper-ore']['frequency'] = mt_rand( 1, 6 );
$j['autoplace_controls']['copper-ore']['size'] = mt_rand( 3, 6 );
$j['autoplace_controls']['copper-ore']['richness'] = mt_rand( 3, 6 );

$j['autoplace_controls']['iron-ore']['frequency'] = mt_rand( 1, 6 );
$j['autoplace_controls']['iron-ore']['size'] = mt_rand( 3, 6 );
$j['autoplace_controls']['iron-ore']['richness'] = mt_rand( 3, 6 );

$j['autoplace_controls']['uranium-ore']['frequency'] = mt_rand( 1, 6 );
$j['autoplace_controls']['uranium-ore']['size'] = mt_rand( 3, 6 );
$j['autoplace_controls']['uranium-ore']['richness'] = mt_rand( 3, 6 );

$j['autoplace_controls']['crude-oil']['frequency'] = mt_rand( 1, 6 );
$j['autoplace_controls']['crude-oil']['size'] = mt_rand( 3, 6 );
$j['autoplace_controls']['crude-oil']['richness'] = mt_rand( 3, 6 );

$j['autoplace_controls']['trees']['frequency'] = mt_rand( 1, 3 );
$j['autoplace_controls']['trees']['size'] = mt_rand( 1, 4 );
$j['autoplace_controls']['trees']['richness'] = mt_rand( 1, 4 );

/*
$j['autoplace_controls']['enemy-base']['frequency'] = mt_rand( 1, 6 );
$j['autoplace_controls']['enemy-base']['size'] = mt_rand( 1, 6 );
$j['autoplace_controls']['enemy-base']['richness'] = mt_rand( 1, 6 );
*/

$j['cliff_settings']['richness'] = mt_rand( 0, 2 );

$j['property_expression_names']['elevation'] = '0_17' . (
  mt_rand( 0, 1 ) === 1 ? '-island' : ''
);

//set_config( $config_dir, $f, $j );

# ---

$f = 'server-adminlist.json';
$j = get_config( $config_dir, $f );

if ( $j === null ) { $j = array(); }

// the server-adminlist.json can be modified in-game by typing /admin,
// let's ensure someone is always an admin in case they get removed.
$static_admins = array(
  'Caaaaarrrrlll',
);

// collect admins that are present, game is case insensitive but php is not
$static_admins_found = array();
foreach ( $static_admins as $static_admin ) {
  foreach ( $j as $admin ) {
    if ( strtolower( $static_admin ) == strtolower( $admin )) {
      $static_admins_found[] = $static_admin;
    }
  }
}

// add missing admins
foreach ( $static_admins as $admin ) {
  if ( !in_array( $admin, $static_admins_found )) {
    $j[] = $admin;
  }
}

sort( $j );

set_config( $config_dir, $f, $j );

# ---
