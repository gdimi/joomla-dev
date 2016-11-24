<?php
/**
 * @copyright	Copyright (c) 2013 HyperWorks. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
//add stylesheet

$documentopap = JFactory::getDocument();
$documentopap->addStyleSheet(JURI::base() . 'modules/mod_opap/tmpl/style.css');

$lotto_data = json_decode(file_get_contents('http://applications.opap.gr/DrawsRestServices/lotto/last.json'));
$joker_data = json_decode(file_get_contents('http://applications.opap.gr/DrawsRestServices/joker/last.json'));
$kino_data = json_decode(file_get_contents('http://applications.opap.gr/DrawsRestServices/kino/last.json'));
$proto_data = json_decode(file_get_contents('http://applications.opap.gr/DrawsRestServices/proto/last.json'));

/*
stdClass Object
(
    [draw] => stdClass Object
        (
            [drawTime] => 06-11-2013T21:00:00
            [drawNo] => 1442
            [results] => Array
                (
                    [0] => 42
                    [1] => 21
                    [2] => 7
                    [3] => 12
                    [4] => 2
                    [5] => 10
                    [6] => 41
                )

        )

)*/
?>
<div id="opap_widget">
    <div>
        <span><img src="<?php echo JURI::base(); ?>modules/mod_opap/tmpl/images/lotto_logo.png" /></span>
        <div class="game-data">
            <?php echo $lotto_data->draw->drawNo; ?> κλήρωση <?php echo str_replace("-","/",substr($lotto_data->draw->drawTime,0,10)); ?>
            <span class="results">
            <?php
                foreach($lotto_data->draw->results as $key=>$result) {
                    if ($key == 6) { echo "+"; }
                    echo "<span>".$result."</span>";
                }
            ?>
            </span>
        </div>
    </div>
    <div>
        <span><img src="<?php echo JURI::base(); ?>modules/mod_opap/tmpl/images/joker_logo.png" /></span>
        <div class="game-data">
           <?php echo $joker_data->draw->drawNo; ?> κλήρωση <?php echo str_replace("-","/",substr($joker_data->draw->drawTime,0,10)); ?>
            <span class="results">
            <?php
                foreach($joker_data->draw->results as $key=>$result) {
                    if ($key == 5) { echo " Τζόκερ: "; }
                    echo "<span>".$result."</span>";
                }
            ?>
            </span>
        </div>
    </div>
    <div>
        <span><img src="<?php echo JURI::base(); ?>modules/mod_opap/tmpl/images/kino_logo.png" /></span>
        <div class="game-data">
          <?php echo $kino_data->draw->drawNo; ?> κλήρωση <?php echo str_replace("-","/",substr($kino_data->draw->drawTime,0,10)); ?>
            <span class="results">
            <?php
                foreach($kino_data->draw->results as $key=>$result) {
                    if ($key == 10) {
                        echo "<br />";
                    }
                    echo "<span>".$result."</span>";
                }
            ?>
            </span>
        </div>
    </div>
    <div>
        <span><img src="<?php echo JURI::base(); ?>modules/mod_opap/tmpl/images/proto_logo.png" /></span>
        <div class="game-data">
          <?php echo $proto_data->draw->drawNo; ?> κλήρωση <?php echo str_replace("-","/",substr($proto_data->draw->drawTime,0,10)); ?>
            <span class="results">
            <?php
                foreach($proto_data->draw->results as $key=>$result) {
                    echo "<span>".$result."</span>";
                }
            ?>
            </span>
        </div>
    </div>
</div>
