<?php
/*

    TERA-DBGrabber for Grabbing Tera Database from http://tera.database.net
    Author : aancw < cacaddv[at]gmail[dot]com >

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
$url = "";

function showHelp(){
  echo "Tera Database Grabber by aancw\n\n";
  echo "Run with php TERA-DBGrabber.php http://teradatabase.net/query.php?a=value\n";
  echo "Replace value with this list without , (comma) : \n armor, crafting, enchant, jewelry, questitems, skillbook, consumables, crystals, etchings, misc, quests, skills, costumes, dye, gatherables, npcs, recipes, weapon\n";
  exit;
}

if( isset($argv[1]) )
{
  $url = $argv[1];

  if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
    showHelp();
    exit;
  }

  echo "Tera Database Grabber by aancw\n";

  echo "Please wait while grabbing data. Sometime take long time to grabbing :)\n";
  $input = file_get_contents($url);

  // Parsing Url
  $parse_url = parse_url($url, PHP_URL_QUERY);
  parse_str($parse_url, $queryValue);
  $filename = $queryValue["a"];
  $extension = ".json";
  $strip = strip_tags($input, '<br><br/>');
  $decode = html_entity_decode($strip, ENT_QUOTES, 'UTF-8');


  file_put_contents("json/" . $filename . $extension ,$decode);
  echo "Done! Data has been saved to json folder\n";
}else {
  showHelp();
}
?>
