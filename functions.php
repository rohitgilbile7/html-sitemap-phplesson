<?php
function Sitemap_menu() {
    $appName = 'html-sitemap';
    $appID = 'html-sitemap-phplesson';
    add_menu_page($appName, $appName, 'administrator', $appID . '-top-level', 'pluginScreen');
}
function my_enqueue($hook) {
      wp_enqueue_script('dashboard');
    wp_enqueue_style('style', plugins_url('phplesson.css', __FILE__));
}
function pluginScreen() {
    global $wpdb;
    $table = $wpdb->prefix . 'html_sitemap_phplesson';
    $row = $wpdb->get_row("SELECT * FROM $table ");
    if (!empty($wpdb->last_result)):
        $pages = explode(",", $row->sitemap_pages);
        $Allpost = explode(",", $row->sitemap_post);
        $category = explode(",", $row->sitemap_category);
    endif;
    ?>
        <div id="poststuff">
        <div id="post-body" class="metabox-holder columns-1">
            <div id="postbox-container-1" class="postbox-container">
                        <div id="side-sortables" class="meta-box-sortables ui-sortable" style="">
                                    <span> <h4> How To Use: Add shortcode <strong>  [html-sitemap] </strong>to your page.  </span> </h4>
                            <!-- Category Section -->
                    <div id="submitdiv" class="postbox">
                        <div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span>Hide Category from sitemap</span></h3>
                        <div class="inside">
                            <form method="post" id="categoryform"> 
                                <div class="submitbox" id="submitpost">

                                            <div id="minor-publishing">
                                            <div id="minor-publishing-actions">
                                                <div id="save-action">
                                                    <span class="spinner"> </span>
                                                </div>

                                                    <div class="clear"></div>
                                            </div><!-- #minor-publishing-actions -->
                                            <div class="misc-pub-section misc-pub-post-status ">
                                                <p><strong>Category</strong></p>
                                                <?php
                                                $args = array(
                                                    'hide_empty' => FALSE,
                                                    'exclude' => '', /* ID of categories to be excluded, separated by comma */
                                                    'post_type' => 'post',
                                                    'post_status' => 'publish'
                                                );
                                                $cats = get_categories($args);
                                                ?>
                                                <select name="postcategory[]" id="postcategory" class="columns-1 postcategory" multiple="">
                                                    <option value="0">None</option>

                                                    <?php
                                                    foreach ($cats as $cat) :
                                                        if (in_array_r($cat->term_id, $category)) : echo '<option value="' . $cat->term_id . ' " selected>' . $cat->cat_name . ' </option>';
                                                        else: echo '<option value="' . $cat->term_id . '">' . $cat->cat_name . '</option>';
                                                        endif;

                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div><!-- .misc-pub-section -->

                                                <div class="clear"></div>
                                        </div>

                                            <div id="major-publishing-actions">
                                            <div id="publishing-action">
                                                <span class="spinner"></span>
                                                <input name="original_publish" type="hidden" id="original_publish" value="Update">
                                                <input name="save" type="submit" class="button button-primary button-large" id="" accesskey="p" value="Update">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    </forlm>
                            </div>
                        </div>
                                <!--post section -->

                                    <div id="pageparentdiv" class="postbox closed">
                                        <div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span>Hide post from sitemap</span></h3>
                            <div class="inside">
                                <form method="post" id="PostForm">
                                    <p><strong>Post</strong></p>
                                    <?php
                                    $args = array(
                                        'offset' => 0,
                                        'category' => '',
                                        'category_name' => '',
                                        'orderby' => 'date',
                                        'order' => 'DESC',
                                        'include' => '',
                                        'exclude' => '',
                                        'meta_key' => '',
                                        'meta_value' => '',
                                        'post_type' => 'post',
                                        'post_mime_type' => '',
                                        'post_parent' => '',
                                        'author' => '',
                                        'post_status' => 'publish',
                                        'suppress_filters' => true
                                    );
                                    $posts_array = get_posts($args);
                                    ?>
                                    <label class="screen-reader-text" for="parent_id">post</label>
                                    <select name="post[]" id="post" multiple="">
                                        <option value="">None</option>
                                        <?php
                                        foreach ($posts_array as $post) :
                                            if (in_array_r($post->ID, $Allpost)) : echo '<option value="' . $post->ID . '" selected>' . $post->post_title . ' </option>';
                                            else:
                                                echo '<option value="' . $post->ID . '">' . $post->post_title . ' </option>';
                                            endif;

                                        endforeach;
                                        ?>
                                    </select>
                                    <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <span class="spinner"></span>
                                            <input name="original_publish" type="hidden" id="original_publish" value="Update">
                                            <input name="save" type="submit" class="button button-primary button-large" id="" accesskey="p" value="Update">
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="postimagediv" class="postbox closed">
                            <div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span>Hide pages from sitemap</span></h3>
                            <div class="inside">
                                <form method="post" id="pageForm">
                                    <?php
                                    $args = array(
                                        'sort_order' => 'asc',
                                        'sort_column' => 'post_title',
                                        'hierarchical' => 1,
                                        'exclude' => '',
                                        'include' => '',
                                        'meta_key' => '',
                                        'meta_value' => '',
                                        'authors' => '',
                                        'child_of' => 0,
                                        'parent' => -1,
                                        'exclude_tree' => '',
                                        'number' => '',
                                        'offset' => 0,
                                        'post_type' => 'page',
                                        'post_status' => 'publish'
                                    );
                                    $pages_array = get_pages($args);
                                    ?>
                                    <label class="screen-reader-text" for="parent_id">pages</label>
                                    <select name="pages" id="pages" multiple="">
                                        <option value="">None</option>

                                        <?php
                                        foreach ($pages_array as $page) :
                                            if (in_array_r($page->ID, $pages)) : echo '<option value="' . $page->ID . '" selected>' . $page->post_title . ' </option>';
                                            else:echo '<option value="' . $page->ID . '">' . $page->post_title . ' </option>';
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>
                                    <div id="major-publishing-actions">
                                        <div id="publishing-action">
                                            <span class="spinner"></span>
                                            <input name="original_publish" type="hidden" id="original_publish" value="Update">
                                            <input name="save" type="submit" class="button button-primary button-large" id="" accesskey="p" value="Update">
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div></div>

                </div><!-- /post-body -->
            <br class="clear">
        </div>            <?php
    }

    function save_Category() {

        global $wpdb;
        $id = lastID();
        $catID = $_POST['postcategory'];
        if (!empty($catID)) {
        if (sizeof($catID) > 1):
            $category = implode(",", $catID);
        else:
            $category = implode("", $catID);
        endif;
        $result = $wpdb->update(SITEMAP_TABLE, array('sitemap_category' => $category), array('sitemap_id' => $id));
        if ($result):
            echo _e('Record updated succesfully');
        else:
            echo $wpdb->last_query; // 'Please try again ';
        endif;
    }
    else {
        echo 'please select categoory';
    }
    wp_die();
}

