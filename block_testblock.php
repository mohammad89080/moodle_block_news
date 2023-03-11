<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Form for editing HTML block instances.
 *
 * @package   block_testblock

 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_testblock extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_testblock');
    }

 

    function get_content() {
        global $DB;
        global $OUTPUT;
        global $CFG;

        $sql = "SELECT m.id, m.title,m.content,m.image, m.timecreated, m.categoryid, u.category_name
              FROM {local_news} m  LEFT JOIN {local_news_categories} u
              ON u.id = m.categoryid ORDER BY timecreated DESC  LIMIT 5";
        $newsall = $DB->get_records_sql($sql);

//        $table = new html_table();
//        $table->head = array('ID', 'Title', 'Content', 'Timecreated','Image','Category Name');
//        $table->data = array();
//    $data=array();
        $i=0;
        foreach ($newsall as $news) {
           $data[] = array(
              'id'=>  $news->id,
               'title'=>  $news->title,
               'content'=> $news->content,
               'timecreated'=> userdate($news->timecreated),
               'image'=>  $news->image,
               'category_name'=> $news->category_name
            );
        }
//        die(print_r($data[0]['category_name']));
//        die(print_r($data));
//        die(print_r($data));
//        die( print_r($data));
//        $output = html_writer::table($table);
//        $templatecontext = (object) [
//            'table' => $data,
//        ];

//        $data1 = array('table' => $data);
        $test=array('wwww','w222','wweerrr');
        $tempalteContent=(object)[
          'data'=> $data
        ];
//        array('data' => $template_data)
//        die( print_r($data));

        $s=$OUTPUT->render_from_template('block_testblock/display',  $tempalteContent);
        $this->content = new stdClass;
        $this->content->text =$s;
//        $this->content->footer = 'this is footer';


        return $this->content;
    }




  
   
}
