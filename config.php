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

array_shift( $argv ); // pop prog name off array
$keep_map_settings = false;

foreach ( $argv as $arg ) {
  $equals = strpos( $arg, '=' );
  if ( $equals === false ) {
    $key   = $arg;
    $value = $arg;
  } else {
    $key   = substr( $arg, 0, $equals );
    $value = substr( $arg, $equals + 1 );
  }

  if ( strtolower( $key ) == 'keep_map_settings' ) {
    $keep_map_settings = $value;
  }
}

# ---

if ( !$keep_map_settings ) {
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

  $j['autoplace_controls']['trees']['frequency'] = mt_rand( 100, 200 ) / 100;
  $j['autoplace_controls']['trees']['size'] = mt_rand( 100, 200 ) / 100;
  $j['autoplace_controls']['trees']['richness'] = mt_rand( 100, 200 ) / 100;

  /*
  $j['autoplace_controls']['enemy-base']['frequency'] = mt_rand( 1, 6 );
  $j['autoplace_controls']['enemy-base']['size'] = mt_rand( 1, 6 );
  $j['autoplace_controls']['enemy-base']['richness'] = mt_rand( 1, 6 );
  */

  $j['cliff_settings']['richness'] = mt_rand( 0, 2 );

  $j['property_expression_names']['elevation'] = '0_17' . (
    mt_rand( 0, 1 ) === 1 ? '-island' : ''
  );

  set_config( $config_dir, $f, $j );
}

# ---

function ore_ratio( &$keys ) {
  $freq     = $keys['frequency'];
  $size     = $keys['size'];
  $richness = $keys['richness'];
  return $freq . '/' . $size . '/' . $richness;
}

$f = 'server-settings.json';
$j = get_config( $config_dir, $f );
$mapgen = get_config( $config_dir, 'map-gen-settings.json' );

$j['name'] = 'The [color=green]Example[/color] Weekly Factory';

$j['description'] = '[item=oil-refinery] [color=green]Example[/color] Community Factorio Server [color=red]Weekly Reset[/color]';

$j['tags'] = [
  '[color=green]Example Server[/color]',
  '[color=red]Achievements Enabled[/color]',
  '[font=default-bold]Direct[/font] - [color=blue]factorio-weekly.example.com[/color]',
  '[font=default-bold]Discord[/font] - [color=blue]https://discord.gg/xxxxxxx[/color]',
  '[color=white]Vanilla[/color]',
  '[color=purple]Weekly Script by Caaaaarrrrlll[/color]',
  '[color=yellow]~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~[/color]',
  '   [color=yellow]Resets Weekly on Tuesday, 7:00am US/Eastern[/color]   ',
  '[color=yellow]~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~[/color]',
  '[color=red][font=default-bold]Settings of the Week:[/font][/color] (Freq./Size/Richness)',
  ' • [font=default-bold]Starting area:[/font] ' . $mapgen['starting_area'],
  ' • [font=default-bold]Coal:[/font] ' . ore_ratio( $mapgen['autoplace_controls']['coal'] ),
  ' • [font=default-bold]Stone:[/font] ' . ore_ratio( $mapgen['autoplace_controls']['stone'] ),
  ' • [font=default-bold]Copper:[/font] ' . ore_ratio( $mapgen['autoplace_controls']['copper-ore'] ),
  ' • [font=default-bold]Iron:[/font] ' . ore_ratio( $mapgen['autoplace_controls']['iron-ore'] ),
  ' • [font=default-bold]Uranium:[/font] ' . ore_ratio( $mapgen['autoplace_controls']['uranium-ore'] ),
  ' • [font=default-bold]Oil:[/font] ' . ore_ratio( $mapgen['autoplace_controls']['crude-oil'] ),
  ' • [font=default-bold]Trees:[/font] ' . ore_ratio( $mapgen['autoplace_controls']['trees'] ),
  ' • [font=default-bold]Enemies:[/font] ' . ore_ratio( $mapgen['autoplace_controls']['enemy-base'] ),
  ' • [font=default-bold]Cliffs:[/font] ' . $mapgen['cliff_settings']['richness'],
  ' • [font=default-bold]Island:[/font] ' . ( stripos( $mapgen['property_expression_names']['elevation'], 'island' ) !== false ? 'yes' : 'no' ),
];

$j['username'] = 'Caaaaarrrrlll';
$j['password'] = 'xxxxxxxxxxxxxxxx';
$j['token'] = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

$j['game_password'] = '';

$j['autosave_interval'] = 30;

set_config( $config_dir, $f, $j );

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