add_action('wp_ajax_submit_Category', 'save_Category');

function save_post() {

    global $wpdb;
    $id = lastID();
    $postID = $_POST['publishpost'];
    if (!empty($postID)) {
        if (sizeof($postID) > 1):
            $post = implode(",", $postID);
        else:
            $post = implode("", $postID);
        endif;
        $result = $wpdb->update(SITEMAP_TABLE, array('sitemap_post' => $post), array('sitemap_id' => $id));
        if ($result):
            echo _e('Record updated succesfully');
        else:
            echo 'Please try again ';
        endif;
    }else {
        echo 'Please select post';
    }
    wp_die();
}

add_action('wp_ajax_submit_Post', 'save_post');

function save_pages() {

    global $wpdb;
    $id = lastID();
    $pageID = $_POST['publishpages'];
    if (!empty($pageID)) {
        if (sizeof($pageID) > 1):
            $page = implode(",", $pageID);
        else:
            $page = implode("", $pageID);
        endif;
        $result = $wpdb->update(SITEMAP_TABLE, array('sitemap_pages' => $page), array('sitemap_id' => $id));
        if ($result):
            echo _e('Record updated succesfully');
        else:
            echo 'Please try again ';
        endif;
    }
    else {
        echo 'Please select page';
    }
    wp_die();
}

