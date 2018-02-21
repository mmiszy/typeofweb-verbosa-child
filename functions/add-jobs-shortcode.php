<?php

include_once(ABSPATH . WPINC . '/feed.php');

if (!class_exists('SimplePie', false)) {
    require_once(ABSPATH . WPINC . '/class-simplepie.php');
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

class SimplePieRemoteOkJobs extends SimplePie_Item {
    function get_company($format = false) {
        $company = $this->get_item_tags('', 'company');
        return $company[0]['data'];
    }
    function get_image($format = false) {
        $image = $this->get_item_tags('', 'image');
        return $image[0]['data'];
    }
    function get_tags($format = false) {
        $tags = $this->get_item_tags('', 'tags');
        return $tags[0]['data'];
    }
}

class SimplePieWeworkremotelyJobs extends SimplePie_Item {
}

class TypeofwebJob {
    public $date;
    public $id;
    public $title;
    public $tags;
    public $image;
    public $permalink;
    public $company;
    public $description;
}

function sortFunction($a, $b) {
    if ($a == $b) {
        return 0;
    }

    return $a < $b ? 1 : -1;
}

function array_uniqu_tags($tags) {
    return array_intersect_key(
        $tags,
        array_unique(
            array_map(
                function ($tag) {
                    $newTag = strtolower($tag);
                    // normalize nodejs and node.js to just "node"
                    $normalizedTag = preg_replace('/\\b(\\w+)(\\.?JS)\\b/i', '$1', $newTag);
                    return empty($normalizedTag) ? $newTag : $normalizedTag;
                },
                $tags
            )
        )
    );
}

function array_unique_jobs($jobs) {
    return array_intersect_key(
        $jobs,
        array_unique(
            array_map(
                function ($job) { return $job->company . '|' . $job->title; },
                $jobs
            )
        )
    );
}

function typeofweb_generate_jobs_html($jobs) {
    $return = '';

    $return .= '<table class="job-offer">';
    $return .= '<tbody>';
    foreach($jobs as $job) {
        $return .= '<tr itemscope="" itemtype="http://schema.org/JobPosting" id="remoteok-' . esc_attr($job->id) .'">';

        $job->date->setTimezone(new DateTimeZone('Europe/Warsaw'));

        $return .= '<td>
        <meta itemprop="datePosted" content="' . $job->date->format(DateTime::ATOM) . '" />
        <meta itemprop="workHours" content="Flexible" />
        <meta itemprop="jobLocation" content="Remote" />
        <meta itemprop="remote-friendly" content="True" />
        <meta itemprop="remote" content="True" />
        <img src="' . esc_attr($job->image) . '" itemprop="image"><span class="image-placeholder"></span>
        </td>';
        $return .= '<td><a href="' . esc_attr($job->permalink) . '" itemprop="url" target="_blank" rel="noopener nofollow"><h2 itemprop="title">' . wp_strip_all_tags($job->title) . '</h2></a></td>';
        $return .= '<td><h3 itemprop="hiringOrganization"><span itemprop="name">' . wp_strip_all_tags($job->company) . '</span></h3></td>';
        $return .= '<td class="visuallyhidden" itemprop="description">' . wp_strip_all_tags($job->description) . '</td>';
        $return .= '<td itemprop="skills">' . $job->tags . '</td>';
        $return .= '<td><time itemprop="datePosted" title="' . esc_attr($job->date->format('Y-m-d H:i:s')) . '" datetime="' . esc_attr($job->date->format(DateTime::ATOM)) . '"></time></td>';

        $return .= '</tr>';
    }
    $return .= '</tbody>';
    $return .= '</table>';

    return $return;
}

function typeofweb_weworkremotely_jobs() {
    $rss = fetch_feed('https://weworkremotely.com/categories/remote-programming-jobs.rss');

    if (is_wp_error($rss)) {
        return [];
    }

    $rss->set_item_class('SimplePieWeworkremotelyJobs');
    $maxitems = $rss->get_item_quantity(50); 
    $rss_items = $rss->get_items(0, $maxitems);


    $jobs = array();
    foreach ($rss_items as $item) {
        $job = new TypeofwebJob();
        $job->id = sanitize_title($item->get_id());
        $job->date = new DateTime($item->get_date(DATE_ATOM));

        $job->image = $item->get_enclosure()->get_link();
        $job->permalink = $item->get_link();
        
        $title = $item->get_title();
        $exploded_title = explode(': ', $title);

        $job->title = $exploded_title[1] ? $exploded_title[1] : $exploded_title[0];
        $job->company = $exploded_title[1] ? $exploded_title[0] : '';
        $job->description = $item->get_description();

        preg_match_all('/\\b(JavaScript|Java Script|Node\\.js|NodeJS|Node|ReactJS|React|AngularJS|Angular 4|Angular 2|Angular|HTML5|HTML|CSS3|CSS|EmberJS|Ember\\.js|Ember|React\\.js|Java|API|Ruby on Rails|Ruby|PostgreSQL|Postgres|MySQL|SQL|Unix|C++|C Plus Plus|C\\/C++|TDD)\\b/i', wp_strip_all_tags($job->title) . ' ' . wp_strip_all_tags($job->description), $output_array);

        $job->tags = implode(
            ' ',
            array_map(
                function ($tag) { return '<span>' . wp_strip_all_tags(trim($tag)) . '</span>'; },
                array_slice(
                    array_uniqu_tags($output_array[0]),
                    0,
                    5
                )
            )
        );

        array_push($jobs, $job);
    }

    return $jobs;
}

function typeofweb_remoteok_jobs() {
    $rss = fetch_feed('https://remoteok.io/remote-jobs.rss');

    if (is_wp_error($rss)) {
        return [];
    }

    $rss->set_item_class('SimplePieRemoteOkJobs');
    $maxitems = $rss->get_item_quantity(50); 
    $rss_items = $rss->get_items(0, $maxitems);

    $jobs = array();
    foreach ($rss_items as $item) {
        $job = new TypeofwebJob();
        $job->id = $item->get_id();
        $job->date = new DateTime($item->get_date(DATE_ATOM));
        $job->tags = implode(
            ' ',
            array_map(
                function ($tag) { return '<span>' . wp_strip_all_tags(trim($tag)) . '</span>'; },
                explode(
                    ',',
                    $item->get_tags()
                )
            )
        );
        $job->image = $item->get_image();
        $job->permalink = $item->get_permalink();
        $job->title = $item->get_title();
        $job->company = $item->get_company();
        $job->description = $item->get_description();
        array_push($jobs, $job);
    }

    return $jobs;
}

function typeofweb_add_jobs_shortcode( $atts ) {
	$atts = shortcode_atts(array(), $atts, 'typeofweb-jobs');

    $remoteok = array();//typeofweb_remoteok_jobs();
    $weworkremotely = typeofweb_weworkremotely_jobs();

    $all_jobs = array_unique_jobs(array_merge($remoteok, $weworkremotely));
    usort($all_jobs, 'sortFunction');

    return typeofweb_generate_jobs_html($all_jobs);
}
add_shortcode( 'typeofweb-jobs', 'typeofweb_add_jobs_shortcode' );