add_action('wp_ajax_submit_Pages', 'save_pages');

function lastID() {
    global $wpdb;
    //   $table = $wpdb->prefix . 'html_sitemap_phplesson';
    $mylink = $wpdb->get_row(" SELECT sitemap_id FROM " . SITEMAP_TABLE);
    return $mylink->sitemap_id;
    wp_die();
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}
function phplesson_html_sitemap() {
    global $wpdb;
    $row = $wpdb->get_row("SELECT * FROM  " . SITEMAP_TABLE);
    if (!empty($wpdb->last_result)):
        $Hidepages = $row->sitemap_pages;
        $Hidepost = $row->sitemap_post;
        $Hidecategory = $row->sitemap_category;
    else:
        $Hidepages = '';
        $Hidepost = '';
        $Hidecategory = '';
    endif;
    $spp_sitemap = '';
    $args = array(
        'exclude' => $Hidecategory,
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $spp_sitemap .='<div class="divleft"><div class="scontent">';
    $spp_sitemap .= '<h4>Category</h4>';
    $spp_sitemap .= '<ul class="sitemapul">';
    $cats = get_categories($args);
    foreach ($cats as $cat) :
        $spp_sitemap .= '<li class="pages-list"><a href="' . get_category_link($cat->term_id) . '">' . $cat->cat_name . '</a></li>';
    endforeach;
    $spp_sitemap .= '</ul>';

    $pages_args = array(
        'exclude' => $Hidepages,
        'post_type' => 'page',
        'post_status' => 'publish'
    );
    $spp_sitemap .= '<h4>Pages</h4>';
    $spp_sitemap .= '<ul class="sitemapul">';
    $pages = get_pages($pages_args);
    foreach ($pages as $page) :
        $spp_sitemap .= '<li class="pages-list"><a href="' . get_page_link($page->ID) . '" rel="bookmark" class="linktag">' . $page->post_title . '</a></li>';
    endforeach;
    $spp_sitemap .= '</ul>';
    $spp_sitemap .= '<h4>Tags</h4>';
    $spp_sitemap .= '<ul class="sitemapul">';

    $tags = get_tags();
    foreach ($tags as $tag) {
        $tag_link = get_tag_link($tag->term_id);
        $spp_sitemap .= "<li class='pages-list'><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
        $spp_sitemap .= $tag->name . '</a></li>';
    }
    $spp_sitemap .= '</ul>';

    $spp_sitemap .='</div></div>';
    $spp_sitemap .='<div class="divright"><div class="scontent">';
    $spp_sitemap .= '<h4>All Articles </h4>';
    $spp_sitemap .= '<ul class="sitemapul">';

    $args = array(
        'offset' => 0,
        'category' => '',
        'category_name' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'include' => '',
        'exclude' => $Hidepost,
        'meta_key' => '',
        'meta_value' => '',
        'post_type' => 'post',
        'post_mime_type' => '',
        'post_parent' => '',
        'author' => '',
        'post_status' => 'publish',
        'suppress_filters' => true
    );
    $spp_sitemap .= '</ul>';
    $posts_array = get_posts($args);
    foreach ($posts_array as $spost):
        $category_detail = get_the_category($spost->ID);
        $spp_sitemap .='<div class="blockArticle">
            <h3><a href="' . $spost->guid . '" rel="bookmark" class="linktag">' . $spost->post_title . '</a> </h3>
            <span class="dateArt">' . date("F j, Y", strtotime($spost->post_date)) . '</span>
            <span class="categoryArt"><a href="' . get_category_link($category_detail[0]->term_id) . '" class="linktag" >' . $category_detail[0]->name . '</a></span>
            <span class="commentsArt"><a href="' . $spost->guid . '#respond' . '" rel="bookmark" class="linktag"><strong>' . $spost->comment_count . '</strong>comment</a></span>
        </div>';
    endforeach;
    $spp_sitemap .='</div></div>';
    return $spp_sitemap;
}
add_shortcode('html-sitemap', 'phplesson_html_sitemap');
